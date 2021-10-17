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

    public function get_course_chat_link($courseid) {
        $chatsincourse = get_coursemodules_in_course('chat', $courseid);

        if (!$chatsincourse) {
            return false;
        }

        $currentchat = current($chatsincourse);

        $url = new \moodle_url('/mod/chat/view.php', ['id' => $currentchat->id]);

        return $url->out();
    }
}
