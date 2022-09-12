<?php
/**
 * Administration Private Message Screen
 *
 * @package DDForum
 * @subpackage Administration
 */

use DDForum\Core\Site;
use DDForum\Core\User;
use DDForum\Core\Message;

if (!defined('DDFPATH')) {
    define('DDFPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
}

$title        =  'Private Message';
$file         =  'message.php';
$parent_menu  =  'message.php';
$has_child    =  false;

// Load admin
require_once(DDFPATH . 'admin/admin.php');

$userId = isset($_GET['user']) ? $_GET['user'] : 0;

include(DDFPATH . 'admin/admin-header.php');

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (!empty($_POST['recipient'])) {
        if (!empty($_POST['subject'])) {
            if (!empty($_POST['pm-body'])) {
                $messageDetails = [
                    'title' => $_POST['subject'],
                    'message' => $_POST['pm-body'],
                    'sender' => $user->currentUserId(),
                    'to' => $userId,
                    'status' => 'sent',
                ];

                if ($message->send($messageDetails)) {
                    Site::info("Message sent");
                } else {
                    Site::info('Unable to send message', true);
                }
            }
        }
    }
}

//if (!$user->exist($userId)) {
//    Site::info("User doesn't exist.", true);
//} else {
   $username = $user->get('username', $userId);
?>

<form method="post" class="action-form clearfix">
    <div class="form-wrap-main">
        <div class="field">
            <span class="label">Recipient</span>
            <label class="screen-reader-text" for="recipient">Recipient</label>
            <input type="text" id="recipient" class="title-box js-pm-recipient" name="recipient" value="<?php echo $username; ?>">
        </div>

        <div class="field">
            <span class="label">Subject</span>
            <label class="screen-reader-text" for="subject">Subject</label>
            <input type="text" id="subject" class="title-box js-pm-recipient" name="subject">
        </div>

        <div class="field">
            <label class="screen-reader-text" for="form-box"></label>
            <textarea class="topic-message" id="form-box" name="pm-body"></textarea>
        </div>
    </div>
    <input type="submit" class="primary-button" value="Send">
</form>

<?php
//}
include DDFPATH.'admin/admin-footer.php';
