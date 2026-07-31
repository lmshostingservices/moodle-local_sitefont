<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Upgrade steps for local_sitefont.
 *
 * @package    local_sitefont
 * @copyright  2026 Essay Grader AI
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_local_sitefont_upgrade($oldversion) {

    // v1.0.14: FIX — unlock_verifier.php switched from raw PHP curl_init() to Moodle's \curl
    // class (require_once $CFG->libdir/filelib.php). Raw curl_init() bypassed Moodle's SSL
    // cert bundle, causing silent API call failures on Moodle hosting environments.
    // Moodle \curl uses the correct CA bundle and respects proxy settings.
    // No DB schema changes. version.php → 2026041000114.
    if ($oldversion < 2026041000114) {
        upgrade_plugin_savepoint(true, 2026041000114, 'local', 'sitefont');
    }

    // v1.0.15: FIX — unlock_verifier no longer caches negative (unlocked=false) results.
    // Previously a 1-hour cached negative would block the unlock from being detected after
    // the admin paid for it on lms-labs.com. Fix: negative results are never written
    // to cache; positive results are cached for 24 hours. Added permanent DB flag
    // (unlocked_permanently) via set_config so once unlocked the API is never hit again,
    // surviving all cache purges and Moodle upgrades. No DB schema changes.
    // version.php → 2026062300115.
    if ($oldversion < 2026062300115) {
        upgrade_plugin_savepoint(true, 2026062300115, 'local', 'sitefont');
    }

    if ($oldversion < 2026072300217) {
        // FIX-API-DOMAIN: Updated all API endpoint URLs from lms-labs.com to lms-labs.com.
        // lms-labs.com has no DNS resolution from Moodle server side; lms-labs.com is the
        // correct working domain. All ajax.php, api_client, unlock_verifier, lib.php calls updated.
        if (function_exists('opcache_invalidate')) {
            $_pluginDir = realpath(__DIR__ . '/..');
            foreach (['version.php', 'db/upgrade.php'] as $_f) {
                $_full = $_pluginDir . '/' . $_f;
                if (file_exists($_full)) {
                    opcache_invalidate($_full, true);
                }
            }
        } elseif (function_exists('opcache_reset')) {
            opcache_reset();
        }
        upgrade_plugin_savepoint(true, 2026072300217, 'local', 'sitefont');
    }

    if ($oldversion < 2026072300218) {
        // FIX-API-DOMAIN: Reverted API endpoint to lms-labs.com (correct domain).
        // essaygraderai.app was the original single-plugin domain; lms-labs.com is correct.
        if (function_exists('opcache_invalidate')) {
            $_pluginDir = realpath(__DIR__ . '/..');
            foreach (['version.php', 'db/upgrade.php'] as $_f) {
                $_full = $_pluginDir . '/' . $_f;
                if (file_exists($_full)) { opcache_invalidate($_full, true); }
            }
        } elseif (function_exists('opcache_reset')) { opcache_reset(); }
        upgrade_plugin_savepoint(true, 2026072300218, 'local', 'sitefont');
    }

    if ($oldversion < 2026072300219) {
        // Domain update: lms-labs.com → lms-labs.com
        if (function_exists('opcache_invalidate')) {
            $_pluginDir = realpath(__DIR__ . '/..');
            foreach (['version.php', 'lib.php', 'db/upgrade.php'] as $_f) {
                $_full = $_pluginDir . '/' . $_f;
                if (file_exists($_full)) { opcache_invalidate($_full, true); }
            }
        } elseif (function_exists('opcache_reset')) { opcache_reset(); }
        upgrade_plugin_savepoint(true, 2026072300219, 'local', 'sitefont');
    }

    return true;
}