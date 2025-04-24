<?php

/**
 * Database connection and utility functions
 *
 * Provides functions for database connectivity and common database operations
 */

require_once('db_credentials.php');

/**
 * Establishes a connection to the database
 * 
 * @return mysqli Database connection object
 */
function db_connect()
{
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect();
  return $connection;
}

/**
 * Closes an active database connection
 * 
 * @param mysqli $connection The database connection to close
 * @return void
 */
function db_disconnect($connection)
{
  if (isset($connection)) {
    mysqli_close($connection);
  }
}

/**
 * Escapes a string for safe use in SQL queries
 * 
 * @param mysqli $connection The database connection
 * @param string $string The string to escape
 * @return string The escaped string
 */
function db_escape($connection, $string)
{
  return mysqli_real_escape_string($connection, $string);
}

/**
 * Confirms database connection was successful
 * 
 * @return void
 */
function confirm_db_connect()
{
  if (mysqli_connect_errno()) {
    $msg = "Database connection failed: ";
    $msg .= mysqli_connect_error();
    $msg .= " (" . mysqli_connect_errno() . ")";
    exit($msg);
  }
}

/**
 * Verifies a database query returned valid results
 * 
 * @param mixed $result_set The result set to check
 * @return void
 */
function confirm_result_set($result_set)
{
  if (!$result_set) {
    exit("Database query failed.");
  }
}
