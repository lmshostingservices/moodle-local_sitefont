<?php
/**
 * Change Site Font - Language strings
 *
 * @package    local_sitefont
 * @copyright  2025 AI Grader
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Change Site Font';
$string['pluginadministration'] = 'Change Site Font administration';

$string['fontfamily'] = 'Font family';
$string['fontfamily_desc'] = 'Select the site-wide font family. All fonts are loaded from Google Fonts with optimized weights for both body text and headings.';

$string['bodysize'] = 'Body font size';
$string['bodysize_desc'] = 'The base font size for body text throughout the site.';

$string['bodyweight'] = 'Body font weight';
$string['bodyweight_desc'] = 'The font weight for body text. 400 is normal, 300 is light, 500 is medium.';

$string['headingweight'] = 'Heading font weight';
$string['headingweight_desc'] = 'The font weight for headings (h1-h6). 600 is semi-bold, 700 is bold.';

$string['headingscale'] = 'Heading size scale';
$string['headingscale_desc'] = 'A multiplier applied to all heading sizes. Use this to make headings proportionally larger or smaller.';

$string['lineheight'] = 'Line height';
$string['lineheight_desc'] = 'The line height (spacing between lines) for body text. 1.5 is standard, higher values are more relaxed.';

$string['privacy:metadata'] = 'The Change Site Font plugin does not store any personal data.';

// Unlock verification
$string['unlock_required'] = 'This plugin requires 1000 AI credits to unlock. Please visit your AI Grader dashboard at lms-labs.com to unlock this plugin.';
$string['plugin_locked'] = 'Plugin Locked';
$string['plugin_unlocked'] = 'Plugin Active';

// API Credentials
$string['apicredentials'] = 'API Credentials';
$string['apicredentials_desc'] = 'Enter your AI Grader credentials to enable plugin unlock verification. These credentials are available from your AI Grader dashboard at lms-labs.com.';
$string['siteid'] = 'Site ID';
$string['siteid_desc'] = 'Your unique Site ID from the AI Grader dashboard.';
$string['apikey'] = 'API Key';
$string['apikey_desc'] = 'Your API Key from the AI Grader dashboard.';
$string['centralconfig_fallback'] = '(Fallback - Central Config takes priority if installed)';
$string['fontsettings'] = 'Font Settings';
