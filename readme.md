# Blabber Child Theme

A child theme for the Blabber WordPress theme with additional functionality.

## Features

- Toggle button to hide/show gambling advertisements
- WordPress widget for easy placement in sidebars and widget areas
- Elementor widget for drag-and-drop page building
- Integrates with age verification system
- Maintains the same styling and structure as the parent Blabber theme

## Installation

1. Upload the `blabber-child` folder to your `/wp-content/themes/` directory
2. Activate the theme through the 'Themes' menu in WordPress
3. Configure your site as you would with the Blabber parent theme

## Usage

### Gambling Ads Toggle Button

The theme includes multiple ways to implement the gambling ads toggle functionality:

#### 1. WordPress Widget
- Navigate to **Appearance > Widgets** in your WordPress admin
- Find the "Ad Toggle" widget and drag it to your desired widget area
- Configure the widget title, button text, and alignment
- The widget can be placed in sidebars, footers, or any widget-enabled area

#### 2. Elementor Widget
- When using Elementor page builder, search for "Ad Toggle" in the widgets panel
- Drag the widget to your desired location on the page
- Customize the button text, alignment, colors, and styling through the Elementor interface
- Includes advanced styling options for background, borders, typography, and spacing

#### 3. Footer Integration
The theme also includes automatic footer integration that displays the toggle button.

**How it works:**
- When clicked, it will hide all elements with the class `code-block`
- The setting is saved in a browser cookie (`canSeeAds`) for 365 days
- It is synchronized with the age verification modal, so if a user selects they are under 18, ads will be hidden automatically

## Customization

You can customize the appearance of the toggle button by editing the CSS in the child theme's `style.css` file.

## Dependencies

- Requires the Blabber parent theme
- Uses jQuery (included with WordPress)
- Elementor widget requires Elementor page builder plugin (optional)

## Credits

- Original Blabber theme by AncoraThemes
- Child theme functionality inspired by https://ikwedopsport.nl

## Version History

- 1.0: Initial release with gambling ads toggle button
- 1.1: Added WordPress widget for flexible placement
- 1.2: Added Elementor widget with advanced styling options

## Support

For support with this child theme, please contact the theme developer.
