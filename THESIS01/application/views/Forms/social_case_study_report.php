<?php

$legalStat = array(
	'name'	=> 'legalStat',
	'id'	=> 'legalStat',
	'value'	=> set_value('legalStat'),
);

$exceptionality = array(
	'name'	=> 'exceptionality',
	'id'	=> 'exceptionality',
	'value' => set_value('exceptionality'),
);

$referalAdmission = array(
	'name'	=> 'referalAdmission',
	'id'	=> 'referalAdmission',
	'value' => set_value('referalAdmission'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$descAdmission = array(
	'name'	=> 'descAdmission',
	'id'	=> 'descAdmission',
	'value' => set_value('descAdmission'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$medicalDev = array(
	'name'	=> 'medicalDev',
	'id'	=> 'medicalDev',
	'value' => set_value('medicalDev'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$present_description = array(
	'name'	=> 'present_description',
	'id'	=> 'present_description',
	'value' => set_value('present_description'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$currentFam = array(
	'name'	=> 'currentFam',
	'id'	=> 'currentFam',
	'value' => set_value('currentFam'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$abandonFact = array(
	'name'	=> 'abandonFact',
	'id'	=> 'abandonFact',
	'value' => set_value('abandonFact'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$Eval_reco = array(
	'name'	=> 'Eval_reco',
	'id'	=> 'Eval_reco',
	'value' => set_value('Eval_reco'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$SocialW = array(
	'name'	=> 'SocialW',
	'id'	=> 'SocialW',
	'value' => set_value('SocialW'),
);

$headSS = array(
	'name'	=> 'headSS',
	'id'	=> 'headSS',
	'value' => set_value('headSS'),
);

$admin = array(
	'name'	=> 'admin',
	'id'	=> 'admin',
	'value' => set_value('admin'),
);


 foreach($client_info as $row_info) 
			{
			    $client_id      = $row_info->client_id;
			    $fname   		= $row_info->client_fname;
			    $mname  		= $row_info->client_mname;
			    $lname   		= $row_info->client_lname;
			    $gender         = $row_info->gender;
			    $Birthplace     = $row_info->birthplace;
			    $dorm_id        = $row_info->dorm_id;
			    $sw_id          = $row_info->sw_id;
			    $Birthday  		= $row_info->birthday;
			    $admitDate 		= $row_info->created;
			    $sector 		= $row_info->client_sector;
             	$baptized   	= $row_info->baptized;
             	$civil_status 	= $row_info->civil_status;
	         	$nationality 	= $row_info->nationality;
	        // 	$present_add = $row_info->present_add;
	        // 	$contact_num = $row_info->contact_num;
	        // 	$permanent_add = $row_info->permanent_add;
	          	$educ_attained 	= $row_info->educ_attained;
	          	$emergency_name = $row_info->emergency_name;
	          	$emergency_add 	= $row_info->emergency_add;
	          	$emergency_contact = $row_info->emergency_contact;
	        // 	$referral_source = $row_info->referral_source;
	        //  	$source_add = $row_info->source_add;
	       //   	$source_contact = $row_info->source_contact;
	          	$id_presented 	= $row_info->id_presented;

	          	$problem 		= $row_info->problem;
	        //  	$agent_name = $row_info->agent_name;
	        //  	$agent_reason = $row_info->agent_reason;
	        //  	$agent_service = $row_info->agent_service;
	        // 	$problem_history = $row_info->problem_history;
	          	$intake_description = $row_info->intake_desc;
	          	$health_history = $row_info->health_history;
	        //$family_bg = $row_info->family_bg;
	          	$assess_problem = $row_info->assess_problem;
	          	$assess_needs 	= $row_info->assess_needs;
	          	$assess_motiv 	= $row_info->assess_motiv;
	          	$assess_resource  = $row_info->assess_resource;
	          	$status         = $row_info->client_status;
			}



function ageCalculator($Birthday){
  if(!empty($Birthday)){
    $birthdate = new DateTime($Birthday);
    $today   = new DateTime(date("Y/m/d"));
    $age = $birthdate->diff($today)->y;
    return $age;
  }else{
    return 0;
  }
}

$age = ageCalculator($Birthday);
			?>
<main >
 <div class="container">
 	<div class="row">
	<?php
		if($status == 0)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_admission.php');
        }
        elseif($status == 1)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');
        }

        ?>
    <div class="col s10" >
     	<?php echo form_open("auth/social_case_report"); ?>
     	<?php echo form_hidden('client_id', $client_id);
     		echo form_hidden('sw_id', $sw_id); ?>
      	<fieldset class="z-depth-2">
      		<center>
                  <h6 >Social Service Department</h6>
                 
                </center>
                <center>
                  <h6 ><b>Social Case Study Report</b></h6>
                </center>
                <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">

       		

			<?php echo "IDENTIFYING INFORMATION"; ?></br>
			<?php echo form_label('Name'); ?>:
			<?php echo $fname." ".$mname." ".$lname; ?></br>
			<?php echo form_label('Date of Birth'); ?>:
			<?php echo date('F d Y', strtotime($Birthday)); ?></br>
			<?php echo form_label('Age/Gender'); ?>:
			<?php echo $age."/"; ?><?php if ($gender == 1){echo "Male";}
			elseif($gender == 2){echo "Female";} ?></br>
			<?php echo form_label('Birthplace'); ?>
			<?php echo $Birthplace; ?></br>
			<?php echo form_label('Legal Status', $legalStat['id']); ?>:
			<?php echo $civil_status ?><br>

			<?php echo "Medical and Developmental History of the child"; ?></br>
			<?php echo form_textarea($medicalDev); ?>
			<?php echo "Description of  the client's Present environment"; ?></br>
			<?php echo form_textarea($present_description); ?>
			

			<?php echo "EVALUATION AND RECOMMENDATION"; ?></br>
			<?php echo form_textarea($Eval_reco); ?>


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