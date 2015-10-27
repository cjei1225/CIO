<?php

$presentApp = array(
	'name'	=> 'presentApp',
	'id'	=> 'presentApp',
	'value' => set_value('presentApp'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$marksPhy = array(
        'name'  => 'marksPhy',
        'id'    => 'marksPhy',
        'value' => set_value('marksPhy'),
        'rows'  => '5',
        'cols'  => '150',
        'class' => 'materialize-textarea',
);

$hairColor = array(
    'name'  => 'hairColor',
    'id'    => 'hairColor',
    'value' => set_value('hairColor'),
);

$eyeColor = array(
    'name'  => 'eyeColor',
    'id'    => 'eyeColor',
    'value' => set_value('eyeColor'),
);

$skinColor = array(
    'name'  => 'skinColor',
    'id'    => 'skinColor',
    'value' => set_value('skinColor'),
);

include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>

<main >
	 <div class="container">
	    <div class="row">
	    <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/Nurse/side_bar_custody.php'); ?>
        <div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info_nurse.php'); ?>
	       
	      	
	      	<?php 

			foreach($app_info as $info){
			    $present_app = $info->present_app; 
			    $admission_app = $info->admission_app;
                $marks_physical = $info->marks_physical;
                $hair_color = $info->hair_color;
                $eye_color = $info->eye_color;
                $skin_color = $info->skin_color;

			}
			if($app_info == null)
			{
				$present_app = "No data";
	            $marks_physical = "No data";
	            $admission_app = "No data";
	        	$hair_color = "No data";
	    	 	$eye_color = "No data";
		 	 	$skin_color = "No data";
	 	 	}
			
	      	?>
	      	
	      	
	          <center>
	            <h5 class="bold">Previous Input</h5>
	          </center>
	          <h5 class="divider black"></h5>
	          <div class="form-group">
	          	<div class="row">
		          	<div class="col s6">
			            <label >Present Appearance: <?php echo $present_app; ?> </label><br>
                        <label >Distinguishing Marks: <?php echo $marks_physical; ?> </label><br>
                        <label>Eye Color: <?php echo $eye_color; ?></label>
			        </div>
					<div class="col s6">
			            <label>Appearance of the client (admission): <?php echo $admission_app; ?></label><br>
                        <label>Hair Color: <?php echo $hair_color; ?></label><br>
                        <label>Skin Color: <?php echo $skin_color; ?></label>
		            </div>
	            </div>         
	          </div>
	        
	      	
	    	
		     	<?php echo form_open("auth/p_condition_submit"); ?>
		      	
		        	<center><h5 class="bold">PHYSICAL DESCRIPTION AND CONDITION</h5></center>
		            <h5 class="divider black"></h5>
		           	<div class="form-group">
		           		<?php echo form_hidden('client_id', $client_id);
						?>

						<?php echo form_label('Describe present appearance', $presentApp['id']); ?>
						<?php echo form_textarea($presentApp); ?>
						<?php echo form_error($presentApp['name']); ?><?php echo isset($errors[$presentApp['name']])?$errors[$presentApp['name']]:''; ?>

                        <?php echo form_label('Distinguishing marks or physical handicaps', $marksPhy['id']); ?>
                        <?php echo form_textarea($marksPhy); ?>
                        <?php echo form_error($marksPhy['name']); ?><?php echo isset($errors[$marksPhy['name']])?$errors[$marksPhy['name']]:''; ?>

						<div>
		           			<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
		           	 	</div>
					</div>
		        </fieldset>
               	<?php echo form_close(); ?>
	    	</div>
	    </div>
	</div>
</main>