<?php

namespace block_evokehq\util;

class group {
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
