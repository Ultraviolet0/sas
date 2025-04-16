<?php

require_once('../../private/initialize.php');
// Use the fina_all_salamanders() function to get an associative array
$salamander_set = find_all_salamanders();

$page_title = 'Salamanders';
include(SHARED_PATH . '/salamander-header.php');

?>
<h1>Salamanders</h1>

<a href="<?= url_for('salamanders/new.php'); ?>">Create Salamander</a>

<!-- Use CSS to style the table -->
<table class="list">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Habitat</th>
    <th>Description</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>

  <!-- // Add PHP code here to loop through the $salamander_set array -->
  <!-- // and output the salamander data in a table -->
  <?php while ($salamander = mysqli_fetch_assoc($salamander_set)) { ?>
    <tr>
      <td><?php echo h($salamander['id']); ?></td>
      <td><?php echo h($salamander['name']); ?></td>
      <td><?php echo h($salamander['habitat']); ?></td>
      <td><?php echo h($salamander['description']); ?></td>
      <td><a class="action" href="<?php echo url_for('salamanders/show.php?id=' . h(u($salamander['id']))); ?>">View</a></td>
      <td><a class="action" href="<?php echo url_for('salamanders/edit.php?id=' . h(u($salamander['id']))); ?>">Edit</a></td>
      <td><a class="action" href="<?php echo url_for('salamanders/delete.php?id=' . h(u($salamander['id']))); ?>">Delete</a></td>
    </tr>
  <?php } ?>
</table>

<!-- // Use the h() function to escape data output -->
<!-- // Use u() function to encode data for URLs -->
<!-- // Use url_for() function to create URLs -->
<!-- // Use the mysqli_fetch_assoc() function to get an associative array -->
<!-- // Use the mysqli_free_result() function to free the result set -->

<?php mysqli_free_result($salamander_set); ?>

Thanks to <a href="https://herpsofnc.org">Amphibians and Reptiles of North Carolina</a>

<?php include(SHARED_PATH . '/salamander-footer.php'); ?>
