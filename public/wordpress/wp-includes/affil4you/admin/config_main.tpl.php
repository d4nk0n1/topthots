<div class="wrap">
    <div class="icon32" id="icon-options-general"><br></div><h2><?php pt('admin.affil4you'); ?> - <?php pt('admin.config'); ?></h2>
    <form id="affil4you-form" method="post" name="affil4you-form" action="" enctype="multipart/form-data">
        <input name="affil4you_update_setting" type="hidden" value="<?php echo wp_create_nonce('affil4you_update_setting'); ?>" />
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="affil4you-key"><?php pt('admin.affil4you-key'); ?> * :</label></th>
                    <td><input type="text" aria-required="true" class="regular-text" maxlength="32" value="<?php echo htmlspecialchars($affil4you_key); ?>" id="affil4you-key" name="affil4you-key">
                       	<?php if (!$is_authentified): ?>
                        	<p class="description"><?php pt('admin.affil4you-key.description.1'); ?></p>
                        <?php else : ?>
                        	<br/>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php if ($is_authentified): ?>
            <div class="message message-success">
                <p class="description"><?php pt('admin.redirection.description'); ?> </p>
            </div>
        <?php elseif ($invalid_key): ?>
            <div class="message message-error">
                <p class="description"><?php pt('admin.affil4you-key.description.error'); ?></p>
            </div>
        <?php endif; ?>
        <p class="submit"><input type="submit" value="<?php pt('admin.btn.submit'); ?>" class="button-primary" id="submit" name="submit"></p>
    </form>
</div>