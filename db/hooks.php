<?php
/**
 * Hook callbacks registration for Change Site Font plugin.
 *
 * For Moodle 4.4+ which uses the new hook system.
 *
 * @package    local_sitefont
 * @copyright  2025 AI Grader
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$callbacks = [
    [
        'hook' => core\hook\output\before_standard_head_html_generation::class,
        'callback' => [local_sitefont\hook_callbacks::class, 'before_standard_head_html_generation'],
        'priority' => 500,
    ],
];
