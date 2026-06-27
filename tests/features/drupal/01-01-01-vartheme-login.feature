@vartheme_bs4 @login
Feature: Vartheme BS4 - login page
  Scenario: The login page loads for an anonymous visitor
    Given I am an anonymous user
    When I am on "/user/login"
    Then "#user-login-form" should be visible
    And I should see "Log in"
