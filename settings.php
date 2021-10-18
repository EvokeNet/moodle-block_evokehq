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
    $settings->add(new admin_setting_configtext('block_evokehq/url_chat', get_string('url_chat', 'block_evokehq'),
        null, null, PARAM_URL));

    $settings->add(new admin_setting_configtext('block_evokehq/url_evokation', get_string('url_evokation', 'block_evokehq'),
        '', null, PARAM_URL));
}
