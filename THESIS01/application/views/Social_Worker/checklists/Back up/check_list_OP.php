<?php

$Fname = array(
	'name'	=> 'Fname',
	'id'	=> 'Fname',
	'placeholder'	=> 'First Name',
	'value' => set_value('Fname'),
	'maxlength'	=> 50,
	'size'	=> 15,
	'class' => 'form-control',
);

$Lname = array(
	'name'	=> 'Lname',
	'id'	=> 'Lname',
	'placeholder'	=> 'Last Name',
	'value'	=> set_value('Lname'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$Mname = array(
	'name'	=> 'Mname',
	'id'	=> 'Mname',
	'placeholder'	=> 'Middle Name',
	'value' => set_value('Mname'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$Sector = array(
	'name'	=> 'Sector',
	'id'	=> 'Sector',
	'value' => set_value('Sector'),
	'class' => 'form-control',
);

$Sector_number = array(
         '1'  => 'Child and Youth',
         '2'  => 'Older Persons',
         '3'  => 'Persons with Special Needs',  
		 '4'  => 'Persons in Crisis Situation',  
);

$Dorm = array(
	'name'	=> 'Dorm',
	'id'	=> 'Dorm',
	'placeholder'	=> 'Dorm',
	'value' => set_value('Dorm'),
	'maxlength'	=> 1,
	'size'	=> 15,
	'class' => 'form-control',
);


$SocialW = array(
	'name'	=> 'SocialW',
	'id'	=> 'SocialW',
	'value' => set_value('SocialW'),
	'maxlength'	=> 1,
	'size'	=> 15,
	'class' => 'form-control',
);

$Gender = array(
	'name'	=> 'Gender',
	'id'	=> 'Gender',
	'value' => set_value('Gender'),
	'class' => 'form-control',
);

$GenderOptions = array(
	'1'  => 'Male',
	'2'  => 'Female',
);

$Birthday = array(
	'name'	=> 'Birthday',
	'id'	=> 'Birthday',
	'placeholder'	=> 'Date of Birth',
	'value' => set_value('Birthday'),
	'class' => 'form-control',
);

$Birthplace = array(
	'name'	=> 'Birthplace',
	'id'	=> 'Birthplace',
	'placeholder'	=> 'Place of Birth',
	'value' => set_value('Birthplace'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$Age = array(
	'name'	=> 'Age',
	'id'	=> 'Age',
	'placeholder'	=> 'Age',
	'value' => set_value('Age'),
	'maxlength'	=> 2,
	'size'	=> 15,
	'class' => 'form-control',
);


$General_intake				 = '0';
$admission_form				 = '0';
$kasunduan					 = '0';
$aff_undertaking			 = '0';
$pre_admission_CC			 = '0';
$initial_scsr				 = '0';
$updated_scsr				 = '0';
$pt_progress_rep			 = '0';
$medical_rep				 = '0';
$referral_letter			 = '0';
$photos						 = '0';
$life_plans 				 = '0';
$gsis_sss	 				 = '0';
$recordings  				 = '0';


$pre_discharge_cc			 = '0';
$discharge_form				 = '0';
$discharge_sum				 = '0';
$death_certificate			 = '0';



?>
<?php 
	$i = 1;
	$document = array();
	foreach($checklist_items as $checklist_items)
		{
		$document = $checklist_items->document_type; 
		if($document == 1){$General_intake = '1';}
		elseif($document == 4){$admission_form = '1';}
		elseif($document == 37){$kasunduan = '1';}
		elseif($document == 38){$aff_undertaking = '1';}
		elseif($document == 39){$pre_admission_CC = '1';}
		elseif($document == 20){$initial_scsr = '1';}
		elseif($document == 20){$updated_scsr = '1';}	
		elseif($document == 40){$pt_progress_rep = '1';}
		elseif($document == 33){$medical_rep = '1';}
		elseif($document == 11){$referral_letter = '1';}
		elseif($document == 42){$photos = '1';}
		elseif($document == 41){$life_plans = '1';}
		elseif($document == 43){$gsis_sss = '1';}
		elseif($document == 9){$recordings = '1';}
		elseif($document == 44){$pre_discharge_cc = '1';}
		elseif($document == 27){$discharge_form = '1';}
		elseif($document == 45){$discharge_sum = '1';}
		elseif($document == 46){$death_certificate = '1';}


		}
 ?>

<?php
	foreach($client_info as $row_client)
	{

		$client_id   	= $row_client->client_id;
		$client_lname   = $row_client->client_lname;
		$client_fname   = $row_client->client_fname;
		$gender  	 	= $row_client->gender;
		$mname   		= $row_client->client_mname;
		$client_sector  = $row_client->client_sector;
		$birthday   	= $row_client->birthday;
		$dorm_id   		= $row_client->dorm_id;
		$birthplace   	= $row_client->birthplace;
		$created   		= $row_client->created;
		$nickname		= $row_client->nickname;
		$birthStat		= "0";
		$religion 		= $row_client->religion;
		$nationality 	= $row_client->nationality;
		$sector 		= $row_client->client_sector;
		$healthStat		= $row_client->health_stat;
		$educAttain		= $row_client->educ_attained;
		$ref_source		= $row_client->referral_source;
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
		          <div>
		            <div class="panel-body" style="height:100%;" >
		        	  <?php
		                echo form_open('auth/update_checklist');
		                echo form_hidden('client_id', $client_id); ?>

		                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text blue lighten-2 z-depth-2" id="userside">Add items</button>
		                <?php
		                echo form_close();
		              
		              ?>

		        	  <?php
		                echo form_open('auth/pending_client_page');
		                echo form_hidden('client_id', $client_id); ?>

		                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
		                <?php
		                echo form_close();
		              
		              ?>

		              <?php
		              echo form_open('auth/view_intake');
		              echo form_hidden('client_id', $client_id); ?>

		              <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">View Intake </button>
		              <?php
		              echo form_close();
		              ?>

		              <?php
		              echo form_open('auth/pre_admission_CC');
		              echo form_hidden('client_id', $client_id);
		              ?>
		              <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">preadmission</button>
		              <?php
		              echo form_close();
		              ?>

		              <?php
		              echo form_open('auth/POA_list');
		              echo form_hidden('client_id', $client_id);
		              ?>
		              <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Plan Of Action</button>
		              <?php
		              echo form_close();
		              ?>

		              <?php
		              echo form_open('auth/media_certificate');
		              echo form_hidden('client_id', $client_id);
		              ?>
		              <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Media Certificate</button>
		              <?php
		              echo form_close();
		              ?>
		             </div>
		          </div>
		        </div>
	     	</div> 
		    <div class="col s10">
		      	<fieldset class="z-depth-2">    
		            <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
		            <center>
		                <h5>HOSPICIO DE SAN JOSE</h5>
		                <h7>Ayala Bridge, Manila</h7>
		                <h6 >Social Service Department</h6>
		                <h6 >Older Person Development Program</h5>
		        	</center>
		            <center>
		            	<h6 ><b>CHECKLIST</b></h6>
		        	</center>
		       
		         	<h5 class="divider black"></h5>
		            <div class="form-group">
		            	<div class="row">
		            		<div class="col s6">
			            	<label ><b>BASIC INFORMATION</b></label>
			            	<br>
			            
			            	<h6>Name: <?php echo $client_fname.' '. $client_lname; ?></h6>
			             	
			            	<h6>Nickname: <?php echo $nickname; ?></h6>
			            	
			            	<h6>Age/Gender: <?php echo $age.'/'; if ($gender == 1){echo "Male";}
                                      elseif($gender == 2){echo "Female";} ?> </h6>
			            	
			            	<h6>Date of Birth: <?php echo $birthday; ?></h6>
			            	
			                <h6>Place of Birth: <?php echo $birthplace; ?></h6>

			               	<h6>Religion: <?php echo $religion; ?></h6>
			               </div>
			               <div class="col s6">
			               	<br>
			                <h6>Nationality: <?php echo $nationality; ?></h6>
			               
			               	<h6>Educational Attainment: <?php echo $educAttain; ?></h6>
			               	
			                <h6>Date Admitted: <?php echo $created; ?></h6>
			               
			                <h6>Source of Referral: <?php echo $ref_source; ?></h6>

			               	<h6 >Case Category: <?php if ($sector == 1){echo "Child and youth";}
                                            elseif($sector == 2){echo "Older Person";}
                                            elseif($sector == 3){echo "special Needs";}
                                            elseif($sector == 4){echo "Crisis Situation";} ?></h6>
			               	
			               	<h6>Health Status: <?php echo $healthStat; ?></h6>
			               	
			               </div>
			            </div>   	
			            <label ><b>DOCUMENT ON FILE</b></label>
		            </div>
		           		<div class="row">
		             		<div class="table-responsive col s12 m6">
		          				<table>
				                    <tbody>
				                    	<tr>
				                        	<td><input id="check1" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?> ><label for="check1"></label></td>
				                        	<td>General Intake Sheet</td>
				                        	<td>03-04-2015</td>
				                      	</tr>

				                      	<tr>
				                        	<td><input id="check2" type="checkbox" <?php if($admission_form == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check2"></label></td>
				                        	<td>Admission Slip</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check3" type="checkbox" <?php if($kasunduan == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check3"></label></td>
				                        	<td>Kasunduan</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check4" type="checkbox" <?php if($aff_undertaking == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check4"></label></td>
				                        	<td>Notarized Affidavit of Undertakings</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check5" type="checkbox" <?php if($pre_admission_CC == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check5"></label></td>
				                        	<td>Pre-Admission Case Conference Materials</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check6" type="checkbox" <?php if($initial_scsr == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check6"></label></td>
				                        	<td>Initial Case Study Report</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check7" type="checkbox" <?php if($updated_scsr == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check7"></label></td>
				                        	<td>Updated Social Case Study Report</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                    </tbody>
		        				</table>
		           			</div>
		           			<div class="table-responsive col s12 m6">
			                	<table >
			                    	<tbody>
			                      	<tr>
			                        	<td><input id="check8" type="checkbox" <?php if($pt_progress_rep == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check8"></label></td>
			                        	<td>PT/ OT Developmental/ Progress Reports</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check9" type="checkbox" <?php if($medical_rep == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check9"></label></td>
			                        	<td>Medical Records/ Laboratory Records</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check10" type="checkbox" <?php if($referral_letter == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check10"></label></td>
			                        	<td>Referral Letter</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                        
			                        <tr>
			                        	<td><input id="check11" type="checkbox" <?php if($photos == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check11"></label></td>
			                        	<td>Photos</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check12" type="checkbox" <?php if($life_plans == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check12"></label></td>
			                        	<td>Life Plans</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check13" type="checkbox" <?php if($gsis_sss == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check13"></label></td>
			                        	<td>GSIS/ SSS Pension (ATM/ Passbook)</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check14" type="checkbox" <?php if($recordings == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check14"></label></td>
			                        	<td>Recordings</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       
			                    </tbody>
			                </table>
			            </div> 
			        </div>
			    	
			    	<div>
			            <label ><b>POST-ADMISSION</b></label>
			            <br>
			            <table>
		                    <tbody>
		                      	<tr>
		                        	<td><input id="check15" type="checkbox" <?php if($pre_discharge_cc == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check15"></label></td>
		                        	<td>Pre-Discharge Case Conference Materials</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check16" type="checkbox" <?php if($discharge_form == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check16"></label></td>
		                        	<td>Discharge Form</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check17" type="checkbox" <?php if($discharge_sum == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check17"></label></td>
		                        	<td>Discharge Summary</td>
		                        	<td>03-04-2015</td>
		                      	</tr>

		                      	<tr>
		                        	<td><input id="check18" type="checkbox" <?php if($death_certificate == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check18"></label></td>
		                        	<td>Death Certificate</td>
		                        	<td>03-04-2015</td>
		                      	</tr>

		                    </tbody>
		                </table>  
		            </div>
		        </fieldset>
		    </div>
		</div>
    </div>
</main>

         	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>