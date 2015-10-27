<?php
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




?>


<main >

 <div class="container">
    <div id="loginsize">
     	<?php echo form_open("auth/update_lab"); ?>
      	<fieldset class="z-depth-2">
        	<center><h5 class="bold">Laboratory Tests</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<?php echo form_hidden('client_id', $client_id);
				?>
           	</br>

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
           			<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Next</button>
           	 	</div>
			</div>
        </fieldset>
               		<?php echo form_close(); ?>
    </div>
</div>
</main>