<?php

foreach($discharge_sum_details as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   		= $row_info->client_fname;
    $lname  		= $row_info->client_lname; 
    $mname  		= $row_info->client_mname;
    $gender         = $row_info->gender;
    $birthplace    	= $row_info->birthplace;
    $dorm 	        = $row_info->d_name;
    $sw_id          = $row_info->first_name." ".$row_info->last_name;
    $birthday   	= $row_info->birthday;
    $admitDate 		= $row_info->created;
    $sector 		= $row_info->client_sector;
    $birthStat 		= "0";
    $dicharge_to	= $row_info->discharge_to;
    $discharge_reason = $row_info->discharge_reason;
    $case_summary	= $row_info->case_summary;
    $post_place_stat = $row_info->post_place_stat;
    $date_admitted	= $row_info->date_admitted;
    $date_discharged= $row_info->date_discharged;

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

                  <?php echo form_open('auth/mpdf_dis_sum'); 
                  echo form_hidden('client_id', $client_id);
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text green lighten-2 z-depth-2" id="userside">Print</button>
                  <?php echo form_close(); ?>
                 </div>
              </div>
            </div>
        </div> 
    	<div class="col s10">
	     	<?php echo form_open("auth/create_discharge_sum"); ?>
	      	<fieldset class="z-depth-2">
	            <center><h6 >Social Service Department</h6></center>
                <center><h5 class="bold">DISCHARGE SUMMARY</h5></center>
                <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
                <h5 class="divider black"></h5>
		        <div class="form-group">
		        	<div class="row">
						<div class="col s12"><b><?php echo "I.	Identifying Information"; ?></b></div>
						
						<div class="col s6"><?php echo form_label('Name of the Child');?>
						<b><?php echo $fname." ".$mname." ".$lname; ?></b>
						</div>
						<div class="col s6"><?php echo form_label('Date of Birth/Gender'); ?>
						<b><?php echo $birthday."/"; ?><?php if ($gender == 1){echo "Male";}
						elseif($gender == 2){echo "Female";} ?></b>
						</div>
						<div class="col s6"><?php echo form_label('Age upon Discharge'); ?>
						<b><?php echo $age; ?></b>
						</div>
						<div class="col s6"><?php echo form_label('Place of Birth'); ?>
						<b><?php echo $birthplace; ?></b>
						</div>
						<div class="col s6"><?php echo form_label('Birth Status'); ?>
						<b><?php echo $birthStat; ?></b>
						</div>
	
						<div class="col s6"><?php echo form_label('Case Category'); ?>
						<b><?php if($sector == 1){echo "Child and youth";}
		                  elseif($sector == 2){echo "Older Person";}
		                  elseif($sector == 3){echo "Special Needs";}
		                  elseif($sector == 4){echo "Crisis Situation";} ?></b>
		                  </div>
						<div class="col s6"><?php echo form_label('Dormitory'); ?>
						<b><?php echo $dorm; ?></b>
						</div>
						<div class="col s6"><?php echo form_label('Number of months of Stay in HSJ'); ?>
						<b><?php echo $num_months; ?></b>
						</div>
						<div class="col s6"><?php echo form_label('Date admitted in HSJ'); ?>
						<b><?php echo date('F-d-Y', strtotime($date_admitted));?></b>
						</div>
						<div class="col s6"><?php echo form_label('Date of Discharged'); ?>
						<b><?php echo date('F-d-Y', strtotime($date_discharged));?></b>
						</div>
						<div class="col s6"><?php echo form_label('Discharged to'); ?>
						<b><?php echo $dicharge_to; ?></b>
						</div>
						<div class="col s12"><?php echo form_label('Reason for discharge'); ?></div>
						<b><div class="col s12"><?php echo $discharge_reason; ?></div></b>
						
						<div class="col s12 divider black"></div>
						
						<div class="col s12"><b><?php echo "II.		Case Summary"; ?></b></div>
						<div class="col s12"><?php echo $case_summary; ?></div>
						
						<div class="col s12 divider black"></div>

						<div class="col s12"><b><?php echo "III.	Post Placement Status"; ?></b></div>
						<div class="col s12"><?php echo $post_place_stat; ?></div>
						<div class="col s12 divider black"></div>
						<div class="col s6"><?php echo "Prepared by"; ?></br>
						<u><?php echo "__________________"; ?></u></br>
						<?php echo $sw_id; ?></br>
						<?php echo form_label('Social Worker'); ?></br>
					</div>

						<div class="col s6"><?php echo "Noted by"; ?></br>
						<u><?php echo "__________________"; ?></u></br>
						<?php echo "Head Social worker"; ?></br>
						<?php echo form_label('Supervising Social Worker'); ?>
					</div>

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