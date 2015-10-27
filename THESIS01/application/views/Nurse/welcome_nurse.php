<?php

$userfile = array(
	'name'	=> 'userfile',
	'id'	=> 'userfile'
);
?>



<?php echo $error;?>

<?php echo form_open_multipart('auth/single_upload');?>

    <div>
<?php echo form_label('Upload', $userfile['id']); ?>
        <?php echo form_upload('userfile'); ?>
    </div>
  <div>
        <?php echo form_submit('save', 'Save'); ?>
    </div>
<?php echo form_close()?>

