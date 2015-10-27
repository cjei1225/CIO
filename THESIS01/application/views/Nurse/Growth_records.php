<?php

$yearMonth = array(
	'name'	=> 'yearMonth[]',
	'id'	=> 'yearMonth',
	'value'	=> set_value('yearMonth'),
);

$ageMonth = array(
	'name'	=> 'ageMonth[]',
	'id'	=> 'ageMonth',
	'value'	=> set_value('ageMonth'),
);

$weightKilos = array(
	'name'	=> 'weightKilos[]',
	'id'	=> 'weightKilos',
	'value'	=> set_value('weightKilos'),
);

$lengthHeight = array(
	'name'	=> 'lengthHeight[]',
	'id'	=> 'lengthHeight',
	'value'	=> set_value('lengthHeight'),
);

$HCcm = array(
	'name'	=> 'HCcm[]',
	'id'	=> 'HCcm',
	'value'	=> set_value('HCcm'),
);

$CCcm = array(
	'name'	=> 'CCcm[]',
	'id'	=> 'CCcm',
	'value'	=> set_value('CCcm'),
);

$teeth = array(
	'name'	=> 'teeth[]',
	'id'	=> 'teeth',
	'value'	=> set_value('teeth'),
);

$body_part = array(
	'name'	=> 'body_part[]',
	'id'	=> 'body_part',
	'value'	=> set_value('body_part'),
);

$observation = array(
	'name'	=> 'observation[]',
	'id'	=> 'observation',
	'value'	=> set_value('observation'),
);

include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/General/Client_data.php');

?>


<main >

	<div class="container">
	    <div class="row">
	    <?php include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/Nurse/side_bar_custody.php'); ?>
        <div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/General/Client_info_nurse.php'); ?>

	       	  <?php foreach($growth_info as $info){ 

	       	  $created = date('M-d-Y',strtotime($info->created));
	       	  $year_month = $info->year_month;
	       	  $age_month = $info->age_month;
	       	  $weight_kilos = $info->weight_kilos;
	       	  $length_height = $info->length_height;
	       	  $HC_cm = $info->HC_cm;
	       	  $CC_cm = $info->CC_cm;
	       	  $teeth = $info->year_month;
			}
				if($growth_info == null){
		       	$created = "No data yet";
				$year_month = "No data yet";
				$age_month = "No data yet";
				$weight_kilos = "No data yet";
				$length_height = "No data yet";
				$HC_cm = "No data yet";
				$CC_cm = "No data yet";
				$teeth = "No data yet";
				}

			   ?>

			   
	          <center>
	            <h5 class="bold">Previous Input</h5>
	          </center>
	          <h5 class="divider black"></h5>
	          <div class="form-group">
	          	<div class="row">
		          	<div class="col s6">
			            <label >Update Date: <?php echo $created; ?> </label>
			            <br>
			            <label >Year / Month: <?php echo $year_month; ?></label>
			            <br> 
						<label >Age in Months: <?php echo $age_month; ?></label>
			            <br> 
						<label >Weight: <?php echo $weight_kilos; ?></label>
			            <br> 
			            <label >Length/Height: <?php echo $length_height; ?></label>
			            <br> 
			            <label>HC: <?php echo $HC_cm; ?></label>
			            <br>
			            <label>CC: <?php echo $CC_cm; ?></label>
			            <br>
						<label>Teeth: <?php echo $teeth; ?></label>
		            </div>
	            </div> 
	          
					

	          </div>
		     	<?php echo form_open("auth/impairment_submit"); ?>
		      	
		        	<center><h5 class="bold">GROWTH RECORDS</h5></center>
		            <h5 class="divider black"></h5>
		           	<div class="form-group">
		           		<?php echo form_hidden('client_id', $client_id);
						?>
					<table class="centered" id="myTable">
					<thead>
						<tr>
							<th data-field="yearMonth">Year / Month</th>
							<th data-field="ageMonth">Age in Months</th>
							<th data-field="weightKilos">Weight (kilos)</th>
							<th data-field="lengthHeight">Length/Height (cm/feet)</th>
							<th data-field="HCcm">HC (cm)</th>
							<th data-field="CCcm">CC (cm)</th>
							<th data-field="teeth">Teeth</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo form_input($yearMonth); ?></td>
							<td><?php echo form_input($ageMonth); ?></td>
							<td><?php echo form_input($weightKilos); ?></td>
							<td><?php echo form_input($lengthHeight); ?></td>
							<td><?php echo form_input($HCcm); ?></td>
							<td><?php echo form_input($CCcm); ?></td>
							<td><?php echo form_input($teeth); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($yearMonth); ?></td>
							<td><?php echo form_input($ageMonth); ?></td>
							<td><?php echo form_input($weightKilos); ?></td>
							<td><?php echo form_input($lengthHeight); ?></td>
							<td><?php echo form_input($HCcm); ?></td>
							<td><?php echo form_input($CCcm); ?></td>
							<td><?php echo form_input($teeth); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($yearMonth); ?></td>
							<td><?php echo form_input($ageMonth); ?></td>
							<td><?php echo form_input($weightKilos); ?></td>
							<td><?php echo form_input($lengthHeight); ?></td>
							<td><?php echo form_input($HCcm); ?></td>
							<td><?php echo form_input($CCcm); ?></td>
							<td><?php echo form_input($teeth); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($yearMonth); ?></td>
							<td><?php echo form_input($ageMonth); ?></td>
							<td><?php echo form_input($weightKilos); ?></td>
							<td><?php echo form_input($lengthHeight); ?></td>
							<td><?php echo form_input($HCcm); ?></td>
							<td><?php echo form_input($CCcm); ?></td>
							<td><?php echo form_input($teeth); ?></td>
						</tr>

					</tbody>
				</table>
				<div>
				<a href="#"  class="btn  waves-effect btn-md  blue z-depth-2 " id="sizebutton" onClick="myFunction()"> Add Row</a>
				</div>
						

						<?php echo "Is there any evidence of disease, impairment or abnormality of:"; ?><br>

						<table class="left">
							<thead>
								<tr>
									<th data-field="blank"> </th>
									<th data-field="obser">Observation/s</th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<select name="body_part" class="browser-default">
					                    <option value="" disabled selected>Body Part</option>
					                    <option value="Head">Head</option>
					                    <option value="Eyes">Eyes</option>
					                    <option value="Nose">Nose</option>
					                    <option value="Ears">Ears</option>
					                    <option value="Mouth and Throat">Mouth and Throat</option>
					                    <option value="Neck">Neck</option>
					                    <option value="Chest">Chest</option>
					                    <option value="Abdomen">Abdomen</option>
					                    <option value="Genitalia">Genitalia</option>
					                    <option value="Spinal Column">Spinal Column</option>
					                    <option value="Extremities">Extremities</option>
					                    <option value="Pulse">Pulse</option>
					                    <option value="Blood">Blood</option>
					                    <option value="Nervous System">Nervous System</option>
					                    <option value="Respiration">Respiration</option>
					                    <option value="Skin">Skin</option>
					                	</select>
					                </td>
									<td><?php echo form_input($observation); ?></td>
								</tr>
								<tr>
									<td>
										<select name="body_part" class="browser-default">
					                    <option value="" disabled selected>Body Part</option>
					                    <option value="Head">Head</option>
					                    <option value="Eyes">Eyes</option>
					                    <option value="Nose">Nose</option>
					                    <option value="Ears">Ears</option>
					                    <option value="Mouth and Throat">Mouth and Throat</option>
					                    <option value="Neck">Neck</option>
					                    <option value="Chest">Chest</option>
					                    <option value="Abdomen">Abdomen</option>
					                    <option value="Genitalia">Genitalia</option>
					                    <option value="Spinal Column">Spinal Column</option>
					                    <option value="Extremities">Extremities</option>
					                    <option value="Pulse">Pulse</option>
					                    <option value="Blood">Blood</option>
					                    <option value="Nervous System">Nervous System</option>
					                    <option value="Respiration">Respiration</option>
					                    <option value="Skin">Skin</option>
					                	</select>
					                </td>
									<td><?php echo form_input($observation); ?></td>
								</tr>
								<tr>
									<td>
										<select name="body_part" class="browser-default">
					                    <option value="" disabled selected>Body Part</option>
					                    <option value="Head">Head</option>
					                    <option value="Eyes">Eyes</option>
					                    <option value="Nose">Nose</option>
					                    <option value="Ears">Ears</option>
					                    <option value="Mouth and Throat">Mouth and Throat</option>
					                    <option value="Neck">Neck</option>
					                    <option value="Chest">Chest</option>
					                    <option value="Abdomen">Abdomen</option>
					                    <option value="Genitalia">Genitalia</option>
					                    <option value="Spinal Column">Spinal Column</option>
					                    <option value="Extremities">Extremities</option>
					                    <option value="Pulse">Pulse</option>
					                    <option value="Blood">Blood</option>
					                    <option value="Nervous System">Nervous System</option>
					                    <option value="Respiration">Respiration</option>
					                    <option value="Skin">Skin</option>
					                	</select>
					                </td>
									<td><?php echo form_input($observation); ?></td>
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

<script>
function myFunction() {
   var tableRef = document.getElementById('myTable').getElementsByTagName('tbody')[0];
   var row   = tableRef.insertRow(tableRef.rows.length);
    var td1 = row.insertCell(0);
    var td2 = row.insertCell(1);
    var td3 = row.insertCell(2);
    var td4 = row.insertCell(3);
    var td5 = row.insertCell(4);
    var td6 = row.insertCell(5);
    var td7 = row.insertCell(6);
    td1.innerHTML = "<input type=\"text\" name=\"yearMonth[]\" >";
    td2.innerHTML = "<input type=\"text\" name=\"ageMonth[]\" >";
    td3.innerHTML = "<input type=\"text\" name=\"weightKilos[]\">";
    td4.innerHTML = "<input type=\"text\" name=\"lengthHeight[]\">";
    td5.innerHTML = "<input type=\"text\" name=\"HCcm[]\">";
    td6.innerHTML = "<input type=\"text\" name=\"CCcm[]\">";
    td7.innerHTML = "<input type=\"text\" name=\"teeth[]\">";
   row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);
    row.appendChild(td4);
    row.appendChild(td5);
    row.appendChild(td6);
    row.appendChild(td7);


    // Append a text node to the cell
/*var newText1  = document.createTextNode('New row')
td1.appendChild(newText1);
    var newText2  = document.createTextNode('New row')
td2.appendChild(newText2);
var newText3  = document.createTextNode('New row')
td3.appendChild(newText3);
    var newText4  = document.createTextNode('New row')
td4.appendChild(newText4);
var newText5  = document.createTextNode('New row')
td5.appendChild(newText5);
*/
}
</script>