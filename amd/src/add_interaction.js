// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Adds interactivity to view-templates and the main-template
 *
 * @module      block_disealytics/add_interaction
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import Ajax from 'core/ajax';
import ModalFactory from 'core/modal_factory';
import Templates from 'core/templates';
import {
    getCourseId,
    getViewlist,
    setScrollTo,
    setScrollToElement,
    setViewlist,
    updateViewlist
} from 'block_disealytics/view_selection';
import {anyViewsEnabled, updateView} from 'block_disealytics/update_view';

/**
 * Initializes the view functionality with the specified viewname.
 * Calls registerEventListener.
 *
 * @param {string} viewname - The viewname in the format of 'viewname-view'.
 * @returns {void}
 */
export const init = (viewname) => {
    registerEventListener(viewname);
    if (!anyViewsEnabled()) {
        const infoOnViews = document.querySelector('.show-when-no-view-exists');
        if (infoOnViews) {
            // Remove the 'hidden' class to show the message.
            infoOnViews.classList.remove('hidden');
        }
    }
    moveModalsToBodyEnd(viewname);
};

/**
 * Creates a container for modals and inserts it before the closing body tag.
 * Modals are moved into the container if they have the class 'block_disealytics-main-modal'.
 * @returns {void}
 */
export const createModalsContainer = () => {
    // Create a div to contain all modals.
    const modalsContainer = document.createElement('div');
    modalsContainer.classList.add('block_disealytics');
    modalsContainer.classList.add('block_disealytics-modals');
    // Get the reference to the closing body tag.
    const closingBodyTag = document.body.lastElementChild;
    // Insert the container before the closing body tag.
    document.body.insertBefore(modalsContainer, closingBodyTag);
    const mainModals = document.querySelectorAll('.block_disealytics-main-modal');
    if (mainModals && mainModals.length > 0) {
        mainModals.forEach((modal) => {
            modalsContainer.appendChild(modal);
        });
    }
};

/**
 * Moves specific modals with the given viewname into the modals container at the end of the body.
 * @param {string} viewname - The identifier for the modals.
 * @returns {void}
 */
export const moveModalsToBodyEnd = (viewname) => {
    const infoModal = document.getElementById(`${viewname}-info-modal`);
    const removeModal = document.getElementById(`${viewname}-remove-modal`);
    const configModals = document.querySelectorAll(`.${viewname}-config-modal`);
    const plannerModals = document.querySelectorAll('.block_disealytics-planner-event-modal');
    const modalsContainer = document.querySelector('.block_disealytics-modals');

    if (modalsContainer) {
        if (infoModal) {
            modalsContainer.appendChild(infoModal);
        }
        if (removeModal) {
            modalsContainer.appendChild(removeModal);
        }
        if (plannerModals && plannerModals.length > 0) {
            plannerModals.forEach((modal) => {
                modalsContainer.appendChild(modal);
            });
        }
        if (configModals && configModals.length > 0) {
            configModals.forEach((modal) => {
                modalsContainer.appendChild(modal);
            });
        }
    }
};

/**
 * Deletes modals within the modals container, excluding those with the class 'block_disealytics-main-modal'.
 * @returns {void}
 */
export const deleteModalsContainer = () => {
    const modalsContainer = document.querySelector('.block_disealytics-modals');
    Array.from(modalsContainer.children).forEach((child) => {
        if (!child.classList.contains('block_disealytics-main-modal')) {
            child.remove();
        }
    });
};

/**
 * Create a custom modal using a template.
 *
 * @param {string} linkToTemplate - The link to the template.
 * @param {Promise} title - The title of the modal.
 * @param {number} id - The ID parameter for the template.
 * @returns {Promise<object>} - A promise that resolves to the created modal.
 */
export const createDiseaModal = async(linkToTemplate, title, id) => {
    return await ModalFactory.create({
        title: title,
        body: Templates.render(linkToTemplate, {id: id}),
        removeOnClose: true
    });
};

/**
 * Show a modal.
 *
 * @param {object} modal - The modal to show.
 */
export const showDiseaModal = async(modal) => {
    const modalObj = await modal;
    modalObj.show();
};

/**
 * Hide a modal.
 *
 * @param {object} modal - The modal to hide.
 */
export const hideDiseaModal = async(modal) => {
    const modalObj = await modal;
    modalObj.hide();
};

/**
 * Sets up the editing mode functionality.
 * Adds event listeners to the toggle button, drag and drop functionality,
 * and add view buttons for each view in the editing mode.
 * When the toggle button is clicked, it triggers the "editing" mode update,
 * and sets up drag and drop functionality for view reordering.
 * When add view button is clicked, it adds the view to the dashboard and saves the updated view list.
 *
 * Is called in the javascript of the main.mustache template.
 *
 * @function
 * @returns {void}
 */
export const setEditingMode = () => {
    const exitEditing = document.querySelector('#block_disealytics_main_exit-edit_button');
    if (exitEditing) {
        exitEditing.addEventListener("click", function() {
            updateSetting('toggle', 'editing');
        });
    }
    const toggleButton = document.querySelector('.block_disealytics-toggle-editing');
    if (toggleButton) {
        toggleButton.addEventListener("click", function() {
            updateSetting('toggle', 'editing');
            const dropContainer = document.querySelector(".block_disealytics-drop-container");
            getViewlist().forEach(({viewname}) => {
                const viewContainer = document.querySelector('#block_disealytics-' + viewname);
                // Set up drag and drop functionality.
                viewContainer.addEventListener("dragstart", () => {
                    viewContainer.classList.add("dragging");
                });
                viewContainer.addEventListener("dragend", () => {
                    viewContainer.classList.remove("dragging");
                    // Save the new order in the database.
                    const allViewsContainer = document.querySelector(".block_disealytics-all-views-container");
                    const viewElements = [...allViewsContainer.children];
                    const updatedViews = [];
                    viewElements.forEach(viewElement => {
                        const viewname = viewElement.id.replace(/^block_disealytics-/, '');
                        if (viewElement.textContent.trim() !== '') {
                            const newView = {viewname: viewname, enabled: 1};
                            updatedViews.push(newView);
                        } else {
                            const newView = {viewname: viewname, enabled: 0};
                            updatedViews.push(newView);
                        }
                    });
                    updateSetting('write', 'views', JSON.stringify(updatedViews));
                });
                // Show/Hide edit-buttons on views.
                const editBtn = document.querySelector('.edit-button-' + viewname);
                if (editBtn) {
                    if (!editBtn.classList.contains('hidden')) {
                        editBtn.classList.add('hidden');
                    } else {
                        editBtn.classList.remove('hidden');
                    }
                }
            });
            dropContainer.addEventListener("dragover", (e) => {
                e.preventDefault();
                const afterElement = getDragAfterElement(dropContainer, e.clientY);
                const draggable = document.querySelector('.dragging');
                if (afterElement === null) {
                    dropContainer.appendChild(draggable);
                } else {
                    dropContainer.insertBefore(draggable, afterElement);
                }
            });
            if (!anyViewsEnabled()) {
                const infoOnViews = document.querySelector('.show-when-no-view-exists');
                if (infoOnViews) {
                    // Remove the 'hidden' class to show the message.
                    infoOnViews.classList.remove('hidden');
                }
            }

        }, true);
    }

    // Add EventListeners to the Buttons.
    getViewlist().forEach(({viewname, enabled}) => {
        // Check if the view is disabled
        // Add view button.
        const addButton = document.querySelector('.block_disealytics-add-' + viewname);
        const viewContainer = document.querySelector('#block_disealytics-' + viewname);
        if (addButton) {
            if (enabled === 1) {
                addButton.classList.add('hidden');
            }
            addButton.addEventListener("click", function() {
                document.querySelector('.show-when-no-view-exists').classList.add('hidden');
                addButton.classList.add('hidden');
                viewContainer.parentElement.append(viewContainer);
                viewContainer.setAttribute('data-visible', 'true');
                setScrollToElement('block_disealytics-' + viewname);
                setScrollTo(true);
                const updatedViewList = updateViewlist(viewname, 'add');
                updateSetting('write', 'views', JSON.stringify(updatedViewList));
            }, true);
        }
    });
};

/**
 * Get the element after which the dragged element should be inserted within a container.
 * The function finds the closest element based on the vertical position (y-coordinate).
 *
 * @param {HTMLElement} container - The container element containing draggable elements.
 * @param {number} y - The vertical position (y-coordinate) of the dragged element.
 * @returns {HTMLElement} The element after which the dragged element should be inserted.
 */
const getDragAfterElement = (container, y) => {
    // Get an array of draggable elements within the container (excluding the currently dragging element).
    const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')];
    // Use the `reduce` function to find the closest element based on the vertical position (y-coordinate).
    return draggableElements.reduce((closest, child) => {
        // Calculate the offset from the vertical center of each element to the dragged element's position.
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;

        // Update the closest element if the current offset is negative (above the dragged element) and
        // closer to the dragged element than the previous closest element.
        if (offset < 0 && offset > closest.offset) {
            return {offset: offset, element: child};
        } else {
            return closest;
        }
    }, {offset: Number.NEGATIVE_INFINITY}).element;
};

/**
 * Registers event listeners (for a single view) that change the user preferences.
 *
 * @param {string} viewname - The viewname in the format of 'viewname-view'.
 * @returns {void}
 */
const registerEventListener = (viewname) => {
    // Returns every delete button.
    const deleteButtons = document.querySelectorAll('.block_disealytics-delete-btn-' + viewname);
    const addButton = document.querySelector('.block_disealytics-add-' + viewname);
    const viewContainer = document.querySelector('#block_disealytics-' + viewname);
    if (deleteButtons) {
        [].forEach.call(deleteButtons, (deleteButton) => {
            // Event to remove the view.
            deleteButton.addEventListener("click", function() {
                viewContainer.setAttribute('data-visible', 'false');
                addButton.classList.remove('hidden');
                const updatedViewList = updateViewlist(viewname, 'delete');
                updateSetting('write', 'views', JSON.stringify(updatedViewList));
            }, false);
        });
    }
    // Returns every toggle button.
    const toggleExpansionButtons = document.querySelectorAll('.block_disealytics-toggle-expansion-btn-' + viewname);
    [].forEach.call(toggleExpansionButtons, (e) => {
        e.addEventListener("click", function() {
            setScrollTo(true);
            updateSetting("write", 'expanded_view', viewname);
        }, false);
    });
    toggleInformationModal(viewname);
    setCourseCategory(viewname);
    toggleViewmodeAccordion(viewname);
};

/**
 * Calculates the position for the information window.
 *
 * Is called in the javascript of the main.mustache template and in the registerEventListener function.
 *
 * @param {string} viewname - The viewname in the format of 'viewname-view'.
 * @returns {void}
 */
export const toggleInformationModal = (viewname) => {
    const informationButton = document.querySelector('.info-btn-' + viewname);
    const outerWindow = document.querySelector('.outer-modal-' + viewname);

    if (informationButton && outerWindow) {
        informationButton.addEventListener("click", function() {
            // Toggle the 'show' class to display or hide the popup.
            outerWindow.classList.toggle('show');
        });
    }
};

export const changeToggleIcon = () => {
    const toggleLink = document.querySelector('#block_disealytics_config_consent_menu');
    const toggleIcon = toggleLink.querySelector('i');

    if (toggleLink && toggleIcon) {
        toggleLink.addEventListener("click", function() {
            toggleIcon.classList.remove('disea-green');
            toggleIcon.classList.remove('fa-toggle-on');
            toggleIcon.classList.add('disea-gray');
            toggleIcon.classList.add('fa-toggle-off');

            // Set a timeout to change the classes back after 1 second.
            setTimeout(function() {
                toggleIcon.classList.remove('disea-gray');
                toggleIcon.classList.remove('fa-toggle-off');
                toggleIcon.classList.add('disea-green');
                toggleIcon.classList.add('fa-toggle-on');
            }, 1000);
        });
    }
};

/**
 * Toggles the visibility of an accordion content section and updates the toggle icon.
 *
 * @param {HTMLElement} element - The head element that surrounds the toggle function.
 * @param {number} index - The index of the accordion section to toggle.
 * @returns {void}
 */
export function toggleAccordion(element, index) {
    const content = element.querySelector(`#content-${index}`);
    const icon = element.querySelector(`#icon-${index}`);

    if (content.classList.contains('active')) {
        // Fold the content if it's open.
        content.classList.remove('active');
        icon.className = "fa fa-chevron-down accordion-icon";
    } else {
        // Unfold the content if it's closed.
        content.classList.add('active');
        icon.className = "fa fa-chevron-up accordion-icon";
    }
}

/**
 * Retrieves the trimmed value of an HTML element by its ID.
 *
 * @function
 * @name getValueById
 * @param {string} id - The ID of the HTML element.
 * @returns {string} - The trimmed value of the specified element.
 */
export function getValueById(id) {
    return document.getElementById(id).value.trim();
}

/**
 * Makes an AJAX call to change a user preference, then calls a view update.
 *
 * @param {string} updatetype - The type of update to perform (set, toggle, expand).
 * @param {string} setting - Determines which and how a user preference should be changed.
 * @param {string} val tmp.
 * @returns {void}
 */
export const updateSetting = (updatetype, setting, val = undefined) => {
    let args = {
        info: {
            action: updatetype,
            name: setting,
        }
    };
    if (val !== undefined) {
        args.info.value = val;
    }
    Ajax.call([{
        methodname: 'block_disealytics_write_user_preference',
        args,
    }
    ])[0].done(async function(response) {
        // Remove contents of the modal container.
        await deleteModalsContainer();
        if (setting === 'viewmode' || setting === 'editing') {
            let views = getViewlist().filter((e) => e.enabled === 1).map((e) => e.viewname);
            await updateView(getCourseId(), views);
        } else {
            if (setting === 'views') {
                const data = JSON.parse(response);
                setViewlist(JSON.parse(data.setting));
                await updateView(getCourseId(), getViewlist());
            } else if (setting === 'expanded_view') {
                await updateView(getCourseId(), [val]);
            } else {
                await updateView(getCourseId(), undefined);
            }
        }
        if (updatetype === 'select_category') {
            await updateView(getCourseId(), [setting]);
        }
        if (updatetype === "revoke_consent") {
            location.reload();
        }
    }).fail(function(err) {
        window.console.log(err);
    });
};

/**
 * Adds an EventListener to the viewmode dropdown.
 *
 * @returns {void}
 */
export const enableViewmodeDropdown = () => {
    document.querySelector(".main-viewmode-selection").addEventListener("change", function() {
        let select = document.querySelector(".main-viewmode-selection");
        const viewmodeLabel = document.querySelector(".main-viewmode-label");
        if (viewmodeLabel) {
            updateSetting("write", 'viewmode', select.value);
        }
    });
};

/**
 * Adds an EventListener to the consent buttons.
 *
 * @returns {void}
 */
export const enableConsentButtons = () => {
    document.querySelector(".disea-delete-btn").addEventListener("click", function() {
        updateSetting("revoke_consent", '', "delete");
    });
    document.querySelector(".disea-save-btn").addEventListener("click", function() {
        updateSetting("revoke_consent", '', '');
    });
};


export const setCourseCategory = (viewname) => {
    const courseCategories = document.querySelectorAll(".course-category-global-item-" + viewname);

    courseCategories.forEach(category => {
        category.addEventListener("click", function() {
            const selectedCategory = this.textContent.trim();
            updateSetting("select_category", viewname, selectedCategory);
        });
    });
};

export const toggleViewmodeAccordion = (viewname) => {
    const accordionIcons = document.querySelectorAll('.course-category-icon-' + viewname);

    accordionIcons.forEach(icon => {
        if (icon) {
            const container = icon.closest('.accordion-head-course-category-' + viewname);
            if (container) {
                icon.addEventListener('click', (event) => {
                    event.stopPropagation(); // Prevent the click from reaching the container
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');

                    const panelBody = container.nextElementSibling;
                    panelBody.classList.toggle('hidden');
                });
                container.addEventListener('click', () => {
                    // Handle the click on the container (excluding the icon)
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');

                    const panelBody = container.nextElementSibling;
                    panelBody.classList.toggle('hidden');
                });
            }
        }
    });
};

export const toggleAccordionAV = (icon) => {
    const coursename = icon.dataset.coursename;
    const table = document.querySelector(`.table-of-assignments[data-coursename="${coursename}"]`);


    if (icon.classList.contains('active')) {
        // Fold the content if it's open.
        icon.classList.remove('active');
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        table.classList.remove('hidden');
    } else {
        // Unfold the content if it's closed.
        icon.classList.add('active');
        icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
        table.classList.add('hidden');
    }
};

