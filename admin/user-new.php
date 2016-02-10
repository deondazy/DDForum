<?php

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title = 'Add New User';
$file = 'user-new.php';
$parent = 'user-edit.php';

$redirect_url = urlencode(admin_url('user-new.php'));

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  
  $data = array();

  $data['first_name']    =  clean_input($_POST['fname']);
  $data['last_name']     =  clean_input($_POST['lname']);
  $data['display_name']  =  clean_input($_POST['uname']);
  $data['country']       =  clean_input($_POST['country']);
  $data['birth_day']     =  clean_input($_POST['day']);
  $data['birth_month']   =  clean_input($_POST['month']);
  $data['birth_year']    =  clean_input($_POST['year']);
  $data['age']           =  date( 'Y' ) - clean_input($_POST['year']);
  $data['gender']        =  clean_input($_POST['gender']);
  $data['register_date'] =  date( 'Y-m-d' );
  $data['last_seen']     =  date( 'Y-m-d h:i:s' );
  $data['level']         =  clean_input($_POST['level']);
  $data['credit']        =  50; // TODO: Change value to site credit setting

  // Username cannot be empty
  if ( !empty($_POST['uname']) ) {

    // Username cannot exceed 16 characters
    if ( strlen($_POST['uname']) <= 16 ) {

      // Allow only alphanumeric characters, underscores and hyphen
      if ( preg_match("/^[a-zA-Z0-9-_]+$/", $_POST['uname']) ) {

        $username = $_POST['uname'];

        // Check if username is registered
        $ddf_db->query("SELECT `username` FROM $ddf_db->users WHERE username = '$username'");
    
        if ( $ddf_db->row_count == 0 ) {

          $data['username']      =  clean_input($username);
         
        }
        else {
          $error[] = "This username $username is already registered. Try another";
        }
      }
      else {
        $error[] = 'Username can only have alphanumeric, hyphen and underscore characters';
      }
    }
    else {
      $error[] = 'Username is too long. Max: 16 characters';
    }
  }
  else {
    $error[] = 'Username is required';
  }
  
  if ( !empty($_POST['email']) ) {
    
    if ( preg_match('/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/', $_POST['email']) ) {

      $email = $_POST['email'];

      // Check if email is registered
      $ddf_db->query("SELECT `email` FROM $ddf_db->users WHERE email = '$email'");
    
      if ( $ddf_db->row_count == 0 ) {

        $data['email']      =  clean_input($email);
       
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
  
  if ( !empty($_POST['pass']) ) {
    if ( !empty($_POST['cpass']) ) {
      if ( $_POST['pass'] == $_POST['cpass'] ) {
        $data['password']      =  md5($_POST['pass']);
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
  if ( !empty($_POST['avatar']) ) {
    $upload_time  =   date('YmdHis') . '_';
    $upload_dir   =   ABSPATH . 'inc/avatar/';
    $upload_file  =   $upload_dir . basename($upload_time . $_FILES['avatar']['name']);

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
      $data['avatar'] = home_url() . '/inc/avatar/' . $upload_time . $_FILES['avatar']['name'];
    }
    else {
      $error[] = "Unable to upload avatar.";
    }
  }
  else {
    $data['avatar'] = home_url() . '/inc/avatar/ddf-avatar.png';
  }
  
  if ( empty($error) ) {
    $ddf_db->insert_data( $ddf_db->users, $data );

    if ( $ddf_db->affected_rows == -1 ) {
      show_message('ERROR: Adding new user failed');
    }
    else if ( $ddf_db->affected_rows == 0 ) {
      show_message('ERROR: Unable to add user');
    }
    else if ( $ddf_db->affected_rows > 0 ) {
      redirect("user-edit.php?message=New user added");
    }
  }
}

require_once( ABSPATH . 'admin/admin-header.php' );

if ( !empty($error) ) {
  foreach ($error as $e) {
    show_message( 'ERROR: ' . $e );
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
              <option value="1">Head Admin</option>
              <option value="2">Admin</option>
              <option value="3">Moderator</option>
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
          <td><?php echo date_select(); ?></td>
        </tr>

        <tr>
          <th scope="row"><label for="country">Country</label></th>
          <td>
            <?php echo json_item_select( ABSPATH . 'inc/country.json', '', 'country', 'country' ); ?>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="user-avatar">Avatar</label></th>
          <td>
            <input name="MAX_FILE_SIZE" type="hidden" value="‪5242880‬" />
            <div id="show-avatar"><?php //echo $ddf_user->get_dp( $user_id ) ?></div>
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

<?php include( ABSPATH . 'admin/admin-footer.php' );
