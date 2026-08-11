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
 * Hook callbacks for Change Site Font plugin.
 *
 * @package    local_sitefont
 * @copyright  2025 AI Grader
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_sitefont;

defined('MOODLE_INTERNAL') || die();

class hook_callbacks {
    /**
     * Callback for the before_standard_head_html_generation hook (Moodle 4.4+).
     *
     * @param \core\hook\output\before_standard_head_html_generation $hook
     */
    public static function before_standard_head_html_generation(
        \core\hook\output\before_standard_head_html_generation $hook
    ): void {
        $output = self::get_font_output();
        if (!empty($output)) {
            $hook->add_html($output);
        }
    }

    /**
     * Get the font CSS output - shared between hook and legacy callback.
     *
     * @return string HTML to inject into head
     */
    public static function get_font_output(): string {
        global $CFG;

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

        $fontimport = self::get_font_import($font);
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
     * Get the Google Fonts import URL for the selected font.
     *
     * @param string $font The font family string.
     * @return string The CSS import statement or empty string.
     */
    public static function get_font_import(string $font): string {
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
