# Changelog - Change Site Font

All notable changes to this plugin will be documented in this file.

## [1.0.5] - 2025-12-22

### Changed
- Default body size changed from 14px to 16px
- Updated settings labels to reflect new default

## [1.0.4] - 2025-12-22

### Fixed
- FontAwesome icon preservation (help icons, tooltips now display correctly)
- Added specific CSS rules to restore icon fonts

## [1.0.3] - 2025-12-22

### Enhanced
- Added !important CSS overrides for admin/settings pages
- Extended font coverage to all Moodle page layouts
- Added coverage for drawers, modals, tables, quiz elements

## [1.0.2] - 2025-12-22

### Fixed
- Moodle 4.4+ hook system compatibility
- Conditional legacy callback to avoid deprecation warnings
- Added hook_callbacks.php for new hook system

## [1.0.0] - 2025-12-22

### Added
- Initial release
- Site-wide font family selection with 11 Google Fonts options
- Body font size configuration (12px to 18px)
- Body font weight configuration (light, normal, medium)
- Heading font weight configuration (medium, semi-bold, bold)
- Heading size scale multiplier (1.0x to 1.3x)
- Line height configuration (1.3 to 1.7)
- CSS variables injection for theme compatibility
- Google Fonts auto-loading with optimized weights
- Privacy API compliance (null provider)
- Moodle 4.0 to 5.x compatibility
