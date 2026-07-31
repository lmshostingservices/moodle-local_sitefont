<?php
/**
 * Change Site Font - Version file
 *
 * @package    local_sitefont
 * @copyright  2025 AI Grader
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_sitefont';
$plugin->version   = 2026072300219;
$plugin->requires  = 2022041900; // Moodle 4.0+
$plugin->supported = [400, 500]; // Moodle 4.0 to 5.x
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = '1.0.18'; // FIX: unlock_verifier no longer caches negative results — unlock is picked up immediately on next page load after payment. Added permanent DB flag so once unlocked it never hits the API again. No DB schema changes.
