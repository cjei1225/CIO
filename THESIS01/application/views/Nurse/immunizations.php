<?php
$immunization = array(
	'name'	=> 'immunization[]',
	'id'	=> 'immunization',
	'value'	=> set_value('immunization'),
);

$immunization_date = array(
	'name'	=> 'immunization_date[]',
	'id'	=> 'immunization_date',
	'value'	=> set_value('immunization_date'),
);

$immunization_physician = array(
	'name'	=> 'immunization_physician[]',
	'id'	=> 'immunization_physician',
	'value'	=> set_value('immunization_physician'),
);

foreach($client_info as $row_info) 
{
	$client_id      = $row_info->client_id;
	$fname   = $row_info->client_fname;
	$mname  = $row_info->client_mname;
	$lname   = $row_info->client_lname;
	$gender         = $row_info->gender;
	$sw_id          = $row_info->sw_id;
	$mname  = $row_info->client_mname;
	$admitDate = $row_info->created;
	$sector = $row_info->client_sector;
    $birthday       = $row_info->birthday;
    $d_name        = $row_info->d_name;
    $religion       = $row_info->religion;
    $client_status   = $row_info->client_status;

}


function ageCalculator($birthday){
  if(!empty($birthday)){
    $birthdate = new DateTime($birthday);
    $today   = new DateTime(date("Y/m/d"));
    $age = $birthdate->diff($today)->y;
    return $age;
  }else{
    return 0;
  }
}
$age = ageCalculator($birthday);


?>
<main >

 <div class="container">
     <div class="row">
	   	    <div class="col s3">
            <ul class="menu">
                <li><a href="#" ><span>Step 1: Measurement </span></a></li>
                <li><a href="#" ><span>Step 2: Present Condition</span></a></li>
                <li><a href="#" ><span>Step 3: Birth Information</span></a></li>
                <li><a href="#" class="active"><span>Step 4: Immunization</span></a></li>
            </ul>
        </div>

        <div class="col s9">
	        <fieldset class="z-depth-1">
	          <center>
	            <h5 class="bold">Client Information</h5>
	          </center>
	          <h5 class="divider black"></h5>
	          <div class="form-group">
	            <img src="<?php echo base_url(); ?>materialize/title logo.png" class="right"> 
	            <label >Name: <?php echo $fname." ".$mname." ".$lname; ?> </label>
	            <br>
	            <label>Age: <?php echo $age; ?></label>
	            <br>
	            <label >Gender: <?php if ($gender == 1){echo "Male";}
	            elseif($gender == 2){echo "Female";} ?></label>
	            <br>
	            <label >Date of Birth: <?php echo date('M-d-Y',strtotime($birthday)); ?></label>
	            <br>
	            <label >Dorm: <?php echo $d_name; ?></label>
	            <br> 
	            <label >Sector: <?php if ($sector == 1){echo "Child and Youth";}
	            elseif($sector == 2){echo "Older Person";}
	            elseif($sector == 3){echo "Person with Special Needs";} 
	            elseif($sector == 4){echo "Person in Crisis Situation";}?></label>
	            <br>     
	            <label >Religion: <?php echo $religion; ?></label>                
	         
	    </div>
	   
     	<?php echo form_open("auth/insert_immunizations"); ?>
     
        	<center><h5 class="bold">IMMUNIZATIONS</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<?php echo form_hidden('client_id', $client_id); ?>

				<table class="centered" id="myTable" >
					<thead>
						<tr>
							<th data-field="immu">Immunization</th>
							<th data-field="date">Date</th>
							<th data-field="physi">Physician</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select name="Immunization[]" class="browser-default">
				                    <option value="" disabled selected>Immunization</option>
				                    <option value="BCG">BCG</option>
				                    <option value="DPT1">DPT1</option>
				                    <option value="DPT2">DPT2</option>
				                    <option value="DPT BOOSTER">DPT BOOSTER</option>
				                    <option value="OPV1">OPV1</option>
				                    <option value="OPV2">OPV2</option>
				                    <option value="OPV3">OPV3</option>
				                    <option value="OPV BOOSTER">OPV BOOSTER</option>
				                    <option value="MEASLES">MEASLES</option>
				                    <option value="MMR">MMR</option>
				                    <option value="HIB 1">HIB 1</option>
				                    <option value="HIB 2">HIB 2</option>
				                    <option value="HIB 3">HIB 3</option>
				                    <option value="HIB BOOSTER">HIB BOOSTER</option>
				                    <option value="HEPA B1">HEPA B1</option>
				                    <option value="HEPA B2">HEPA B2</option>
				                    <option value="HEPA B3">HEPA B3</option>
				                    <option value="HEPA B BOOSTER">HEPA B BOOSTER</option>
				                </select>
				            </td>
							<td><input type="text" name="immunization_date[]" class="datepicker"></td>
							<td><?php echo form_input($immunization_physician); ?></td>
						</tr>
						<tr>
							<td>
								<select name="Immunization[]" class="browser-default">
				                    <option value="" disabled selected>Immunization</option>
				                    <option value="BCG">BCG</option>
				                    <option value="DPT1">DPT1</option>
				                    <option value="DPT2">DPT2</option>
				                    <option value="DPT BOOSTER">DPT BOOSTER</option>
				                    <option value="OPV1">OPV1</option>
				                    <option value="OPV2">OPV2</option>
				                    <option value="OPV3">OPV3</option>
				                    <option value="OPV BOOSTER">OPV BOOSTER</option>
				                    <option value="MEASLES">MEASLES</option>
				                    <option value="MMR">MMR</option>
				                    <option value="HIB 1">HIB 1</option>
				                    <option value="HIB 2">HIB 2</option>
				                    <option value="HIB 3">HIB 3</option>
				                    <option value="HIB BOOSTER">HIB BOOSTER</option>
				                    <option value="HEPA B1">HEPA B1</option>
				                    <option value="HEPA B2">HEPA B2</option>
				                    <option value="HEPA B3">HEPA B3</option>
				                    <option value="HEPA B BOOSTER">HEPA B BOOSTER</option>
				                </select>
				            </td>
							<td><input type="text" name="immunization_date[]" class="datepicker"></td>
							<td><?php echo form_input($immunization_physician); ?></td>
						</tr>
						<tr>
							<td>
								<select name="Immunization[]" class="browser-default">
				                    <option value="" disabled selected>Immunization</option>
				                    <option value="BCG">BCG</option>
				                    <option value="DPT1">DPT1</option>
				                    <option value="DPT2">DPT2</option>
				                    <option value="DPT BOOSTER">DPT BOOSTER</option>
				                    <option value="OPV1">OPV1</option>
				                    <option value="OPV2">OPV2</option>
				                    <option value="OPV3">OPV3</option>
				                    <option value="OPV BOOSTER">OPV BOOSTER</option>
				                    <option value="MEASLES">MEASLES</option>
				                    <option value="MMR">MMR</option>
				                    <option value="HIB 1">HIB 1</option>
				                    <option value="HIB 2">HIB 2</option>
				                    <option value="HIB 3">HIB 3</option>
				                    <option value="HIB BOOSTER">HIB BOOSTER</option>
				                    <option value="HEPA B1">HEPA B1</option>
				                    <option value="HEPA B2">HEPA B2</option>
				                    <option value="HEPA B3">HEPA B3</option>
				                    <option value="HEPA B BOOSTER">HEPA B BOOSTER</option>
				                </select>
				            </td>
							<td><input type="text" name="immunization_date[]" class="datepicker"></td>
							<td><?php echo form_input($immunization_physician); ?></td>
						</tr>
						<tr>
							<td>
								<select name="Immunization[]" class="browser-default">
				                    <option value="" disabled selected>Immunization</option>
				                    <option value="BCG">BCG</option>
				                    <option value="DPT1">DPT1</option>
				                    <option value="DPT2">DPT2</option>
				                    <option value="DPT BOOSTER">DPT BOOSTER</option>
				                    <option value="OPV1">OPV1</option>
				                    <option value="OPV2">OPV2</option>
				                    <option value="OPV3">OPV3</option>
				                    <option value="OPV BOOSTER">OPV BOOSTER</option>
				                    <option value="MEASLES">MEASLES</option>
				                    <option value="MMR">MMR</option>
				                    <option value="HIB 1">HIB 1</option>
				                    <option value="HIB 2">HIB 2</option>
				                    <option value="HIB 3">HIB 3</option>
				                    <option value="HIB BOOSTER">HIB BOOSTER</option>
				                    <option value="HEPA B1">HEPA B1</option>
				                    <option value="HEPA B2">HEPA B2</option>
				                    <option value="HEPA B3">HEPA B3</option>
				                    <option value="HEPA B BOOSTER">HEPA B BOOSTER</option>
				                </select>
				            </td>
							<td><input type="text" name="immunization_date[]" class="datepicker"></td>
							<td><?php echo form_input($immunization_physician); ?></td>
						</tr>
						<tr>
							<td>
								<select name="Immunization[]" class="browser-default">
				                    <option value="" disabled selected>Immunization</option>
				                    <option value="BCG">BCG</option>
				                    <option value="DPT1">DPT1</option>
				                    <option value="DPT2">DPT2</option>
				                    <option value="DPT BOOSTER">DPT BOOSTER</option>
				                    <option value="OPV1">OPV1</option>
				                    <option value="OPV2">OPV2</option>
				                    <option value="OPV3">OPV3</option>
				                    <option value="OPV BOOSTER">OPV BOOSTER</option>
				                    <option value="MEASLES">MEASLES</option>
				                    <option value="MMR">MMR</option>
				                    <option value="HIB 1">HIB 1</option>
				                    <option value="HIB 2">HIB 2</option>
				                    <option value="HIB 3">HIB 3</option>
				                    <option value="HIB BOOSTER">HIB BOOSTER</option>
				                    <option value="HEPA B1">HEPA B1</option>
				                    <option value="HEPA B2">HEPA B2</option>
				                    <option value="HEPA B3">HEPA B3</option>
				                    <option value="HEPA B BOOSTER">HEPA B BOOSTER</option>
				                </select>
				            </td>
							<td><input type="text" name="immunization_date[]" class="datepicker"></td>
							<td><?php echo form_input($immunization_physician); ?></td>
						</tr>
					
						
					</tbody>
				</table>
				
				<div>
           			<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>                      
           			<a href="#"  class="btn  waves-effect btn-md  blue z-depth-2 " id="sizebutton" onClick="myFunction()"> Add Row</a>
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
    td1.innerHTML = "<select name=\"Immunization[]\" class=\"browser-default\"><option value=\"\" disabled selected>Immunization</option><option value=\"BCG\">BCG</option><option value=\"DPT1\">DPT1</option><option value=\"DPT2\">DPT2</option><option value=\"DPT BOOSTER\">DPT BOOSTER</option><option value=\"OPV1\">OPV1</option><option value=\"OPV2\">OPV2</option><option value=\"OPV3\">OPV3</option><option value=\"OPV BOOSTER\">OPV BOOSTER</option><option value=\"MEASLES\">MEASLES</option><option value=\"MMR\">MMR</option><option value=\"HIB 1\">HIB 1</option><option value=\"HIB 2\">HIB 2</option><option value=\"HIB 3\">HIB 3</option><option value=\"HIB BOOSTER\">HIB BOOSTER</option><option value=\"HEPA B1\">HEPA B1</option><option value=\"HEPA B2\">HEPA B2</option><option value=\"HEPA B3\">HEPA B3</option><option value=\"HEPA B BOOSTER\">HEPA B BOOSTER</option></select>";
    td2.innerHTML = "<input type=\"text\" name=\"immunization_date[]\" class=\"datepicker\">";
    td3.innerHTML = "<input type=\"text\" name=\"immunization_physician\">";
   row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);

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