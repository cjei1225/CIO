<?php

$Fname = array(
	'name'	=> 'Fname',
	'id'	=> 'Fname',
	'value' => set_value('Fname'),
	'maxlength'	=> 50,
	'size'	=> 15,
	'class' => 'form-control',
);

$Lname = array(
	'name'	=> 'Lname',
	'id'	=> 'Lname',
	'value'	=> set_value('Lname'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$Mname = array(
	'name'	=> 'Mname',
	'id'	=> 'Mname',
	'value' => set_value('Mname'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$Dorm = array(
	'name'	=> 'Dorm',
	'id'	=> 'Dorm',
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

$Birthday = array(
	'name'	=> 'Birthday',
	'id'	=> 'Birthday',
	'value' => set_value('Birthday'),
	'class' => 'form-control',
);

$Birthplace = array(
	'name'	=> 'Birthplace',
	'id'	=> 'Birthplace',
	'value' => set_value('Birthplace'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$nickname = array(
	'name'	=> 'nickname',
	'id'	=> 'nickname',

	'value' => set_value('nickname'),
	'class' => 'form-control',
);

$civilStat = array(
	'name'	=> 'civilStat',
	'id'	=> 'civilStat',

	'value' => set_value('civilStat'),
	'class' => 'form-control',
);

$healthStat = array(
	'name'	=> 'healthStat',
	'id'	=> 'healthStat',
	'value' => set_value('healthStat'),
	'class' => 'form-control',
);

$religion = array(
	'name'	=> 'religion',
	'id'	=> 'religion',

	'value' => set_value('religion'),
	'class' => 'form-control',
);

$baptized = array(
	'name'	=> 'baptized',
	'id'	=> 'baptized',
	'value' => set_value('baptized'),
	'class' => 'form-control',
);

$nationality = array(
	'name'	=> 'nationality',
	'id'	=> 'nationality',
	'value' => set_value('nationality'),
	'class' => 'form-control',
);

$educAttain = array(
	'name'	=> 'educAttain',
	'id'	=> 'educAttain',

	'value' => set_value('educAttain'),
	'class' => 'form-control',
);

$schoolAttended = array(
	'name'	=> 'schoolAttended',
	'id'	=> 'schoolAttended',

	'value' => set_value('schoolAttended'),
	'class' => 'form-control',
);

$emergencyPerson = array(
	'name'	=> 'emergencyPerson',
	'id'	=> 'emergencyPerson',

	'value' => set_value('emergencyPerson'),
	'class' => 'form-control',
);

$emergencyAdd = array(
	'name'	=> 'emergencyAdd',
	'id'	=> 'emergencyContact',

	'value' => set_value('emergencyAdd'),
	'class' => 'form-control',
);

$emergencyContact = array(
	'name'	=> 'emergencyContact',
	'id'	=> 'emergencyContact',

	'value' => set_value('emergencyContact'),
	'class' => 'form-control',
);

$presentedID = array(
	'name'	=> 'presentedID',
	'id'	=> 'presentedID',

	'value' => set_value('presentedID'),
	'class' => 'form-control',
);

$dorm_counter = 0;
$surrenderer_name = "";
$surrenderer_add = "";
$surrenderer_contact = "";
$founder_name = "";
$found_address = "";
$found_contact = "";
$found_where = "";
$agenAdd = "";
$agenSW = "";
$agenSWContact = "";
?>

<main >
	<div class="container">
		<div class="row">
			<div class="col s3">
		    <ul class="menu">
		    	<?php if ($role == 9) { ?>
	            <li><a href="#" class="active"><span>Step 1: Client Information </span></a></li>
	            <li><a href="#"><span>Step 2: Background Info</span></a></li>
	            <li><a href="#"><span>Step 3: View Intake Output</span></a></li>
            	<li><a href="#"><span>Step 4: Upload Documents</span></a></li>
		    	<?php }elseif ($role == 7){ ?>
		    	<li><a href="#" ><span>Step 1: Admission Type</span></a></li>
		    	<li><a href="#" class="active"><span>Step 2: Client Information </span></a></li>
	            <li><a href="#"><span>Step 3: Background Info</span></a></li>
	            <li><a href="#"><span>Step 4: View Intake Output</span></a></li>
            	<li><a href="#"><span>Step 5: Upload Documents</span></a></li>
		    	<?php }else{ ?>
		    	<li><a href="#" ><span>Step 1: Admission Type</span></a></li>
	            <li><a href="#" ><span>Step 2: Guardian Information</span></a></li>
	            <li><a href="#" class="active"><span>Step 3: Client Information </span></a></li>
	            <li><a href="#"><span>Step 4: Background Info</span></a></li>
	            <li><a href="#"><span>Step 5: View Intake Output</span></a></li>
            	<li><a href="#"><span>Step 6: Upload Documents</span></a></li>
            	<?php } ?>
            	
		  	</ul>
</div>

	        <div  class="col s9" >
	         	<?php echo form_open("auth/background_info"); ?>
	         		<?php echo form_hidden('client_id', $client_id); 
		          		echo form_hidden('admission_type', $admission_type); 
		          		echo form_hidden('surrenderer_name', $surrenderer_name); 	
		          		echo form_hidden('surrenderer_add', $surrenderer_add); 	
		          		echo form_hidden('surrenderer_contact', $surrenderer_contact); 	
		          		echo form_hidden('founder_name', $founder_name); 	
		          		echo form_hidden('found_address', $found_address); 	
		          		echo form_hidden('found_contact', $found_contact); 
		          		echo form_hidden('found_where', $found_where);
		          		echo form_hidden('agenAdd', $agenAdd); 	
		          		echo form_hidden('agenSW', $agenSW); 
		          		echo form_hidden('agenSWContact', $agenSWContact);
		          		
					 ?> 
	          	<fieldset class="z-depth-2">
	            	<center><h5 class="bold">CLIENT INFORMATION</h5></center>
	                <h5 class="divider black"></h5>
	               	<div class="form-group">
	               		
	               			 <strong>Client ID : <?=$client_id;?></strong>
					    <div class = "row">     

	               			
		               		<div class="input-field col s6 ">
			                    <?php echo form_label('First name *', $Fname['id']); ?>
								<?php echo form_input($Fname); ?>
								<?php echo form_error($Fname['name']); ?><?php echo isset($errors[$Fname['name']])?$errors[$Fname['name']]:''; ?>
							</div>

			                <div class="input-field col s6 ">
			                    <?php echo form_label('Last name (Leave blank if none/unknown)', $Lname['id']); ?>
								<?php echo form_input($Lname); ?>
			                   	<?php echo form_error($Lname['name']); ?><?php echo isset($errors[$Lname['name']])?$errors[$Lname['name']]:''; ?>
		                   	</div>
		                   	<?php if ($admission_type == '3' && $Lname == ""){
		                   		$Lname = $found_where;}
		                   	?>

							<div class="input-field col s6 ">
			                   	<?php echo form_label('Middle name (Leave blank if none/unknown)', $Mname['id']); ?>
								<?php echo form_input($Mname); ?>
								 <?php echo form_error($Mname['name']); ?><?php echo isset($errors[$Mname['name']])?$errors[$Mname['name']]:''; ?>
							</div>

							<div class="input-field col s6 ">
								<?php echo form_label('Nickname (Leave blank if none/unknown)', $nickname['id']); ?>
								<?php echo form_input($nickname); ?>
								<?php echo form_error($nickname['name']); ?><?php echo isset($errors[$nickname['name']])?$errors[$nickname['name']]:''; ?>
							</div>

		                    <div class="input-field col s6 ">
			                    <label>Place of Birth (Leave blank if unknown)</label>
			                    <?php echo form_input($Birthplace); ?>
			                    <?php echo form_error($Birthplace['name']); ?><?php echo isset($errors[$Birthplace['name']])?$errors[$Birthplace['name']]:''; ?>
		                    </div>

		                    <div class="input-field col s6 ">
			                   	<label>Date of Birth (Leave blank if none/unknown)</label>
			                    <input type="date" name="Birthday" class="datepicker">
			                     <?php echo form_error($Birthday['name']); ?><?php echo isset($errors[$Birthday['name']])?$errors[$Birthday['name']]:''; ?>
		                    </div>

							<div class="input-field col s6 ">
								<?php echo form_label('Gender *', $Gender['id']); ?></br>
			                    <input name="Gender" value="1" type="radio" id="male" class="with-gap"/><label for="male">Male</label>
	      						<input name="Gender" value="2" type="radio" id="fem" class="with-gap"/><label for="fem">Female</label>
	      						<?php echo form_error($Gender['name']); ?><?php echo isset($errors[$Gender['name']])?$errors[$Gender['name']]:''; ?>
			                </div>

			                <div class="input-field col s6 ">
								<?php echo form_label('Baptized? *', $baptized['id']); ?></br>
								<input type="radio" name="baptized" value="0" id="sam1" class="with-gap"><label for='sam1'>No</label>
								<input type="radio" name="baptized" value="1" id="sam2" class="with-gap"><label for='sam2'>Yes</label>
								<input type="radio" name="baptized" value="2" id="sam3" class="with-gap"><label for='sam3'>Unknown</label>
								<?php echo form_error($baptized['name']); ?><?php echo isset($errors[$baptized['name']])?$errors[$baptized['name']]:''; ?>
							</div>

							<div class="input-field col s6 ">
								<div id="design_drop">
									<select name="Dorm" class="browser-default"> 
	                                    <option value="" disabled selected>Dormitory *</option>
	                                    <?php
	                                    foreach ($Dorms as $row_dorm)
	                                    {
	                                    echo"<option value="; echo "'".$row_dorm->dormitory_id."'"; echo">";  echo $row_dorm->d_name; echo ' ('; echo $row_dorm->d_capacity; echo ') </option>'; 
	                                    }
	                                    ?>
	                                </select>
		                        </div>
		                        <?php echo form_error($Dorm['name']); ?><?php echo isset($errors[$Dorm['name']])?$errors[$Dorm['name']]:''; ?>
							</div>

							<div class="input-field col s6 ">
								<select name="civilStat" class="browser-default">
					                    <option value="" disabled selected>Civil Status *</option>
					                    <option value="Single">Single</option>
					                    <option value="Married">Married</option>
					                    <option value="Widow">Widow</option>
					                    <option value="Widower">Widower</option>
					            </select>
					            <?php echo form_error($civilStat['name']); ?><?php echo isset($errors[$civilStat['name']])?$errors[$civilStat['name']]:''; ?>
					        </div>

							<div class="input-field col s6 ">
								<select name="religion" class="browser-default">
					                    <option value="" disabled selected>Religion *</option>
					                    <option value="Catholic">Catholic</option>
					                    <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
					                    <option value="Buddhist">Buddhist</option>
					                    <option value="Atheist">Atheist</option>
					                    <option value="Born Again">Born Again</option>
					                    <option value="No Religion">No Religion</option>
					                    <option value="Unknown">Unknown</option>
					            </select>
					            <?php echo form_error($religion['name']); ?><?php echo isset($errors[$religion['name']])?$errors[$religion['name']]:''; ?>
							</div>

							<div class="input-field col s6 ">
								<select name="healthStat" class="browser-default">
					                    <option value="" disabled selected>Health Status *</option>
					                    <option value="Underweight">Underweight</option>
					                    <option value="Normal Weight">Normal Weight</option>
					                    <option value="Overweight">Overweight</option>
					                    <option value="Obese">Obese</option>
					                    <option value="Unknown">Unknown</option>
					            </select>
					            <?php echo form_error($healthStat['name']); ?><?php echo isset($errors[$healthStat['name']])?$errors[$healthStat['name']]:''; ?>
							</div>

							<div class="input-field col s6 ">	
								<select name="educAttain" class="browser-default">
					                    <option value="" disabled selected>Highest Educational Attainment *</option>
					                    <option value="No Education">No Education</option>
					                    <option value="Pre-school">Pre-school</option>
					                    <option value="Elementary School">Elementary School</option>
					                    <option value="High School">High School</option>
					                    <option value="College">College</option>
					            </select>
					            <?php echo form_error($educAttain['name']); ?><?php echo isset($errors[$educAttain['name']])?$errors[$educAttain['name']]:''; ?>
					        </div>
							<div class="input-field col s6 ">
								<?php echo form_label('School Attended (Leave blank if unknown)', $schoolAttended['id']); ?>
								<?php echo form_input($schoolAttended); ?>
								<?php echo form_error($schoolAttended['name']); ?><?php echo isset($errors[$schoolAttended['name']])?$errors[$schoolAttended['name']]:''; ?>
							</div>
							<div class="input-field col s6 ">
								<?php echo form_label('Nationality (Leave blank if unknown)', $nationality['id']); ?>
								<?php echo form_input($nationality); ?>
								<?php echo form_error($nationality['name']); ?><?php echo isset($errors[$nationality['name']])?$errors[$nationality['name']]:''; ?>
							</div>
							<?php if ($role == '10' && $admission_type == '3') { ?>
							<div class="input-field col s6 ">
								<?php echo form_label('I.D. PRESENTED (specify, leave blank if none)', $presentedID['id']); ?>
								<?php echo form_input($presentedID); ?>
								<?php echo form_error($presentedID['name']); ?><?php echo isset($errors[$presentedID['name']])?$errors[$presentedID['name']]:''; ?>
							</div>   
							<?php } ?>				
							

							<?php if ($admission_type == '1' || $admission_type == '4') { ?>
							<div class="col center s12">
			                <h5>In case of emergency</h5>
			                <div class="divider"></div>
							
							<div class="input-field col s6 ">
								<?php echo form_label('Contact person (Leave blank if none/unknown)', $emergencyPerson['id']); ?>
								<?php echo form_input($emergencyPerson); ?>
								<?php echo form_error($emergencyPerson['name']); ?><?php echo isset($errors[$emergencyPerson['name']])?$errors[$emergencyPerson['name']]:''; ?>
							</div>

							<div class="input-field col s6 ">
								<?php echo form_label('Address (Leave blank if none/unknown)', $emergencyAdd['id']); ?>
								<?php echo form_input($emergencyAdd); ?>
								<?php echo form_error($emergencyAdd['name']); ?><?php echo isset($errors[$emergencyAdd['name']])?$errors[$emergencyAdd['name']]:''; ?>
							</div>

							<div class="input-field col s6 ">
								<?php echo form_label('Tel. Nos. (Leave blank if none/unknown)', $emergencyContact['id']); ?>
								<?php echo form_input($emergencyContact); ?>
								<?php echo form_error($emergencyContact['name']); ?><?php echo isset($errors[$emergencyContact['name']])?$errors[$emergencyContact['name']]:''; ?>
							</div>   
							<?php }elseif ($admission_type == '2') {
								echo form_hidden('emergencyPerson', $surrenderer_name);
								echo form_hidden('emergencyAdd', $surrenderer_add);
								echo form_hidden('emergencyContact', $surrenderer_contact);
							}elseif ($admission_type == '1') {
								echo form_hidden('emergencyPerson', $founder_name);
								echo form_hidden('emergencyAdd', $found_address);
								echo form_hidden('emergencyContact', $found_contact);
							} ?>

							<?php if ($admission_type == '' && $emergencyPerson == "" && $emergencyAdd == "" &&$emergencyContact == ""){
		                   		$emergencyPerson = $agenSW;
								$emergencyAdd = $agenAdd;
								$emergencyContact = $agenSWContact;
		                   	}
		                   	?>	
							
					         
							      
	               		</div>
	                <div class="col s12  center">
	               		<button class="btn  waves-effect green z-depth-2 " type="submit" name="action">Submit</button>
	                </div>
	            </fieldset>
	               		<?php echo form_close(); ?>
	        </div>
	    </div>
    </div>
</main>

         	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });

  
    </script>