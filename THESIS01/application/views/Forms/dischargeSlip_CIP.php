<?php

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

$disDate = array(
	'name'	=> 'disDate',
	'id'	=> 'disDate',
	'value'	=> set_value('disDate'),
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

$address = array(
	'name'	=> 'address',
	'id'	=> 'address',
	'value' => set_value('address'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$contactNum = array(
	'name'	=> 'contactNum',
	'id'	=> 'contactNum',
	'value' => set_value('contactNum'),
);

$sign = array(
	'name'	=> 'sign',
	'id'	=> 'sign',
	'value' => set_value('sign'),
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

$sister = array(
	'name'	=> 'sister',
	'id'	=> 'sister',
	'value' => set_value('sister'),
);

$admin = array(
	'name'	=> 'admin',
	'id'	=> 'admin',
	'value' => set_value('admin'),
);
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
		     	<?php echo form_open("auth/create_dis_slip"); ?>
		      	<fieldset class="z-depth-2">
		        	<center><h5 class="bold">DISCHARGE SLIP</h5></center>
		            <h5 class="divider black"></h5>
		           	<div class="form-group">

				
						<?php echo form_hidden('client_id', $client_id); ?>
						<?php echo form_label('Name');?></br>
						<?php echo $fname." ".$mname." ".$lname; ?></br>
						<?php echo form_label('Age upon discharge/Gender'); ?></br>
						<?php echo $age."/"; ?><?php if ($gender == 1){echo "Male";}
		                                elseif($gender == 2){echo "Female";} ?></br>
						<?php echo form_label('Date admitted in HSJ'); ?></br>
						<?php echo $admitDate; ?></br>
						<?php echo form_label('Case Category'); ?></br>
						<?php if($sector == 1){echo "Child and youth";}
		                  elseif($sector == 2){echo "Older Person";}
		                  elseif($sector == 3){echo "Special Needs";}
		                  elseif($sector == 4){echo "Crisis Situation";} ?></br>
						<?php echo form_label('Reason for discharged', $dischargeReason['id']); ?>

						<?php echo form_input($dischargeReason); ?>
						<?php echo form_label('Address', $address['id']); ?>
						
						<?php echo form_input($address); ?>
						<?php echo form_label('Tel. / Contact #', $contactNum['id']); ?>
						
						<?php echo form_input($contactNum); ?>

					<!-- <?php echo "Dapat nd to nasa e-form"; ?></br>
			
						<?php echo "Recommended by"; ?></br>
						<u><?php echo "button here for e-signature"; ?></u></br>
						<?php echo "Name of the social worker"; ?></br>
						<?php echo form_label('Social Worker'); ?></br></br>

						<?php echo "Recommending Approval"; ?></br>
						<u><?php echo "button here for e-signature"; ?></u></br>
						<?php echo "Name of the head of social service"; ?></br>
							<?php echo form_label('Head, Social Services', $headSS['id']); ?></br>
						<u><?php echo "button here for e-signature"; ?></u></br>
						<?php echo "Name of the sister in-charge"; ?></br>
						<?php echo form_label('Sister in-charge'); ?></br></br>
						
						<?php echo "Approved by"; ?></br>
						<u><?php echo "button here for e-signature"; ?></u></br>
						<?php echo "Name of the admin"; ?></br>
						<?php echo form_label('Administrator'); ?> 
					-->
					<div>
		           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
		            </div>
		            </fieldset>
		               		<?php echo form_close(); ?>
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