<?php

use DDForum\Core\Database;
use DDForum\Core\User;
use DDForum\Core\Option;
use DDForum\Core\Util;
use DDForum\Core\Site;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

$title = 'General Settings';
$file = 'settings-general.php';
$parent_menu = 'settings-general.php';
$has_child = false;

/** Load admin **/
require_once DDFPATH.'admin/admin.php';

require_once DDFPATH.'admin/admin-header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $options = [
        'site_name' => $_POST['site-name'],
        'site_description' => $_POST['site-description'],
        'site_url' => $_POST['site-url'],
        'admin_email' => $_POST['admin-email'],
        'enable_pm' => $_POST['enable-pm'],
        'enable_credits' => $_POST['enable-credits'],
    ];

    foreach ($options as $option => $value) {
        $set_option = Option::set($option, $value);
    }

    var_dump($set_option);

    if ($set_option) {
        Site::info('Settings saved');
    } else {
        Site::info('Unable to save settings, try again', true);
    }
}
?>

<form action="" method="post" role="form">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="site-name">Site Name</label></th>
                <td><input id="site-name" type="text" class="text-box-lg" name="site-name" value="<?php echo Option::get('site_name'); ?>"></td>
            </tr>

            <tr>
                <th scope="row"><label for="site-description">Site Description</label></th>
                <td>
                    <input id="site-description" type="text" class="text-box-lg" name="site-description" value="<?php echo Option::get('site_description'); ?>">
                    <p class="description">Explain in summary what this site is about</p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="site-url">Site URL</label></th>
                <td>
                    <input id="site-url" type="text" class="text-box-lg" name="site-url" value="<?php echo Option::get('site_url'); ?>">
                    <p class="description">This URL is your homepage address, enter an absolute URL e.g: http://sitename.com</p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="admin-email">Admin Email</label></th>
                <td>
                    <input id="admin-email" type="text" class="text-box-lg" name="admin-email" value="<?php echo Option::get('admin_email'); ?>">
                    <p class="description">This email is where you get notifications and other emailed admin info</p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="enable-pm">Enable PM</label></th>
                <td><select name="enable-pm" id="enable-pm" class="select-box">
                    <?php $use_pm = ['No', 'Yes'];
                    foreach ($use_pm as $id => $item) : ?>
                        <option value="<?php echo $id; ?>" <?php Util::selected(Option::get('enable_pm'), $id); ?>><?php echo $item; ?></option>
                        <?php
                    endforeach; ?>
                </select></td>
            </tr>

            <tr>
                <th scope="row"><label for="enable-credits">Enable Credits</label></th>
                <td><select name="enable-credits" id="enable-credits" class="select-box">
                    <?php $use_credits = ['No', 'Yes'];
                    foreach ($use_credits as $id => $item) : ?>
                        <option value="<?php echo $id; ?>" <?php Util::selected(Option::get('enable_credits'), $id); ?>><?php echo $item; ?></option>
                        <?php
                    endforeach; ?>
                </select></td>
            </tr>
        </tbody>
    </table>
    <p><input id="submit" name="submit" class="primary-button" type="submit" value="Save Settings">
</form>
