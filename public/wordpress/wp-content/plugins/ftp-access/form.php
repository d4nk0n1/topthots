<?php 
$faArray = unserialize(get_option('FTP'));
?>
<div class="wrap">
<div id="icon-plugins" class="icon32"></div><h2><?php _e('Connection Information') ?></h2><br/><br/>
<?php settings_errors(); ?>
<form method="post" action="">
<?php _e('Please enter your FTP credentials to proceed.') ?><br/>
<table class="form-table">
<tbody><tr valign="top">
<th scope="row"><label for="FTPHost"><?php _e('Hostname') ?> :</label></th>
<td><input type="text" id="FTPHost" name="FTPHost" value="<?php echo $faArray[0];?>" size="40" dir="ltr" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="FTPUser"><?php _e('FTP Username') ?> :</label></th>
<td><input type="text" id="FTPUser" name="FTPUser" value="<?php echo $faArray[1];?>" size="40" dir="ltr" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="FTPPassword"><?php _e('FTP Password') ?> :</label></th>
<td><input type="password" id="FTPPassword" name="FTPPassword" value="<?php echo $faArray[2];?>" size="40" /> </td>
</tr>

</tbody></table>

<div>
<input type="hidden" name="FTPHid" value="FTPHid" />
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</div>
</form>
</div>

