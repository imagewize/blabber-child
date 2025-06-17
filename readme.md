# Blabber Child Theme

A child theme for the Blabber WordPress theme with additional functionality.

## Features

- Toggle button to hide/show gambling advertisements
- Integrates with age verification system
- Maintains the same styling and structure as the parent Blabber theme

## Installation

1. Upload the `blabber-child` folder to your `/wp-content/themes/` directory
2. Activate the theme through the 'Themes' menu in WordPress
3. Configure your site as you would with the Blabber parent theme

## Usage

### Gambling Ads Toggle Button

The theme includes a toggle button in the footer that allows users to hide or show gambling advertisements. This button is labeled "Verberg gokreclames" (Hide gambling ads) and works as follows:

- When clicked, it will hide all elements with the class `code-block`
- The setting is saved in a browser cookie (`canSeeAds`) for 365 days
- It is synchronized with the age verification modal, so if a user selects they are under 18, ads will be hidden automatically

## Customization

You can customize the appearance of the toggle button by editing the CSS in the child theme's `style.css` file.

## Dependencies

- Requires the Blabber parent theme
- Uses jQuery (included with WordPress)

## Credits

- Original Blabber theme by AncoraThemes
- Child theme functionality inspired by https://ikwedopsport.nl

## Version History

- 1.0: Initial release with gambling ads toggle button

## Support

For support with this child theme, please contact the theme developer.
