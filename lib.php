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
 * Change Site Font - Library functions
 *
 * This file provides the legacy callback for Moodle 4.0-4.3 only.
 * Moodle 4.4+ uses the hook system defined in db/hooks.php.
 *
 * @package    local_sitefont
 * @copyright  2025 AI Grader
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Only define the legacy callback if the new hook system doesn't exist.
// This prevents the deprecation warning in Moodle 4.4+.
if (!class_exists('\core\hook\output\before_standard_head_html_generation')) {

    /**
     * Inject CSS variables and font imports before the standard HTML head.
     * Legacy callback for Moodle 4.0-4.3 only.
     *
     * @return string HTML to inject into head
     */
    function local_sitefont_before_standard_html_head() {
        global $CFG;

        // Check if plugin is unlocked
        if (class_exists('\local_sitefont\unlock_verifier')) {
            if (!\local_sitefont\unlock_verifier::is_unlocked()) {
                return ''; // Plugin not unlocked - don't apply font styling
            }
        }

        $font = get_config('local_sitefont', 'font_family');
        if (empty($font)) {
            $font = "'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif";
        }

        $bodysize = get_config('local_sitefont', 'body_size');
        if (empty($bodysize)) {
            $bodysize = '16px';
        }

        $bodyweight = get_config('local_sitefont', 'body_weight');
        if (empty($bodyweight)) {
            $bodyweight = '400';
        }

        $headingweight = get_config('local_sitefont', 'heading_weight');
        if (empty($headingweight)) {
            $headingweight = '600';
        }

        $scale = get_config('local_sitefont', 'heading_scale');
        if (empty($scale)) {
            $scale = '1.1';
        }

        $lineheight = get_config('local_sitefont', 'line_height');
        if (empty($lineheight)) {
            $lineheight = '1.5';
        }

        $output = '';

        $fontimport = local_sitefont_get_font_import_legacy($font);
        if (!empty($fontimport)) {
            $output .= '<style>' . $fontimport . '</style>' . "\n";
        }

        $css = "
            :root {
                --site-font-family: {$font};
                --site-body-size: {$bodysize};
                --site-body-weight: {$bodyweight};
                --site-heading-weight: {$headingweight};
                --site-heading-scale: {$scale};
                --site-line-height: {$lineheight};
            }
        ";

        $output .= '<style>' . $css . '</style>' . "\n";
        $output .= '<link rel="stylesheet" href="' . $CFG->wwwroot . '/local/sitefont/styles.css">' . "\n";

        return $output;
    }

    /**
     * Get the Google Fonts import URL for the selected font (legacy version).
     *
     * @param string $font The font family string.
     * @return string The CSS import statement or empty string.
     */
    function local_sitefont_get_font_import_legacy(string $font): string {
        $fontmap = [
            'Inter' => 'Inter:wght@300;400;500;600;700',
            'Roboto' => 'Roboto:wght@300;400;500;700',
            'Poppins' => 'Poppins:wght@300;400;500;600;700',
            'Lato' => 'Lato:wght@300;400;700',
            'Montserrat' => 'Montserrat:wght@300;400;500;600;700',
            'Open Sans' => 'Open+Sans:wght@300;400;500;600;700',
            'Source Sans Pro' => 'Source+Sans+Pro:wght@300;400;600;700',
            'Nunito' => 'Nunito:wght@300;400;500;600;700',
            'Raleway' => 'Raleway:wght@300;400;500;600;700',
            'Work Sans' => 'Work+Sans:wght@300;400;500;600;700'
        ];

        foreach ($fontmap as $name => $spec) {
            if (strpos($font, $name) !== false) {
                return "@import url('https://fonts.googleapis.com/css2?family={$spec}&display=swap');";
            }
        }

        return '';
    }
}
