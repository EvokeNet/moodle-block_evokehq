<?php

/**
 * EvokeHQ portfolio page renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace block_evokehq\output;

defined('MOODLE_INTERNAL') || die();

use mod_evokeportfolio\util\evokeportfolio;
use renderable;
use templatable;
use renderer_base;

/**
 * EvokeHQ portfolios page renderer.
 *
 * @package     block_evokehq
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class portfolio implements renderable, templatable {

    protected $context;
    protected $portfolio;
    protected $group;

    public function __construct($context, $portfolio, $group) {
        $this->context = $context;
        $this->portfolio = $portfolio;
        $this->group = $group;
    }

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
        global $USER;

        $portfolioutil = new evokeportfolio();

        $submissions = $portfolioutil->get_portfolio_group_submissions($this->portfolio, $this->context, $this->group->id);

        $userpicture = theme_evoke_get_user_avatar_or_image($USER);

        $timeremaining = $this->portfolio->datelimit - time();

        return [
            'id' => $this->portfolio->id,
            'name' => $this->portfolio->name,
            'intro' => format_module_intro('evokeportfolio', $this->portfolio, $this->context->instanceid),
            'datelimit' => userdate($this->portfolio->datelimit),
            'timeremaining' => format_time($timeremaining),
            'courseid' => $this->portfolio->course,
            'groupid' => $this->group->id,
            'portfolioname' => $this->portfolio->name,
            'submissions' => $submissions,
            'hassubmissions' => $submissions != false,
            'userpicture' => $userpicture,
            'userfullname' => fullname($USER),
        ];
    }
}
