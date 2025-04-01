<?php

require_once('../../private/initialize.php');

if (is_post_request()) {

  // Handle form values sent by new.php

  $salamander = [];
  $salamander['name'] = h($_POST['salamander_name']) ?? '';
  $salamander['habitat'] = h($_POST['habitat']) ?? '';
  $salamander['description'] = h($_POST['description']) ?? '';

  $result = insert_salamander($salamander);
  $new_id = mysqli_insert_id($db);
  redirect_to(url_for('salamanders/show.php?id=' . $new_id));
} else {
  redirect_to(url_for('salamanders/new.php'));
}
