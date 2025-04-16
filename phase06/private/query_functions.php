<?php

// Create the find_all_salamanders() function
// This function should return an associative array of salamanders
// Remember that $db needs to be global in scope
function find_all_salamanders()
{
  global $db;

  $sql = "SELECT * FROM salamander ";
  $sql .= "ORDER BY id ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_salamander_by_id($id)
{
  global $db;

  $sql = "SELECT * FROM salamander ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $salamander = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $salamander;
}

function validate_salamander($salamander) {

  $errors = [];

  // name
  if(is_blank($salamander['name'])) {
    $errors[] = "Name cannot be blank.";
  } elseif(!has_length($salamander['name'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Name must be between 2 and 255 characters.";
  }

  // habitat
  if(is_blank($salamander['habitat'])) {
    $errors[] = "Habitat cannot be blank.";
  } else if(!has_length($salamander['habitat'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Habitat must be between 2 and 255 characters.";
  }

  // description
  if(is_blank($salamander['description'])) {
    $errors[] = "Description cannot be blank.";
  } else if(!has_length($salamander['description'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Description must be between 2 and 255 characters.";
  }


  return $errors;
}

function insert_salamander($salamander)
{
  global $db;

  $errors = validate_salamander($salamander);
  if(!empty($errors)) {
    return $errors;
  }

  $sql = "INSERT INTO salamander ";
  $sql .= "(name, habitat, description) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $salamander['name']) . "', ";
  $sql .= "'" . db_escape($db, $salamander['habitat']) . "', ";
  $sql .= "'" . db_escape($db, $salamander['description']) . "' ";
  $sql .= ")";
  $result = mysqli_query($db, $sql);

  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_salamander($salamander)
{
  global $db;

  $errors = validate_salamander($salamander);
  if(!empty($errors)) {
    return $errors;
  }

  $sql = "UPDATE salamander SET ";
  $sql .= "name='" . db_escape($db, $salamander['name']) . "', ";
  $sql .= "habitat='" . db_escape($db, $salamander['habitat']) . "', ";
  $sql .= "description='" . db_escape($db, $salamander['description']) . "' ";
  $sql .= "WHERE id='" . db_escape($db, $salamander['id']) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function delete_salamander($id)
{
  global $db;

  $sql = "DELETE FROM salamander ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);

  // For DELETE statements, $result is true/false
  if ($result) {
    return true;
  } else {
    // DELETE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
