<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Create Salamander'; ?>
<?php include(SHARED_PATH . '/salamander-header.php'); ?>

<a class="back-link" href="<?php echo url_for('salamanders/index.php'); ?>">&laquo; Back to Salamanders</a>

<h1>Create Salamander</h1>

<form action="<?php echo url_for('salamanders/create.php'); ?>" method="post">
  <label for="salamander_name">Salamander Name:</label><br>
  <input type="text" id="salamander_name" name="salamander_name" required><br>

  <label for="habitat">Habitat:</label><br>
  <textarea id="habitat" name="habitat" cols="50" rows="5" required></textarea><br>

  <label for="description">Description:</label><br>
  <textarea id="description" name="description" cols="50" rows="5" required></textarea><br>

  <input type="submit" value="Create Salamander">
</form>

<?php include(SHARED_PATH . '/salamander-footer.php'); ?>
