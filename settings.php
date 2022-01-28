<?php

/**
 * EvokeHQ block settings page
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $imagefieldoptions = ['accepted_types' => ['.png', '.jpg', '.svg'], 'maxfiles' => 1];

    $settings->add(new admin_setting_configstoredfile(
        'block_evokehq/img_missions',
        get_string('img_missions', 'block_evokehq'),
        '',
        'img_missions',
        0,
        $imagefieldoptions
    ));

    $settings->add(new admin_setting_configstoredfile(
        'block_evokehq/img_evokation',
        get_string('img_evokation', 'block_evokehq'),
        '',
        'img_evokation',
        0,
        $imagefieldoptions
    ));

    $settings->add(new admin_setting_configstoredfile(
        'block_evokehq/img_portfolios',
        get_string('img_portfolios', 'block_evokehq'),
        '',
        'img_portfolios',
        0,
        $imagefieldoptions
    ));

    $settings->add(new admin_setting_configstoredfile(
        'block_evokehq/img_chat',
        get_string('img_chat', 'block_evokehq'),
        '',
        'img_chat',
        0,
        $imagefieldoptions
    ));
}
