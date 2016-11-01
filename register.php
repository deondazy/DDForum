<?php
/**
 * User Registration
 *
 * @package DDForum
 */

use DDForum\Core\User;
use DDForum\Core\Filter;
use DDForum\Core\Site;
use DDForum\Core\Util;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

// Load DDForum Startup
require_once DDFPATH.'startup.php';

$title = 'Register - '.$option->get('site_name');

include DDFPATH.'header.php'; ?>

<h2 class="page-title">Register</h2>

<?php
// Check if form is submitted
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $user = [
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

    try {
        DDForum\Core\UserAuth::register($user);
    } catch (DDForum\Core\Exception\WrongValueException $e) {
        Site::info($e->getMessage(), true);
    }
}?>

<div class="container">
    <?php
    if ($user->isLogged()) {
        Site::info('You are already logged in.', true, true);
    }
    ?>

    <div class="centered">Already registered? <a href="<?php echo $siteUrl; ?>/login/">Login</a></div>

    <form role="form" method="post" class="action-form">
        <div class="form-groups">
            <div class="form-group">
                <label for="reg-uname">Username*</label>
                <input id="reg-uname" class="form-control" type="text" name="uname" <?php echo Util::fill('uname'); ?>>
            </div>
            <div class="form-group">
                <label for="reg-pass">Password*</label>
                <input id="reg-pass" class="form-control" type="password" name="pass">
            </div>
            <div class="form-group">
                <label for="reg-cpass">Confirm password*</label>
                <input id="reg-cpass" class="form-control" type="password" name="cpass">
            </div>
            <div class="form-group">
                <label for="reg-email">Email*</label>
                <input id="reg-email" class="form-control" type="text" name="email" <?php echo Util::fill('email'); ?>>
            </div>
            <div class="form-group">
                <label for="reg-gender">Gender</label>
                <select id="reg-gender" class="form-control" name="gender">
                    <option value="male" <?php echo Util::fill('gender', 'select', 'male'); ?>>Male</option>
                    <option value="female" <?php echo Util::fill('gender', 'select', 'female'); ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="reg-dob">Birthday</label>
                <?php echo Util::selectDate(); ?>
            </div>
            <div class="form-group">
                <label for="reg-country">Country</label>
                <?php echo Util::selectFromJson(DDFPATH.'inc/country.json', '', 'country', 'country'); ?>
            </div>
            <input id="reg-submit" class="centered action-button" type="submit" value="Register">
        </div>
    </form>
</div>
<?php include DDFPATH.'footer.php';
