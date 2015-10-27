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

$numMonths = array(
	'name'	=> 'numMonths',
	'id'	=> 'numMonths',
	'value' => set_value('numMonths'),
	'class' => 'form-control',
);

$stayHSJ = array(
	'name'	=> 'stayHSJ',
	'id'	=> 'stayHSJ',
	'value' => set_value('stayHSJ'),
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


?>


<div id="page-wrapper">
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-5" >
				<?php echo "DISCHARGE FORM"; ?></br>
				<div class="form-group">
					<?php echo form_label('Date', $disDate['id']); ?>
					<?php echo date("M-d-Y", $disDate['name']); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Time', $disTime['id']); ?>
					<?php echo date("h:i:a", $disTime['name']); ?>
					
				</div>

				<div class="form-group">
					<?php echo form_label('Name of the Child');?>
					<?php echo $fname." ".$mname." ".$lname; ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Date of Birth/Gender'); ?>
					<?php echo $Birthday."/"; ?><?php if ($gender == 1){echo "Male";}
                                    elseif($gender == 2){echo "Female";} ?>
				</div>	
				<div class="form-group">
					<?php echo form_label('Age upon Discharge'); ?>
					<?php echo $Age; ?>
				</div>	
				<div class="form-group">
					<?php echo form_label('Place of Birth'); ?>
					<?php echo $Birthplace; ?></div>
				</div>
				<div class="form-group">
					<?php echo form_label('Birth Status'); ?>
					<?php echo $birthStat; ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Date admitted in HSJ'); ?>
					<?php echo $admitDate; ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Case Category'); ?>
					<?php echo $caseCategory; ?></div>
				</div>
				<div class="form-group">
					<?php echo form_label('Dormitory'); ?>
					<?php echo $dorm; ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Number of months/years of', $numMonths['id']); ?>
					<?php echo form_input($numMonths); ?>
				</div>
				<div class="form-group">
					<?php echo form_label('Stay in HSJ', $stayHSJ['id']); ?>
					<?php echo form_input($stayHSJ); ?>
				</div>

				<?php echo "Discharge To"; ?></br>
				

				<div class="form-group">
					<?php echo form_input($adopFather); ?>
					<?php echo form_label('Adoptive Father', $adopFather['id']); ?>
				</div>

				<div class="form-group">
					<?php echo form_input($adopMother); ?>
					<?php echo form_label('Adoptive Mother', $adopMother['id']); ?>
				</div>

				<?php echo "Recommended"; ?></br>
				<div class="form-group">
					<?php echo form_input($adopSW); ?>
					<?php echo form_label('Adoption Social Worker', $adopSW['id']); ?>
				</div>

				<?php echo "Recommending Approval"; ?></br>
				<div class="form-group">
					<?php echo form_input($headSS); ?>
					<?php echo form_label('AHead, Social Services', $headSS['id']); ?>
				</div>
				<div class="form-group">
					<?php echo form_input($headNurse); ?>
					<?php echo form_label('Head Nurse, Nursery Section ', $headNurse['id']); ?>
				</div>

				<?php echo "Approved"; ?></br>
				<div class="form-group">
					<?php echo form_input($admin); ?>
					<?php echo form_label('Administrator', $admin['id']); ?>
				</div>

			</div>
		</div>
	</div>
</div>