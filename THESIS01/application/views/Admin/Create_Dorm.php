<?php

$dorm_name = array(
	'name'	=> 'dorm_name',

	'class' => 'form-control',
	'id'	=> 'dorm_name',
	'value' => set_value('dorm_name')
);
$incharge = array(
	'name'	=> 'incharge',
	'class' => 'form-control',
	'id'	=> 'incharge',
	'value' => set_value('incharge')
);

$capacity = array(
	'name' => 'capacity',
	'class' => 'form_control',
	'id' 	=> 'capacity');
$dorm_sector = array(
	''	=> '-----',
	'1' =>'Child and Youth ',
	'2' =>'Older Persons',
	'3' =>'Special Needs ',
	'4' =>'Crisis Situation'
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
			<div class="form-group">
				<?php echo form_label('For Sector'); ?>
				<div id="design_drop"><?php echo form_dropdown('dorm_sector', $dorm_sector); ?></div>
			</div>
			<div class="form-group">
				<?php echo form_label('Dorm Name', $dorm_name['id']); ?>
				<?php echo form_input($dorm_name); ?>
				<?php echo form_error($dorm_name['name']); ?><?php echo isset($errors[$dorm_name['name']])?$errors[$dorm_name['name']]:''; ?>
			</div>
			<div class="form-group">
				<?php echo form_label('House Parent', $incharge['id']); ?>
				 <select name="incharge" class="browser-default">
	                  <option value="-----" disabled selected>-----</option>
	                  <?php foreach($parents as $lol)
	                  { ?>
	                  <option value="<?php echo $lol->id; ?>"><?php echo $lol->first_name." ".$lol->last_name; ?></option>
	                  <?php } ?>
	              </select>
			</div>
			<div class="form-group">
				<?php echo form_label('Capacity', $capacity['id']); ?>
				<?php echo form_input($capacity); ?>
				<?php echo form_error($capacity['name']); ?>
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