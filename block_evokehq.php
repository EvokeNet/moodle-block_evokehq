<?php

/**
 * Block evokehq is defined here.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class block_evokehq extends block_base {

    /**
     * Initializes class member variables.
     */
    public function init() {
        // Needed by Moodle to differentiate between blocks.
        $this->title = get_string('pluginname', 'block_evokehq');
    }

    /**
     * Controls the block title based on instance configuration
     *
     * @return bool
     */
    public function specialization() {
        $title = isset($this->config->title) ? trim($this->config->title) : '';

        if (!empty($title)) {
            $this->title = format_string($this->config->title);
        }
    }

    /**
     * Returns the block contents.
     *
     * @return stdClass The block contents.
     */
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();

        $renderer = $this->page->get_renderer('block_evokehq');

        $contentrenderable = new \block_evokehq\output\block($this->config);

        $this->content->text = $renderer->render($contentrenderable);

        $this->content->footer = '';

        return $this->content;
    }

    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
    public function applicable_formats() {
        return [
            'my' => true,
            'course-view' => true
        ];
    }

    /**
     * Allow block general configuration
     *
     * @return bool
     */
    public function has_config() {
        return true;
    }
}
