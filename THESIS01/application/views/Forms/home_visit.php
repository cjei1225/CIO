<?php

$response = array(
	'name'	=> 'response',
	'id'	=> 'response',
	'value'	=> set_value('response'),
);

$visitDate = array(
	'name'	=> 'visitDate',
	'id'	=> 'visitDate',
	'value'	=> set_value('visitDate'),
	'placeholder' => 'yyyy/mm/dd',
);

$visitPlace = array(
	'name'	=> 'visitPlace',
	'id'	=> 'visitPlace',
	'value'	=> set_value('visitPlace'),
);

$obj = array(
	'name'	=> 'obj',
	'id'	=> 'obj',
	'value' => set_value('obj'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$narra = array(
	'name'	=> 'narra',
	'id'	=> 'narra',
	'value' => set_value('narra'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$assess = array(
	'name'	=> 'assess',
	'id'	=> 'assess',
	'value' => set_value('assess'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>

<main >

 <div class="container">
    <div class="row">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');?>
		 <div class="col s10">
              <fieldset class="z-depth-2">
                  <center>
                    <h5 class="bold">Client</h5>
                  </center>
                  <h5 class="divider black"></h5>
                    <div class="form-group">
            <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info.php'); ?> 
                      <br>

                     	<?php echo form_open("auth/home_visit_report"); ?>

                        	<center><h5 class="bold">HOME VISIT FEEDBACK REPORT</h5></center>
                            <h5 class="divider black"></h5>
                           	<div class="form-group">
                           		
                				<?php echo form_hidden('client_id', $client_id); ?>
                				<?php echo form_label('Re', $response['id']); ?>
                				<?php echo form_input($response);?>
                				<?php echo form_label('Date of Visit', $visitDate['id']); ?>
                				<input type="date" name="visitDate" class="datepicker">
                        
                				<?php echo form_label('Place of Visit', $visitPlace['id']); ?>
                				<?php echo form_input($visitPlace);?>
                				<?php echo form_label('Objective', $obj['id']); ?>
                				<?php echo form_textarea($obj);?>
                				<?php echo form_label('Narrative', $narra['id']); ?>
                				<?php echo form_textarea($narra);?>
                				<?php echo form_label('Assessment', $assess['id']); ?>
                				<?php echo form_textarea($assess);?>



			<div>
           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
            </div>
            </fieldset>
               		<?php echo form_close(); ?>
               	</div>
        </div>
    </div>
</main>
