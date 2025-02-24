<?php require_once('../../private/initialize.php'); ?>

<?php
$id = $_GET['id'] ?? '1'; // PHP > 7.0
?>

<?php
$pageTitle = 'Salamander Details';
include(SHARED_PATH . '/salamander-header.php');
?>

<h2><?= $pageTitle; ?></h2>
<p>Page ID: <?= h($id); ?>
<p><a href="<?= url_for('/salamanders/index.php'); ?>">&laquo; Back to Salamander List</a></p>

<?php include(SHARED_PATH . '/salamander-footer.php'); ?>
