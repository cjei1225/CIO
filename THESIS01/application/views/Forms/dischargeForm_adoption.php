<?php

$disDate = array(
	'name'	=> 'disDate',
	'id'	=> 'disDate',
	'value'	=> set_value('disDate'),
	'class' => 'form-control',
);

$disTime = array(
	'name'	=> 'disTime',
	'id'	=> 'disTime',
	'value' => set_value('disTime'),
	'class' => 'form-control',
);



$adopFather = array(
	'name'	=> 'adopFather',
	'id'	=> 'adopFather',
	'value' => set_value('adopFather'),
	'class' => 'form-control',
);

$adopMother = array(
	'name'	=> 'adopMother',
	'id'	=> 'adopMother',
	'value' => set_value('adopMother'),
	'class' => 'form-control',
);

$adopSW = array(
	'name'	=> 'adopSW',
	'id'	=> 'adopSW',
	'value' => set_value('adopSW'),
	'class' => 'form-control',
);

$headSS = array(
	'name'	=> 'headSS',
	'id'	=> 'headSS',
	'value' => set_value('headSS'),
	'class' => 'form-control',
);

$headNurse = array(
	'name'	=> 'headNurse',
	'id'	=> 'headNurse',
	'value' => set_value('headNurse'),
	'class' => 'form-control',
);

$admin = array(
	'name'	=> 'admin',
	'id'	=> 'admin',
	'value' => set_value('admin'),
	'class' => 'form-control',
);

foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   		= $row_info->client_fname;
    $lname  		= $row_info->client_lname; 
    $mname  		= $row_info->client_mname;
    $birthStat		= "0";
    $gender         = $row_info->gender;
    $birthplace    	= $row_info->birthplace;
    $dorm 	        = $row_info->dorm_id;
    $sw_id          = $row_info->sw_id;
    $birthday   	= $row_info->birthday;
    $admitDate 		= $row_info->created;
    $sector 		= $row_info->client_sector;
    $date_admitted	= date('F-d-y', strtotime($row_info->created));
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

$date_discharged = date('F-d-y');
$age = ageCalculator($birthday);

function stay_duration($date_admitted, $date_discharged){
  if(!empty($date_admitted)){
    $birthdate = new DateTime($date_admitted);
    $today   = new DateTime($date_discharged);
    $age = $birthdate->diff($today)->m;
    return $age;
  }else{
    return 0;
  }
}

$num_months = stay_duration($date_admitted, $date_discharged)
?>

<main>
	<div class="container">
		<fieldset class="z-depth-2">
			<div class="row">
				<?php echo form_open('auth/create_dis_adop'); ?>
				<div class="col s12">
					<center><h5 class="bold">DISCHARGE SLIP</h5></center>
		            <h5 class="divider black"></h5>
		        </div>
		           	<?php echo form_hidden('client_id', $client_id); ?>
				<div class="col s6 ">
					<?php echo form_label('Date', $disDate['id']); ?>
					<?php echo date("M-d-Y"); ?>
				</div>
				<div class="col s6 ">
					<?php echo form_label('Time', $disTime['id']); ?>
					<?php echo date("h:i:a"); ?>
					
				</div>

				<div class="col s6 ">
					<?php echo form_label('Name of the Child');?>
					<?php echo $fname." ".$mname." ".$lname; ?>
				</div>
				<div class="col s6 ">
					<?php echo form_label('Date of Birth/Gender'); ?>
					<?php echo date('F-d-y',strtotime($birthday))."/"; ?><?php if ($gender == 1){echo "Male";}
                                    elseif($gender == 2){echo "Female";} ?>
				</div>	
				<div class="col s6 ">
					<?php echo form_label('Age upon Discharge'); ?>
					<?php echo $age; ?>
				</div>	
				<div class="col s6 ">
					<?php echo form_label('Place of Birth'); ?>
					<?php echo $birthplace; ?>
				</div>
				<div class="col s6 ">
					<?php echo form_label('Birth Status'); ?>
					<?php echo $birthStat; ?>
				</div>
				<div class="col s6 ">
					<?php echo form_label('Date admitted in HSJ'); ?>
					<?php echo $admitDate; ?>
				</div>
				<div class="col s6 ">
					<?php echo form_label('Case Category'); ?>
					<?php echo $sector; ?>
				</div>
				<div class="col s6 ">
					<?php echo form_label('Dormitory'); ?>
					<?php echo $dorm; ?>
				</div>
				<div class="col s6 ">
					<?php echo form_label('Number of months/years of Stay in HSJ'); ?>
					<?php echo $num_months; ?> <br>
					<?php echo form_hidden('numMonths', $num_months); ?>
				</div>

				<div class="col s12 ">
				<?php echo "Discharge To"; ?></br>
				</div>

				<div class="input-field col s6 ">
					<?php echo form_input($adopFather); ?>
					<?php echo form_label('Adoptive Father', $adopFather['id']); ?>
				</div>

				<div class="input-field col s6 ">
					<?php echo form_input($adopMother); ?>
					<?php echo form_label('Adoptive Mother', $adopMother['id']); ?>
				</div>

				
				<div class="input-field col s6 ">
					<?php echo form_input($adopSW); ?>
					<?php echo form_label('Adoption Social Worker', $adopSW['id']); ?>
				</div>

				
				<div class="input-field col s6 ">
					<?php echo form_input($headSS); ?>
					<?php echo form_label('AHead, Social Services', $headSS['id']); ?>
				</div>
				<div class="input-field col s6 ">
					<?php echo form_input($headNurse); ?>
					<?php echo form_label('Head Nurse, Nursery Section ', $headNurse['id']); ?>
				</div>
				<div>
		        	<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
		        </div>
		        <?php echo form_close(); ?>
			</div>
		</fieldset>
	</div>
</main>