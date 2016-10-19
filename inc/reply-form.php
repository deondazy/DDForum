<?php
/**
 * Reply form
 *
 * @package DDForum
 */
?>
<div class="reply-editor">
    <form method="post" id="reply-form" class="editors">
        <div class="field">
            <label class="screen-reader-text" for="front-editor">Reply form</label>
            <textarea class="editor-message" id="front-editor" name="reply-message"></textarea>
        </div>
        <input type="submit" class="primary-button submit-editor" value="<?php echo isset($action) ? 'Edit' : 'Post'; ?>">
    </form>
</div>
