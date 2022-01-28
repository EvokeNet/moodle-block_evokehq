<?php

defined('MOODLE_INTERNAL') || die();

/**
 * EvokeHQ file function.
 *
 * @param stdClass $course
 * @param stdClass $birecordorcm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return boolean
 */
function block_evokehq_pluginfile($course, $birecordorcm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    $fs = get_file_storage();
    $filename = array_pop($args);

    $fileareas = [
        'img_missions',
        'img_evokation',
        'img_portfolios',
        'img_chat'
    ];

    if (in_array($filearea, $fileareas)) {
        $file = $fs->get_file($context->id, 'block_evokehq', $filearea, 0, '/', $filename);

        if ($file || !$file->is_directory()) {
            send_stored_file($file, null, 0, true, $options);
        }
    }

    send_file_not_found();

    return true;
}
