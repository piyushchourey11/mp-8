# Menu item fields

The main purpose of the module is to be able to add fields to
custom menu items and render them with different view modes.

## Features

* Add fields to menu items and sort their display.
* Show fielded menu items with a block chosing the view mode.
* Configure additional options on the formatter the 'rel' and target attributes.
* Add more attributes with the [Link attributes](https://www.drupal.org/project/link_attributes/) module.
* Optionally have a field on the menu link entity that overrides the display mode.
  * Is up to the site builder to create it.
  * This field needs to store the string value of the display mode, for example: 'mega'.

## Similar modules

* [Menu item extras](https://www.drupal.org/project/menu_item_extras):
  * Provides a bundle for each menu while this module does not add any new bundle.
  * The children of a menu item can be sorted on the interface. With this module you need to edit the template.
  * In general this module tries to be more simple trying to override as few templates as posible.

## Contributions

Patches on drupal.org are accepted but merge requests on
[gitlab](https://gitlab.com/upstreamable/drupal-menu-item-fields) are preferred.

## Future improvements

Being able to load the field information into other kind of menu items so
all the menu items can be rendered similarly (e.g icons) and not only custom menu items.

## Real time communication

You can join the [#menu-item-fields](https://drupalchat.me/channel/menu-item-fields)
channel on [drupalchat.me](https://drupalchat.me).

## Notes

Inspired by the [Menu Link Content fields](https://www.drupal.org/project/menu_link_content_fields) module
and of course Menu Link Extras.
