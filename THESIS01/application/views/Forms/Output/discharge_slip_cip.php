<?php

foreach($discharge_sli_details as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   		= $row_info->client_fname;
    $lname  		= $row_info->client_lname; 
    $mname  		= $row_info->client_mname;

    $gender         = $row_info->gender;
    $birthplace    	= $row_info->birthplace;
    $dorm 	        = $row_info->dorm_id;
    $sw_id          = $row_info->first_name." ".$row_info->last_name;
    $birthday   	= $row_info->birthday;
    $admitDate 		= $row_info->created;
    $sector 		= $row_info->client_sector;

    $reason 		= $row_info->dis_reason;
    $address 		= $row_info->address;
    $contact_num	= $row_info->contact_num;
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

                      <?php echo form_open('auth/mpdf_dis_slip'); 
	                  echo form_hidden('client_id', $client_id);
	                  ?>
	                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text green lighten-2 z-depth-2" id="userside">Print</button>
	                  <?php echo form_close(); ?>
                     </div>
                  </div>
                </div>
            </div> 
		    <div class="col s10">
		      	<fieldset class="z-depth-2">
		         <center><h6 >Social Service Department</h6></center>
                <center><h5 class="bold">DISCHARGE Slip</h5></center>
                <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
                <h5 class="divider black"></h5>
		           	<div class="form-group">
		           		<div class="row">
				
							<div class="col s6">
							<?php echo form_label('Name');?></br>
							<?php echo $fname." ".$mname." ".$lname; ?></br>
							</div>
							<div class="col s6">
							<?php echo form_label('Age upon discharge/Gender'); ?></br>
							<?php echo $age."/"; ?><?php if ($gender == 1){echo "Male";}
			                                elseif($gender == 2){echo "Female";} ?></br>
							</div>
							<div class="col s6">
							<?php echo form_label('Date admitted in HSJ'); ?></br>
							<?php echo $admitDate; ?></br>
							</div>
							<div class="col s6">
							<?php echo form_label('Case Category'); ?></br>
							<?php if($sector == 1){echo "Child and youth";}
			                  elseif($sector == 2){echo "Older Person";}
			                  elseif($sector == 3){echo "Special Needs";}
			                  elseif($sector == 4){echo "Crisis Situation";} ?></br>
							</div>
							<div class="col s6">
							<?php echo form_label('Reason for discharged'); ?>
							<?php echo $reason; ?>
							</div>
							<div class="col s6">
							<?php echo form_label('Address'); ?>
							<?php echo $address; ?>
							</div>
							<div class="col s6">
							<?php echo form_label('Tel. / Contact #'); ?>
							<?php echo $contact_num; ?>
							</div>
							<div class="col s12 divider black"></div><br>

							<div class="col s6">
							<?php echo "Recommended by:"; ?></br>
							<u><?php echo "button here for e-signature"; ?></u></br>
							<?php echo $sw_id; ?></br>
							<?php echo form_label('Social Worker'); ?>
							</div>

							<div class="col s6">
								<?php echo "Recommending Approval"; ?></br>
								<u><?php echo "button here for e-signature"; ?></u></br>
								<?php echo "head of social service"; ?>
							</div>
							
							<div class="col s6">
								<?php echo form_label('Head, Social Services'); ?></br>
								<u><?php echo "button here for e-signature"; ?></u></br>
								<?php echo "Name of the sister in-charge"; ?></br>
								<?php echo form_label('Sister in-charge'); ?>
							</div>
							
							<div class="col s6">
								<?php echo "Approved by"; ?></br>
								<u><?php echo "button here for e-signature"; ?></u></br>
								<?php echo "Name of the admin"; ?></br>
								<?php echo form_label('Administrator'); ?> 
							</div>
						<!--	<div>
				           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
				            </div>
				        -->
		        		</div>
		            </fieldset>
		               		
		        </div>
		    </div>
		</div>
	</div>
</main>

 	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>