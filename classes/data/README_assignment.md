# Instructions on how the assignment class works

### Properties

* `$id`: Represents the ID of the assignment.
* `$assign`: Holds the assignment record retrieved from the database.
* `$gradeitem`: Contains the grade item record associated with the assignment.
* `$gradegrade`: Stores the grade record for the assignment.
* `$hovertext`: Holds the text for the hover tooltip.
* `$submissionstatus`: Represents the submission status of the assignment.
* `$gradestatus`: Represents the grade status of the assignment.
* `$modinfo`: Stores the module information of the assignment.
* `$attempts`: Contains an array of attempts for the assignment.

### Constants

We use constants that describe either the submission status or the grade status or the grade type:

* ``STATUS_EMPTY`` is used if the status cannot be classified.


* ``SUBMISSION_STATUS_NEUTRAL`` is used when the submission of an answer to the assignment is not necessary and the assignment is and will not be graded.
* ``SUBMISSION_STATUS_INCOMPLETE`` is used when the date of the submission is after the due date of the assignment or the assignment is not (yet) available.
* ``SUBMISSION_STATUS_SUBMITTED`` is used when an answer to the assignment is submitted.
* ``SUBMISSION_STATUS_NOTSUBMITTED`` is used when an answer to the assignment is not (yet) submitted.


* ``GRADE_STATUS_NEUTRAL`` is the default grade status. Is also used when there is no setting about the passing limit of the assignment.
* ``GRADE_STATUS_INCOMPLETE`` is used when an assignment has not yet been passed but there are still tries left or if the grade type is set to scale and the scale value is 'Nacharbeit'.
* ``GRADE_STATUS_OKAY`` is used when the assignment has been passed.
* ``GRADE_STATUS_FAILED`` is used when the assignment has not been passed and there are no tries left.
* ``GRADE_STATUS_INFO`` is used when the grade type is set to scale but no passing limit has been set. That way the exact word value of the scale gets printed out in the hover text. 


* ``GRADE_TYPE_TEXT`` is used when the grade type is set to feedback. (Only grade types scale and value can be classified and is used for the calculation of the status.)
* ``GRADE_TYPE_SCALE`` is used when the grade type is set to scale.
* ``GRADE_TYPE_VALUE`` is used when the grade type is set to point evaluation.
* ``GRADE_TYPE_NONE`` is used when the grade type is set to none. (Only grade types scale and value can be classified and is used for the calculation of the status.)

### Database Tables
In order to estimate the status of an assignment we need the following moodle tables which are accessed and saved in variables in the constructor function of the class:
* `assign`: general info on the assignment
* `assign_submission`: info on submission status and max attempts
* `assign_grades`: info on grade status and attempts
* `grade_items`: info on how the assignment gets graded (grade type and min grade to pass)
* `grade_grades`: info on the final grade of the user


### Methods
There are two complex functions to generate the status of an assignment:
* `block_disealytics_gen_submission_status()` will generate the submission status. Within this function there are these helping functions implemented:
  * `block_disealytics_needs_submission()` returns true if the assignment needs a submission of the user.
  * `block_disealytics_is_teamsubmission()` returns true if the assignment must be submitted as a team/group.
  * `block_disealytics_get_duedate()` returns the set due date of the assignment.
  * `block_disealytics_has_submission()` returns true if the assignment has a submission.
  * `block_disealytics_has_submission_ontime()` returns true if the submitted answer to the assignment was on time.
  * `block_disealytics_gets_graded()` returns true if the assignment will be graded.
  

* `block_disealytics_gen_grade_status()` will generate the grade status (the generation of the submission status is included). Within this function there are these helping functions implemented:
  * `block_disealytics_has_grade()` returns true if the assignment has been graded.
  * `block_disealytics_get_gradetype()` returns the grade type of the assignment.
  * `block_disealytics_get_scale_grade_text()` returns the text of the scale value.
  * `block_disealytics_has_tries_left()` returns true if there are still tries remaining to answer the assignment.

Finally, to display the status on the learning dashboard, the following two functions will generate the assignment link and the representing HTML. Both functions are used in the assignment_view.php file.
* `block_disealytics_build_name_link()` will build a link for the assignment.
* `block_disealytics_gen_status_html()` will generate the HTML representation of the assignment status.