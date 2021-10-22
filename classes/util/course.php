<?php

namespace block_evokehq\util;

/**
 * EvokeHQ course utility class.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

class course {
    public function get_user_course() {
        $courses = enrol_get_my_courses();

        if (!$courses) {
            return false;
        }

        return current($courses);
    }

    public function get_course_portfolios($courseid) {
        $portfoliosincourse = get_coursemodules_in_course('evokeportfolio', $courseid);

        if (!$portfoliosincourse) {
            return false;
        }

        return array_values($portfoliosincourse);
    }
}
