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
    public function get_course_groups($course) {
        global $DB, $CFG;

        $groups = $DB->get_records('groups', ['courseid' => $course->id]);

        if (!$groups) {
            return false;
        }

        foreach ($groups as $group) {
            $pictureurl = get_group_picture_url($group, $course->id, true);

            if ($pictureurl) {
                $group->groupimg = $pictureurl->out();

                continue;
            }

            $group->groupimg = $CFG->wwwroot . '/blocks/evokehq/pix/defaultgroupimg.png';
        }

        return array_values($groups);
    }
}
