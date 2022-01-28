<?php

namespace block_evokehq\util;

/**
 * EvokeHQ block utility class.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

class block {
    public function get_block_images() {
        $config = get_config('block_evokehq');

        return [
            'img_missions' => $this->get_image('img_missions', $config->img_missions),
            'img_evokation' => $this->get_image('img_evokation', $config->img_evokation),
            'img_portfolios' => $this->get_image('img_portfolios', $config->img_portfolios),
            'img_chat' => $this->get_image('img_chat', $config->img_chat)
        ];
    }

    protected function get_image($filearea, $filename = null) {
        global $CFG;

        if (!$filename) {
            return $CFG->wwwroot . "/blocks/evokehq/pix/{$filearea}.png";
        }

        $filename = str_replace('/', '', $filename);

        $context = \context_system::instance();

        $file = \moodle_url::make_pluginfile_url($context->id, 'block_evokehq', $filearea, 0, '/', $filename)->out();

        return $file;
    }
}
