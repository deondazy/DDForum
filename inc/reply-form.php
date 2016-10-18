<?php
/**
 * Reply form
 *
 * @package DDForum
 */
?>
<div class="reply-editor">
    <div class="container editor-container">
        <form method="post" id="reply-form" class="editors">
            <a href="#" title="Close" class="close-editor pull-right"><i class="fa fa-remove"></i></a>
            <div class="form-wrap-main">
                <div class="field">
                    <label class="screen-reader-text" for="front-editor"></label>
                    <textarea class="editor-message" id="front-editor" name="reply-message"></textarea>
                </div>
                <input type="submit" class="primary-button submit-editor" value="<?php echo isset($action) ? 'Edit' : 'Post'; ?>">
            </div>
        </form>
    </div>
</div>
