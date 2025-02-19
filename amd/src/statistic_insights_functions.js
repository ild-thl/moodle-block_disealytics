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

/**
 * Initialize the statistic insights interface.
 *
 */
export const init = () => {
    // Attach click event to each accordion head if not already present.
    const accordion = document.getElementById('block_disealytics-panel-statistic-insights-view');
    const accordionHeads = document.querySelectorAll('.statistic-insights-accordion .accordion-head');
    accordionHeads.forEach((head, index) => {
        // Check if the event listener is already attached.
        if (head.dataset.listenerAttached !== 'true') {
            head.addEventListener('click', () => {
                toggleAccordion(accordion, index + 1);
            });
            // Mark the event listener as attached.
            head.dataset.listenerAttached = 'true';
        }
    });
};