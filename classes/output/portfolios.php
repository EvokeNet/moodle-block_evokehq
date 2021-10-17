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
use mod_evokeportfolio\util\section;
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
        $sectionutil = new section();
        $groupsutil = new group();

        $portfolio = $courseutil->get_course_portfolio($this->course->id);

        $timeremaining = $portfolio->datelimit - time();

        $groupgradingmodetext = get_string('groupgrading', 'mod_evokeportfolio');
        if ($portfolio->groupgradingmode == MOD_EVOKEPORTFOLIO_GRADING_INDIVIDUAL) {
            $groupgradingmodetext = get_string('individualgrading', 'mod_evokeportfolio');
        }

        $sections = $sectionutil->get_portfolio_sections($portfolio->id);

        $data = [
            'id' => $portfolio->id,
            'name' => $portfolio->name,
            'intro' => format_module_intro('evokeportfolio', $portfolio, $this->context->instanceid),
            'datelimit' => userdate($portfolio->datelimit),
            'timeremaining' => format_time($timeremaining),
            'cmid' => $portfolio->cmid,
            'groupactivity' => $portfolio->groupactivity,
            'groupgradingmodetext' => $groupgradingmodetext,
            'groupid' => $this->group->id,
            'sections' => $sections
        ];

        if ($portfolio->groupactivity) {
            $data['groupname'] = $this->group->name;
            $data['groupmembers'] = $groupsutil->get_group_members($this->group->id);
        }

        return $data;
    }
}
