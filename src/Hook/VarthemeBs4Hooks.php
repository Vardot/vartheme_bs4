<?php

declare(strict_types=1);

namespace Drupal\vartheme_bs4\Hook;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ThemeExtensionList;
use Drupal\Core\Extension\ThemeHandlerInterface;
use Drupal\Core\Extension\ThemeSettingsProvider;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Path\PathMatcherInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Hook implementations for the Vartheme BS4 theme.
 */
class VarthemeBs4Hooks implements ContainerInjectionInterface {

  public function __construct(
    protected ThemeHandlerInterface $themeHandler,
    protected RouteMatchInterface $routeMatch,
    protected EntityTypeManagerInterface $entityTypeManager,
    protected PathMatcherInterface $pathMatcher,
    protected RequestStack $requestStack,
    protected ThemeExtensionList $themeExtensionList,
    protected ThemeSettingsProvider $themeSettingsProvider,
    protected ConfigFactoryInterface $configFactory,
  ) {}

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): static {
    return new static(
      $container->get('theme_handler'),
      $container->get('current_route_match'),
      $container->get('entity_type.manager'),
      $container->get('path.matcher'),
      $container->get('request_stack'),
      $container->get('extension.list.theme'),
      $container->get(ThemeSettingsProvider::class),
      $container->get('config.factory'),
    );
  }

  /**
   * Implements hook_theme_registry_alter().
   */
  #[Hook('theme_registry_alter')]
  public function themeRegistryAlter(array &$theme_registry): void {
    $vartheme_bs4_path = $this->themeHandler->getTheme('vartheme_bs4')->getPath();
    $theme_registry['entity_embed_container']['path'] = $vartheme_bs4_path . '/templates/entity-embed';

    foreach (['page__user__login', 'page__user__register', 'page__user__password', 'page__user__reset'] as $key) {
      $theme_registry[$key]['path'] = $vartheme_bs4_path . '/templates/betterlogin';
    }
  }

  /**
   * Implements hook_theme_suggestions_HOOK_alter() for page templates.
   */
  #[Hook('theme_suggestions_page_alter')]
  public function themeSuggestionsPageAlter(array &$suggestions, array $variables): void {
    $node = $this->routeMatch->getParameter('node');
    if (is_numeric($node)) {
      $node = $this->entityTypeManager->getStorage('node')->load($node);
    }
    if ($node instanceof NodeInterface) {
      array_splice($suggestions, 1, 0, 'page__' . $node->bundle());
    }
  }

  /**
   * Implements hook_preprocess_page_title().
   */
  #[Hook('preprocess_page_title')]
  public function preprocessPageTitle(array &$variables): void {
    // Hide the page title on the front page; keep it for screen readers only.
    if ($this->pathMatcher->isFrontPage()) {
      $variables['title_attributes']['class'][] = 'page-title';
      $variables['title_attributes']['class'][] = 'sr-only';
    }
  }

  /**
   * Implements hook_preprocess_html().
   */
  #[Hook('preprocess_html')]
  public function preprocessHtml(array &$variables): void {
    $base_url = $this->requestStack->getCurrentRequest()->getBaseUrl();
    // The path for the Vartheme BS4 theme.
    $variables['vartheme_bs4_path'] = $base_url . '/' . $this->themeExtensionList->getPath('vartheme_bs4');

    if ($this->themeSettingsProvider->getSetting('bootstrap_barrio_navbar_position')) {
      $variables['navbar_position'] = $this->themeSettingsProvider->getSetting('bootstrap_barrio_navbar_position');
    }
  }

  /**
   * Implements hook_preprocess_page().
   */
  #[Hook('preprocess_page')]
  public function preprocessPage(array &$variables): void {
    $base_url = $this->requestStack->getCurrentRequest()->getBaseUrl();
    // The print logo.
    $variables['logo_print'] = $base_url . '/' . $this->themeExtensionList->getPath('vartheme_bs4') . '/logo-print.png';

    // The site name and slogan.
    $site_config = $this->configFactory->get('system.site');
    $variables['site_name'] = $site_config->get('name');
    $variables['site_slogan'] = $site_config->get('slogan');
  }

  /**
   * Prepares variables for views grid templates.
   */
  #[Hook('preprocess_views_bootstrap_grid')]
  public function preprocessViewsBootstrapGrid(array &$vars): void {
    if (isset($vars['options']['col_xs'])) {
      $vars['options']['col_xs'] = str_replace('xs-', '', $vars['options']['col_xs']);
    }
  }

  /**
   * Implements hook_form_alter().
   */
  #[Hook('form_alter')]
  public function formAlter(array &$form, FormStateInterface $form_state, string $form_id): void {
    if ($form_id == 'content_moderation_entity_moderation_form') {
      $form['#attributes']['class'][] = 'card card-body bg-light';
    }

    if (preg_match('/^node_.*._layout_builder_form$/', $form_id) && isset($form['moderation_state'])) {
      $form['moderation_state']['#attributes']['class'][] = 'card card-body bg-light';
      $form['#attached']['library'][] = 'vartheme_bs4/moderation-state';
    }
  }

  /**
   * Implements hook_preprocess_login_with().
   */
  #[Hook('preprocess_login_with')]
  public function preprocessLoginWith(array &$variables): void {
    $theme_path = $this->themeHandler->getTheme('vartheme_bs4')->getPath();
    foreach ($variables['social_networks'] as $social_network_index => $social_network) {
      if (isset($social_network['img_path'])) {
        $replaced_path_for_icons = str_replace('modules/contrib', 'social_auth', $social_network['img_path']);
        $social_network_img_path_in_vartheme = $theme_path . '/images/' . $replaced_path_for_icons;

        if (file_exists(DRUPAL_ROOT . '/' . $social_network_img_path_in_vartheme)) {
          $variables['social_networks'][$social_network_index]['img_path'] = $social_network_img_path_in_vartheme;
        }
      }
    }
  }

}
