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

use block_evokehq\util\missionmap;
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

        $blockutil = new \block_evokehq\util\block();
        $data = $blockutil->get_block_images();

        $data['url_chat'] = $this->config->chat ?? false;
        $data['url_evokation'] = $this->config->evokation ?? false;

        $title = get_string('pluginname', 'block_evokehq');
        $configtitle = isset($this->config->title) ? trim($this->config->title) : '';
        if (!empty($configtitle)) {
            $title = format_string($configtitle);
        }

        $data['title'] = $title;

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

        $usergroups = $grouputil->get_user_groups($courseid);

        if ($usergroups) {
            $data['groupmembers'] = $grouputil->get_groups_members($usergroups);
            $data['hasgroup'] = true;
        }

        $missionmap = new missionmap();
        $mapinstanceid = $missionmap->get_course_map($courseid);

        $data['hasmissionmap'] = false;
        if ($mapinstanceid) {
            $data['hasmissionmap'] = true;
        }

        return $data;
    }
}