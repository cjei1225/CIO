<?php

$illAge = array(
	'name'	=> 'illAge[]',
	'id'	=> 'illAge',
	'value'	=> set_value('illAge'),
);
$illName = array(
	'name'	=> 'illName[]',
	'id'	=> 'illName',
	'value'	=> set_value('illName'),
);
$illMed = array(
	'name'	=> 'illMed[]',
	'id'	=> 'illMed',
	'value'	=> set_value('illMed'),
);

$illActive = array(
	'name'	=> 'illActive',
	'id'	=> 'illActive',
	'value'	=> set_value('illActive'),
);

$illCompli = array(
	'name'	=> 'illCompli',
	'id'	=> 'illCompli',
	'value'	=> set_value('illCompli'),
);

$illAccident = array(
	'name'	=> 'illAccident',
	'id'	=> 'illAccident',
	'value'	=> set_value('illAccident'),
);


				
?>
<main >

 <div class="container">
    <div id="loginsize">
     	<?php echo form_open("auth/update_illness"); ?>
      	<fieldset class="z-depth-2">
        	<center><h5 class="bold">Illnesses</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<?php echo form_hidden('client_id', $client_id);
				?>
           		</br>

				<table class="centered" >
					<thead>
						<tr>
							<th data-field="illDate">Date</th>
							<th data-field="illAge">Age</th>
							<th data-field="illName">Illness</th>
							<th data-field="illMed">Medication</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" name="illDate[]" class="datepicker"></td>
							<td><?php echo form_input($illAge); ?></td>
							<td><?php echo form_input($illName); ?></td>
							<td><?php echo form_input($illMed); ?></td>
						</tr>
						<tr>
							<td><input type="text" name="illDate[]" class="datepicker"></td>
							<td><?php echo form_input($illAge); ?></td>
							<td><?php echo form_input($illName); ?></td>
							<td><?php echo form_input($illMed); ?></td>
						</tr>

						<tr>
							<td><input type="text" name="illDate[]" class="datepicker"></td>
							<td><?php echo form_input($illAge); ?></td>
							<td><?php echo form_input($illName); ?></td>
							<td><?php echo form_input($illMed); ?></td>
						</tr>

						<tr>
							<td><input type="text" name="illDate[]" class="datepicker"></td>
							<td><?php echo form_input($illAge); ?></td>
							<td><?php echo form_input($illName); ?></td>
							<td><?php echo form_input($illMed); ?></td>
						</tr>

						<tr>
							<td><input type="text" name="illDate[]" class="datepicker"></td>
							<td><?php echo form_input($illAge); ?></td>
							<td><?php echo form_input($illName); ?></td>
							<td><?php echo form_input($illMed); ?></td>
						</tr>

					</tbody>
				</table>

				<?php echo form_label('Describe in detail if active now', $illActive['id']); ?>
				<?php echo form_input($illActive); ?>
				<?php echo form_label('If complications are present, please describe', $illCompli['id']); ?>
				<?php echo form_input($illCompli); ?>
				<?php echo form_label('Accidents, injuries or surgeries (date, description, effects)', $illAccident['id']); ?>
				<?php echo form_input($illAccident); ?>
				
				<div>
           			<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Next</button>
           	 	</div>
			</div>
        </fieldset>
               		<?php echo form_close(); ?>
    </div>
</div>
</main>