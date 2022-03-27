/**
 * @file
 * Behaviors for the vartheme bs4 theme.
 */

(function ($, _, Drupal) {
  Drupal.behaviors.varthemeBS4 = {
    attach() {
      // Vartheme JavaScript behaviors goes here.

      // Move panels ipe tray padding buttom by it's outer height.
      $('#panels-ipe-tray')
        .parent('body')
        .css('padding-bottom', $('#panels-ipe-tray').outerHeight());

      // Fix toolbar top space load of the page.
      const toolbarTabOuterHeight =
        $('#toolbar-bar').find('.toolbar-tab').outerHeight() || 0;
      const toolbarTrayHorizontalOuterHeight =
        $('.is-active.toolbar-tray-horizontal').outerHeight() || 0;
      const topSpace = toolbarTabOuterHeight + toolbarTrayHorizontalOuterHeight;
      $('body').css({ 'padding-top': topSpace });
    },
  };
})(window.jQuery, window._, window.Drupal);
