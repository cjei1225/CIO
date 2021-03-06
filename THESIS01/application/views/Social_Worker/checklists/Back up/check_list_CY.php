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
$birth_cert					 = '0';
$founling_cert				 = '0';
$Bastimal_cert				 = '0';
$admission_slip				 = '0';
$confirmation_cert			 = '0';
$parents_marriage_cert		 = '0';
$parents_death_cert			 = '0';
$Recordings					 = '0';
$report_cards				 = '0';
$referral_letter			 = '0';
$foot_hand_prints			 = '0';
$DVC						 = '0';
$letter_mother				 = '0';
$barangay_report 			 = '0';
$police_report 				 = '0';
$barangay_cert_nonresidency  = '0';
$media_cert					 = '0';
$radio_cert					 = '0';
$newspaper_cert 			 = '0';
$returned_registered_mail 	 = '0';
$petition_declared_abandoned = '0';
$CDCLAA						 = '0';
$Notice_posting				 = '0';
$Court_decision				 = '0';

$fatality_cert				 = '0';
$discharge_slip				 = '0';
$PARR1						 = '0';
$PARR2						 = '0';
$PARR3						 = '0';
$PARR4						 = '0';
$Adoption_degree			 = '0';

$Social_case				 = '0';
$Progress_report			 = '0';
$Medical_Report				 = '0';
?>
<?php 
	$i = 1;
	$document = array();
	foreach($checklist_items as $checklist_items)
		{
		$document = $checklist_items->document_type; 
		if($document == 1){$General_intake = '1';}
		elseif($document == 2){$birth_cert = '1';}
		elseif($document == 3){$founling_cert = '1';}
		elseif($document == 4){$admission_slip = '1';}
		elseif($document == 5){$Bastimal_cert = '1';}
		elseif($document == 6){$confirmation_cert = '1';}
		elseif($document == 7){$parents_marriage_cert = '1';}
		elseif($document == 8){$parents_death_cert = '1';}	
		elseif($document == 9){$Recordings = '1';}
		elseif($document == 10){$report_cards = '1';}
		elseif($document == 11){$referral_letter = '1';}
		elseif($document == 12){$foot_hand_prints = '1';}
		elseif($document == 13){$DVC = '1';}
		elseif($document == 14){$letter_mother = '1';}
		elseif($document == 15){$barangay_report = '1';}
		elseif($document == 16){$police_report = '1';}
		elseif($document == 17){$barangay_cert_nonresidency = '1';}
		elseif($document == 18){$radio_cert = '1';}
		elseif($document == 19){$newspaper_cert = '1';}
		elseif($document == 20){$Social_case++;}
		elseif($document == 21){$returned_registered_mail = '1';}
		elseif($document == 22){$petition_declared_abandoned = '1';}
		elseif($document == 23){$CDCLAA = '1';}
		elseif($document == 24){$Notice_posting = '1';}
		elseif($document == 25){$Court_decision = '1';}
		elseif($document == 26){$fatality_cert = '1';}
		elseif($document == 27){$discharge_slip = '1';}
		elseif($document == 33){$Medical_Report++;}	
		elseif($document == 50){$PARR1 = '1';}
		elseif($document == 51){$PARR2 = '1';}
		elseif($document == 52){$PARR3 = '1';}
		elseif($document == 53){$PARR4 = '1';}
		elseif($document == 54){$Adoption_degree = '1';}

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
		$admission_type = $row_client->admission_type;

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
		                <h6 >Children and Youth Welfare Development Program</h5>
		                <h6 >Adoption Services</h6>
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
			            
			            	<h6 >Name: <?php echo $client_fname.' '. $client_lname; ?></h6>
			             	
			            	<h6> Nickname:</h6>
			            	
			            	<h6>Age: <?php echo $age; ?></h6>
			            	
			            	<h6 >Gender: <?php echo $gender; ?></h6>
			            	
			            	<h6 >Date of Birth [Given]: <?php echo $birthday; ?></h6>
			            	<?php if($admission_type == "2")
			            	{?>
			                <h6 >Place Found: </h6>
			               	<?php } ?><br>
			               	<h6 >Birth Status:</h6>
			               </div>
			               <div class="col s6">
			               	<br>
			               	<h6>Religion:</h6>
			               
			                <h6>Nationality:</h6>
			               
			               	<h6 >Grade Level:</h6>
			               
			               	<h6>School Attended:</h6>
			               	
			                <h6>Date Admitted: <?php echo $created; ?></h6>
			               
			                <h6>Source of Referral:</h6>
			               	<h6 >Case Category: </h6>
			               	<br> 
			               	
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
				                        	<td>Intake Sheet</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check2" type="checkbox" <?php if($admission_slip == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check2"></label></td>
				                        	<td>Admission Slip</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check3" type="checkbox" <?php if($Social_case == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check3"></label></td>
				                        	<td>Child Case Study Report</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check4" type="checkbox" <?php if($birth_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check4"></label></td>
				                        	<td>Birth Certificate [Local/Secpa]</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check5" type="checkbox" <?php if($founling_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check5"></label></td>
				                        	<td>Foundling Certificate [Local/Secpa]</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check6" type="checkbox" <?php if($Bastimal_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check6"></label></td>
				                        	<td>Baptismal Certificate</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check7" type="checkbox" <?php if($confirmation_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check7"></label></td>
				                        	<td>Confirmation Certificate</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check8" type="checkbox" <?php if($parents_marriage_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check8"></label></td>
				                        	<td>Marriage Certificate of Parent</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check9" type="checkbox" <?php if($parents_death_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check9"></label></td>
				                        	<td>Death Certificate of Parent/s</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check10" type="checkbox" <?php if($Recordings == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check10"></label></td>
				                        	<td>Recordings</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                      	
				                      	<tr>
				                        	<td><input id="check11" type="checkbox" <?php if($Progress_report == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check11"></label></td>
				                        	<td>Progress Report</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><p><?php echo $Medical_Report;?></p><label for="check12"></label></td>
				                        	<td>
				                        		
		                                <?php
		                                  echo form_open('auth/socialW_medical_profile');
		                                  echo form_hidden('client_id', $client_id);
		                                ?>

		                                <button type="submit" value="view">Health and Medical Abstarct/Records </button>
		                                <?php
		                                  echo form_close();
		                                ?>
		                           
				                        	</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                        
				                        <tr>
				                        	<td><input id="check13" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check13"></label></td>
				                        	<td>Psychological Evaluation Report</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                         	<td><input id="check14" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check14"></label></td>
				                        	<td>Psychiatric Evaluation Report</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check15" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check15"></label></td>
				                        	<td>OT/PT/ST/ Developmental Assessment</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check16" type="checkbox" <?php if($report_cards == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check16"></label></td>
				                        	<td>Child's School Report/Card</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check17" type="checkbox" <?php if($referral_letter == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check17"></label></td>
				                        	<td>Referral Letter</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check18" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check18"></label></td>
				                        	<td>Picture [upon admission/recent]</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       	
				                       	<tr>
				                        	<td><input id="check19" type="checkbox" <?php if($foot_hand_prints == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check19"></label></td>
				                        	<td>Footprints/ Handprints upon admission</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                       
				                      	<tr>
				                        	<td><input id="check20" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check20"></label></td>
				                        	<td>Incidental Reports</td>
				                        	<td>03-04-2015</td>
				                      	</tr>
				                    </tbody>
		        				</table>
		           			</div>
		           			<div class="table-responsive col s12 m6">
			                	<table >
			                    	<tbody>
			                      	<tr>
			                        	<td><input id="check21" type="checkbox" <?php if($DVC == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check21"></label></td>
			                        	<td>Deed of Volunatry Commitment [DVC]</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check22" type="checkbox" <?php if($letter_mother == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check22"></label></td>
			                        	<td>Letter of Mother</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check23" type="checkbox" <?php if($barangay_report == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check23"></label></td>
			                        	<td>Barangay/ Police Blotter/ Report</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td>	<input id="check24" type="checkbox" <?php if($barangay_cert_nonresidency == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check24"></label></td>
			                        	<td>Barangay Certification of Non-residency</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                        
			                        <tr>
			                        	<td></td>
			                        	<td style="height:25px;">Media Certification</td>
			                        	<td></td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check25" type="checkbox" <?php if($radio_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check25"></label></td>
			                        	<td>Radio Station/s Certification</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check26" type="checkbox" <?php if($newspaper_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check26"></label></td>
			                        	<td>Newspaper Publication</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check27" type="checkbox" <?php if($returned_registered_mail == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check27"></label></td>
			                        	<td>Returned Registered Mail/Letter</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check28" type="checkbox" <?php if($petition_declared_abandoned == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check28"></label></td>
			                        	<td>Pettion for Declareded Abandoned</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       
			                       	<tr>
			                        	<td><input id="check29" type="checkbox" <?php if($CDCLAA == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check29"></label></td>
			                        	<td>CDCLAA Copy</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check30" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check30"></label></td>
			                        	<td>Affidavit of the FInder</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                       	
			                       	<tr>
			                        	<td><input id="check31" type="checkbox" <?php if($Notice_posting == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check31"></label></td>
			                        	<td>Notice of Posting</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                      	
			                      	<tr>
			                        	<td><input id="check32" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check32"></label></td>
			                        	<td>Child's Profile <input id="check32.1" type="checkbox" ><label for="check32.1">Local</label> <input id="check32.2" type="checkbox" ><label for="check32.2">ICAB</label></td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                      	
			                      	<tr>
			                        	<td><input id="check33" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check33"></label></td>
			                        	<td>Health and Medical Profile (ICAB Form)</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                      	
			                      	<tr>
			                        	<td><input id="check34" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check34"></label></td>
			                        	<td>Pedia-clearance</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                      	
			                      	<tr>
			                        	<td><input id="check35" type="checkbox" <?php if($Court_decision == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check35"></label></td>
			                        	<td>Court's Decision</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                      	
			                      	<tr>
			                        	<td><input id="check36" type="checkbox" <?php if($fatality_cert == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check36"></label></td>
			                        	<td>Certificate of Finality</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                      	
			                      	<tr>
			                        	<td><input id="check37" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check37"></label></td>
			                        	<td>Supplemental Report</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                      	
			                      	<tr>
			                        	<td><input id="check38" type="checkbox" <?php if($discharge_slip == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check38"></label></td>
			                        	<td>Discharge Slip</td>
			                        	<td>03-04-2015</td>
			                      	</tr>
			                      	
			                      	<tr>
			                        	<td><input id="check40" type="checkbox" <?php if($General_intake == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check40"></label></td>
			                        	<td>Others[specify] <input type="text" style="width:200px; margin-top:-50px; margin-bottom:-9px;"/></td>
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
		                        	<td><input id="check41" type="checkbox" <?php if($PARR1 == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check41"></label></td>
		                        	<td>1st Post-Admission Report Recieved</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check42" type="checkbox" <?php if($PARR2 == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check42"></label></td>
		                        	<td>2nd Post-Admission Report Recieved</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check43" type="checkbox" <?php if($PARR3 == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check43"></label></td>
		                        	<td>3rd Post-Admission Report Recieved</td>
		                        	<td>03-04-2015</td>
		                      	</tr>

		                      	<tr>
		                        	<td><input id="check43" type="checkbox" <?php if($PARR4 == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check43"></label></td>
		                        	<td>4th Post-Admission Report Recieved</td>
		                        	<td>03-04-2015</td>
		                      	</tr>

		                       	<tr>
		                        	<td><input id="check44" type="checkbox" <?php if($Adoption_degree == 1){echo 'checked="checked" disabled="disabled"';}?>><label for="check44"></label></td>
		                        	<td>Adoption Degree Received</td>
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