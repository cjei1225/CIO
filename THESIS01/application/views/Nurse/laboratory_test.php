<?php
$labDate = array(
    'name'  => 'labDate[]',
    'id'    => 'labDate',
    'value' => set_value('labDate'),
);

$labTest = array(
	'name'	=> 'labTest[]',
	'id'	=> 'labTest',
	'value'	=> set_value('labTest'),
);

$labResult = array(
	'name'	=> 'labResult[]',
	'id'	=> 'labResult',
	'value'	=> set_value('labResult'),
);

$labAction = array(
	'name'	=> 'labAction[]',
	'id'	=> 'labAction',
	'value'	=> set_value('labAction'),
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
	       
            <?php foreach($lab_info as $info){ 

              $created = date('M-d-Y',strtotime($info->created));
              $lab_date = $info->lab_date;
              $lab_test = $info->lab_test;
              $lab_result = $info->lab_result;
              $lab_action = $info->lab_action;
           
            }
                if($lab_info == null){
                $created = "No data";
                $lab_date = "No data";
                $lab_test = "No data";
                $lab_result = "No data";
                $lab_action = "No data";
               
                }

               ?>
            <center>
                <h5 class="bold">Previous Input</h5>
              </center>
              <h5 class="divider black"></h5>
              <div class="form-group">

                    <label>Update Date: <?php echo $created; ?></label><br>
                    <label>Date: <?php echo $lab_date;  ?></label><br>
                    <label>Laboratory Test: <?php echo $lab_test; ?></label><br>
                    <label>Results: <?php echo $lab_result; ?></label><br>
                    <label>Action Done: <?php echo $lab_action; ?></label><br>
     
              </div>
     	<?php echo form_open("auth/insert_lab_test"); ?>
      	
        	<center><h5 class="bold">LABORATORY TEST</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<?php echo form_hidden('client_id', $client_id);
				?>

				<table class="centered" >
					<thead>
						<tr>
							<th data-field="labDate">Date</th>
							<th data-field="labTest">Laboratory Test</th>
							<th data-field="labResult">Results</th>
							<th data-field="labAction">Action Done</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" name="labDate[]" class="datepicker"></td>
							<td><?php echo form_input($labTest); ?></td>
							<td><?php echo form_input($labResult); ?></td>
							<td><?php echo form_input($labAction); ?></td>
						</tr>
												<tr>
							<td><input type="text" name="labDate[]" class="datepicker"></td>
							<td><?php echo form_input($labTest); ?></td>
							<td><?php echo form_input($labResult); ?></td>
							<td><?php echo form_input($labAction); ?></td>
						</tr>
												<tr>
							<td><input type="text" name="labDate[]" class="datepicker"></td>
							<td><?php echo form_input($labTest); ?></td>
							<td><?php echo form_input($labResult); ?></td>
							<td><?php echo form_input($labAction); ?></td>
						</tr>
												<tr>
							<td><input type="text" name="labDate[]" class="datepicker"></td>
							<td><?php echo form_input($labTest); ?></td>
							<td><?php echo form_input($labResult); ?></td>
							<td><?php echo form_input($labAction); ?></td>
						</tr>
												<tr>
							<td><input type="text" name="labDate[]" class="datepicker"></td>
							<td><?php echo form_input($labTest); ?></td>
							<td><?php echo form_input($labResult); ?></td>
							<td><?php echo form_input($labAction); ?></td>
						</tr>
												<tr>
							<td><input type="text" name="labDate[]" class="datepicker"></td>
							<td><?php echo form_input($labTest); ?></td>
							<td><?php echo form_input($labResult); ?></td>
							<td><?php echo form_input($labAction); ?></td>
						</tr>
						
					</tbody>
				</table>
				
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