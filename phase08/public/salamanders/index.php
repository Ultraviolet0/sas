<?php
/**
 * index.php
 *
 * Lists all salamanders in the database
 */

require_once('../../private/initialize.php');

// Get all salamanders from the database
$salamander_set = find_all_salamanders();
$page_title = 'Salamanders';

include(SHARED_PATH . '/salamander-header.php');
?>

<h1>Salamanders</h1>

<a href="<?php echo url_for('salamanders/new.php'); ?>">Create Salamander</a>

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

<?php 
mysqli_free_result($salamander_set); 
?>

<p>Thanks to <a href="https://herpsofnc.org">Amphibians and Reptiles of North Carolina</a></p>

<?php include(SHARED_PATH . '/salamander-footer.php'); ?>
