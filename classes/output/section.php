<?php

/**
 * EvokeHQ section page renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace block_evokehq\output;

defined('MOODLE_INTERNAL') || die();

use mod_evokeportfolio\util\group;
use renderable;
use templatable;
use renderer_base;

/**
 * EvokeHQ section page renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class section implements renderable, templatable {

    protected $context;
    protected $portfolio;
    protected $section;
    protected $group;

    public function __construct($context, $portfolio, $section, $group) {
        $this->context = $context;
        $this->portfolio = $portfolio;
        $this->section = $section;
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
        global $USER, $PAGE;

        $grouputil = new group();

        $groupmembers = $grouputil->get_group_members($this->group->id, false);
        $groupmembersids = [];
        foreach ($groupmembers as $groupmember) {
            $groupmembersids[] = $groupmember->id;
        }

        $sectionutil = new \mod_evokeportfolio\util\section();
        $submissions = $sectionutil->get_section_submissions($this->context, $this->section->id, $groupmembersids);

        $userpicture = new \user_picture($USER);
        $userpicture->size = 1;

        return [
            'courseid' => $this->portfolio->course,
            'portfolioname' => $this->portfolio->name,
            'sectionname' => $this->section->name,
            'sectiondescription' => $this->section->description,
            'submissions' => $submissions,
            'hassubmissions' => $submissions != false,
            'userpicture' => $userpicture->get_url($PAGE)->out(),
            'userfullname' => fullname($USER),
        ];
    }
}
