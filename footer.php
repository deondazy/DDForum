<?php

use DDForum\Core\Site;
use DDForum\Core\Option;

?>

</div><!-- .content -->

<footer id="footer" class="site-footer">
	<div class="container">
    <div class="site-footer-credit">&copy; <?php echo date('Y') . ' ' . Option::get('site_name'); ?>
    <div class="pull-right">
      <span class="site-footer-stat">
        <strong><?php echo Site::userCount(); ?></strong> Registered users
      </span>
      <span class="site-footer-stat">
        <strong><?php echo Site::onlineUsersCount(); ?></strong> Users online
      </span>
      <span class="site-footer-stat">
        <strong><?php echo Site::forumCount(); ?></strong> Forums
      </span>
      <span class="site-footer-stat">
        <strong><?php echo Site::topicCount(); ?></strong> Topics
      </span>
    </div>
</footer>
</div><!-- #wrapper -->
</body>
</html>
