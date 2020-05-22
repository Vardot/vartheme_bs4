<?php

namespace Drupal\Tests\vartheme_bs4\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\Core\Cache\Cache;

/**
 * Vartheme BS4 Tests.
 *
 * @group vartheme_bs4
 */
class VarthemeBs4Tests extends BrowserTestBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'vartheme_bs4';

  /**
   * The profile to install as a basis for testing.
   *
   * @var string
   */
  protected $profile = 'standard';

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'toolbar',
    'language',
    'config_translation',
    'content_translation',
    'locale',
    'node',
    'system',
    'user',
    'block',
    'help',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    ConfigurableLanguage::createFromLangcode('ar')->save();
    Cache::invalidateTags(['rendered', 'locale']);
  }

  /**
   * Check Vartheme BS4 blocks.
   */
  public function testCheckVarthemeBs4Blocks() {
    $assert_session = $this->assertSession();

    $this->drupalLogin($this->rootUser);

    // Vartheme Claro blocks.
    $this->drupalGet('/admin/structure/block/list/vartheme_bs4');

    $assert_session->pageTextContains($this->t('Site branding'));
    $assert_session->pageTextContains($this->t('Main navigation'));
    $assert_session->pageTextContains($this->t('Breadcrumbs'));
    $assert_session->pageTextContains($this->t('Primary admin actions'));
    $assert_session->pageTextContains($this->t('Status messages'));
    $assert_session->pageTextContains($this->t('Page title'));
    $assert_session->pageTextContains($this->t('Tabs'));
    $assert_session->pageTextContains($this->t('Media Hero Slider'));
    $assert_session->pageTextContains($this->t('Highlighted'));
    $assert_session->pageTextContains($this->t('Help'));
    $assert_session->pageTextContains($this->t('Content'));
    $assert_session->pageTextContains($this->t('Main page content'));
    $assert_session->pageTextContains($this->t('Primary'));
    $assert_session->pageTextContains($this->t('SecondaryPlace'));
    $assert_session->pageTextContains($this->t('Footer'));
    $assert_session->pageTextContains($this->t('Footer menu'));
  }

}
