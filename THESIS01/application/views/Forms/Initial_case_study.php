<?php


$exceptionality = array(
	'name'	=> 'exceptionality',
	'id'	=> 'exceptionality',
	'value' => set_value('exceptionality'),
);

$currentFam = array(
	'name'	=> 'currentFam',
	'id'	=> 'currentFam',
	'value' => set_value('currentFam'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$abandonFact = array(
	'name'	=> 'abandonFact',
	'id'	=> 'abandonFact',
	'value' => set_value('abandonFact'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$evalReco = array(
	'name'	=> 'evalReco',
	'id'	=> 'evalReco',
	'value' => set_value('evalReco'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$presentEnvi = array(
	'name'	=> 'presentEnvi',
	'id'	=> 'presentEnvi',
	'value' => set_value('presentEnvi'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);
$referalAdmission = array(
	'name'	=> 'referalAdmission',
	'id'	=> 'referalAdmission',
	'value' => set_value('referalAdmission'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);


include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
			?>
<main >
 	<div class="container">
 		<div class="row">
	 		<?php
			if($status == 0)
	        {
	          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_admission.php');
	        }
	        elseif($status == 1)
	        {
	          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');
	        }

	        ?>
	    	<div class="col s10" >

	     		<?php echo form_open("auth/intial_case_submit"); ?>
		      		<fieldset class="z-depth-2">
		      			<?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info.php'); ?>
		      		</fieldset>
		      		<br>
		      			<fieldset class="z-depth-2">
			      		<center>
			                  <h6 >Social Service Department</h6>
			                 
			                </center>
			                <center>
			                  <h6 ><b>Social Case Study Report</b></h6>
			                </center>
			                <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
			            <h5 class="divider black"></h5>
			           	<div class="form-group">
			           		<?php echo form_hidden('client_id', $client_id); ?>
						
						<?php echo '1. Exceptionality'; ?>
						<?php echo form_input($exceptionality); ?>
						<?php echo form_error($exceptionality['name']); ?><?php echo isset($errors[$exceptionality['name']])?$errors[$exceptionality['name']]:''; ?>

						<?php echo "2. Description of the client's Present environment"; ?>
						<?php echo form_textarea($presentEnvi); ?>
						<?php echo form_error($presentEnvi['name']); ?><?php echo isset($errors[$presentEnvi['name']])?$errors[$presentEnvi['name']]:''; ?>

						<?php echo "3. Circumstances of referral and admission"; ?>
						<?php echo form_textarea($referalAdmission); ?>
						<?php echo form_error($referalAdmission['name']); ?><?php echo isset($errors[$referalAdmission['name']])?$errors[$referalAdmission['name']]:''; ?>

						<?php echo "4. The Family"; ?>
						<?php echo form_textarea($currentFam); ?>
						<?php echo form_error($currentFam['name']); ?><?php echo isset($errors[$currentFam['name']])?$errors[$currentFam['name']]:''; ?>

						<?php echo "5. Facts of abandonment"; ?>
						<?php echo form_textarea($abandonFact); ?>
						<?php echo form_error($abandonFact['name']); ?><?php echo isset($errors[$abandonFact['name']])?$errors[$abandonFact['name']]:''; ?>
						
						<?php echo "6. EVALUATION AND RECOMMENDATION"; ?>
						<?php echo form_textarea($evalReco); ?>
						<?php echo form_error($evalReco['name']); ?><?php echo isset($errors[$evalReco['name']])?$errors[$evalReco['name']]:''; ?>

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