<?php

$bloodP = array(
	'name'	=> 'bloodP',
	'id'	=> 'bloodP',
	'value'	=> set_value('bloodP'),
);

$pulseRate = array(
	'name'	=> 'pulseRate',
	'id'	=> 'pulseRate',
	'value'	=> set_value('pulseRate'),
);

$height = array(
	'name'	=> 'height',
	'id'	=> 'height',
	'value'	=> set_value('height'),
);

$weight = array(
	'name'	=> 'weight',
	'id'	=> 'weight',
	'value'	=> set_value('weight'),
);

$temperature = array(
	'name'	=> 'temperature',
	'id'	=> 'temperature',
	'value'	=> set_value('temperature'),
);

$respiRate = array(
	'name'	=> 'respiRate',
	'id'	=> 'respiRate',
	'value'	=> set_value('respiRate'),
);

$headCir = array(
	'name'	=> 'headCir',
	'id'	=> 'headCir',
	'value'	=> set_value('headCir'),
);

$chestCir = array(
	'name'	=> 'chestCir',
	'id'	=> 'chestCir',
	'value'	=> set_value('chestCir'),
);

$abdoCir = array(
	'name'	=> 'abdoCir',
	'id'	=> 'abdoCir',
	'value'	=> set_value('abdoCir'),
);



include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');
?>
<main >
	 <div class="container">
	    <div class="row">
	    <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Nurse/side_bar_custody.php'); ?>
	    	<div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_info_nurse.php'); ?>
	        
	      	<?php 
	      	if($measure_info != null)
	      	{
				foreach($measure_info as $info)
				{
				    $blood_pressure = $info->blood_pressure; 
				    $pulse_rate = $info->pulse_rate;
				    $height_db = $info->height;
				    $weight_db = $info->weight; 
				    $temperature_db = $info->temperature;
				    $pulse_rate = $info->pulse_rate;
				    $respiratory_rate = $info->respiratory_rate;
				    $head_circum = $info->head_circum;
				    $chest_circum = $info->chest_circum;
				    $abdomen_circum = $info->abdomen_circum;
				}
			}
			elseif($measure_info == null)
			{
					$blood_pressure = 'null'; 
				    $pulse_rate = 'null';
				    $height_db = 'null';
				    $weight_db = 'null'; 
				    $temperature_db = 'null';
				    $pulse_rate = 'null';
				    $respiratory_rate = 'null';
				    $head_circum = 'null';
				    $chest_circum = 'null';
				    $abdomen_circum = 'null';
			}

			if ($head_circum == NULL){$head_circum = "No data yet";}
			if ($chest_circum == NULL){$chest_circum = "No data yet";}
			if ($abdomen_circum == NULL){$abdomen_circum = "No data yet";}
		
			
	      	?>
	      	
	      	
	          <center>
	            <h5 class="bold">Previous Measurement</h5>
	          </center>
	          <h5 class="divider black"></h5>
	          <div class="form-group">
	          	<div class="row">
		          	<div class="col s6">
			            <label >Blood Pressure: <?php echo $blood_pressure; ?> </label>
			            <br>
			            <label >Height: <?php echo $height_db; ?></label>
			            <br> 
						<label >Temperature: <?php echo $temperature_db; ?></label>
			            <br> 
						<label >Head Circumference: <?php echo $head_circum; ?></label>
			            <br> 
			            <label >Abdomen Circumference: <?php echo $abdomen_circum; ?></label>
			        </div>
					<div class="col s6">
			            <label>Pulse Rate/Min: <?php echo $pulse_rate; ?></label>
			            <br>
			            <label>Weight: <?php echo $weight_db; ?></label>
			            <br>
						<label>Respiratory Rate/Min: <?php echo $respiratory_rate; ?></label>
						<br>
						<label>Chest Circumference: <?php echo $chest_circum; ?></label>
		            </div>
	            </div>         
	          </div>
	       
		     	<?php echo form_open("auth/measurement_submit"); ?>
			      	
			        	<center><h5 class="bold">MEASUREMENT</h5></center>
			            <h5 class="divider black"></h5>
			           	<div class="form-group">

							<?php echo form_hidden('client_id', $client_id); ?>
							
							<div class="input-field col s6 ">
							<?php echo form_label('Blood Pressure (_/60)', $bloodP['id']); ?>
							<?php echo form_input($bloodP); ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Pulse Rate/Min', $pulseRate['id']); ?>
							<?php echo form_input($pulseRate); ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Height (cm/feet)', $height['id']); ?>
							<?php echo form_input($height); ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Weight (kg)', $weight['id']); ?>
							<?php echo form_input($weight); ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Temperature (Celsius)', $temperature['id']); ?>
							<?php echo form_input($temperature); ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Respiratory Rate/Min', $respiRate['id']); ?>
							<?php echo form_input($respiRate); ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Head Circumference (cm)', $headCir['id']); ?>
							<?php echo form_input($headCir); ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Chest Circumference (cm)', $chestCir['id']); ?>
							<?php echo form_input($chestCir); ?>
							</div>
							<div class="input-field col s6 ">
							<?php echo form_label('Abdomen Circumference (cm)', $abdoCir['id']); ?>
							<?php echo form_input($abdoCir); ?>
							</div>
							
						
							
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
