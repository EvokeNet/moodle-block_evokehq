<?php

/**
 * EvokeHQ portfolios page renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace block_evokehq\output;

defined('MOODLE_INTERNAL') || die();

use block_evokehq\util\course;
use mod_evokeportfolio\util\group;
use renderable;
use templatable;
use renderer_base;

/**
 * EvokeHQ portfolios page renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class portfolios implements renderable, templatable {

    protected $context;
    protected $course;
    protected $group;

    public function __construct($context, $course, $group) {
        $this->context = $context;
        $this->course = $course;
        $this->group = $group;
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
        $courseutil = new course();
        $grouputil = new group();

        $data = [
            'groupname' => $this->group->name,
            'groupimage' => $grouputil->get_group_image($this->group),
            'groupmembers' => $grouputil->get_group_members($this->group->id),
            'hasportfolios' => false,
            'groupid' => $this->group->id
        ];

        $portfolios = $courseutil->get_course_portfolios($this->course->id);

        if (!$portfolios) {
            return $data;
        }

        $data['hasportfolios'] = true;
        $data['portfolios'] = $portfolios;

        return $data;
    }
}
