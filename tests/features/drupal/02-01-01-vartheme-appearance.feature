@vartheme_bs4 @appearance
Feature: Vartheme BS4 - appearance
  As a site administrator
  I want the Vartheme (Bootstrap 4 - SASS) theme available

  Background:
    Given I am a logged in user with the "Webmaster" user

  Scenario: The Vartheme theme is listed on the appearance page
    When I go to "/admin/appearance"
    Then I should see "Vartheme"
    And I should see "Bootstrap 4 - SASS"

  Scenario: The theme is based on Bootstrap Barrio
    When I go to "/admin/appearance"
    Then I should see "Bootstrap Barrio"

  Scenario: The Vartheme theme settings page loads
    When I go to "/admin/appearance/settings/vartheme_bs4"
    Then I should see "Vartheme"
    And I should not see "The website encountered an unexpected error"
