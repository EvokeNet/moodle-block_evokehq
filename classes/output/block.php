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

    protected $config;

    public function __construct($config) {
        $this->config = $config;
    }

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
        global $COURSE;

        $courseid = $COURSE->id;

        $courseutil = new course();
        $grouputil = new group();

        $config = get_config('block_evokehq');

        $urlchat = $config->url_chat ?: false;
        $urlevokation = $config->url_evokation ?: false;

        if (isset($this->config->chat)) {
            $urlchat = $this->config->chat;
        }

        if (isset($this->config->evokation)) {
            $urlevokation = $this->config->evokation;
        }

        $data = [
            'url_chat' => $urlchat,
            'url_evokation' => $urlevokation
        ];

        if ($courseid == SITEID) {
            $usercourse = $courseutil->get_user_course();

            if (!$usercourse) {
                $data['courseid'] = false;
                $data['groupmembers'] = false;

                return $data;
            }
        }

        $data['courseid'] = $courseid;
        $data['groupmembers'] = false;
        $data['hasgroup'] = false;

        $usergroup = $grouputil->get_user_group($courseid);

        if ($usergroup) {
            $data['groupmembers'] = $grouputil->get_group_members($usergroup->id);
            $data['hasgroup'] = true;
        }

        return $data;
    }
}