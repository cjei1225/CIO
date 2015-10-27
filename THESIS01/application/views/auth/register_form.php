<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'placeholder'	=> 'Username',
		'class' => 'form-control',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$email = array(
	'name'	=> 'email',
	'placeholder'	=> 'E-mail',
	'class' => 'form-control',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'placeholder'	=> 'Password',
	'class' => 'form-control',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'placeholder'	=> 'Confirm Password',
	'class' => 'form-control',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$first_name = array(
	'name'	=> 'first_name',
	'placeholder'	=> 'First Name',
	'class' => 'form-control',
	'id'	=> 'first_name',
	'value' => set_value('first_name'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$last_name = array(
	'name'	=> 'last_name',
	'placeholder'	=> 'Last Name',
	'class' => 'form-control',
	'id'	=> 'last_name',
	'value' => set_value('last_name'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$role = array(
	'name'	=> 'position',
	'id'	=> 'position',
	'class' => 'form-control',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'value' => set_value('position'),
);
$role_number = array(
		 '-----' => '-----',
         '2'  => 'Nurse',
         '3'  => 'Psychiatrist',  
		 '4'  => 'Psychologist',  
         '5'  => 'House Parent',  
         '6'  => 'Physical Therapist', 
         '7'  => 'Social Worker for Older',
		 '8'  => 'Social Worker for Special Needs',
		 '9'  => 'Social Worker for Crisis Situation',
		 '10' => 'Social Worker for Child/ Youth'
);
?>


<style>

#design_drop select {
display: block;
width: 100%;
height: 34px;
padding: 6px 12px;
font-size: 14px;
line-height: 1.42857143;
color: #555;
background-color: #fff;
background-image: none;
border: 1px solid #ccc;
border-radius: 4px;
}

#remove_design input {
	color: white;
	background-color: transparent;
	border:0;
	padding: 1px 6px;
}

#submit a {
	color: white;
	border:0;
	text-decoration: none;
}

</style>

<main>
	<div class="container">
		<div id="loginsize">
		<fieldset class="z-depth-2">
			<?php echo form_open($this->uri->uri_string()); ?>
			<legend>LOGIN DETAILS</legend>
			<div class="form-group">
				<?php echo form_label('Username', $username['id']); ?>
				<?php echo form_input($username); ?>
				<?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
			</div>
			<div class="form-group">
				<?php echo form_label('Email Address', $email['id']); ?>
				<?php echo form_input($email); ?>
				<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
			</div>
			<div class="form-group">
				<?php echo form_label('Password', $password['id']); ?>
				<?php echo form_password($password); ?>
				<?php echo form_error($password['name']); ?>
			</div>
			<div class="form-group">
				<?php echo form_label('Confirm Password', $confirm_password['id']); ?>
				<?php echo form_password($confirm_password); ?>
				<?php echo form_error($confirm_password['name']); ?>
			</div>
			<legend>USER INFORMATION</legend>
			<div class="form-group">
				<?php echo form_label('First Name', $first_name['id']); ?>
				<?php echo form_input($first_name); ?>
				<?php echo form_error($first_name['name']); ?>
			</div>
			<div class="form-group">
				<?php echo form_label('Last Name', $last_name['id']); ?>
				<?php echo form_input($last_name); ?>
				<?php echo form_error($last_name['name']); ?>
			</div>
			<div class="form-group">
				<?php echo form_label('Role', $role['id']); ?>
				<div id="design_drop"><?php echo form_dropdown('role', $role_number); ?></div>
			</div>
			<div align=center>
				<?php if ($this->config->item('allow_registration', 'tank_auth')) ?> 
				<button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Submit </button>
			</div>
			<?php echo form_close(); ?>
			</div>
</fieldset>
<div>
	</main>