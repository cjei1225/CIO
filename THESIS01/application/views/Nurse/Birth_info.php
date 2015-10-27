<?php
$gestationAge = array(
	'name'	=> 'gestationAge',
	'id'	=> 'gestationAge',
	'value'	=> set_value('gestationAge'),
);

$deliType = array(
	'name'	=> 'deliType',
	'id'	=> 'deliType',
	'value'	=> set_value('deliType'),
);


$forcep = array(
	'name'	=> 'forcep',
	'id'	=> 'forcep',
	'value'	=> set_value('forcep'),
);

$bornAt = array(
	'name'	=> 'bornAt',
	'id'	=> 'bornAt',
	'value'	=> set_value('bornAt'),
);

$deliverBy = array(
	'name'	=> 'deliverBy',
	'id'	=> 'deliverBy',
	'value'	=> set_value('deliverBy'),
);

$deliverName = array(
	'name'	=> 'deliverName',
	'id'	=> 'deliverName',
	'value'	=> set_value('deliverName'),
);

$compli = array(
	'name'	=> 'compli',
	'id'	=> 'compli',
	'value'	=> set_value('compli'),
);

$weightBirth = array(
	'name'	=> 'weightBirth',
	'id'	=> 'weightBirth',
	'value'	=> set_value('weightBirth'),
);

$lengthBirth = array(
	'name'	=> 'lengthBirth',
	'id'	=> 'lengthBirth',
	'value'	=> set_value('lengthBirth'),
);

$headCirBirth = array(
	'name'	=> 'headCirBirth',
	'id'	=> 'headCirBirth',
	'value'	=> set_value('headCirBirth'),
);

$chestCirBirth = array(
	'name'	=> 'chestCirBirth',
	'id'	=> 'chestCirBirth',
	'value'	=> set_value('chestCirBirth'),
);

$apgarScore = array(
	'name'	=> 'apgarScore',
	'id'	=> 'apgarScore',
	'value'	=> set_value('apgarScore'),
);

$abnormalBirth = array(
	'name'	=> 'abnormalBirth',
	'id'	=> 'abnormalBirth',
	'value'	=> set_value('abnormalBirth'),
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
                <li><a href="#" ><span>Step 2: Present Condition</span></a></li>
                <li><a href="#" class="active"><span>Step 3: Birth Information</span></a></li>
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
	        
     	<?php echo form_open("auth/insert_birth_history"); ?>
    
        	<center><h5 class="bold">BIRTH HISTORY</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<?php echo form_hidden('client_id', $client_id);
				?>
           			<div class="input-field col s6 ">
					Born at<br>
					<input type="radio" name="bornAt" value="home" id="bornHome" class="with-gap"><label for="bornHome">Home</label>
					<input type="radio" name="bornAt" value="hospital" id="bornHos" class="with-gap"><label for="bornHos">Hospital</label>
					<input type="radio" name="bornAt" value="other" id="bornOth" class="with-gap"><label for="bornOth">Other</label>
					</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Forceps ', $forcep['id']); ?>
				<?php echo form_input($forcep); ?>
				<?php echo form_error($forcep['name']); ?><?php echo isset($errors[$forcep['name']])?$errors[$forcep['name']]:''; ?>
				</div>
					<div class="input-field col s6 ">
					<input type="radio" name="deliverBy" value="Midwife" id="deliMidwife" class="with-gap"><label for="deliMidwife">Midwife</label>
					<input type="radio" name="deliverBy" value="Nurse" id="deliNurse" class="with-gap"><label for="deliNurse">Nurse</label>
					<input type="radio" name="deliverBy" value="Self" id="deliSelf" class="with-gap"><label for="deliSelf">Self</label>
					<input type="radio" name="deliverBy" value="Others" id="deliOthers" class="with-gap"><label for="deliOthers">Others</label>
					<?php echo form_error($deliverBy['name']); ?><?php echo isset($errors[$deliverBy['name']])?$errors[$deliverBy['name']]:''; ?>
					</div>

					<div class="input-field col s6 ">
					<?php echo form_label('Delivered by (name)', $deliverName['id']); ?>
					<?php echo form_input($deliverName, $deliverName['id']); ?>
					<?php echo form_error($deliverName['name']); ?><?php echo isset($errors[$deliverName['name']])?$errors[$deliverName['name']]:''; ?>
					</div>


				<div class="input-field col s6 ">
				<?php echo form_label('Complications ', $compli['id']); ?>
				<?php echo form_input($compli); ?>
				<?php echo form_error($compli['name']); ?><?php echo isset($errors[$compli['name']])?$errors[$compli['name']]:''; ?>

				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Birth weight ', $weightBirth['id']); ?>
				<?php echo form_input($weightBirth); ?>
				<?php echo form_error($weightBirth['name']); ?><?php echo isset($errors[$weightBirth['name']])?$errors[$weightBirth['name']]:''; ?>
				
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Length ', $lengthBirth['id']); ?>
				<?php echo form_input($lengthBirth); ?>
				<?php echo form_error($lengthBirth['name']); ?><?php echo isset($errors[$lengthBirth['name']])?$errors[$lengthBirth['name']]:''; ?>

				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Head circumference ', $headCirBirth['id']); ?>
				<?php echo form_input($headCirBirth); ?>
				<?php echo form_error($headCirBirth['name']); ?><?php echo isset($errors[$headCirBirth['name']])?$errors[$headCirBirth['name']]:''; ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Chest circumference ', $chestCirBirth['id']); ?>
				<?php echo form_input($chestCirBirth); ?>
				<?php echo form_error($chestCirBirth['name']); ?><?php echo isset($errors[$chestCirBirth['name']])?$errors[$chestCirBirth['name']]:''; ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Apgar Score ', $apgarScore['id']); ?>
				<?php echo form_input($apgarScore); ?>
				<?php echo form_error($apgarScore['name']); ?><?php echo isset($errors[$apgarScore['name']])?$errors[$apgarScore['name']]:''; ?>
				
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Abnormalities at birth (please describe)', $abnormalBirth['id']); ?>
				<?php echo form_input($abnormalBirth); ?>
				<?php echo form_error($abnormalBirth['name']); ?><?php echo isset($errors[$abnormalBirth['name']])?$errors[$abnormalBirth['name']]:''; ?>
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