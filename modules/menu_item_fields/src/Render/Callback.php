<?php

namespace Drupal\menu_item_fields\Render;

/**
 * Provides a trusted callbacks to alter some elements markup.
 *
 * NOTE:
 * When dropping compatibility for Drupal < 8.8.0 this object
 * needs to implement
 * Drupal\Core\Render\Element\RenderCallbackInterface;
 *
 * @see https://www.drupal.org/node/2966725
 *
 * @see https://git.drupalcode.org/project/drupal/commit/5a42b47b6ed88a3bf65ff8d23ee24f49ccd20b61#7597429dcbbf29cc3aaf9f732750eeb93a0e61a5_0_1
 *
 * @see menu_item_fields_preprocess_menu__field_content()
 */
class Callback {

  /**
   * Fill the the link field with values from the menu item.
   *
   * #pre_render callback.
   */
  public static function preRenderMenuLinkContent($element) {
    $contentLink = &$element['link'][0];
    $contentUrl = &$contentLink['#url'];

    // Set the title attribute (description field) from the menu item.
    $menuItemAttributes = $element['#menu_item']['url']->getOption('attributes');
    if (isset($menuItemAttributes['title'])) {
      $contentLinkAttributes = $contentUrl->getOption('attributes');
      $contentLinkAttributes['title'] = $menuItemAttributes['title'];
      $contentUrl->setOption('attributes', $contentLinkAttributes);
    }

    $contentUrl->setOption('set_active_class', $element['#menu_item']['url']->getOption('set_active_class'));

    if (is_string($contentLink['#title'])) {
      $contentLink['#title'] = $element['#menu_item']['title'];
    }

    return $element;
  }

}
