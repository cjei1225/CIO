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
?>







<main >

    <div class="container">
        <div class="row">
          	<fieldset class="z-depth-2">
            	<center><h5 class="bold">Check List</h5></center>
            	<h5 class="divider black"></h5>
            	<div class="col s5">
	            	<ul>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>

	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>

	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
					</ul>
				</div>
				<div class="col s5">
					<ul>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>

	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>

	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            		<li>[ ]General Intake form</li>
	            	</ul>
	            </div>
            </fieldset>
        </div>
    </div>
</main>

         	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>