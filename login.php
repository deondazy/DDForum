<?php
/**
 * Loging in.
 */

use DDForum\Core\Option;
use DDForum\Core\User;
use DDForum\Core\Filter;
use DDForum\Core\Site;

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once(DDFPATH . 'startup.php');

$title = 'Login - ' . Option::get('site_name');

require_once(DDFPATH . 'header.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $remember = (isset($_POST['remember'])) ? true : false;

  if (!User::login($_POST['username'], $_POST['password'], $remember) && isset(User::$error)) {
    Site::info(User::$error);
  }
}
?>

<div class="container">
  <div class="form-wrap">

    <?php if (User::isLogged()) Site::info('You are already logged in', false, true); ?>

    <h2 class="page-title">Login To <?php echo Option::get('site_name'); ?></h2>

    <form role="form" action="" method="post" class="action-form form-inline">

      <h4 class="area-head">Enter your Username and Password below to login</h4>

      <div class="form-groups">
        <div class="form-group">
          <label for="login-uname">Username</label>
          <input id="login-uname" class="form-control" type="text" name="username">
        </div>

        <div class="form-group">
          <label for="login-pass">Password</label>
          <input id="login-pass" class="form-control" type="password" name="password">
        </div>

        <div class="form-group">
          <label for="login-remember">
            <input id="login-remember" class="checkbox-input" type="checkbox"> Remember me
          </label>
        </div>

        <input id="login-submit" class="action-button" type="submit" value="login">
      </div>
    </form>
  </div>
</div>
