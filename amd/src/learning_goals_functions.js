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

import Ajax from 'core/ajax';
import {updateView} from "./update_view";
import {getCourseId} from "./view_selection";
import {toggleAccordion} from "./add_interaction";

/**
 * Initialize the learning goals interface.
 *
 * This function initializes the learning goals interface by setting up the due date, handling checkboxes,
 * and performing other necessary setup tasks.
 */
export const init = () => {
    initGoalDueDate();
    handleCheckboxes();
    // Attach click event to each accordion head.
    const accordion = document.getElementById('learning-goals-panel-accordion');
    const accordionHeads = document.querySelectorAll('#learning-goals-panel-accordion .accordion-head');
    accordionHeads.forEach((head, index) => {
        head.addEventListener('click', () => {
            toggleAccordion(accordion, index + 1);
        });
    });
};

/**
 * Initialize event listeners for buttons and elements related to managing learning goals.
 *
 * This function attaches event listeners for buttons and elements used in the learning goals interface,
 * including showing/hiding the goal form, saving goals, canceling/resetting the form, deleting goals,
 * and enabling editing mode for goals.
 */
export function initGoalEventListeners() {
    // The button to show the goal form.
    const showGoalFormBtn = document.getElementById('show-goal-form');
    // The goal form.
    const createGoalForm = document.getElementById('create-goal-container');
    // The button to add goals.
    const saveGoalBtn = document.getElementById('save-goal');
    // The button to cancel and reset the form.
    const cancelGoalBtn = document.getElementById('cancel-goal');
    // Warning if there are too many goals already.
    const goalLimitBtn = document.getElementById('goal-limit');
    // Warning if there is something wrong/missing.
    const goalsInvalidBtns = document.getElementsByClassName('goal-invalid');
    // The button to delete a goal permanently.
    const deleteGoalBtns = document.querySelectorAll('.delete-goal');
    // The button to edit goals.
    const editGoalsBtn = document.getElementById('edit-goals');

    // This checks if the limit of 20 goals is reached.
    const learningGoalProgress = document.getElementById('learning-goals-progress');
    if (learningGoalProgress) {
        if (Number(learningGoalProgress.getAttribute('max')) >= 30) {
            goalLimitBtn.classList.remove('hidden');
            showGoalFormBtn.classList.add('hidden');
        }
    }

    // Show the create a goal form.
    if (showGoalFormBtn) {
        showGoalFormBtn.addEventListener('click', function() {
            createGoalForm.classList.remove('hidden');
        });
    }

    // Saving goal in database.
    if (saveGoalBtn) {
        saveGoalBtn.addEventListener('click', function() {
            saveGoal();
        });
    }

    // Cancel/reset the create a goal form.
    if (cancelGoalBtn) {
        cancelGoalBtn.addEventListener('click', function() {
            const goalNameInput = document.getElementById('goal-name-input');

            // Reset the form.
            goalNameInput.value = '';
            initGoalDueDate();
            createGoalForm.classList.add('hidden');
            for (const goalInvalidBtn of goalsInvalidBtns) {
                goalInvalidBtn.classList.add('hidden');
            }
        });
    }

    // Delete a goal from the database.
    for (const deleteGoalBtn of deleteGoalBtns) {
        deleteGoalBtn.addEventListener('click', function() {
            const goalId = deleteGoalBtn.parentNode.id;
            deleteGoal(goalId);
        });
    }

    // Turn editing mode on.
    if (editGoalsBtn) {
        editGoalsBtn.addEventListener('click', () => {
            // Set the color for the editing pencil on/off.
            if (editGoalsBtn.querySelector('i').classList.contains('editing-off')) {
                editGoalsBtn.querySelector('i').classList.remove('editing-off');
                editGoalsBtn.querySelector('i').style.color = 'var(--diseared)';
            } else {
                editGoalsBtn.querySelector('i').classList.add('editing-off');
                editGoalsBtn.querySelector('i').style.color = 'var(--diseablue)';
            }
            // Turn settings for editing mode on.
            setEditingModeForLearningGoals();
        });
    }
}

/**
 * Sets the editing mode for learning goals.
 *
 * This function hides the create-goal-container, activates the editing mode for accordion contents (goals),
 * and manages the display of goal content and associated buttons for editing and canceling.
 */
function setEditingModeForLearningGoals() {
    const createGoalContainer = document.getElementById('create-goal-container');
    if (!createGoalContainer.classList.contains('hidden')) {
        createGoalContainer.classList.add('hidden');
    }
    const accordionContents = document.querySelectorAll('.accordion-content');
    for (const accordionContent of accordionContents) {
        if (accordionContent.classList.contains('edit-mode')) {
            accordionContent.classList.remove('edit-mode');
            accordionContent.classList.remove('active');
        } else {
            accordionContent.classList.add('edit-mode');
            accordionContent.classList.add('active');
        }
    }
    const goalContents = document.querySelectorAll('.goal-content');
    for (const goalContent of goalContents) {
        const viewMode = goalContent.querySelector('.goal-view-mode');
        const editMode = goalContent.querySelector('.goal-edit-mode');
        const goalsInvalidBtns = goalContent.querySelectorAll('.goal-invalid');
        const editBtn = goalContent.querySelector('#edit-goal');
        if (editBtn.classList.contains('hidden')) {
            editBtn.classList.remove('hidden');
        } else {
            editBtn.classList.add('hidden');
        }
        editBtn.addEventListener('click', () => {
            editMode.classList.remove('hidden');
            viewMode.classList.add('hidden');
            // Edit the goal in the database.
            editGoal(goalContent);
        });
        // Cancel Button.
        const cancelEditBtn = goalContent.querySelector('#cancel-goal-edit');
        if (cancelEditBtn) {
            cancelEditBtn.addEventListener('click', () => {
                editMode.classList.add('hidden');
                viewMode.classList.remove('hidden');
                for (const goalInvalidBtn of goalsInvalidBtns) {
                    goalInvalidBtn.classList.add('hidden');
                }
            });
        }
    }
}

/**
 * Initializes the goal due date and time input fields with current date and time values.
 */
function initGoalDueDate() {
    const goalDueDateInput = document.getElementById('goal-due-date-input');
    const goalDueTimeInput = document.getElementById('goal-due-time-input');

    const now = new Date();
    const currentDate = `${now.getFullYear()}-${(now.getMonth() + 1)
        .toString().padStart(2, '0')}-${now.getDate()
        .toString().padStart(2, '0')}`;
    const currentTime = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;

    if (goalDueDateInput) {
        goalDueDateInput.value = currentDate;
        goalDueDateInput.min = currentDate;
    }

    if (goalDueTimeInput) {
        goalDueTimeInput.value = currentTime;
    }
}

/**
 * Validates input values for a goal.
 *
 * @param {string} goalType - The type of action the validation is needed for (new/update).
 * @param {string} name - The goal name to validate.
 * @param {Date} dateTime - The date and time to validate.
 * @param {string} dateTimeStr - The date and time as a string.
 * @param {Element} [goalContent=null] - The goal content element (used for 'update' type).
 *
 * @returns {boolean} True if all validation checks pass, false otherwise.
 */
function validateInputs(goalType, name, dateTime, dateTimeStr, goalContent = null) {
    // All warnings.
    let goalsInvalid = document.getElementsByClassName('goal-invalid');
    let goalNameMissing, goalDateMissing, goalNameInvalid;

    if (goalType === 'new') {
        // Warning if the name is not filled out.
        goalNameMissing = document.getElementById('goal-name-missing');
        // Warning if the date is not filled out.
        goalDateMissing = document.getElementById('goal-date-missing');
        // Warning if the name is wrong.
        goalNameInvalid = document.getElementById('goal-name-invalid');
    }

    if (goalType === 'update') {
        // Warning if the name is not filled out.
        goalNameMissing = goalContent.querySelector('#edit-goal-name-missing');
        // Warning if the date is not filled out.
        goalDateMissing = goalContent.querySelector('#edit-goal-date-missing');
        // Warning if the name is wrong.
        goalNameInvalid = goalContent.querySelector('#edit-goal-name-invalid');
    }

    if (name.trim() === '') {
        for (const goalInvalid of goalsInvalid) {
            goalInvalid.classList.add('hidden');
        }
        goalNameMissing.classList.remove('hidden');
        return false;
    }
    if (!/^[a-zA-Z0-9\s!?äöüÄÖÜßéè]+$/.test(name)) {
        for (const goalInvalid of goalsInvalid) {
            goalInvalid.classList.add('hidden');
        }
        goalNameInvalid.classList.remove('hidden');

        return false;
    }
    if (!dateTimeStr || isNaN(dateTime)) {
        for (const goalInvalid of goalsInvalid) {
            goalInvalid.classList.add('hidden');
        }
        goalDateMissing.classList.remove('hidden');
        return false;
    }
    // All validation checks passed.
    return true;
}

/**
 * Saves a learning goal to the database after validating inputs.
 *
 * @async
 * @function
 * @returns {Promise<void>} A promise that resolves when the goal is saved successfully or rejects on error.
 */
async function saveGoal() {
    try {
        const goalNameInput = document.getElementById('goal-name-input').value;
        const selectedDate = document.getElementById('goal-due-date-input').value;
        const selectedTime = document.getElementById('goal-due-time-input').value;
        const combinedDateTimeString = `${selectedDate}T${selectedTime}`;
        const combinedDateTime = new Date(combinedDateTimeString);

        // Validate inputs before submitting.
        if (validateInputs('new', goalNameInput, combinedDateTime, combinedDateTimeString)) {
            const timestamp = Number(combinedDateTime.getTime() / 1000);
            const courseId = getCourseId();

            await new Promise((resolve, reject) => {
                Ajax.call([{
                    methodname: 'block_disealytics_add_learning_goal',
                    args: {
                        courseid: courseId,
                        goalname: goalNameInput,
                        duedate: timestamp,
                    }
                }])[0].done(function() {
                    // Resolve the promise when done.
                    resolve();
                }).fail(function(err) {
                    // Reject the promise if there's an error.
                    reject(err);
                });
            });

            // Update the view after saving the goal.
            updateView(courseId, ['learning-goals-view']);
        }
    } catch (error) {
        // Handle any errors here.
        window.console.error(error);
    }
}

/**
 * Handles checkboxes for marking learning goals as finished or unfinished.
 *
 * This function automatically checks checkboxes for finished goals,
 * and it adds event listeners to update goal statuses based on checkbox changes.
 */
function handleCheckboxes() {
    // Select all elements that are finished.
    const finishedGoals = document.querySelectorAll('[data-goal-finished="true"]');
    finishedGoals.forEach(goal => {
        // Mark the checkbox checked.
        const checkbox = goal.querySelector('.goal-checkbox');
        // Check the checkbox.
        checkbox.checked = true;
        const name = goal.querySelector('.goal-name');
        const date = goal.querySelector('.goal-date');

        name.classList.add('strikethrough');
        date.classList.add('strikethrough');

    });

    // Get all checkboxes.
    const allCheckboxes = document.querySelectorAll('.goal-checkbox');
    allCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', async function() {
            const id = checkbox.id.replace("goal-", "");
            const goalContent = checkbox.parentNode.parentNode.parentNode;
            const name = goalContent.querySelector('.goal-name');
            const date = goalContent.querySelector('.goal-date');
            const dateTimestamp = goalContent.getAttribute('data-goal-timestamp');

            if (checkbox.checked) {
                name.classList.add('strikethrough');
                date.classList.add('strikethrough');

                try {
                    await updateGoal(id, name.innerText, dateTimestamp, true);
                    // Update was successful.
                } catch (error) {
                    // Handle error here.
                    window.console.error(error);
                }
            } else {
                name.classList.remove('strikethrough');
                date.classList.remove('strikethrough');

                try {
                    await updateGoal(id, name.innerText, dateTimestamp, false);
                    // Update was successful.
                } catch (error) {
                    // Handle error here.
                    window.console.error(error);
                }
            }
        });
    });
}

/**
 * Edits a learning goal's details.
 *
 * This function retrieves and displays a learning goal's information for editing.
 * It allows the user to modify the goal's name and due date, and then save the changes.
 *
 * @param {HTMLElement} goalContent - The container element for the learning goal to be edited.
 */
function editGoal(goalContent) {
    // Get elements.
    const goalId = goalContent.getAttribute('data-goal-id');
    const goalName = goalContent.querySelector('.goal-name');
    const goalTimestamp = goalContent.getAttribute('data-goal-timestamp');
    const goalStatus = goalContent.getAttribute('finished');

    // Name.
    const goalSetNameInput = goalContent.querySelector('#goal-set-name-input');
    goalSetNameInput.value = goalName.innerText;

    // Date.
    const originalDate = new Date(goalTimestamp * 1000);
    const goalSetDateInput = goalContent.querySelector('#goal-set-date-input');
    const goalSetTimeInput = goalContent.querySelector('#goal-set-time-input');
    goalSetDateInput.value = originalDate.toISOString().slice(0, 10);
    goalSetDateInput.min = originalDate.toISOString().slice(0, 10);
    goalSetTimeInput.value = originalDate.toISOString().slice(11, 16);

    // Save updated goal.
    const saveEditBtn = goalContent.querySelector('#save-goal-edit');
    if (saveEditBtn) {
        saveEditBtn.addEventListener('click', async function() {
            const updatedName = goalSetNameInput.value;
            const updatedDate = goalSetDateInput.value;
            const updatedTime = goalSetTimeInput.value;
            const combinedDateTimeString = `${updatedDate}T${updatedTime}`;
            const combinedDateTime = new Date(combinedDateTimeString);

            // Validate inputs before submitting.
            if (validateInputs('update', updatedName, combinedDateTime, combinedDateTimeString, goalContent)) {
                const updatedTimestamp = Number(combinedDateTime.getTime() / 1000);
                await updateGoal(goalId, updatedName, updatedTimestamp, goalStatus).then(() => {
                    return setEditingModeForLearningGoals();
                });
            }
        });
    }
}

/**
 * Updates a learning goal in the database.
 *
 * This function sends a request to update a learning goal with the provided details.
 *
 * @async
 * @function
 * @param {string} id - The ID of the learning goal to update.
 * @param {string} name - The updated name for the learning goal.
 * @param {string} date - The updated due date for the learning goal (in timestamp format).
 * @param {boolean} finished - Indicates whether the learning goal is finished (true) or not (false).
 * @returns {Promise<void>} A promise that resolves when the goal is updated successfully or rejects on error.
 */
async function updateGoal(id, name, date, finished) {
    return new Promise((resolve, reject) => {
        Ajax.call([{
            methodname: 'block_disealytics_update_learning_goal',
            args: {
                goalid: id,
                goalname: name,
                duedate: date,
                finished: finished === true ? 1 : 0
            }
        }])[0].done(function() {
            updateView(getCourseId(), ['learning-goals-view']);
            resolve(); // Resolve the promise when done
        }).fail(function(err) {
            window.console.error(err);
            reject(err); // Reject the promise if there's an error
        });
    });
}

/**
 * Deletes a learning goal from the database.
 *
 * This function sends a request to delete a learning goal with the specified ID.
 *
 * @param {string} id - The ID of the learning goal to delete.
 * @returns {Promise<void>} A promise that resolves when the goal is deleted successfully or rejects on error.
 */
function deleteGoal(id) {
    return new Promise((resolve, reject) => {
        Ajax.call([{
            methodname: 'block_disealytics_delete_learning_goal',
            args: {
                goalid: id
            }
        }])[0].done(function() {
            // Update the view after successfully deleting the goal.
            updateView(getCourseId(), ['learning-goals-view']);
            // Resolve the promise when done.
            resolve();
        }).fail(function(err) {
            // Log the error to the console.
            window.console.error(err);
            // Reject the promise if there's an error.
            reject(err);
        });
    });
}

