<?php
/**
 * Footer template for Southern Appalachian Salamanders website
 */
?>
<footer>
  &copy; <?php echo date('Y'); ?> Southern Appalachian Salamanders
</footer>
</div><!-- Close main content container -->
</body>
</html>
<?php 
// Consider moving this database disconnection to a more appropriate place
// such as a shutdown function or connection management class
db_disconnect($db); 
?>
