<?php

$bloodP = array(
	'name'	=> 'bloodP',
	'id'	=> 'bloodP',
	'value'	=> set_value('bloodP'),
);

$pulseRate = array(
	'name'	=> 'pulseRate',
	'id'	=> 'pulseRate',
	'value'	=> set_value('pulseRate'),
);

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

$temperature = array(
	'name'	=> 'temperature',
	'id'	=> 'temperature',
	'value'	=> set_value('temperature'),
);

$respiRate = array(
	'name'	=> 'respiRate',
	'id'	=> 'respiRate',
	'value'	=> set_value('respiRate'),
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


foreach($client_info as $row_info) 
{
	$client_id      = $row_info->client_id;
	$fname   = $row_info->client_fname;
	$mname  = $row_info->client_mname;
	$lname   = $row_info->client_lname;
	$gender         = $row_info->gender;
	$sw_id          = $row_info->sw_id;
	$mname  = $row_info->client_mname;
	$admitDate = $row_info->created;
	$sector = $row_info->client_sector;
    $birthday       = $row_info->birthday;
    $d_name        = $row_info->d_name;
    $religion       = $row_info->religion;
    $client_status   = $row_info->client_status;

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
		    <div class="col s3">
			    <ul class="menu">
		            <li><a href="#" class="active"><span>Step 1: Measurement </span></a></li>
		            <li><a href="#"><span>Step 2: Present Condition</span></a></li>
		            <li><a href="#"><span>Step 3: Birth Information</span></a></li>
	            	<li><a href="#"><span>Step 4: Immunization</span></a></li>
			  	</ul>
			</div>
	    	<div class="col s9">
	        <fieldset class="z-depth-1">
	          <center>
	            <h5 class="bold">Client Information</h5>
	          </center>
	          <h5 class="divider black"></h5>
	          <div class="form-group">
	            <img src="<?php echo base_url(); ?>materialize/title logo.png" class="right"> 
	            <label >Name: <?php echo $fname." ".$mname." ".$lname; ?> </label>
	            <br>
	            <label>Age: <?php echo $age; ?></label>
	            <br>
	            <label >Gender: <?php if ($gender == 1){echo "Male";}
	            elseif($gender == 2){echo "Female";} ?></label>
	            <br>
	            <label >Date of Birth: <?php echo date('M-d-Y',strtotime($birthday)); ?></label>
	            <br>
	            <label >Dorm: <?php echo $d_name; ?></label>
	            <br> 
	            <label >Sector: <?php if ($sector == 1){echo "Child and Youth";}
	            elseif($sector == 2){echo "Older Person";}
	            elseif($sector == 3){echo "Person with Special Needs";} 
	            elseif($sector == 4){echo "Person in Crisis Situation";}?></label>
	            <br>     
	            <label >Religion: <?php echo $religion; ?></label>                
	          </div>
	      
		     	<?php echo form_open("auth/initial_medical_submit"); ?>
			      	
			        	<center><h5 class="bold">MEASUREMENT</h5></center>
			            <h5 class="divider black"></h5>
			           	<div class="form-group">

							<?php echo form_hidden('client_id', $client_id); ?>
							
							<div class="input-field col s6 ">
							<?php echo form_label('Blood Pressure (_/60)*', $bloodP['id']); ?>
							<?php echo form_input($bloodP); ?>
							<?php echo form_error($bloodP['name']); ?><?php echo isset($errors[$bloodP['name']])?$errors[$bloodP['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Pulse Rate/Min *', $pulseRate['id']); ?>
							<?php echo form_input($pulseRate); ?>
							<?php echo form_error($pulseRate['name']); ?><?php echo isset($errors[$pulseRate['name']])?$errors[$pulseRate['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Height (cm/feet) *', $height['id']); ?>
							<?php echo form_input($height); ?>
							<?php echo form_error($height['name']); ?><?php echo isset($errors[$height['name']])?$errors[$height['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Weight (kg) *', $weight['id']); ?>
							<?php echo form_input($weight); ?>
							<?php echo form_error($weight['name']); ?><?php echo isset($errors[$weight['name']])?$errors[$weight['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Temperature (Celsius) *', $temperature['id']); ?>
							<?php echo form_input($temperature); ?>
							<?php echo form_error($temperature['name']); ?><?php echo isset($errors[$temperature['name']])?$errors[$temperature['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Respiratory Rate/Min *', $respiRate['id']); ?>
							<?php echo form_input($respiRate); ?>
							<?php echo form_error($respiRate['name']); ?><?php echo isset($errors[$respiRate['name']])?$errors[$respiRate['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Head Circumference (cm)', $headCir['id']); ?>
							<?php echo form_input($headCir); ?>
							<?php echo form_error($headCir['name']); ?><?php echo isset($errors[$headCir['name']])?$errors[$headCir['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Chest Circumference (cm)', $chestCir['id']); ?>
							<?php echo form_input($chestCir); ?>
							<?php echo form_error($chestCir['name']); ?><?php echo isset($errors[$chestCir['name']])?$errors[$chestCir['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Abdomen Circumference (cm)', $abdoCir['id']); ?>
							<?php echo form_input($abdoCir); ?>
							<?php echo form_error($abdoCir['name']); ?><?php echo isset($errors[$abdoCir['name']])?$errors[$abdoCir['name']]:''; ?>
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
