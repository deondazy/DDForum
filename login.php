<?php
/**
 * Loging in.
 */

use DDForum\Core\User;
use DDForum\Core\Site;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once DDFPATH.'startup.php';

// Set page title
$title = 'Login - '.$option->get('site_name');

// Load page header
include DDFPATH.'header.php'; ?>

<h2 class="page-title">Login</h2>

<?php
// Check if form is submitted
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $remember = (isset($_POST['login-remember'])) ? true : false;

    try {
        DDForum\Core\UserAuth::login($_POST['username'], $_POST['password'], $remember);
    } catch (DDForum\Core\Exception\WrongValueException $e) {
        Site::info($e->getMessage(), true);
    }
}
?>

<div class="form-wrap">
<?php
if (User::isLogged()) {
    Site::info('You are already logged in', false, true);
} ?>

<form role="form" method="post" class="action-form">

  <div class="form-groups">
    <div class="form-group">
      <label for="login-uname">Username</label>
      <input id="login-uname" class="form-control" type="text" name="username">
    </div>

    <div class="form-group">
        <a class="pull-right" href="<?php echo $siteUrl; ?>/forgot-password">Forgot your password?</a>
      <label for="login-pass">Password</label>
      <input id="login-pass" class="form-control" type="password" name="password">
    </div>

    <div class="form-group">
      <label for="login-remember">
        <input id="login-remember" class="checkbox-input" type="checkbox" name="login-remember"> Remember me
      </label>
    </div>

    <input id="login-submit" class="centered action-button front-login-button" type="submit" value="Login">
  </div>
</form>

<div class="alternative divider"><h5>New to <?php echo $option->get('site_name'); ?>?</h5></div>
<div class="centered new-account-section"><a class="secondary-button" href="<?php echo $siteUrl; ?>/register">Create a new account</a></div>
</div>


<?php include('footer.php'); ?>
