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
        global $DB;

        if (!class_exists(\block_mission_map\output\blockintohq::class)) {
            return ['blockcontent' => false];
        }

        $sql = 'SELECT b.*
                FROM {block_instances} b
                INNER JOIN {context} c ON c.id = b.parentcontextid
                WHERE b.blockname = :blockname AND c.contextlevel = :contextlevel AND instanceid = :courseid';
        $record = $DB->get_record_sql(
            $sql,
            [
                'blockname' => 'mission_map',
                'contextlevel' => 50,
                'courseid' => $this->course->id
            ]
        );

        if (!$record) {
            return ['blockcontent' => false];
        }


        $contentrenderable = new \block_mission_map\output\blockintohq($record->id);

        return [
            'blockcontent' => $output->render($contentrenderable)
        ];
    }
}
