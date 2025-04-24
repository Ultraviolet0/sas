<?php
/**
 * Validation functions
 *
 * Contains functions for validating input data in various ways
 */

/**
 * Validates data presence (blank check)
 * 
 * - Uses trim() so empty spaces don't count
 * - Uses === to avoid false positives
 * - Better than empty() which considers "0" to be empty
 * 
 * @param mixed $value The value to check
 * @return bool True if value is blank, false otherwise
 */
function is_blank($value) {
    return !isset($value) || trim($value) === '';
}

/**
 * Validates data presence
 * 
 * - Reverse of is_blank()
 * 
 * @param mixed $value The value to check
 * @return bool True if value has presence, false otherwise
 */
function has_presence($value) {
    return !is_blank($value);
}

/**
 * Validates string length is greater than minimum
 * 
 * - Spaces count towards length
 * - Use trim() if spaces should not count
 * 
 * @param string $value The string to check
 * @param int $min The minimum required length
 * @return bool True if string is longer than minimum, false otherwise
 */
function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
}

/**
 * Validates string length is less than maximum
 * 
 * - Spaces count towards length
 * - Use trim() if spaces should not count
 * 
 * @param string $value The string to check
 * @param int $max The maximum allowed length
 * @return bool True if string is shorter than maximum, false otherwise
 */
function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
}

/**
 * Validates string length is exactly as specified
 * 
 * - Spaces count towards length
 * - Use trim() if spaces should not count
 * 
 * @param string $value The string to check
 * @param int $exact The exact required length
 * @return bool True if string is exactly the specified length, false otherwise
 */
function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
}

/**
 * Validates string length against various criteria
 * 
 * - Combines functions greater_than, less_than, exactly
 * - Spaces count towards length
 * - Use trim() if spaces should not count
 * 
 * @param string $value The string to check
 * @param array $options Array of criteria options (min, max, exact)
 * @return bool True if string meets all criteria, false otherwise
 */
function has_length($value, $options) {
    if (isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
        return false;
    } elseif (isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
        return false;
    } elseif (isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
        return false;
    } else {
        return true;
    }
}

/**
 * Validates inclusion in a set
 * 
 * @param mixed $value The value to check
 * @param array $set The set to check against
 * @return bool True if value is in the set, false otherwise
 */
function has_inclusion_of($value, $set) {
    return in_array($value, $set);
}

/**
 * Validates exclusion from a set
 * 
 * @param mixed $value The value to check
 * @param array $set The set to check against
 * @return bool True if value is not in the set, false otherwise
 */
function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
}

/**
 * Validates inclusion of character(s)
 * 
 * - strpos returns string start position or false
 * - uses !== to prevent position 0 from being considered false
 * - strpos is faster than preg_match()
 * 
 * @param string $value The string to check
 * @param string $required_string The substring to find
 * @return bool True if required string is found, false otherwise
 */
function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
}

/**
 * Validates correct format for email addresses
 * 
 * - Format: [chars]@[chars].[2+ letters]
 * - Uses regular expression
 * 
 * @param string $value The email to validate
 * @return bool True if email format is valid, false otherwise
 */
function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}

/**
 * Validates uniqueness of pages.menu_name
 * 
 * - For new records, provide only the menu_name
 * - For existing records, provide current ID as second argument
 * 
 * @param string $menu_name The menu_name to check
 * @param string $current_id The current record ID (default "0")
 * @return bool True if menu_name is unique, false otherwise
 */
function has_unique_page_menu_name($menu_name, $current_id = "0") {
    global $db;
    
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE menu_name='" . db_escape($db, $menu_name) . "' ";
    $sql .= "AND id != '" . db_escape($db, $current_id) . "'";
    
    $page_set = mysqli_query($db, $sql);
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);
    
    return $page_count === 0;
}
