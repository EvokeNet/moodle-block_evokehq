<?php

namespace block_evokehq\util;

/**
 * EvokeHQ mission map utility class.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

class missionmap {
    /**
     * Returns false or the course mission map instance id
     *
     * @param int $courseid
     *
     * @return bool|int
     *
     * @throws \dml_exception
     */
    public function get_course_map($courseid) {
        global $DB;

        if (!class_exists(\block_mission_map\output\blockintohq::class)) {
            return false;
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
                'courseid' => $courseid
            ]
        );

        if (!$record) {
            return false;
        }

        return $record->id;
    }
}
