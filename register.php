<?php
/**
 * User Registration
 *
 * @package DDForum
 */

use DDForum\Core\Option;
use DDForum\Core\User;
use DDForum\Core\Filter;
use DDForum\Core\Site;
use DDForum\Core\Util;

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once(DDFPATH . 'startup.php');

$title = 'Register - ' . Option::get('site_name');

require_once(DDFPATH . 'header.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = [
    'first_name'  => $_POST['fname'],
    'last_name'   => $_POST['lname'],
    'username'    => $_POST['uname'],
    'password'    => $_POST['pass'],
    'password2'   => $_POST['cpass'],
    'email'       => $_POST['email'],
    'gender'      => $_POST['gender'],
    'birth_day'   => $_POST['day'],
    'birth_month' => $_POST['month'],
    'birth_year'  => $_POST['year'],
    'country'     => $_POST['country'],
  ];

  User::register($user);
}

?>
<div class="container" >

  <?php if (User::isLogged()) {
    Site::info('You are already logged in, logout then click Register.', true);
  } ?>

  <form action="" method="post" class="action-form">
    <p class="form-control">
      <label for="reg-fname">First name</label>
      <input id="reg-fname" class="box-input" type="text" name="fname" <?php echo Util::fill('fname'); ?>>
    </p>
    <p class="form-control">
      <label for="reg-lname">Last name</label>
      <input id="reg-lname" class="box-input" type="text" name="lname" <?php echo Util::fill('lname'); ?>>
    </p>
    <p class="form-control">
      <label for="reg-uname">Username</label>
      <input id="reg-uname" class="box-input" type="text" name="uname" <?php echo Util::fill('uname'); ?>>
    </p>
    <p class="form-control">
      <label for="reg-pass">Password</label>
      <input id="reg-pass" class="box-input" type="password" name="pass">
    </p>
    <p class="form-control">
      <label for="reg-cpass">Confirm password</label>
      <input id="reg-cpass" class="box-input" type="password" name="cpass">
    </p>
    <p class="form-control">
      <label for="reg-email">Email</label>
      <input id="reg-email" class="box-input" type="text" name="email" <?php echo Util::fill('email'); ?>>
    </p>
    <p class="form-control">
      <label for="reg-gender">Gender</label>
      <select id="reg-gender" class="box-select" name="gender">
        <option value="male" <?php echo Util::fill('gender', 'select', 'male'); ?>>Male</option>
        <option value="female" <?php echo Util::fill('gender', 'select', 'female'); ?>>Female</option>
      </select>
    </p>
    <p class="form-control">
      <label for="reg-dob">Birthday</label>
      <?php echo Util::selectDate(); ?>
    </p>
    <p class="form-control">
      <label for="reg-country">Country</label>
      <?php echo Util::selectFromJson(DDFPATH .'inc/country.json', '', 'country', 'country'); ?>
    </p>
    <p class="form-control">
      <input id="reg-submit" class="action-button" type="submit" value="Register">
    </p>
  </form>
</div>
