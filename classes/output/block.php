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
use block_evokehq\util\course;
use mod_evokeportfolio\util\group;

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

        $config = get_config('block_evokehq');

        $data = [
            'url_chat' => $config->url_chat ?: false,
            'url_evokation' => $config->url_evokation ?: false,
            'issiteadmin' => false
        ];

        if (is_siteadmin()) {
            $data['issiteadmin'] = true;
            $data['courseid'] = false;
            $data['groupmembers'] = false;

            return $data;
        }

        $usercourse = $courseutil->get_user_course();

        $groupmembers = $grouputil->get_group_members($usercourse->id);

        $data['courseid'] = $usercourse->id;
        $data['groupmembers'] = $groupmembers;

        return $data;
    }
}