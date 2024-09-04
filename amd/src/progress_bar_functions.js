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
import {getCourseId} from "./view_selection";
import {updateView} from "./update_view";
import ProgressBarModal from "./progress_bar_modal";

/**
 * Initialize the progress bar interface.
 */
export const init = () => {
    const openProgressBarModalBtn = document.getElementById('block_disealytics_open-progress-bar-modal');

    if (openProgressBarModalBtn) {
        openProgressBarModalBtn.addEventListener('click', async() => {
            const modal = await ModalFactory.create({
                type: ProgressBarModal.TYPE,
                removeOnClose: true,
            });

            modal.show();

            initProgressBarModalAccordion();
            initButtonsInOptionalInputModal();
        });
    }
};

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
 * Initializes event listeners for buttons in the optional input modal.
 * Manages the logic for adding, updating, deleting, and cancelling optional inputs.
 */
function initButtonsInOptionalInputModal() {
    // Add input.
    const addContainer = document.querySelector('.add-optional-input-container');
    const addFieldBtn = document.getElementById('add-optional-input-fields');
    const addBtn = document.getElementById('add-optional-input-button');
    const cancelBtn = document.getElementById('cancel-optional-input-button');

    if (addFieldBtn) {
        addFieldBtn.addEventListener('click', () => {
            addFieldBtn.classList.add('hidden');
            addContainer.classList.remove('hidden');
        });
    }

    if (addBtn) {
        addBtn.addEventListener('click', async function() {
            const material = document.getElementById('optional-input-document');
            const currentpage = document.getElementById('optional-input-currentpage');
            const lastpage = document.getElementById('optional-input-lastpage');
            const time = document.getElementById('optional-input-expenditureoftime');
            switch (validateInputs(currentpage.value, lastpage.value, time.value, material)) {
                case 'correct':
                    await addOptionalInput(material, currentpage, lastpage, time);
                    resetInputFields();
                    addFieldBtn.classList.remove('hidden');
                    addContainer.classList.add('hidden');
                    await showMessage(document.getElementById('optional-inputs-save-successful'));
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
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            addFieldBtn.classList.remove('hidden');
            addContainer.classList.add('hidden');
            resetInputFields();
        });
    }

    // Delete input.
    const deleteButtons = document.querySelectorAll('.delete-optional-input-button');

    if (deleteButtons) {
        deleteButtons.forEach((deleteBtn, index) => {
            deleteBtn.addEventListener('click', async function() {
                    const editContainer = document.querySelectorAll('.optional-input-container')[index];
                    const id = editContainer.getAttribute('data-optionalinputid');
                    await deleteOptionalInput(id);
                    await showMessage(document.querySelector('#optional-inputs-deletion-successful'));
                }
            );
        });
    }

    // Edit input.
    const updateButtons = document.querySelectorAll('.update-optional-input-button');
    const editButtons = document.querySelectorAll('.edit-optional-input-button');
    const cancelUpdateButtons = document.querySelectorAll('.cancel-update-optional-input-button');

    if (editButtons) {
        editButtons.forEach((editBtn, index) => {
            editBtn.addEventListener('click', () => {
                const editContainer = document.querySelectorAll('.optional-input-container')[index];
                editContainer.classList.add('hidden');
                editContainer.nextElementSibling.classList.remove('hidden');
            });
        });
    }

    if (cancelUpdateButtons) {
        cancelUpdateButtons.forEach((cancelUpdateBtn, index) => {
            cancelUpdateBtn.addEventListener('click', () => {
                const editContainer = document.querySelectorAll('.optional-input-container')[index];
                editContainer.classList.remove('hidden');
                editContainer.nextElementSibling.classList.add('hidden');
            });
        });
    }

    if (updateButtons) {
        updateButtons.forEach((updateBtn, index) => {
            updateBtn.addEventListener('click', async function() {
                    const editForm = document.querySelectorAll('.edit-optional-input-container')[index];
                    const currentpage = editForm.querySelector('.optional-input-update-currentpage');
                    const lastpage = editForm.querySelector('.optional-input-update-lastpage');
                    const time = editForm.querySelector('.optional-input-update-expenditureoftime');
                    const material = editForm.querySelector('.optional-input-document-name');
                    const id = editForm.getAttribute('data-optionalinputid');
                    switch (validateInputs(currentpage.value, lastpage.value, time.value)) {
                        case 'correct':
                            await updateOptionalInput(id, material, currentpage, lastpage, time);
                            editForm.classList.add('hidden');
                            editForm.previousElementSibling.classList.remove('hidden');
                            await showMessage(editForm.querySelector('.optional-inputs-update-successful'));
                            break;
                        case 'document':
                            await showMessage(document.querySelector('.optional-input-update-warning.nodocumentselectederror'));
                            break;
                        case 'pagenumber':
                            await showMessage(document.querySelector('.optional-input-update-warning.pageerror'));
                            break;
                        case 'pagezero':
                            await showMessage(document.querySelector('.optional-input-update-warning.lastpagezeroerror'));
                            break;
                        case 'negative':
                            await showMessage(document.querySelector('.optional-input-update-warning.negativepageerror'));
                            break;
                        case 'beyondlimit':
                            await showMessage(document.querySelector('.optional-input-update-warning.pageoverflowerror'));
                            break;
                        case 'timebeyond':
                            // eslint-disable-next-line max-len
                            await showMessage(document.querySelector('.optional-input-update-warning.expenditureoftimeoverflowerror'));
                            break;
                        case 'notanumber':
                            await showMessage(document.querySelector('.optional-input-update-warning.notanumbererror'));
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

/**
 * Resets the values of input fields to their default or initial state.
 *
 * @returns {void}
 */
function resetInputFields() {
    document.getElementById('optional-input-document').selectedIndex = 0;
    document.getElementById('optional-input-currentpage').value = 1;
    document.getElementById('optional-input-lastpage').value = 1;
    document.getElementById('optional-input-expenditureoftime').value = 1;
}

/**
 * Validates input fields for optional inputs.
 *
 * @param {number} currentpage - The value of the current page.
 * @param {number} lastpage - The value of the last page.
 * @param {number} time - The value of the time spent.
 * @param {HTMLElement} [material=null] - The optional input material element.
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
 * Adds an optional input to the system.
 *
 * @param {HTMLSelectElement} material - The material select element.
 * @param {HTMLInputElement} currentpage - The input element for current page.
 * @param {HTMLInputElement} lastpage - The input element for last page.
 * @param {HTMLInputElement} time - The input element for time expenditure.
 */
function addOptionalInput(material, currentpage, lastpage, time) {
    Ajax.call([{
        methodname: 'block_disealytics_optional_input',
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
        resetInputFields();
        await updateView(getCourseId(), ['progress-bar-view']);
    }).fail(err => {
        window.console.log(err);
    });
}

/**
 * Updates an existing optional input in the system.
 *
 * @param {string} id - The unique identifier of the optional input.
 * @param {HTMLElement} material - The material element containing the updated content.
 * @param {HTMLInputElement} currentpage - The input element for current page.
 * @param {HTMLInputElement} lastpage - The input element for last page.
 * @param {HTMLInputElement} time - The input element for time expenditure.
 */
function updateOptionalInput(id, material, currentpage, lastpage, time) {
    Ajax.call([{
        methodname: 'block_disealytics_optional_input',
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
    }).fail(err => {
        window.console.log(err);
    });
}

/**
 * Deletes an existing optional input from the system.
 *
 * @param {string} id - The unique identifier of the optional input to be deleted.
 */
function deleteOptionalInput(id) {
    Ajax.call([{
        methodname: 'block_disealytics_optional_input',
        args: {
            calltype: 'delete',
            id: String(id),
        }
    }])[0].done(async function() {
        await updateView(getCourseId(), ['progress-bar-view']);
    }).fail(err => {
        window.console.log(err);
    });
}
