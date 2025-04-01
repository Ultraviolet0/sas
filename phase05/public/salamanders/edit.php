<?php require_once('../../private/initialize.php');

if (!isset($_GET['id'])) {
  redirect_to(url_for('salamanders/index.php'));
}

$id = $_GET['id'];

if (is_post_request()) {

  $salamander = [];
  $salamander['id'] = $id;
  $salamander['name'] = h($_POST['salamander_name']) ?? '';
  $salamander['habitat'] = h($_POST['habitat']) ?? '';
  $salamander['description'] = h($_POST['description']) ?? '';

  $result = update_salamander($salamander);
  if ($result === true) {
    redirect_to(url_for('salamanders/show.php?id=' . $id));
  } else {
    $errors = $result;
    // var_dump($errors);
  }
} else {
  $salamander = find_salamander_by_id($id);
}

$salamander_set = find_all_salamanders();
$salamander_count = mysqli_num_rows($salamander_set);
mysqli_free_result($salamander_set);

$page_title = 'Edit Salamander';
include(SHARED_PATH . '/salamander-header.php'); ?>

<a class="back-link" href="<?php echo url_for('salamanders/index.php'); ?>">&laquo; Back to Salamanders</a>

<h1>Edit Salamander</h1>

<?php echo display_errors($errors); ?>

<form action="<?php echo url_for('salamanders/edit.php?id=' . h(u($id))); ?>" method="post">
  <label for="salamander_name">Salamander Name:</label><br>
  <input type="text" id="salamander_name" name="salamander_name" value="<?php echo h($salamander['name']); ?>"><br>

  <label for="habitat">Habitat:</label><br>
  <textarea id="habitat" name="habitat" cols="50" rows="5"><?php echo h($salamander['habitat']); ?></textarea><br>

  <label for="description">Description:</label><br>
  <textarea id="description" name="description" cols="50" rows="5"><?php echo h($salamander['description']); ?></textarea><br>

  <input type="submit" value="Edit Salamander">
</form>

<?php include(SHARED_PATH . '/salamander-footer.php'); ?>
