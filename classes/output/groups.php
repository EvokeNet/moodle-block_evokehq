<?php

/**
 * EvokeHQ groups page renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace block_evokehq\output;

defined('MOODLE_INTERNAL') || die();

use block_evokehq\util\group;
use renderable;
use templatable;
use renderer_base;

/**
 * EvokeHQ groups page renderer.
 *
 * @package    block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class groups implements renderable, templatable {

    protected $course;

    public function __construct($course) {
        $this->course = $course;
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
        $grouputil = new group();

        $groups = $grouputil->get_course_groups($this->course);

        return [
            'courseid' => $this->course->id,
            'coursename' => $this->course->fullname,
            'groups' => $groups
        ];
    }
}
