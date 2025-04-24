<?php
/**
 * Utility functions for the Southern Appalachian Salamanders website
 *
 * Contains functions for URL handling, encoding, error handling, and form processing
 */

/**
 * Creates a complete URL by prepending the base URL
 *
 * @param string $script_path The relative path to be appended to base URL
 * @return string The complete URL
 */
function url_for($script_path) {
    // Add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

/**
 * Wrapper for urlencode()
 *
 * @param string $string The string to URL encode
 * @return string The URL encoded string
 */
function u($string = "") {
    return urlencode($string);
}

/**
 * Wrapper for rawurlencode()
 *
 * @param string $string The string to raw URL encode
 * @return string The raw URL encoded string
 */
function raw_u($string = "") {
    return rawurlencode($string);
}

/**
 * Wrapper for htmlspecialchars()
 *
 * @param string $string The string to be HTML escaped
 * @return string The HTML escaped string
 */
function h($string = "") {
    return htmlspecialchars($string);
}

/**
 * Returns a 404 Not Found error and terminates script execution
 *
 * @return void
 */
function error_404() {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}

/**
 * Returns a 500 Internal Server Error and terminates script execution
 *
 * @return void
 */
function error_500() {
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}

/**
 * Redirects to a different page and terminates script execution
 *
 * @param string $location The URL to redirect to
 * @return void
 */
function redirect_to($location) {
    header("Location: " . $location);
    exit();
}

/**
 * Checks if the current request method is POST
 *
 * @return bool True if request method is POST, false otherwise
 */
function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

/**
 * Checks if the current request method is GET
 *
 * @return bool True if request method is GET, false otherwise
 */
function is_get_request() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

/**
 * Formats an array of error messages into HTML
 *
 * @param array $errors List of error messages
 * @return string HTML formatted error messages
 */
function display_errors($errors = array()) {
    $output = '';
    if (!empty($errors)) {
        $output .= "<div class=\"errors\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach ($errors as $error) {
            $output .= "<li>" . h($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}
