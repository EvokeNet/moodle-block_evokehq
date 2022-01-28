<?php

/**
 * EvokeHQ missions page renderer.
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

/**
 * EvokeHQ missions page renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class missions implements renderable, templatable {

    protected $context;
    protected $course;

    public function __construct($context, $course) {
        $this->context = $context;
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
        $missionmap = new missionmap();
        $mapinstanceid = $missionmap->get_course_map($this->course->id);

        if (!$mapinstanceid) {
            return ['blockcontent' => false];
        }

        $contentrenderable = new \block_mission_map\output\blockintohq($mapinstanceid);

        return [
            'blockcontent' => $output->render($contentrenderable)
        ];
    }
}
