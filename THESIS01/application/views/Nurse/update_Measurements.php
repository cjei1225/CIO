<?php

$height = array(
	'name'	=> 'height',
	'id'	=> 'height',
	'value'	=> set_value('height'),
);

$weight = array(
	'name'	=> 'weight',
	'id'	=> 'weight',
	'value'	=> set_value('weight'),
);

$headCir = array(
	'name'	=> 'headCir',
	'id'	=> 'headCir',
	'value'	=> set_value('headCir'),
);

$chestCir = array(
	'name'	=> 'chestCir',
	'id'	=> 'chestCir',
	'value'	=> set_value('chestCir'),
);

$abdoCir = array(
	'name'	=> 'abdoCir',
	'id'	=> 'abdoCir',
	'value'	=> set_value('abdoCir'),
);

$hairColor = array(
	'name'	=> 'hairColor',
	'id'	=> 'hairColor',
	'value'	=> set_value('hairColor'),
);

$eyeColor = array(
	'name'	=> 'eyeColor',
	'id'	=> 'eyeColor',
	'value'	=> set_value('eyeColor'),
);

$skinColor = array(
	'name'	=> 'skinColor',
	'id'	=> 'skinColor',
	'value'	=> set_value('skinColor'),
);

$presentLoc = array(
	'name'	=> 'presentLoc',
	'id'	=> 'presentLoc',
	'value'	=> set_value('presentLoc'),
);

foreach($client_info as $row_info) 
{
	$client_id      = $row_info->client_id;
	$fname   = $row_info->client_fname;
	$lname   = $row_info->client_lname;
	$gender         = $row_info->gender;
	$birth_place     = $row_info->birthplace;
	$dorm_id        = $row_info->dorm_id;
	$sw_id          = $row_info->sw_id;
	$mname  = $row_info->client_mname;

	$admitDate = $row_info->created;
	$sector = $row_info->client_sector;
    $birthday       = $row_info->birthday;

}


function ageCalculator($birthday){
  if(!empty($birthday)){
    $birthdate = new DateTime($birthday);
    $today   = new DateTime(date("Y/m/d"));
    $age = $birthdate->diff($today)->y;
    return $age;
  }else{
    return 0;
  }
}
$age = ageCalculator($birthday);
?>
<main >

	 <div class="container">
	    <div class="row">
	    	<div class="col s1">
	    		<p></p>
	    	</div>
	    	<div class="col s10">
		     	<?php echo form_open("auth/update_measurements"); ?>
			      	<fieldset class="z-depth-2">
			        	<center><h5 class="bold">Measurements</h5></center>
			            <h5 class="divider black"></h5>
			           	<div class="form-group">
			           		
				           		<?php echo form_label('Date: '); ?>
								<?php echo date("M-d-Y"); ?></br>

								<?php  echo form_hidden('client_id', $client_id); ?>
								
								<div class="input-field col s6 ">
								<?php echo form_label('Height', $height['id']); ?>
								<?php echo form_input($height); ?>
								</div>
								<div class="input-field col s6 ">
								<?php echo form_label('Weight', $weight['id']); ?>
								<?php echo form_input($weight); ?>
								</div>
								<div class="input-field col s6 ">
								<?php echo form_label('Head Circumference', $headCir['id']); ?>
								<?php echo form_input($headCir); ?>
								</div>
								<div class="input-field col s6 ">
								<?php echo form_label('Chest Circumference', $chestCir['id']); ?>
								<?php echo form_input($chestCir); ?>
								</div>
								<div class="input-field col s6 ">
								<?php echo form_label('Abdomen Circumference', $abdoCir['id']); ?>
								<?php echo form_input($abdoCir); ?>
								</div>
								<div class="input-field col s6 ">
								<?php echo form_label('Hair color', $hairColor['id']); ?>
								<?php echo form_input($hairColor); ?>
								</div>
								<div class="input-field col s6 ">
								<?php echo form_label('Eyes', $eyeColor['id']); ?>
								<?php echo form_input($eyeColor); ?>
								</div>
								<div class="input-field col s6 ">
								<?php echo form_label('Skin', $skinColor['id']); ?>
								<?php echo form_input($skinColor); ?>
								</div>
								<div class="input-field col s6 ">
								<?php echo form_label('Present Location', $presentLoc['id']); ?>
								<?php echo form_input($presentLoc); ?>
								</div>
							
							<div>
			           			<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Next</button>
			           	 	</div>
						</div>
			        </fieldset>
		        <?php echo form_close(); ?>
	    	</div>
	    </div>
	</div>
</main>
