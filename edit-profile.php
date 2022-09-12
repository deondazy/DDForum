<?php
/**
 * Edit Profile Screen
 */
use DDForum\Core\Util;
use DDForum\Core\User;
use DDForum\Core\Site;

define('DDFPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

// Load Startup file
require_once DDFPATH.'startup.php';

$title = 'Edit Profile - ' . $option->get('site_name');

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $data = [
        'first_name'    => Util::escape($_POST['fname']),
        'last_name'     => Util::escape($_POST['lname']),
        'display_name'  => Util::escape($_POST['dname']),
        'country'       => Util::escape($_POST['country']),
        'state'         => Util::escape($_POST['state']),
        'city'          => Util::escape($_POST['city']),
        'mobile'        => Util::escape($_POST['mobile']),
        'website_title' => Util::escape($_POST['website-title']),
        'website_url'   => Util::escape($_POST['website-url']),
        'facebook'      => Util::escape($_POST['facebook']),
        'twitter'       => Util::escape($_POST['twitter']),
        'gender'        => Util::escape($_POST['gender']),
        'birth_day'     => Util::escape($_POST['day']),
        'birth_month'   => Util::escape($_POST['month']),
        'birth_year'    => Util::escape($_POST['year']),
        'age'           => Util::escape(date('Y') - $_POST['year']),
        'biography'     => Util::escape($_POST['bio']),
    ];

    if (!empty($_POST['email'])) {
        if (Util::isEmail($_POST['email'])) {
            $data['email'] = $_POST['email'];
        } else {
            $err = 'Email is invalid';
        }
    } else {
        $err = 'Email cannot be empty';
    }

    if (!empty($_POST['pass'])) {
        if (!empty($_POST['cpass'])) {
            if ($_POST['pass'] == $_POST['cpass']) {
                $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $data['password'] = $pass;
            } else {
                $err = 'Error: Password mismatch.';
            }
        } else {
            $err = 'Please confirm your password';
        }
    }

    // Avatar
    if (!empty($_FILES['avatar'])) {
        $upload_time = date('YmdHis').'_';
        $upload_dir = DDFPATH.'inc/avatar/';
        $upload_file = $upload_dir.basename($upload_time.$_FILES['avatar']['name']);

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
            $data['avatar'] = Site::url().'/inc/avatar/'.$upload_time.$_FILES['avatar']['name'];
        }
    }

    if (empty($err)) {
        $update_user = $user->update($data, $user->currentUserId());

        if (0 == $update_user) {
            $msg = 'No changes';
        } elseif ($update_user > 0) {
            $msg = 'Profile Updated';
        }
    }
}

include DDFPATH . 'header.php'; ?>

<h2 class="page-title">Edit Profile</h2>

<form method="post" class="action-form" enctype="multipart/form-data">
    <?php
    if (isset($msg)) {
        Site::info($msg);
    } elseif (isset($_GET['message'])) {
        Site::info($_GET['message']);
    }

    if (isset($err)) {
        Site::info($err, true);
    }
    ?>

    <div class="form-group">
        <label for="fname">First Name</label>
        <input class="form-control" type="text" value="<?php echo $user->get('first_name'); ?>" name="fname" id="fname">
    </div>
          
    <div class="form-group">
        <label for="lname">Last Name</label>
        <input class="form-control" type="text" value="<?php echo $user->get('last_name'); ?>" name="lname" id="lname">
    </div>
          
    <div class="form-group"> 
        <label for="dname">Display Name</label>
        <select class="form-control" name="dname" id="dname">
            <?php
            $display_name = array();
            $display_name['username'] = $user->get('username');

            if (!empty($user->get('first_name'))) {
                $display_name['first_name'] = $user->get('first_name');
            }
            if (!empty($user->get('last_name'))) {
                $display_name['last_name'] = $user->get('last_name');
            }
            if (!empty($user->get('first_name')) && !empty($user->get('last_name'))) {
                $display_name['first_last'] = $user->get('first_name').' '.$user->get('last_name');
                $display_name['last_first'] = $user->get('last_name').' '.$user->get('first_name');
            }
            if (!in_array($user->get('display_name'), $display_name)) {
                $display_name = ['displayname' => $user->get('display_name')] + $display_name;
            }

            $display_name = array_map('trim', $display_name);
            $display_name = array_unique($display_name);

            foreach ($display_name as $item) : ?>
                <option <?php Util::selected($user->get('display_name'), $item); ?>><?php echo $item; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
               
    <div class="form-group">
        <label for="country">Country</label>
        <?php echo Util::SelectFromJson2(DDFPATH.'inc/country.json', array(
        'selected' => $user->get('country'),
        'name'     => 'country',
        'class'    => 'form-control', 
        'id'       => 'country')); ?>
    </div>

    <div class="form-group">          
        <label for="state">State</label>
        <input class="form-control" type="text" value="<?php echo $user->get('state'); ?>" name="state" id="state">
    </div>

    <div class="form-group">
        <label for="city">City</label>
        <input class="form-control" type="text" value="<?php echo $user->get('city'); ?>" name="city" id="city">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input placeholder="name@example.com" class="form-control" type="email" value="<?php echo $user->get('email'); ?>" name="email" id="email">
    </div>

    <div class="form-group">
        <label for="mobile">Mobile</label>
        <input class="form-control" type="text" value="<?php echo $user->get('mobile'); ?>" name="mobile" id="mobile">
    </div>
          
    <div class="form-group">
        <label for="website-title">Website Title</label>
        <input placeholder="<?php echo $option->get('site_name'); ?>" class="form-control" type="text" value="<?php echo $user->get('website_title'); ?>" name="website-title" id="website-title">
    </div>

    <div class="form-group">
        <label for="website-url">Website URL</label>
        <input placeholder="<?php echo Site::url(); ?>" class="form-control" type="url" value="<?php echo $user->get('website_url'); ?>" name="website-url" id="website-url">
    </div>
          
    <div class="form-group">
        <label for="facebook">Facebook</label>
        <input placeholder="http://facebook.com/username" class="form-control" type="url" value="<?php echo $user->get('facebook'); ?>" name="facebook" id="facebook">
    </div>
          
    <div class="form-group">
        <label for="twitter">Twitter</label>
        <input placeholder="http://twitter.com/username" class="form-control" type="url" value="<?php echo $user->get('twitter'); ?>" name="twitter" id="twitter">
    </div>

    <div class="form-group">
        <label for="gender">Gender</label>
        <select class="form-control" name="gender" id="gender">
            <?php
            $gender = ['male' => 'Male', 'female' => 'Female'];
            foreach ($gender as $id => $item) : ?>
            <option <?php Util::selected($user->get('gender'), $id); ?>><?php echo $item; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
          
    <div class="form-group">
        <label for="byear">Birthday</label>
        <?php echo Util::selectDate($user->get('birth_day'), $user->get('birth_month'), $user->get('birth_year')); ?>
    </div>
                
    <div class="form-group">
        <label for="bio">Biography</label>
        <textarea class="form-control" id="bio" name="bio" rows="5"><?php echo $user->get('biography'); ?></textarea>
    </div>

    <div class="form-group">
        <label for="user-avatar">Avatar</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="‪5242880‬">
        <div id="show-avatar"><img src="<?php echo $user->get('avatar') ?>" height="100" width="100"></div>
        <div id="response"></div>
        <input id="user-avatar" name="avatar" type="file">
    </div>

    <div class="form-group">
        <label for="pass">Change Password</label>
        <input class="form-control" type="password" name="pass" id="pass">
    </div>

    <div class="form-group">
        <label for="cpass">Confirm Password</label>
        <input class="form-control" type="password" name="cpass" id="cpass">
    </div>

    <input class="btn btn-primary" value="Update" type="submit">
</form>

<?php include DDFPATH.'footer.php'; ?>
