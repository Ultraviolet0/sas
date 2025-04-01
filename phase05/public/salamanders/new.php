<?php require_once('../../private/initialize.php');

if (is_post_request()) {

  // Handle form values sent by new.php

  $salamander = [];
  $salamander['name'] = h($_POST['salamander_name']) ?? '';
  $salamander['habitat'] = h($_POST['habitat']) ?? '';
  $salamander['description'] = h($_POST['description']) ?? '';

  $result = insert_salamander($salamander);
  if ($result === true) {
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('salamanders/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }
} else {
  // display the blank form
}

?>

<?php $page_title = 'Create Salamander'; ?>
<?php include(SHARED_PATH . '/salamander-header.php'); ?>

<a class="back-link" href="<?php echo url_for('salamanders/index.php'); ?>">&laquo; Back to Salamanders</a>

<h1>Create Salamander</h1>

<?php echo display_errors($errors); ?>
<form action="<?php echo url_for('salamanders/new.php'); ?>" method="post">
  <label for="salamander_name">Salamander Name:</label><br>
  <input type="text" id="salamander_name" name="salamander_name"><br>

  <label for="habitat">Habitat:</label><br>
  <textarea id="habitat" name="habitat" cols="50" rows="5"></textarea><br>

  <label for="description">Description:</label><br>
  <textarea id="description" name="description" cols="50" rows="5"></textarea><br>

  <input type="submit" value="Create Salamander">
</form>

<?php include(SHARED_PATH . '/salamander-footer.php'); ?>
