<?php
/**
 * Form for New and Edit User Screen.
 */
use DDForum\Core\Site;
use DDForum\Core\Util;

// Can't be accessed directly
if (!defined('DDFPATH')) {
    die('Direct access denied');
}

if (CURRENT_PROFILE) {
    $form_action = 'profile.php';
    $redirect_url = Site::adminUrl('profile.php');
} elseif (EDIT_PROFILE && $user_id != 0) {
    $form_action = 'user.php?action=edit&id='.$user_id;
    $redirect_url = Site::adminUrl('user.php?action=edit&id='.$user_id);
}

require_once DDFPATH.'admin/admin-header.php';

if (isset($msg)) {
    Site::info($msg);
} elseif (isset($_GET['message'])) {
    Site::info($_GET['message']);
}

if (isset($err)) {
    Site::info($err, true);
}

function User($data)
{
    global $user_id, $user;
    return $user->get($data, $user_id);
}
?>
<div class="profile-summary clearfix row">
    <div class="col-lg-4 col-sm-4">
        <div class="profile-avatar pull-left"><img src="<?php echo User('avatar'); ?>" width="100"></div>

        <div class="user-info pull-left">
            <div class="display-name"><?php echo User('display_name'); ?></div>

            <div class="gender-age">
                <span class="gender"><?php echo ucfirst(User('gender')); ?></span>
                <span class="user-age">(<?php echo User('age'); ?>)</span>
            </div>

            <div class="online-status">
                <?php if (User('status') == 1 && User('online_status') == 1) : ?>
                    Online
                <?php elseif (User('status') == 1 && User('online_status') == 0) : ?>
                    Last seen <?php echo Util::time2str(Util::timestamp(User('last_seen'))); ?>
                <?php elseif (User('status') == 0) : ?>
                    Banned
                <?php elseif (User('status') == 2) : ?>
                    Pending activation
                <?php endif; ?>
            </div>

            <div class="user-level"><?php echo $user->level(User('level')); ?></div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4">
        <div class="register-date">Member since: <?php echo Util::time2str(User('register_date')); ?></div>
        <div class="topic-count"><?php echo $topic->count($user_id, 'poster'); ?> Topics</div>
        <div class="reply-count"><?php echo $reply->count($user_id, 'poster'); ?> Replies</div>
        <div class="credits"><?php echo User('credit'); ?> Credits</div>
    </div>

    <?php if (!CURRENT_PROFILE) : ?>
        <div class="col-lg-4 col-sm-4">
            <?php if (User('use_pm')) : ?>
                <div class="send-pm"><a rel="nofollow" href="<?php echo Site::adminUrl("message.php?user={$user_id}"); ?>">Send PM</a></div>
            <?php endif; ?>

            <div class="send-email"><a rel="nofollow" href="mailto:<?php echo User('email'); ?>">Send Email</a></div>

            <?php if (!empty(User('facebook'))) : ?>
                <div class="facebook"><a rel="nofollow" href="<?php echo User('facebook'); ?>">Facebook</a></div>
            <?php endif; ?>

            <?php if (!empty(User('twitter'))) : ?>
                <div class="twitter"><a rel="nofollow" href="<?php echo User('twitter'); ?>">Twitter</a></div>
            <?php endif; ?>

            <?php if (!empty(User('website_url'))) : ?>
                <div class="website"><a rel="nofollow" href="<?php echo User('website_url'); ?>"><?php echo !empty(User('website_title')) ? User('website_title') : User('website_url'); ?></a></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="col-lg-4 col-sm-4"></div>
</div>

<form class="user-form" enctype="multipart/form-data" action="<?php echo $form_action; ?>" method="post" role="form">

    <div class="form-wrap-main">

        <?php if ($user->isAdmin()) : ?>

            <h3>Admin Tools</h3>

            <table class="form-table">
                <tbody>

                    <?php if (!CURRENT_PROFILE) : ?>
                        <tr>
                            <th scope="row"><label for="status">Status</label></th>
                            <td><select name="status" id="status" class="select-box">
                                <?php
                                $status = ['Banned', 'Active', 'Pending Activation'];

                                $status = array_map('trim', $status);

                                foreach ($status as $id => $item) : ?>

                                    <option value="<?php echo $id; ?>" <?php Util::selected(User('status'), $id); ?>><?php echo $item; ?></option>

                                <?php endforeach; ?>

                            </select></td>

                        </tr>

                        <tr>
                            <th scope="row"><label for="level">Level</label></th>
                            <td><select class="select-box" name="level" id="level">
                                <?php
                                $level = ['User', 'Administrator', 'Moderator'];
                                foreach ($level as $id => $item) : ?>
                                    <option value="<?php echo $id; ?>" <?php Util::selected(User('level'), $id); ?>><?php echo $item; ?></option>
                                <?php endforeach; ?>

                            </select></td>

                        </tr>
                    <?php endif; ?>

                    <tr>
                        <th scope="row"><label for="credit">Credit</label></th>
                        <td><input name="credit" type="number" id="credit" value="<?php echo User('credit'); ?>" min="0" class="select-box"></td>
                    </tr>
                </tbody>
            </table>

        <?php endif; ?>

        <h3>Options</h3>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="online-status">Online Status</label></th>
                    <td>
                        <select name="online-status" id="online-status">
                            <option>Online</option>
                            <option>Offline</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="use-pm">Use PM</label></th>
                    <td><select name="use-pm" id="use-pm" class="select-box">
                        <?php $use_pm = ['No', 'Yes'];

                        foreach ($use_pm as $id => $item) : ?>

                            <option value="<?php echo $id; ?>" <?php Util::selected(User('use_pm'), $id); ?>><?php echo $item; ?></option>

                        <?php endforeach; ?>

                    </select></td>

                </tr>
            </tbody>
        </table>


        <h3>Name</h3>

        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="uname">Username</label></th>
                    <td><input id="uname" class="text-box-lg" type="text" value="<?php echo User('username'); ?>" disabled></td>
                </tr>

                <tr>
                    <th scope="row"><label for="fname">First Name</label></th>
                    <td><input class="text-box-lg" type="text" value="<?php echo User('first_name'); ?>" name="fname" id="fname"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="lname">Last Name</label></th>
                    <td><input class="text-box-lg" type="text" value="<?php echo User('last_name'); ?>" name="lname" id="lname"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="dname">Display Name</label></th>
                    <td><select class="select-box" name="dname" id="dname">

                        <?php
                        $display_name = array();
                        $display_name['username'] = User('username');

                        if (!empty(User('first_name'))) {
                            $display_name['first_name'] = User('first_name');
                        }
                        if (!empty(User('last_name'))) {
                            $display_name['last_name'] = User('last_name');
                        }
                        if (!empty(User('first_name')) && !empty(User('last_name'))) {
                            $display_name['first_last'] = User('first_name').' '.User('last_name');
                            $display_name['last_first'] = User('last_name').' '.User('first_name');
                        }
                        if (!in_array(User('display_name'), $display_name)) {
                            $display_name = ['displayname' => User('display_name')] + $display_name;
                        }

                        $display_name = array_map('trim', $display_name);
                        $display_name = array_unique($display_name);

                        foreach ($display_name as $item) : ?>

                            <option <?php Util::selected(User('display_name'), $item); ?>><?php echo $item; ?></option>

                        <?php endforeach; ?>

                    </select></td>
                </tr>
            </tbody>
        </table>

        <h3>Contact Info</h3>

        <table class="form-table">

            <tr>
                <th scope="row"><label for="country">Country</label></th>
                <td>
                    <?php echo Util::SelectFromJson(DDFPATH.'inc/country.json', User('country'), 'country', 'country'); ?>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="state">State</label></th>
                <td>
                    <input class="text-box-lg" type="text" value="<?php echo User('state'); ?>" name="state" id="state">
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="city">City</label></th>
                <td>
                    <input class="text-box-lg" type="text" value="<?php echo User('city'); ?>" name="city" id="city">
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="email">Email</label></th>
                <td><input placeholder="name@example.com" class="text-box-lg" type="email" value="<?php echo User('email'); ?>" name="email" id="email"></td>
            </tr>

            <tr>
                <th scope="row"><label for="mobile">Mobile</label></th>
                <td><input class="text-box-lg" type="text" value="<?php echo User('mobile'); ?>" name="mobile" id="mobile"></td>
            </tr>

            <tr>
                <th scope="row"><label for="website-title">Website Title</label></th>
                <td>
                    <input placeholder="<?php echo $option->get('site_name'); ?>" class="text-box-lg" type="text" value="<?php echo User('website_title'); ?>" name="website-title" id="website-title">
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="website-url">Website URL</label></th>
                <td>
                    <input placeholder="<?php echo Site::url(); ?>" class="text-box-lg" type="url" value="<?php echo User('website_url'); ?>" name="website-url" id="website-url">
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="facebook">Facebook</label></th>
                <td><input placeholder="http://facebook.com/username" class="text-box-lg" type="url" value="<?php echo User('facebook'); ?>" name="facebook" id="facebook"></td>
            </tr>

            <tr>
                <th scope="row"><label for="twitter">Twitter</label></th>
                <td><input placeholder="http://twitter.com/username" class="text-box-lg" type="url" value="<?php echo User('twitter'); ?>" name="twitter" id="twitter"></td>
            </tr>
        </table>

        <h3>About Yourself</h3>

        <table class="form-table">

            <tr>
                <th scope="row"><label for="gender">Gender</label></th>
                <td><select class="select-box" name="gender" id="gender">

                        <?php
                        $gender = ['male' => 'Male', 'female' => 'Female'];

                        foreach ($gender as $id => $item) : ?>

                            <option <?php Util::selected(User('gender'), $id); ?>><?php echo $item; ?></option>

                        <?php endforeach; ?>

                    </select></td>
            </tr>

            <tr>
                <th scope="row"><label for="byear">Birthday</label></th>
                <td><?php echo Util::selectDate(User('birth_day'), User('birth_month'), User('birth_year')); ?></td>
            </tr>

            <tr>
                <th scope="row"><label for="bio">Biography</label></th>
                <td><textarea class="textarea-box" id="bio" name="bio"><?php echo User('biography'); ?></textarea></td>
            </tr>

            <tr>
                <th scope="row"><label for="user-avatar">Avatar</label></th>
                <td>
                    <input type="hidden" name="MAX_FILE_SIZE" value="‪5242880‬">
                    <div id="show-avatar"><img src="<?php echo User('avatar') ?>" height="100" width="100"></div>
                    <div id="response"></div>
                    <input id="user-avatar" name="avatar" type="file">
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="pass">Change Password</label></th>
                <td><input class="text-box-lg" type="password" name="pass" id="pass"></td>
            </tr>

            <tr>
                <th scope="row"><label for="cpass">Confirm Password</label></th>
                <td><input class="text-box-lg" type="password" name="cpass" id="cpass"></td>
            </tr>
        </table>

        <p><input class="primary-button" type="submit" value="Update" name="submit"></p>

    </div>

</form>
