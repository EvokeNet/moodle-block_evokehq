<?php

namespace block_evokehq\privacy;

/**
 * Privacy API implementation for the Headquarters plugin.
 *
 * @package     block_evokehq
 * @category    privacy
 * @copyright   2021 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class provider implements \core_privacy\local\metadata\null_provider {

    /**
     * Returns stringid of a text explaining that this plugin stores no personal data.
     *
     * @return string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
}
