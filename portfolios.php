<?php

/**
 * EvokeHQ block - groups page
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

require(__DIR__ . '/../../config.php');

$courseid = required_param('course', PARAM_INT);
$groupid = required_param('group', PARAM_INT);

$course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);
$group = $DB->get_record('groups', ['id' => $groupid], '*', MUST_EXIST);

require_login($course);

$context = context_course::instance($course->id);

$params = [
    'course' => $courseid,
    'group' => $groupid,
];

$url = new moodle_url('/blocks/evokehq/portfolios.php', $params);

// Page info.
$PAGE->set_url($url);
$PAGE->set_context($context);

$title = get_string('page_portfolios_title', 'block_evokehq', $course->fullname);
$PAGE->set_title($title);
$PAGE->set_heading($title);

$output = $PAGE->get_renderer('block_evokehq');

echo $output->header();
echo $output->container_start('page-portfolios');

$renderable = new \block_evokehq\output\portfolios($context, $course, $group);

echo $output->render($renderable);

echo $output->container_end();

echo $output->footer();