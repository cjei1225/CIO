<?php

$disDate = array(
	'name'	=> 'disDate',
	'id'	=> 'disDate',
	'value'	=> set_value('disDate'),
);

$numMonths = array(
	'name'	=> 'numMonths',
	'id'	=> 'numMonths',
	'value' => set_value('numMonths'),
);

$dischargeTo = array(
	'name'	=> 'dischargeTo',
	'id'	=> 'dischargeTo',
	'value' => set_value('dischargeTo'),
);

$dischargeReason = array(
	'name'	=> 'dischargeReason',
	'id'	=> 'dischargeReason',
	'value' => set_value('dischargeReason'),
);

$caseSum = array(
	'name'	=> 'caseSum',
	'id'	=> 'caseSum',
	'value' => set_value('caseSum'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$postPlaceStat = array(
	'name'	=> 'postPlaceStat',
	'id'	=> 'postPlaceStat',
	'value' => set_value('postPlaceStat'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$socialW = array(
	'name'	=> 'socialW',
	'id'	=> 'socialW',
	'value' => set_value('socialW'),
);

$headSS = array(
	'name'	=> 'headSS',
	'id'	=> 'headSS',
	'value' => set_value('headSS'),
);

foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   		= $row_info->client_fname;
    $lname  		= $row_info->client_lname; 
    $mname  		= $row_info->client_mname;
    $gender         = $row_info->gender;
    $birthplace    	= $row_info->birthplace;
    $dorm 	        = $row_info->dorm_id;
    $sw_id          = $row_info->sw_id;
    $birthday   	= $row_info->birthday;
    $admitDate 		= $row_info->created;
    $sector 		= $row_info->client_sector;
    $birth_stat 		= '0';
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
    	<div class="col s2 left">
            <div class=" grey lighten-4" style="height:100%;">
              <div  >
                <div class="panel-body" style="height:100%;" >
                	 <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                          <br>
                <?php
                  if ($sector == 1){
                  echo form_open('auth/before_dis_adop'); 
                  echo form_hidden('client_id', $client_id);
                  echo '<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Slip</button>';
                  }
                  elseif ($sector == 2){
                  echo form_open('auth/before_dis_slip'); 
                  echo form_hidden('client_id', $client_id);
                  echo '<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Slip</button>';
                  }
                  elseif ($sector == 3){
                  echo form_open('auth/before_dis_slip'); 
                  echo form_hidden('client_id', $client_id);
                  echo '<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Slip</button>';
                  }
                  elseif ($sector == 4){
                  echo form_open('auth/before_dis_slip'); 
                  echo form_hidden('client_id', $client_id);
                  echo '<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Slip</button>';
                  }
                  ?>
                  <?php echo form_close(); ?>
                  <?php echo form_open('auth/before_dis_sum'); 
                  echo form_hidden('client_id', $client_id);
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Summary</button>
                  <?php echo form_close(); ?>
                 </div>
              </div>
            </div>
        </div> 
    	<div class="col s10">
	     	<?php echo form_open("auth/create_discharge_sum"); ?>
	      	<fieldset class="z-depth-2">
	        	<center><h5 class="bold">DISCHARGE SUMMARY</h5></center>
	            <h5 class="divider black"></h5>
	           	<div class="form-group">
					<?php echo "I.	Identifying Information"; ?></br>
					<?php echo form_hidden('client_id', $client_id); ?>
					<?php echo form_label('Name of the Child');?></br>
					<?php echo $fname." ".$mname." ".$lname; ?></br>
					<?php echo form_label('Date of Birth/Gender'); ?></br>
					<?php echo date('F-d-y', strtotime($birthday))."/"; ?><?php if ($gender == 1){echo "Male";}
					elseif($gender == 2){echo "Female";} ?></br>
					<?php echo form_label('Age upon Discharge'); ?></br>
					<?php echo $age; ?></br>
					<?php echo form_label('Place of Birth'); ?></br>
					<?php echo $birthplace; ?></br>
					<?php echo form_label('Birth Status'); ?></br>
					<?php echo $birth_stat; ?></br>
					<?php echo form_label('Date admitted in HSJ'); ?></br>
					<?php echo date('F-d-y', strtotime($admitDate)); ?></br>
					<?php echo form_label('Case Category'); ?></br>
					<?php if($sector == 1){echo "Child and youth";}
	                  elseif($sector == 2){echo "Older Person";}
	                  elseif($sector == 3){echo "Special Needs";}
	                  elseif($sector == 4){echo "Crisis Situation";} ?></br>
					<?php echo form_label('Dormitory'); ?></br>
					<?php echo $dorm; ?></br>
					<?php echo form_label('Number of months/years of Stay in HSJ', $numMonths['id']); ?>
					<?php echo form_input($numMonths); ?>
					<?php echo "dapt ata computated na to, not sure though"; ?></br>
					<?php echo form_label('Date admitted in HSJ'); ?></br>
					<?php echo date('F-d-y', strtotime($admitDate)); ?></br>
					<?php echo form_label('Date of Discharged'); ?></br>
					<?php echo date("F-d-Y"); ?></br>
					<?php echo form_label('Discharged to', $dischargeTo['id']); ?>
					<?php echo form_input($dischargeTo); ?>
					<?php echo form_label('Reason for discharged', $dischargeReason['id']); ?>
					<?php echo form_input($dischargeReason); ?>

					<?php echo "II.		Case Summary"; ?></br>
					<?php echo form_textarea($caseSum); ?>

					<?php echo "III.	Post Placement Status"; ?></br>
					<?php echo form_textarea($postPlaceStat); ?>

					<?php echo "Prepared by"; ?></br>
					<u><?php echo "button here for e-signature"; ?></u></br>
					<?php echo "Name of the social worker"; ?></br>
					<?php echo form_label('Social Worker'); ?></br>

					<?php echo "Noted by"; ?></br>
					<u><?php echo "button here for e-signature"; ?></u></br>
					<?php echo "Name of the head of social worker"; ?></br>
					<?php echo form_label('Supervising Social Worker'); ?>

					<div>
		           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
		            </div>
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