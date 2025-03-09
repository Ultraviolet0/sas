<?php

require_once('../../private/initialize.php');

if (!isset($_GET['id'])) {
  redirect_to(url_for('/salamanders/index.php'));
}
$id = $_GET['id'];
$salamander_name = '';

if (is_post_request()) {

  // Handle form values sent by new.php

  $salamander_name = $_POST['salamander_name'] ?? '';

  echo "Form parameters<br>";
  echo "Salamander name: " . $salamander_name . "<br>";
}

?>

<?php $page_title = 'Edit Salamander'; ?>
<?php include(SHARED_PATH . '/salamander-header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/salamanders/index.php'); ?>">&laquo; Back to List</a>

  <div class="salamander edit">
    <h1>Edit Salamander</h1>

    <form action="<?php echo url_for('/salamanders/edit.php?id=' . h(u($id))); ?>" method="post">
      <label for="salamander_name">Salamander Name</label><br>
      <input type="text" name="salamander_name" value="<?php echo h($salamander_name); ?>">
      <div id="operations">
        <input type="submit" value="Edit Salamander">
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/salamander-footer.php'); ?>
