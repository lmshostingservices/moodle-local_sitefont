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
 * Change Site Font - Admin settings
 *
 * @package    local_sitefont
 * @copyright  2025 AI Grader
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    // Check unlock status - only show notification when viewing THIS settings page
    $islocked = false;
    if (class_exists('\local_sitefont\\unlock_verifier')) {
        if (!\local_sitefont\unlock_verifier::is_unlocked()) {
            $islocked = true;
            // Only show warning when user is actually viewing this plugin's settings page
            $currentsection = optional_param('section', '', PARAM_RAW);
            if ($currentsection === 'local_sitefont') {
                \core\notification::warning(get_string('unlock_required', 'local_sitefont'));
            }
        }
    }

    $settings = new admin_settingpage(
        'local_sitefont',
        get_string('pluginname', 'local_sitefont')
    );

    // Check if Central Config plugin is installed (provides site-wide credentials)
    $centralconfiginstalled = file_exists($CFG->dirroot . '/local/aiconfig/version.php');
    
    // API Credentials heading
    $settings->add(new admin_setting_heading(
        'local_sitefont/apicredentials',
        get_string('apicredentials', 'local_sitefont'),
        get_string('apicredentials_desc', 'local_sitefont')
    ));
    
    // Site ID (fallback if Central Config not installed)
    $settings->add(new admin_setting_configtext(
        'local_sitefont/siteid',
        get_string('siteid', 'local_sitefont'),
        get_string('siteid_desc', 'local_sitefont') . ($centralconfiginstalled ? ' ' . get_string('centralconfig_fallback', 'local_sitefont') : ''),
        '',
        PARAM_TEXT
    ));
    
    // API Key (fallback if Central Config not installed)
    $settings->add(new admin_setting_configpasswordunmask(
        'local_sitefont/apikey',
        get_string('apikey', 'local_sitefont'),
        get_string('apikey_desc', 'local_sitefont') . ($centralconfiginstalled ? ' ' . get_string('centralconfig_fallback', 'local_sitefont') : ''),
        ''
    ));
    
    // Font Settings heading
    $settings->add(new admin_setting_heading(
        'local_sitefont/fontsettings',
        get_string('fontsettings', 'local_sitefont'),
        ''
    ));

    $settings->add(new admin_setting_configselect(
        'local_sitefont/font_family',
        get_string('fontfamily', 'local_sitefont'),
        get_string('fontfamily_desc', 'local_sitefont'),
        "'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif",
        [
            "'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Inter (recommended)',
            "'Roboto', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Roboto',
            "'Poppins', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Poppins',
            "'Lato', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Lato',
            "'Montserrat', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Montserrat',
            "'Open Sans', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Open Sans',
            "'Source Sans Pro', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Source Sans Pro',
            "'Nunito', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Nunito',
            "'Raleway', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Raleway',
            "'Work Sans', system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'Work Sans',
            "system-ui, -apple-system, BlinkMacSystemFont, sans-serif" => 'System default'
        ]
    ));

    $settings->add(new admin_setting_configselect(
        'local_sitefont/body_size',
        get_string('bodysize', 'local_sitefont'),
        get_string('bodysize_desc', 'local_sitefont'),
        '16px',
        [
            '12px' => '12px (compact)',
            '13px' => '13px',
            '14px' => '14px (small)',
            '15px' => '15px',
            '16px' => '16px (default)',
            '18px' => '18px (large)'
        ]
    ));

    $settings->add(new admin_setting_configselect(
        'local_sitefont/body_weight',
        get_string('bodyweight', 'local_sitefont'),
        get_string('bodyweight_desc', 'local_sitefont'),
        '400',
        [
            '300' => '300 (light)',
            '400' => '400 (normal)',
            '500' => '500 (medium)'
        ]
    ));

    $settings->add(new admin_setting_configselect(
        'local_sitefont/heading_weight',
        get_string('headingweight', 'local_sitefont'),
        get_string('headingweight_desc', 'local_sitefont'),
        '600',
        [
            '500' => '500 (medium)',
            '600' => '600 (semi-bold)',
            '700' => '700 (bold)'
        ]
    ));

    $settings->add(new admin_setting_configselect(
        'local_sitefont/heading_scale',
        get_string('headingscale', 'local_sitefont'),
        get_string('headingscale_desc', 'local_sitefont'),
        '1.1',
        [
            '1.0' => 'Normal (1.0x)',
            '1.1' => 'Slightly larger (1.1x)',
            '1.2' => 'Large (1.2x)',
            '1.3' => 'Extra large (1.3x)'
        ]
    ));

    $settings->add(new admin_setting_configselect(
        'local_sitefont/line_height',
        get_string('lineheight', 'local_sitefont'),
        get_string('lineheight_desc', 'local_sitefont'),
        '1.5',
        [
            '1.3' => '1.3 (compact)',
            '1.4' => '1.4',
            '1.5' => '1.5 (default)',
            '1.6' => '1.6',
            '1.7' => '1.7 (relaxed)'
        ]
    ));

    $ADMIN->add('appearance', $settings);
}
