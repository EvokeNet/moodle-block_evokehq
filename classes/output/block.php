<?php

/**
 * HQ block renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace block_evokehq\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;

/**
 * HQ block renderable class.
 *
 * @package    block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class block implements renderable, templatable {

    /**
     * Export the data.
     *
     * @param renderer_base $output
     *
     * @return array|\stdClass
     *
     * @throws \coding_exception
     *
     * @throws \dml_exception
     */
    public function export_for_template(renderer_base $output) {
        return [];
    }
}