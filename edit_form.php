<?php

/**
 * Block evokehq is defined here.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

defined('MOODLE_INTERNAL') || die();

/**
 *  Block Game config form definition class
 *
 * @package    block_game
 * @copyright  2019 Jose Wilson
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_evokehq_edit_form extends block_edit_form {

    /**
     * Block Game form definition
     *
     * @param mixed $mform
     * @return void
     */
    protected function specific_definition($mform) {
        global $COURSE, $OUTPUT;

        // Start block specific section in config form.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        if ($COURSE->id != SITEID && has_capability('moodle/site:config', context_system::instance())) {
            // Block instance alternate title.
            $mform->addElement('text', 'config_title', get_string('config_title', 'block_evokehq'));
            $mform->setDefault('config_title', '');
            $mform->setType('config_title', PARAM_TEXT);

            $mform->addElement('text', 'config_chat', get_string('config_chat', 'block_evokehq'));
            $mform->setDefault('config_chat', '');
            $mform->setType('config_chat', PARAM_URL);

            $mform->addElement('text', 'config_evokation', get_string('config_evokation', 'block_evokehq'));
            $mform->setDefault('config_evokation', '');
            $mform->setType('config_evokation', PARAM_URL);
        }
    }
}