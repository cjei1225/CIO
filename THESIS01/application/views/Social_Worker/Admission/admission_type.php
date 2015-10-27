<?php



?>

<main >
	<div class="container">
		<div class="row">
			<div class="col s3">
		    <ul class="menu">

		        <li><a href="#" class="active"><span>Step 1: Admission Type</span></a></li>
		        <li><a href="#"><span>Step 2: Guardian Information</span></a></li>
		        <li><a href="#"><span>Step 3: Client Information</span></a></li>
		        <li><a href="#"><span>Step 4: Background Info</span></a></li>
		        <li><a href="#"><span>Step 5: View Intake Output</span></a></li>
            	<li><a href="#"><span>Step 6: Upload Documents</span></a></li>
		  	</ul>
			</div>

	        <div  class="col s9" >
	         
	          	<fieldset class="z-depth-2">
	            	<center><h5 class="bold">Client Type</h5></center>
	                <h5 class="divider black"></h5>
	               	<div class="form-group">
	               		<div class = "row">
	               			<div class="col s12">
	               			 <strong>Client has been added successfully. Client ID : <?=$client_id;?></strong>
	               			</div>
	               			<div class="col">
	               				<?php
		                            echo form_open('auth/guardian_info');
		                            $admission_type = '1';
		                            echo form_hidden('admission_type', $admission_type);
		                            echo form_hidden('client_id', $client_id);                          
		                          ?>
			               		<button class="btn  waves-effect btn-md  green z-depth-2 left" type="submit" name="action">Reffered</button>

			               		<?php echo form_close(); ?>
			                </div>
			                <div class="col">
			                	<?php
		                            echo form_open('auth/guardian_info');
		                            $admission_type = '2';
		                            echo form_hidden('admission_type', $admission_type);
		                            echo form_hidden('client_id', $client_id);                          
		                          ?>
			               		<button class="btn  waves-effect btn-md  blue z-depth-2 left" type="submit" name="action">Surrendered</button>
			               		<?php echo form_close(); ?>
			                </div>
			                <div class="col">
			                	<?php if ($role == '7' || $role == '10' || $role == '8'){
		                            echo form_open('auth/guardian_info');
		                            $admission_type = '3';
		                            echo form_hidden('admission_type', $admission_type);
		                            echo form_hidden('client_id', $client_id);
		                        ?>                          
		                        
			               		<button class="btn  waves-effect btn-md  cyan z-depth-2 left" type="submit" name="action">Walk-In</button>
			               		<?php } ?>
			               		<?php echo form_close(); ?>

			                </div>
			                <div class="col">
			                	<?php if ($role == '7' ||$role == '9'){
		                            echo form_open('auth/client_info_special');
		                            $admission_type = '4';
		                            echo form_hidden('client_id', $client_id); 
		                            echo form_hidden('admission_type', $admission_type);
		                        ?>
			               		<button class="btn  waves-effect btn-md  cyan z-depth-2 left" type="submit" name="action">Self-Surrendered</button>
			               		<?php } ?>
			               		<?php echo form_close(); ?>
			                </div>
			                
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