<?php

namespace Drupal\Tests\vartheme_bs4\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\WebDriverTestBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\Core\Cache\Cache;

/**
 * Vartheme BS4 Tests.
 *
 * @group vartheme_bs4
 */
class VarthemeBs4Tests extends WebDriverTestBase {

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
  protected function setUp(): void {
    parent::setUp();

    ConfigurableLanguage::createFromLangcode('ar')->save();
    Cache::invalidateTags(['rendered', 'locale']);
  }

  /**
   * Check Vartheme BS4 blocks.
   */
  public function testCheckVarthemeBs4Blocks() {

    // Given that the root super user was logged in to the site.
    $this->drupalLogin($this->rootUser);

    // Vartheme BS4 blocks.
    $this->drupalGet('/admin/structure/block/list/vartheme_bs4');

    $this->assertSession()->pageTextContains($this->t('Site branding'));
    $this->assertSession()->pageTextContains($this->t('Main navigation'));
    $this->assertSession()->pageTextContains($this->t('Breadcrumbs'));
    $this->assertSession()->pageTextContains($this->t('Primary admin actions'));
    $this->assertSession()->pageTextContains($this->t('Status messages'));
    $this->assertSession()->pageTextContains($this->t('Page title'));
    $this->assertSession()->pageTextContains($this->t('Tabs'));
    $this->assertSession()->pageTextContains($this->t('Highlighted'));
    $this->assertSession()->pageTextContains($this->t('Help'));
    $this->assertSession()->pageTextContains($this->t('Content'));
    $this->assertSession()->pageTextContains($this->t('Main page content'));
    $this->assertSession()->pageTextContains($this->t('Primary'));
    $this->assertSession()->pageTextContains($this->t('SecondaryPlace'));
    $this->assertSession()->pageTextContains($this->t('Footer'));
    $this->assertSession()->pageTextContains($this->t('Footer menu'));
  }

}
