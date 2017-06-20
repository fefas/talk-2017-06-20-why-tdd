Feature: Check username format and availability
  In order to check if I can use an username
  As an user
  I want to request POST /check-username with the username in the body

  Scenario: The username has a valid format and is available
    When I request POST "/check-username" with the following body:
      """
      {
        "username": "fefas"
      }
      """
    Then the response status code should be 200
    And the response body should be empty

  Scenario: The username is not provided
    When I request POST "/check-username" with the following body:
      """
      {
      }
      """
    Then the response status code should be 422
    And the response body should be:
      """
      {
        "message": "The field 'username' is missing"
      }
      """
