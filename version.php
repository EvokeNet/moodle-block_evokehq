<?php

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'block_evokehq';
$plugin->release = '0.1.0';
$plugin->version = 2021092300;
$plugin->requires = 2021051700;
$plugin->maturity = MATURITY_BETA;
$plugin->dependencies = [
    'mod_evokeportfolio' => 2021092200,
];
