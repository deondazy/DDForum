<?php

use DDForum\Core\User;
use DDForum\Core\Site;
use DDForum\Core\Util;

if (!defined('DDFPATH')) {
  define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

/** Load admin **/
require_once(DDFPATH .'admin/admin.php');

$title       = 'Add New User';
$file        = 'user-new.php';
$parent_menu = 'user-edit.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $data = [
    'first_name'    =>  $_POST['fname'],
    'last_name'     =>  $_POST['lname'],
    'display_name'  =>  $_POST['uname'],
    'country'       =>  $_POST['country'],
    'birth_day'     =>  $_POST['day'],
    'birth_month'   =>  $_POST['month'],
    'birth_year'    =>  $_POST['year'],
    'age'           =>  date( 'Y' ) - $_POST['year'],
    'gender'        =>  $_POST['gender'],
    'register_date' =>  date('Y-m-d'),
    'last_seen'     =>  date('Y-m-d h:i:s'),
    'level'         =>  $_POST['level'],
    'credit'        =>  50, // TODO: Change value to site credit setting
  ];

  // Username cannot be empty
  if (!empty($_POST['uname'])) {

    // Username cannot exceed 16 characters
    if (strlen($_POST['uname']) <= 16) {

      // Allow only alphanumeric characters, underscores and hyphen
      if (preg_match("/^[a-zA-Z0-9]+$/", $_POST['uname'])) {

        // Check if username is already taken
        if (!$user->findByName($_POST['uname'])) {

          $data['username'] =  $_POST['uname'];
        }
        else {
          $error[] = "This username {$username} is already registered. Try another";
        }
      }
      else {
        $error[] = 'Username can only have alphanumeric characters';
      }
    }
    else {
      $error[] = 'Username is too long. Max: 16 characters';
    }
  }
  else {
    $error[] = 'Username is required';
  }

  if (!empty($_POST['email'])) {

    // Check if email is valid
    if (preg_match('/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/', $_POST['email'])) {

      // Check if email is registered
      if (!$user->findByEmail($_POST['email'])) {

        $data['email'] =  $_POST['email'];
      }
      else {
        $error[] = "Email address is already taken";
      }
    }
    else {
      $error[] = 'Invalid Email address';
    }
  }
  else {
    $error[] = 'Email is required';
  }

  if (!empty($_POST['pass'])) {
    if (!empty($_POST['cpass'])) {
      if ($_POST['pass'] == $_POST['cpass']) {
        $data['password'] = md5($_POST['pass']);
      }
      else {
        $error[] = 'Password mismatch';
      }
    }
    else {
      $error[] = 'Confirm Password is required';
    }
  }
  else {
    $error[] = 'Password is required';
  }

  // Avatar
  if (!empty($_POST['avatar'])) {
    $upload_time  =   date('YmdHis') . '_';
    $upload_dir   =   DDFPATH . 'inc/avatar/';
    $upload_file  =   $upload_dir . basename($upload_time . $_FILES['avatar']['name']);

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
      $data['avatar'] = Site::url() . '/inc/avatar/' . $upload_time . $_FILES['avatar']['name'];
    }
    else {
      $error[] = "Unable to upload avatar.";
    }
  }
  else {
    $data['avatar'] = Site::url() . '/inc/avatar/ddf-avatar.png';
  }

  if (empty($error)) {

    if (!$user->create($data)) {
      Site::info('ERROR: Adding new user failed', true);
    } else {
      Util::redirect("user-edit.php?message=New user added", true);
    }
  }
}

require_once(DDFPATH .'admin/admin-header.php');

if (!empty($error)) {
  foreach ($error as $e) {
    Site::info('ERROR: ' . $e, true);
  }
}
?>

<form enctype="multipart/form-data" action="" method="post" role="form" novalidate="novalidate">

  <div class="form-wrap-main">

    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="uname">Username*</label></th>
          <td><input name="uname" type="text" id="uname" class="text-box-lg" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="email">Email*</label></th>
          <td><input name="email" type="email" id="email" class="text-box-lg" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="level">Level</label></th>
          <td>
            <select name="level" id="level" class="select-box">
              <option value="0">User</option>
              <option value="1">Admin</option>
              <option value="2">Moderator</option>
            </select>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="fname">First Name</label></th>
          <td><input name="fname" type="text" id="fname" class="text-box-lg" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="lname">Last Name</label></th>
          <td><input name="lname" type="text" id="lname" class="text-box-lg" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="gender">Gender</label></th>
          <td>
            <select name="gender" id="gender" class="select-box">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="byear">Birthday</label></th>
          <td><?php echo Util::selectDate(); ?></td>
        </tr>

        <tr>
          <th scope="row"><label for="country">Country</label></th>
          <td>
            <?php echo Util::selectFromJson(DDFPATH .'inc/country.json', '', 'country', 'country'); ?>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="user-avatar">Avatar</label></th>
          <td>
            <input name="MAX_FILE_SIZE" type="hidden" value="‪5242880‬" />
            <div id="show-avatar"><img src="<?php echo Site::url(); ?>/inc/avatar/ddf-avatar.png"></div>
            <div id="response"></div>
            <input name="avatar" type="file" id="user-avatar" />
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="pass">Password*</label></th>
          <td><input name="pass" type="password" id="pass" class="text-box-lg" /></td>
        </tr>

        <tr>
          <th scope="row"><label for="cpass">Confirm Password*</label></th>
          <td><input name="cpass" type="password" id="cpass" class="text-box-lg" /></td>
        </tr>
      </tbody>
    </table>

    <p><input name="submit" type="submit" id="new-user-submit" value="Add New User" class="primary-button" /></p>

  </div>

</form>

<?php include(DDFPATH .'admin/admin-footer.php');
