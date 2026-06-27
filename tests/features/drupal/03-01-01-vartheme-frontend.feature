@vartheme_bs4 @frontend
Feature: Vartheme BS4 - front-end rendering
  As a visitor
  I want the site rendered with the Bootstrap-based Vartheme

  Scenario: The front page renders with the Bootstrap layout
    Given I am an anonymous user
    When I am on the homepage
    Then ".container" should be visible

  Scenario: The login page renders with the Bootstrap layout
    Given I am an anonymous user
    When I am on "/user/login"
    Then ".container" should be visible
    And I should see "Log in"
