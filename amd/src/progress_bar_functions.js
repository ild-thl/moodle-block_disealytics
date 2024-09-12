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

import {toggleAccordion} from "./add_interaction";
import Ajax from 'core/ajax';
import ModalFactory from 'core/modal_factory';
import Templates from "core/templates";
import {getCourseId} from "./view_selection";
import {updateView} from "./update_view";
import {get_string as getString} from 'core/str';
import ModalEvents from "core/modal_events";

let progressBarModals = [];

/**
 * Initialize the progress bar interface.
 */
export const init = () => {
    initProgressBarModal();
};

/**
 *
 */
function initProgressBarModal() {
    const progressBarModalBtns = document.querySelectorAll('.block_disealytics_open-progress-bar-modal');
    if (progressBarModalBtns) {
        progressBarModalBtns.forEach((progressBarModalBtn) => {
            progressBarModalBtn.addEventListener('click', async function() {
                const learningMaterials = await getLearningMaterials();

                const progressBarModal = await ModalFactory.create({
                    title: await getString('progress_config_title', 'block_disealytics'),
                    body: await Templates.render('block_disealytics/progress_bar_modal', learningMaterials),
                    removeOnClose: true,
                });
                progressBarModals.push(progressBarModal);
                await progressBarModal.show();
                initProgressBarModalAccordion();
                initButtonsInProgressBarModal(learningMaterials);
            });
        });
    }
}

/**
 * Initializes the progress bar modal accordion.
 */
function initProgressBarModalAccordion() {
    // Attach click event to each accordion head.
    const accordion = document.getElementById('progress-bar-accordion');
    const accordionHeads = accordion.querySelectorAll('.accordion-head');
    accordionHeads.forEach((head, index) => {
        head.addEventListener('click', () => {
            toggleAccordion(accordion, index + 1);
        });
    });
}

/**
 * Initializes event listeners for buttons in the learning material modal.
 * Manages the logic for adding, updating, deleting, and cancelling learning materials.
 * @param {array} learningMaterials
 */
function initButtonsInProgressBarModal(learningMaterials) {
    // Open help modal.
    const helpBtn = document.getElementById('block_disealytics_open-progress-bar-help-modal');

    if (helpBtn) {
        helpBtn.addEventListener('click', async() => {
            const helpModal = await ModalFactory.create({
                type: ModalFactory.types.OK,
                title: await getString('progress_config_help_title', 'block_disealytics'),
                body: await getString('learning_materials-view_help_info_text', 'block_disealytics'),
                removeOnClose: true,
            });
            progressBarModals.push(helpModal);
            await helpModal.show();
        });
    }

    // Add input.
    const addFieldBtn = document.getElementById('add-learning-material-fields');

    if (addFieldBtn) {
        addFieldBtn.addEventListener('click', async() => {
            const addLearningMaterialModal = await ModalFactory.create({
                type: ModalFactory.types.SAVE_CANCEL,
                title: await getString('progress_config_help_title', 'block_disealytics'),
                body: await Templates.render('block_disealytics/learning_material_add_inputs', learningMaterials),
                removeOnClose: true,
            });
            addLearningMaterialModal.setSaveButtonText(await getString('learning_material_save', 'block_disealytics'));
            progressBarModals.push(addLearningMaterialModal);
            addLearningMaterialModal.show();
            addLearningMaterialModal.getRoot().on(ModalEvents.save, async function() {
                const material = document.getElementById('learning-material-document');
                const currentpage = document.getElementById('learning-material-currentpage');
                const lastpage = document.getElementById('learning-material-lastpage');
                const time = document.getElementById('learning-material-expenditureoftime');
                switch (validateInputs(currentpage.value, lastpage.value, time.value, material)) {
                    case 'correct':
                        await addLearningMaterial(material, currentpage, lastpage, time);
                        break;
                    case 'document':
                        await showMessage(document.querySelector('.nodocumentselectederror'));
                        break;
                    case 'pagenumber':
                        await showMessage(document.querySelector('.pageerror'));
                        break;
                    case 'pagezero':
                        await showMessage(document.querySelector('.lastpagezeroerror'));
                        break;
                    case 'negative':
                        await showMessage(document.querySelector('.negativepageerror'));
                        break;
                    case 'beyondlimit':
                        await showMessage(document.querySelector('.pageoverflowerror'));
                        break;
                    case 'timebeyond':
                        await showMessage(document.querySelector('.expenditureoftimeoverflowerror'));
                        break;
                    case 'notanumber':
                        await showMessage(document.querySelector('.notanumbererror'));
                        break;
                }
            });
        });
    }

    // Delete input.
    const deleteButtons = document.querySelectorAll('.delete-learning-material-button');

    if (deleteButtons) {
        deleteButtons.forEach((deleteBtn, index) => {
            deleteBtn.addEventListener('click', async function() {
                    const editContainer = document.querySelectorAll('.learning-material-container')[index];
                    const id = editContainer.getAttribute('data-learningmaterialid');
                    await deleteLearningMaterial(id);
                }
            );
        });
    }

    // Edit input.
    const updateButtons = document.querySelectorAll('.update-learning-material-button');
    const editButtons = document.querySelectorAll('.edit-learning-material-button');
    const cancelUpdateButtons = document.querySelectorAll('.cancel-update-learning-material-button');

    if (editButtons) {
        editButtons.forEach((editBtn, index) => {
            editBtn.addEventListener('click', () => {
                const editContainer = document.querySelectorAll('.learning-material-container')[index];
                editContainer.classList.add('hidden');
                editContainer.nextElementSibling.classList.remove('hidden');
                const documentId = editContainer.getAttribute('data-learningmaterialid');
                storeInitialValues(documentId);
            });
        });
    }

    if (cancelUpdateButtons) {
        cancelUpdateButtons.forEach((cancelUpdateBtn, index) => {
            cancelUpdateBtn.addEventListener('click', () => {
                const editContainer = document.querySelectorAll('.learning-material-container')[index];
                editContainer.classList.remove('hidden');
                editContainer.nextElementSibling.classList.add('hidden');
                const documentId = editContainer.getAttribute('data-learningmaterialid');
                resetInputFields(documentId);
            });
        });
    }

    if (updateButtons) {
        updateButtons.forEach((updateBtn, index) => {
            updateBtn.addEventListener('click', async function() {
                    const editForm = document.querySelectorAll('.edit-learning-material-container')[index];
                    const currentpage = editForm.querySelector('.learning-material-update-currentpage');
                    const lastpage = editForm.querySelector('.learning-material-update-lastpage');
                    const time = editForm.querySelector('.learning-material-update-expenditureoftime');
                    const material = editForm.querySelector('.learning-material-document-name');
                    const id = editForm.getAttribute('data-learningmaterialid');
                    switch (validateInputs(currentpage.value, lastpage.value, time.value)) {
                        case 'correct':
                            await updateLearningMaterial(id, material, currentpage, lastpage, time);
                            editForm.classList.add('hidden');
                            editForm.previousElementSibling.classList.remove('hidden');
                            break;
                        case 'document':
                            await showMessage(document.querySelector('.learning-material-update-warning.nodocumentselectederror'));
                            break;
                        case 'pagenumber':
                            await showMessage(document.querySelector('.learning-material-update-warning.pageerror'));
                            break;
                        case 'pagezero':
                            await showMessage(document.querySelector('.learning-material-update-warning.lastpagezeroerror'));
                            break;
                        case 'negative':
                            await showMessage(document.querySelector('.learning-material-update-warning.negativepageerror'));
                            break;
                        case 'beyondlimit':
                            await showMessage(document.querySelector('.learning-material-update-warning.pageoverflowerror'));
                            break;
                        case 'timebeyond':
                            // eslint-disable-next-line max-len
                            await showMessage(document.querySelector('.learning-material-update-warning.expenditureoftimeoverflowerror'));
                            break;
                        case 'notanumber':
                            await showMessage(document.querySelector('.learning-material-update-warning.notanumbererror'));
                            break;
                    }
                }
            );
        });
    }
}

/**
 * Displays a message element for a short duration and then hides it.
 *
 * @param {HTMLElement} messageElement - The HTML element representing the message.
 * @returns {Promise<void>} A Promise that resolves after the message is hidden.
 */
const showMessage = async(messageElement) => {
    messageElement.classList.remove('hidden');
    await new Promise(resolve => setTimeout(resolve, 2000));
    messageElement.classList.add('hidden');
};

let initialValues = {};

/**
 * Stores the initial values of the input fields.
 *
 * @param {int} documentId - The unique identifier of the learning material.
 * @returns {void}
 */
function storeInitialValues(documentId) {
    initialValues = {
        currentPage: document.getElementById('learning-material-update-currentpage-' + documentId).value,
        lastPage: document.getElementById('learning-material-update-lastpage-' + documentId).value,
        expenditureOfTime: document.getElementById('learning-material-update-expenditureoftime-' + documentId).value
    };
}

/**
 * Resets the input fields to their initial values.
 *
 * @param {int} documentId - The unique identifier of the learning material.
 * @returns {void}
 */
function resetInputFields(documentId) {
    document.getElementById('learning-material-update-currentpage-' + documentId).value = initialValues.currentPage;
    document.getElementById('learning-material-update-lastpage-' + documentId).value = initialValues.lastPage;
    document.getElementById('learning-material-update-expenditureoftime-' + documentId).value = initialValues.expenditureOfTime;
}

/**
 * Closes all modals.
 */
const closeModals = () => {
    progressBarModals.forEach(modal => {
        if (modal) {
            modal.destroy();
        }
    });
};

/**
 * Retrieves learning materials from the database.
 * @returns {Promise} A Promise that resolves with the learning materials.
 */
function getLearningMaterials() {
    return new Promise((resolve, reject) => {
        Ajax.call([{
            methodname: 'block_disealytics_get_learning_materials',
            args: {
                courseid: getCourseId(),
            }
        }])[0].done(function(data) {
            resolve(data);
        }).fail(function(err) {
            reject(err);
        });
    });

}

/**
 * Validates input fields for learning materials.
 *
 * @param {number} currentpage - The value of the current page.
 * @param {number} lastpage - The value of the last page.
 * @param {number} time - The value of the time spent.
 * @param {HTMLElement} [material=null] - The learning material element.
 * @returns {string} A string indicating the validation result:
 *  - 'document': No document selected.
 *  - 'pagenumber': Current page exceeds last page.
 *  - 'pagezero': Last page is zero.
 *  - 'negative': Negative values entered.
 *  - 'beyondlimit': Page number exceeds limit.
 *  - 'timebeyond': Time exceeds limit.
 *  - 'notanumber': Non-numeric values entered.
 *  - 'correct': Inputs are valid.
 */
function validateInputs(currentpage, lastpage, time, material = null) {
    if (!(material === null)) {
        const selectedOption = material.selectedOptions[0];
        const dataDocumentSelected = selectedOption.getAttribute("data-documentselected");
        if (dataDocumentSelected === "0") {
            return "document";
        }
    }
    if (currentpage > lastpage) {
        return "pagenumber";
    }
    if (lastpage === 0) {
        return "pagezero";
    }
    if (lastpage < 0 || currentpage < 0 || time < 0) {
        return "negative";
    }
    if (lastpage > 1000 || currentpage > 1000) {
        return "beyondlimit";
    }
    if (time > 500) {
        return "timebeyond";
    }
    if (isNaN(currentpage) || isNaN(lastpage) || isNaN(time)) {
        return "notanumber";
    }
    return "correct";
}

/**
 * Adds an learning material to the system.
 *
 * @param {HTMLSelectElement} material - The material select element.
 * @param {HTMLInputElement} currentpage - The input element for current page.
 * @param {HTMLInputElement} lastpage - The input element for last page.
 * @param {HTMLInputElement} time - The input element for time expenditure.
 */
function addLearningMaterial(material, currentpage, lastpage, time) {
    Ajax.call([{
        methodname: 'block_disealytics_learning_material',
        args: {
            calltype: 'add',
            id: -1,
            courseid: getCourseId(),
            name: material.value,
            currentpage: currentpage.value,
            lastpage: lastpage.value,
            expenditureoftime: time.value,
        }
    }])[0].done(async function() {
        await updateView(getCourseId(), ['progress-bar-view']);
        await closeModals();
    }).fail(err => {
        window.console.log(err);
    });
}

/**
 * Updates an existing learning material in the system.
 *
 * @param {string} id - The unique identifier of the learning material.
 * @param {HTMLElement} material - The material element containing the updated content.
 * @param {HTMLInputElement} currentpage - The input element for current page.
 * @param {HTMLInputElement} lastpage - The input element for last page.
 * @param {HTMLInputElement} time - The input element for time expenditure.
 */
function updateLearningMaterial(id, material, currentpage, lastpage, time) {
    Ajax.call([{
        methodname: 'block_disealytics_learning_material',
        args: {
            calltype: 'update',
            id: String(id),
            courseid: getCourseId(),
            name: material.textContent,
            currentpage: currentpage.value,
            lastpage: lastpage.value,
            expenditureoftime: time.value,
        }
    }])[0].done(async function() {
        await updateView(getCourseId(), ['progress-bar-view']);
        await closeModals();
    }).fail(err => {
        window.console.log(err);
    });
}

/**
 * Deletes an existing learning material from the system.
 *
 * @param {string} id - The unique identifier of the learning material to be deleted.
 */
function deleteLearningMaterial(id) {
    Ajax.call([{
        methodname: 'block_disealytics_learning_material',
        args: {
            calltype: 'delete',
            id: id,
        }
    }])[0].done(async function() {
        await updateView(getCourseId(), ['progress-bar-view']);
        await closeModals();
    }).fail(err => {
        window.console.log(err);
    });
}
