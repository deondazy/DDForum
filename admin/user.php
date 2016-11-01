<?php

use DDForum\Core\Site;
use DDForum\Core\User;

/** Load admin **/
require_once(dirname(__FILE__).'/admin.php');

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$current_user_id = $user->currentUserId();
$action = isset($_GET['action']) ? $_GET['action'] : '';

if (!defined('CURRENT_PROFILE')) {
    define('CURRENT_PROFILE', ($user_id == $current_user_id));
}

$title = CURRENT_PROFILE ? 'Profile' : 'Edit User';
$parent_menu = 'user-edit.php';
$file = CURRENT_PROFILE ? 'profile.php' : 'user-edit.php';

if (0 == $user_id && CURRENT_PROFILE) {
    $user_id = $current_user_id;
    $action = 'edit';
} elseif (0 == $user_id && !CURRENT_PROFILE) {
    Site::info('Invalid User ID', true, true);
} elseif (!$user->exist($user_id)) {
    Site::info('Invalid User ID', true, true);
}

switch ($action) {
    case 'edit':
        define('EDIT_PROFILE', true);

        if (!CURRENT_PROFILE && !$user->isAdmin()) {
            Site::info('You do not have the rights to edit users', true, true);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'first_name' => $_POST['fname'],
                'last_name' => $_POST['lname'],
                'display_name' => $_POST['dname'],
                'country' => $_POST['country'],
                'state' => $_POST['state'],
                'city' => $_POST['city'],
                'mobile' => $_POST['mobile'],
                'website_title' => $_POST['website-title'],
                'website_url' => $_POST['website-url'],
                'facebook' => $_POST['facebook'],
                'twitter' => $_POST['twitter'],
                'gender' => $_POST['gender'],
                'birth_day' => $_POST['day'],
                'birth_month' => $_POST['month'],
                'birth_year' => $_POST['year'],
                'age' => date('Y') - $_POST['year'],
                'biography' => $_POST['bio'],
                'use_pm' => $_POST['use-pm'],
            ];

            // Admin set
            if (!CURRENT_PROFILE) {
                $data['status'] = $_POST['status'];
                $data['level'] = $_POST['level'];
            }

            if ($user->isAdmin()) {
                $data['credit'] = $_POST['credit'];
            }

            if (!empty($_POST['email'])) {
                if (preg_match('/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/', $_POST['email'])) {
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
                        $pass = md5($_POST['pass']);

                        $data['password'] = $pass;
                    } else {
                        $err = 'Error: Password mismatch.';
                    }
                } else {
                    $err = 'Please confirm your password';
                }
            }

            // Avatar
            $upload_time = date('YmdHis').'_';
            $upload_dir = DDFPATH.'inc/avatar/';
            $upload_file = $upload_dir.basename($upload_time.$_FILES['avatar']['name']);

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
                $data['avatar'] = Site::url().'/inc/avatar/'.$upload_time.$_FILES['avatar']['name'];
            }

            if (empty($err)) {
                $update_user = $user->update($data, $user_id);

                if (0 == $update_user) {
                    $message = 'No changes';
                } elseif ($update_user > 0) {
                    $message = CURRENT_PROFILE ? 'Profile Updated' : 'User Updated';
                }
            }
        }

        break;

    case 'delete':
        //TODO: Delete user

        break;

    default:
        Site::info('Unknown action', true, true);

        break;
}

include DDFPATH.'admin/inc/user-form.php';
include DDFPATH.'admin/admin-footer.php';
