<?php
$illDate = array(
    'name'  => 'illDate[]',
    'id'    => 'illDate',
    'value' => set_value('illDate'),
);
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
$misDate = array(
    'name'  => 'misDate[]',
    'id'    => 'misDate',
    'value' => set_value('misDate'),
);
$misDesc = array(
    'name'  => 'misDesc[]',
    'id'    => 'misDesc',
    'value' => set_value('misDesc'),
);
$misEff = array(
    'name'  => 'misEff[]',
    'id'    => 'misEff',
    'value' => set_value('misEff'),
);
$misClass = array(
    'name'  => 'misClass[]',
    'id'    => 'misClass',
    'value' => set_value('misClass'),
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

	        <?php foreach($ill_info as $info){ 

              $created = date('M-d-Y',strtotime($info->created));
              $ill_date = $info->ill_date;
              $ill_age = $info->ill_age;
              $ill_name = $info->ill_name;
              $ill_med = $info->ill_med;
           
            }
                if($ill_info == null){
                $created = "No data";
                $ill_date = "No data";
                $ill_age = "No data";
                $ill_name = "No data";
                $ill_med = "No data";
               
                }

            ?>
            <?php foreach($ill_bg_info as $info){ 

              $created = date('M-d-Y',strtotime($info->created));
              $ill_active = $info->ill_active;
              $ill_complication = $info->ill_complication;

            }
                if($ill_bg_info == null){
                $ill_active = "No data";
                $ill_complication = "No data";
                           
                }

               ?>
                 
            <center>
                <h5 class="bold">Previous Input</h5>
              </center>
              <h5 class="divider black"></h5>
              <div class="form-group">
                <div class="row">
                    <div class="col s6 ">
                        <label>Update Date: <?php echo $created; ?></label><br>
                        <label>Date: <?php echo $ill_date;  ?></label><br>
                        <label>Age: <?php echo $ill_age; ?></label><br>
                        <label>Illness: <?php echo $ill_name; ?></label><br>
                        <label>Medication: <?php echo $ill_med; ?></label><br>
                    </div>
                    <div class="col s6 ">
                        <label>Active Illness: <?php echo $ill_active; ?></label><br>
                        <label>Complication Present: <?php echo $ill_complication;  ?></label><br>
                    </div>
                </div>
              </div>
     	<?php echo form_open("auth/insert_illnesses"); ?>
      
        	<center><h5 class="bold">ILLNESSESS</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<?php echo form_hidden('client_id', $client_id);
				?>
                List of Illness<br>
				<table class="centered " id="myTable">
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
                <a href="#"  class="btn  waves-effect btn-md  blue z-depth-2 " id="sizebutton" onClick="myFunction()"> Add Row</a><br>
                <div class="input-field col s6 ">
				<?php echo form_label('Describe in detail if active now', $illActive['id']); ?>
				<?php echo form_input($illActive); ?>
                </div>
                <div class="input-field col s6 ">
				<?php echo form_label('If complications are present, please describe', $illCompli['id']); ?>
				<?php echo form_input($illCompli); ?>
				</div>
                List of Mishaps<br>
                <table class="centered " id="mishap_table">
                    <thead>
                        <tr>
                            <th data-field="misDate">Date</th>
                            <th data-field="misAge">Description</th>
                            <th data-field="misName">Effects</th>
                            <th data-field="misMed">Classification</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="misDate[]" class="datepicker"></td>
                            <td><?php echo form_input($misDesc); ?></td>
                            <td><?php echo form_input($misEff); ?></td>
                            <td><select name="misClass[]" class="browser-default">
                                    <option value="" disabled selected>Classification</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Injury">Injury</option>
                                    <option value="Surgery">Surgery</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="misDate[]" class="datepicker"></td>
                            <td><?php echo form_input($misDesc); ?></td>
                            <td><?php echo form_input($misEff); ?></td>
                            <td><select name="misClass[]" class="browser-default">
                                    <option value="" disabled selected>Classification</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Injury">Injury</option>
                                    <option value="Surgery">Surgery</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="misDate[]" class="datepicker"></td>
                            <td><?php echo form_input($misDesc); ?></td>
                            <td><?php echo form_input($misEff); ?></td>
                            <td><select name="misClass[]" class="browser-default">
                                    <option value="" disabled selected>Classification</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Injury">Injury</option>
                                    <option value="Surgery">Surgery</option>
                                </select>
                            </td>
                        </tr>

                    </tbody>
                </table>
                

				<div>
                    <a href="#"  class="btn  waves-effect btn-md  blue z-depth-2 " id="sizebutton" onClick="mishap_function()"> Add Row</a>
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
    td1.innerHTML = "<input type=\"text\" name=\"illDate[]\" class=\"datepicker\">";
    td2.innerHTML = "<input type=\"text\" name=\"illAge[]\" >";
    td3.innerHTML = "<input type=\"text\" name=\"illName[]\">";
    td4.innerHTML = "<input type=\"text\" name=\"illMed[]\">";
   row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);
    row.appendChild(td4);


}


function mishap_function() {
   var tableRef = document.getElementById('mishap_table').getElementsByTagName('tbody')[0];
   var row   = tableRef.insertRow(tableRef.rows.length);
    var td1 = row.insertCell(0);
    var td2 = row.insertCell(1);
    var td3 = row.insertCell(2);
    var td4 = row.insertCell(3);
    td1.innerHTML = "<input type=\"text\" name=\"misDate[]\" class=\"datepicker\">";
    td2.innerHTML = "<input type=\"text\" name=\"misDesc[]\" >";
    td3.innerHTML = "<input type=\"text\" name=\"misEff[]\">";
    td4.innerHTML = "<select name=\"misClass[]\" class=\"browser-default\"><option value=\"\" disabled selected>Classification</option><option value=\"Accident\">Accident</option><option value=\"Injury\">Injury</option><option value=\"Surgery\">Surgery</option></select>";
    
    row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);
    row.appendChild(td4);

}
</script>