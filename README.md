# DiSEA Learner Dashboard

The Learner Dashboard is a Moodle Block Plugin and offers a visual representation of the student's learning progress based on various factors and the opportunity for self-reflection. The main target group are online students.

## Features

The Learner Dashboard provides the following features:
- **Personalization**: The Learner Dashboard can be personalized by adding or removing cards.
- **Cards**: The Learner Dashboard (LD) contains cards in which various information or functions are included. Cards can be added to the LD and deleted again. There are the following different cards from which the students can compile their personal LD.
  * **Activity**: The Activity card shows the student's activity in the course/semester/studies.
  * **Assignments**: The Assignments card shows the student's status of assignments.
  * **Learning Goals**: The Learning Goals card is a checklist and handles the student's self-created learning goals.
  * **Planning Assistant**: The Planning Assistant card helps the students to plan their learning activities. The students are able to create individual events regarding their studies.
  * **Study Progress**: The Study Progress card shows the student's learning progress in the course/semester/studies.
  * **Progressbar of Learning Materials**: The Progressbar card shows the student's progress in reading the material provided in the regarding course.
  * **PVL-Probability**: The PVL-Probability card shows the student's probability of passing the course. It is an estimation based on the submission status of assignments of the student.

## Code Structure

The codebase is primarily written in PHP, JavaScript, SQL.

### PHP

The PHP code is object-oriented and follows the Moodle coding standards.

### JavaScript

JavaScript are used for client-side scripting. They handle user interactions and update the user interface in real-time.

## Requirements

The plugin is developed to support **Moodle 4.1**, using the plugin with other Moodle versions may cause unexpected issues.
As such the plugin has been has been tested specifically with the following configurations:
* Database: MariaDB, PostgreSQL
* PHP: 7.4, 8.0, 8.1

## Installation

### Cloning

Clone this repository into the blocks directory of your moodle installation:

```
git clone https://github.com/ild-thl/moodle-block_disealytics.git disealytics
```

### Configuring

When moodle asks you to configure the new settings for the plugin, upload the provided CSV-files:
 
- `block_disealytics | filterfile` -> upload event_filter_yymmdd.csv
- `block_disealytics | components` -> upload comp_map_yymmdd.csv
