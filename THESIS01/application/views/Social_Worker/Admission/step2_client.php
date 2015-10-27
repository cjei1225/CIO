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

?>







<main >
	<div class="container">
	    <ul class="menu">
	        <li><a href="#" class="active"><span>Step 1:Sector</span></a></li>
	        <li><a href="#" ><span>Step 2: Basic Information</span></a></li>
	        <li><a href="#"><span>Step 3: General Intake</span></a></li>
	        <li><a href="#"><span>Step 4: Upload Documents</span></a></li>
	  	</ul>
	</div>
    <div class="container">
        <div id="loginsize" style="margin-top:-120px; width:70%;">
          	<fieldset class="z-depth-2">
            	<center><h5 class="bold">Sector</h5></center>
                <h5 class="divider black"></h5>
                 <div class="row">
                 	<div class="col s3">
                 		<?php echo form_open('auth/step1_client'); ?>
						<?php echo form_hidden('Sector', '2'); ?>
						<button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Older person</button>
	               		<?php echo form_close(); ?>
	                 </div>
	                 <div class="col s3">
	                 	<?php echo form_open('auth/step1_client'); ?>
						<?php echo form_hidden('Sector', '1'); ?>
						<button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Child/Youth</button>
	               		<?php echo form_close(); ?>
	                </div> 
	                 <div class="col s3">
	                 	<?php echo form_open('auth/step1_client'); ?>
						<?php echo form_hidden('Sector', '4'); ?>
						<button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Crisis situation</button>
	               		<?php echo form_close(); ?>
	                </div> 
	                 <div class="col s3">
	                 	<?php echo form_open('auth/step1_client'); ?>
						<?php echo form_hidden('Sector', '3'); ?>
						<button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Special needs</button>
	               		<?php echo form_close(); ?>
	                </div>
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