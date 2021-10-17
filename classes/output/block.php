<?php

/**
 * HQ block renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace block_evokehq\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;
use block_evokehq\util\group;
use block_evokehq\util\course;

/**
 * HQ block renderable class.
 *
 * @package    block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class block implements renderable, templatable {

    /**
     * Export the data.
     *
     * @param renderer_base $output
     *
     * @return array|\stdClass
     *
     * @throws \coding_exception
     *
     * @throws \dml_exception
     */
    public function export_for_template(renderer_base $output) {
        $courseutil = new course();
        $grouputil = new group();

        $usercourse = $courseutil->get_user_course();

        $groupmembers = $grouputil->get_group_members($usercourse->id);

        return [
            'courseid' => $usercourse->id,
            'groupmembers' => $groupmembers,
            'coursechat' => $courseutil->get_course_chat_link($usercourse->id)
        ];
    }
}