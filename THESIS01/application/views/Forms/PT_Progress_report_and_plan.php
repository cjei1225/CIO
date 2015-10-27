<?php

$coveredPeriod = array(
	'name'	=> 'coveredPeriod',
	'id'	=> 'coveredPeriod',
	'value' => set_value('coveredPeriod'),
);

$diag = array(
	'name'	=> 'diag',
	'id'	=> 'diag',
	'value' => set_value('diag'),
);

$prob1 = array(
	'name'	=> 'prob1',
	'id'	=> 'prob1',
	'value' => set_value('prob1'),
);

$prob2 = array(
	'name'	=> 'prob2',
	'id'	=> 'prob2',
	'value' => set_value('prob2'),
);

$prob3 = array(
	'name'	=> 'prob3',
	'id'	=> 'prob3',
	'value' => set_value('prob3'),
);

$prog1 = array(
	'name'	=> 'prog1',
	'id'	=> 'prog1',
	'value' => set_value('prog1'),
);

$prog2 = array(
	'name'	=> 'prog2',
	'id'	=> 'prog2',
	'value' => set_value('prog2'),
);

$prog3 = array(
	'name'	=> 'prog3',
	'id'	=> 'prog3',
	'value' => set_value('prog3'),
);

$presentPlan1 = array(
	'name'	=> 'presentPlan1',
	'id'	=> 'presentPlan1',
	'value' => set_value('presentPlan1'),
);

$presentPlan2 = array(
	'name'	=> 'presentPlan2',
	'id'	=> 'presentPlan2',
	'value' => set_value('presentPlan2'),
);

$presentPlan3 = array(
	'name'	=> 'presentPlan3',
	'id'	=> 'presentPlan3',
	'value' => set_value('presentPlan3'),
);

$reco = array(
	'name'	=> 'reco',
	'id'	=> 'reco',
	'value' => set_value('reco'),
);

foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   		= $row_info->client_fname;
    $lname  		= $row_info->client_lname; 
    $mname  		= $row_info->client_mname;
    $birthday       = $row_info->birthday;
    $gender         = $row_info->gender;
    $sw_name = $row_info->first_name." ".$row_info->last_name;
    

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
  <div class="row" >
  	
  <div class="col s8 offset-s2"  >
     	<?php echo form_open("auth/submit_PT"); ?>
      	<fieldset class="z-depth-2 ">
        	<center>
	        <h6 ><b>PT PROGRESS REPORT AND PLAN</b></h6>
	        </center>
	        <h5 class="divider black"></h5>
           	<div class="form-group ">
				<?php echo "Physical Therapy and Rehabilitation Centre"; ?></br>
				<?php echo form_hidden('client_id', $client_id); ?>
				<?php echo form_label('Period Covered', $coveredPeriod['id']); ?>
				<?php echo form_input($coveredPeriod); ?>
				<?php echo form_label('Date Prepared'); ?></br>
				<?php echo date("M-d-Y"); ?></br>
				</br>
				<?php echo form_label('Name of Patient'); ?></br>
				<?php echo $fname." ".$mname." ".$lname; ?></br>
				<?php echo form_label('Age/Gender'); ?></br>
				<?php echo $age."/"; ?><?php if ($gender == 1){echo "Male";}
				elseif($gender == 2){echo "Female";} ?></br>
				<?php echo form_label('Diagnosis', $diag['id']); ?>
				<?php echo form_input($diag); ?>

				<?php echo "Problem List:"; ?></br>
				<ol>
					<li> <?php echo form_input($prob1); ?>
					<li> <?php echo form_input($prob2); ?>
					<li> <?php echo form_input($prob3); ?>
				</ol>

				<?php echo "Progress Noted:"; ?></br>
				<ol>
					<li> <?php echo form_input($prog1); ?>
					<li> <?php echo form_input($prog2); ?>
					<li> <?php echo form_input($prog3); ?>
				</ol>

				<?php echo "Present PT Management (Plan):"; ?></br>
				<ol>
					<li> <?php echo form_input($presentPlan1); ?>
					<li> <?php echo form_input($presentPlan2); ?>
					<li> <?php echo form_input($presentPlan3); ?>
				</ol>

				<?php echo "PT Recommendation:"; ?></br>
				<?php echo form_input($reco); ?>
				
				<div id="wrap">
					<label><u><?php echo $sw_name; ?></u></label></br>
					<label>PT Staff In-charge</label>

					<label>Noted by</label></br>
					<label><u>Name of the head of health dept</u></label></br>
					<label>Head, Health Services Department</label>
				</div>
			<div>
           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
            </div>
            </fieldset>
               		<?php echo form_close(); ?>
        </div>
    </div>
</main>

 	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>