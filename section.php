<?php

/**
 * EvokeHQ block - groups page
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

require(__DIR__ . '/../../config.php');

$id = required_param('id', PARAM_INT);
$sectionid = required_param('section', PARAM_INT);
$groupid = required_param('group', PARAM_INT);

list ($course, $cm) = get_course_and_cm_from_cmid($id, 'evokeportfolio');
$section = $DB->get_record('evokeportfolio_sections', ['id' => $sectionid], '*', MUST_EXIST);
$group = $DB->get_record('groups', ['id' => $groupid], '*', MUST_EXIST);

$portfolio = $DB->get_record('evokeportfolio', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course);

$cmcontext = context_module::instance($id);

$coursecontext = context_course::instance($course->id);

$params = [
    'id' => $id,
    'section' => $sectionid,
    'group' => $groupid,
];

$url = new moodle_url('/blocks/evokehq/section.php', $params);

// Page info.
$PAGE->set_url($url);
$PAGE->set_context($coursecontext);

$title = get_string('page_section_title', 'block_evokehq', $course->fullname);
$PAGE->set_title($title);
$PAGE->set_heading($title);

$output = $PAGE->get_renderer('block_evokehq');

echo $output->header();
echo $output->container_start('page-section');

$renderable = new \block_evokehq\output\section($cmcontext, $portfolio, $section, $group);

echo $output->render($renderable);

echo $output->container_end();

echo $output->footer();