<?php
/**
 * Reply form
 *
 * @package DDForum
 */

use DDForum\Core\Site;
?>
<div class="reply-editor">
    <?php
    if (isset($err)) {
        Site::info($err, true);
    }
    ?>

    <form method="post" id="reply-form" class="editors" enctype="multipart/form-data">
        <div class="field">
            <label class="screen-reader-text" for="front-editor">Reply form</label>
            <textarea class="editor-message" id="front-editor" name="reply-message"></textarea>
        </div>
        <p style="margin-bottom: 5px" class="description"><strong>ATTACHMENTS</strong> (only images, maximum size: <strong>5MB</strong>)</p>

        <input type="hidden" name="MAX_FILE_SIZE" value="‪5000000">
        <input type="file" name="attachment" id="attachment"><br>

        <input type="submit" class="primary-button submit-editor" value="<?php echo isset($action) ? 'Edit' : 'Post'; ?>">
    </form>
</div>
