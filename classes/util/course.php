<?php

namespace block_evokehq\util;

use core\plugininfo\portfolio;

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

    public function get_course_chat_link($courseid) {
        $chatsincourse = get_coursemodules_in_course('chat', $courseid);

        if (!$chatsincourse) {
            return false;
        }

        $currentchat = current($chatsincourse);

        $url = new \moodle_url('/mod/chat/view.php', ['id' => $currentchat->id]);

        return $url->out();
    }

    public function get_course_portfolio($courseid) {
        global $DB;

        $portfoliosincourse = get_coursemodules_in_course('evokeportfolio', $courseid);

        if (!$portfoliosincourse) {
            return false;
        }

        $cm = current($portfoliosincourse);

        $portfolio = $DB->get_record('evokeportfolio', ['id' => $cm->instance], '*', MUST_EXIST);

        $portfolio->cmid = $cm->id;

        return $portfolio;
    }
}
