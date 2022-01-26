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

$course = $DB->get_record('course', ['id' => $id], '*', MUST_EXIST);

require_login($course);

$context = context_course::instance($course->id);

$params = [
    'id' => $id
];

$url = new moodle_url('/blocks/evokehq/missions.php', $params);

// Page info.
$PAGE->set_url($url);
$PAGE->set_context($context);

$title = get_string('page_missions_title', 'block_evokehq', $course->fullname);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->navbar->add($title);

$output = $PAGE->get_renderer('block_evokehq');

echo $output->header();
echo $output->container_start('page-missions');

$renderable = new \block_evokehq\output\missions($context, $course);

echo $output->render($renderable);

echo $output->container_end();

echo $output->footer();