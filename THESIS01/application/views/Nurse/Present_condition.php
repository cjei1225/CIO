<?php

$presentApp = array(
	'name'	=> 'presentApp',
	'id'	=> 'presentApp',
	'value' => set_value('presentApp'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$admissionApp = array(
	'name'	=> 'admissionApp',
	'id'	=> 'admissionApp',
	'value' => set_value('admissionApp'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$marksPhy = array(
        'name'  => 'marksPhy',
        'id'    => 'marksPhy',
        'value' => set_value('marksPhy'),
        'rows'  => '5',
        'cols'  => '150',
        'class' => 'materialize-textarea',
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
                <li><a href="#" ><span>Step 1: Measurement </span></a></li>
                <li><a href="#" class="active"><span>Step 2: Present Condition</span></a></li>
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
	       
		     	<?php echo form_open("auth/present_submit"); ?>
		      
		        	<center><h5 class="bold">PHYSICAL DESCRIPTION AND CONDITION</h5></center>
		            <h5 class="divider black"></h5>
		           	<div class="form-group">
		           		<?php echo form_hidden('client_id', $client_id);
						?>

						<?php echo form_label('Describe present appearance', $presentApp['id']); ?>
						<?php echo form_textarea($presentApp); ?>
						<?php echo form_error($presentApp['name']); ?><?php echo isset($errors[$presentApp['name']])?$errors[$presentApp['name']]:''; ?>

						<?php echo form_label('Describe appearance of the client at time of admission into care *', $admissionApp['id']); ?>						
						<?php echo form_textarea($admissionApp); ?>
						<?php echo form_error($admissionApp['name']); ?><?php echo isset($errors[$admissionApp['name']])?$errors[$admissionApp['name']]:''; ?>

						<?php echo form_label('Distinguishing marks or physical handicaps', $marksPhy['id']); ?>
                        <?php echo form_textarea($marksPhy); ?>
                        <?php echo form_error($marksPhy['name']); ?><?php echo isset($errors[$marksPhy['name']])?$errors[$marksPhy['name']]:''; ?>

                        <div class="input-field col s6 ">
						<?php echo form_label('Hair color *', $hairColor['id']); ?>
						<?php echo form_input($hairColor); ?>
						<?php echo form_error($hairColor['name']); ?><?php echo isset($errors[$hairColor['name']])?$errors[$hairColor['name']]:''; ?>

						</div>
						<div class="input-field col s6 ">
						<?php echo form_label('Eyes *', $eyeColor['id']); ?>
						<?php echo form_input($eyeColor); ?>
						<?php echo form_error($eyeColor['name']); ?><?php echo isset($errors[$eyeColor['name']])?$errors[$eyeColor['name']]:''; ?>

						</div>
						<div class="input-field col s6 ">
						<?php echo form_label('Skin *', $skinColor['id']); ?>
						<?php echo form_input($skinColor); ?>
						<?php echo form_error($skinColor['name']); ?><?php echo isset($errors[$skinColor['name']])?$errors[$skinColor['name']]:''; ?>
						
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