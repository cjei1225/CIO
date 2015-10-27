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

$GenderOptions = array(
	'1'  => 'Male',
	'2'  => 'Female',
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

$Age = array(
	'name'	=> 'Age',
	'id'	=> 'Age',
	'value' => set_value('Age'),
	'maxlength'	=> 2,
	'size'	=> 15,
	'class' => 'form-control',
);

$URL =  $this->uri->uri_string();


if ($URL == "auth/step1_client")
{
	
}

?>

<main >
	<div class="container">
		<div class="row">
			<div class="col s3">
		    <ul class="menu">

		        <li><a href="#" class="active"><span>Step 1: Basic Information</span></a></li>
		        <li><a href="#"><span>Step 2: General Intake</span></a></li>
		        <li><a href="#"><span>Step 3: Upload Documents</span></a></li>
		  	</ul>
</div>

	        <div  class="col s9" >
	         	<?php echo form_open("auth/create_client"); ?>
	         
	          	<fieldset class="z-depth-2">
	            	<center><h5 class="bold">CREATE CLIENT</h5></center>
	                <h5 class="divider black"></h5>
	               	<div class="form-group">
	               		<div class = "row">

	               			<div class="input-field col s12 center ">

		               			<input name="admission_type" value="1" type="radio" id="referral" />
	      						<label for="referral">REFERED</label>
	      						<input name="admission_type" value="2" type="radio" id="surrender" />
	      						<label for="surrender">SURRENDER</label>
	      						<input name="admission_type" value="3" type="radio" id="walkin" />
	      						<label for="walkin">WALK-IN(found)</label>


  							</div>
		               		<div class="input-field col s6 ">
			                    <?php echo form_label('First name', $Fname['id']); ?>
								<?php echo form_input($Fname); ?>
								<?php echo form_error($Fname['name']); ?><?php echo isset($errors[$Fname['name']])?$errors[$Fname['name']]:''; ?>
							</div>
			                <div class="input-field col s6 ">
			                    <?php echo form_label('Last name', $Lname['id']); ?>
								<?php echo form_input($Lname); ?>
			                   	<?php echo form_error($Lname['name']); ?><?php echo isset($errors[$Lname['name']])?$errors[$Lname['name']]:''; ?>
		                   	</div>
							<div class="input-field col s6 ">
			                   	<?php echo form_label('Middle name', $Mname['id']); ?>
								<?php echo form_input($Mname); ?>
								 <?php echo form_error($Mname['name']); ?><?php echo isset($errors[$Mname['name']])?$errors[$Mname['name']]:''; ?>
							</div>
		                    <div class="input-field col s6 ">
			                    <label>Place of Birth</label>
			                    <?php echo form_input($Birthplace); ?>
			                     <?php echo form_error($Birthplace['name']); ?><?php echo isset($errors[$Birthplace['name']])?$errors[$Birthplace['name']]:''; ?>
		                    </div>
		                    <div class="input-field col s6 ">
			                   
			                    <input type="date" placeholder="Date of Birth" name="Birthday" class="datepicker">
			                     <?php echo form_error($Birthday['name']); ?><?php echo isset($errors[$Birthday['name']])?$errors[$Birthday['name']]:''; ?>
		                    </div>

							<div class="input-field col s6 ">
			                    <select name="Gender" class="browser-default">
				                    <option value="" disabled selected>Gender</option>
				                    <option value="1">Male</option>
				                    <option value="2">Female</option>
				                </select>
			                </div>
							<div class="input-field col s6 ">
								<div id="design_drop">
									<select name="Dorm" class="browser-default"> 
	                                    <option value="" disabled selected>Dormitory</option>
	                                    <?php
	                                    foreach ($Dorms as $row_dorm)
	                                    {
	                                    echo"<option value="; echo "'".$row_dorm->dormitory_id."'"; echo">";  echo $row_dorm->d_name; echo '</option>'; 
	                                    }
	                                    ?>
	                                </select>
		                        </div>
							</div>             
	               		</div>
	                <div>
	               		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
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