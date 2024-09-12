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
import ModalEvents from 'core/modal_events';
import Templates from 'core/templates';
import {get_string as getString} from 'core/str';
import {
    allViewsEnabled,
    anyViewsEnabled,
    getCourseId,
    getViewlist,
    setScrollTo,
    setScrollToElement,
    setViewlist,
    updateViewlist
} from 'block_disealytics/view_selection';
import {updateView} from 'block_disealytics/update_view';

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
        const infoOnViews = document.querySelector('.show-when-no-view-enabled');
        if (infoOnViews) {
            // Remove the 'hidden' class to show the message.
            infoOnViews.classList.remove('hidden');
        }
    }
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
            const noViewsParagraph = document.querySelector('.show-when-no-view-enabled');
            if (!(noViewsParagraph.classList.contains('hidden'))) {
                noViewsParagraph.classList.add('hidden');
            }
            updateSetting('toggle', 'editing');
            // Drag and Drop.
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

            // Add view button.
            const addViewButton = document.querySelector('#block_disealytics-open-add-modal');
            if (addViewButton && addViewButton.dataset.listenerAttached !== 'true') {
                addViewButton.addEventListener("click", async function() {
                    try {
                        const modal = await ModalFactory.create({
                            title: await getString('main_add_view_title', 'block_disealytics'),
                            body: await Templates.render('block_disealytics/addview_modal', {id: 6}),
                            footer: await getString('plugin-version-details', 'block_disealytics'),
                            removeOnClose: true
                        });
                        await modal.show();

                        const allViews = document.querySelector('.show-when-all-views-enabled');
                        const anyViewSelectable = document.querySelector('.show-when-any-view-selectable');

                        if (allViewsEnabled()) {
                            anyViewSelectable.classList.add('hidden');
                            allViews.classList.remove('hidden');
                        } else {
                            anyViewSelectable.classList.remove('hidden');
                            allViews.classList.add('hidden');
                        }

                        // Add EventListeners to the Buttons.
                        getViewlist().forEach(({viewname, enabled}) => {
                            const addButton = document.querySelector('.block_disealytics-add-' + viewname);
                            const viewContainer = document.querySelector('#block_disealytics-' + viewname);
                            if (addButton) {
                                if (!enabled) {
                                    addButton.classList.remove('hidden');
                                }
                                addButton.addEventListener("click", async function() {
                                    addButton.classList.add('hidden');
                                    viewContainer.parentElement.append(viewContainer);
                                    viewContainer.setAttribute('data-visible', 'true');
                                    setScrollToElement('block_disealytics-' + viewname);
                                    setScrollTo(true);
                                    const updatedViewList = updateViewlist(viewname, 'add');
                                    await updateSetting('write', 'views', JSON.stringify(updatedViewList));
                                    // This handles the information given to the user, when all views are used or not.
                                    for (const view of updatedViewList) {
                                        if (view.enabled === 0) {
                                            allViews.classList.add('hidden');
                                            anyViewSelectable.classList.remove('hidden');
                                            break;
                                        } else {
                                            allViews.classList.remove('hidden');
                                            anyViewSelectable.classList.add('hidden');
                                        }
                                    }
                                }, true);
                            }
                        });
                        // Mark the event listener as attached.
                        addViewButton.dataset.listenerAttached = 'true';
                    } catch (error) {
                        window.console.error("Failed to open the add view modal:", error);
                    }
                });
            }
        }, true);
    }
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
    // Verify deletion modal.
    const verifyDeletionButton = document.querySelector('.block_disealytics_remove_modal_' + viewname);
    if (verifyDeletionButton) {
        verifyDeletionButton.addEventListener("click", async function() {
            // Fetch necessary strings.
            const modalRemoveText1 = await getString('modal_remove_text_1', 'block_disealytics');
            const modalRemoveView = await getString(viewname, 'block_disealytics');
            const modalRemoveText2 = await getString('modal_remove_text_2', 'block_disealytics');

            // Create the modal with the custom content.
            const modal = await ModalFactory.create({
                type: ModalFactory.types.SAVE_CANCEL,
                title: await getString('modal_remove_title', 'block_disealytics'),
                body: `${modalRemoveText1} <strong>${modalRemoveView}</strong> ${modalRemoveText2}`,
                removeOnClose: true,
            });
            modal.setSaveButtonText(await getString('modal_remove_check', 'block_disealytics'));
            const saveBtn = modal.getRoot().find(modal.getActionSelector('save'));
            if (saveBtn) {
                saveBtn.removeClass('btn-primary');
                saveBtn.addClass('btn-danger');
            }
            const cancelBtn = modal.getFooter().find(modal.getActionSelector('cancel'));
            if (cancelBtn) {
                cancelBtn.css('display', 'none');
            }
            modal.show();
            modal.getRoot().on(ModalEvents.save, async function() {
                const viewContainer = document.querySelector('#block_disealytics-' + viewname);
                viewContainer.setAttribute('data-visible', 'false');
                const updatedViewList = updateViewlist(viewname, 'delete');
                await updateSetting('write', 'views', JSON.stringify(updatedViewList));
            });
        }, false);
    }

    // Toggle expansion.
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
 * Generates the information modal.
 *
 * Is called in the javascript of the main.mustache template and in the registerEventListener function.
 *
 * @param {String} viewname - The button element that triggers the modal.
 * @returns {void}
 */
export const toggleInformationModal = (viewname) => {
    const btn = document.querySelector("#block_disealytics_" + viewname + "_info_btn");
    const btnExpanded = document.querySelector("#block_disealytics_" + viewname + "_info_btn_expanded");

    if (btn) {
        btn.addEventListener('click', async function() {
            const footerContent = viewname === 'main' ?
                '<div>' + await getString('plugin-version-details', 'block_disealytics') + '</div>' :
                '';

            const modal = await ModalFactory.create({
                title: viewname === 'main' ?
                    await getString('main_help_title', 'block_disealytics') :
                    await getString(viewname, 'block_disealytics'),
                body: viewname === 'main' ?
                    await Templates.render('block_disealytics/help_modal', {id: 5}) :
                    await getString(viewname + '_help_info_text', 'block_disealytics'),
                footer: footerContent,
                removeOnClose: true
            });

            await modal.show();

            if (viewname === 'main') {
                initHelpModalAccordion();
            }
        });
    }

    if (btnExpanded) {
        btnExpanded.addEventListener('click', async function() {
            const modal = await ModalFactory.create({
                title: getString(viewname, 'block_disealytics'),
                body: getString(viewname + '_help_info_text_expanded', 'block_disealytics'),
                removeOnClose: true
            });
            modal.show();
        });
    }
};

/**
 * Generates the main config modal.
 *
 * Is called in the javascript of the main.mustache template.
 *
 * @returns {void}
 */
export const toggleMainConfigModal = () => {
    const mainConfigBtn = document.querySelector("#block_disealytics_config_menu");
    if (mainConfigBtn) {
        mainConfigBtn.addEventListener('click', async function() {
            // Create the main config modal with custom content.
            const modal = await ModalFactory.create({
                title: await getString('main_config_title', 'block_disealytics'),
                body: await Templates.render('block_disealytics/config_menu', {id: 1}),
                removeOnClose: true
            });

            // Show the modal.
            await modal.show();

            // Wait until the modal content is fully shown.
            if (modal.getRoot()) {
                const mainConsentBtn = document.querySelector("#block_disealytics_config_consent_menu");
                if (mainConsentBtn) {
                    const toggleIcon = mainConsentBtn.querySelector('i');

                    mainConsentBtn.addEventListener('click', async function() {
                        // Toggle icon classes.
                        toggleIcon.classList.remove('disea-green', 'fa-toggle-on');
                        toggleIcon.classList.add('disea-gray', 'fa-toggle-off');

                        // Set a timeout to change the classes back after 1 second.
                        setTimeout(() => {
                            toggleIcon.classList.remove('disea-gray', 'fa-toggle-off');
                            toggleIcon.classList.add('disea-green', 'fa-toggle-on');
                        }, 1000);

                        // Create and show the consent modal.
                        const consentModal = await ModalFactory.create({
                            title: await getString('consent_config_title', 'block_disealytics'),
                            body: await Templates.render('block_disealytics/config_menu_consent', {id: 2}),
                            removeOnClose: true
                        });

                        await consentModal.show();

                        // Initialize consent buttons after the consent modal is shown.
                        enableConsentButtons(consentModal);
                    });
                }
            }
        });
    }
};

export const initHelpModalAccordion = () => {
    // Attach click event to each accordion head.
    const accordion = document.getElementById('block_disealytics_info-modal-accordion');
    const accordionHeads = document.querySelectorAll('#block_disealytics_info-modal-accordion .accordion-head');
    accordionHeads.forEach((head, index) => {
        head.addEventListener('click', () => {
            toggleAccordion(accordion, index + 1);
        });
    });
};

/**
 * Toggles the visibility of an accordion content section and updates the toggle icon.
 *
 * @param {HTMLElement} element - The head element that surrounds the toggle function.
 * @param {number} index - The index of the accordion section to toggle.
 * @returns {void}
 */
export const toggleAccordion = (element, index) => {
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
};

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
 * @param {object} modal - The modal to enable the buttons for.
 * @returns {void}
 */
export const enableConsentButtons = (modal = null) => {
    document.querySelector(".disea-delete-consent-btn").addEventListener("click", function() {
        updateSetting("revoke_consent", '', "delete");
    });
    document.querySelector(".disea-save-consent-btn").addEventListener("click", function() {
        updateSetting("revoke_consent", '', '');
    });
    document.querySelector(".disea-cancel-consent-btn").addEventListener("click", function() {
        modal.destroy();
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
