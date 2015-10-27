<?php 
$Remarks = array(
	'name'  => 'Remarks[]',
	'id'    => 'Remarks',
	'value' => set_value('Remarks'),
	);
$Person_responsible = array(
	'name'  => 'Person_responsible',
	'id'    => 'Person_responsible',
	'value' => set_value('Person_responsible'),
	);
$task = array(
  'name'  => 'task[]',
  'id'    => 'task',
  'value' => set_value('<?php echo $POA->task; ?>'),
  );
$start_date = array(
  'name'  => 'start_date',
  'id'    => 'start_date',
  'value' => set_value('start_date'),
  );
$end_date = array(
  'name'  => 'end_date',
  'id'    => 'end_date',
  'value' => set_value('end_date'),
  );

foreach($client_info as $row_info) 
{
  $client_id      = $row_info->client_id;
  $fname          = $row_info->client_fname;
  $lname          = $row_info->client_lname;
  $sector         = $row_info->client_sector;
  $gender         = $row_info->gender;
  $birth_place    = $row_info->birthplace;
  $dorm_id        = $row_info->dorm_id;
  $sw_id          = $row_info->sw_id;
  $birthday      = $row_info->birthday;
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
            
            <div> 

              <fieldset class="z-depth-2">
        
                <center>
                  <h6 >Social Service Department</h6>
                </center>
                <center>
                  <h6 ><b>PLAN OF ACTION</b></h6>
                  
                </center>
               
                 <h5 class="divider black"></h5>
                   <div class="form-group">
                    <center>
                    <label class="right">Date:</label>
                    <br>
                     <label class="right">Time:</label>
                    <br>
                    </center>
                     <h5 class="divider black"></h5>
                    <label><b>CLIENT:</b></label>
                    <br>

                     <label >Name:<?php echo $fname; ?></label>
                      <br>
                      <label>Age:<?php  echo $age; ?></label>
                       <br>
                       <label >Gender: <?php
                       if($gender == '1'){echo 'Male';}
                        elseif($gender == '2'){echo 'Female';} ?></label>
                       <br>
                        <label>Sector:<?php 
                        if($sector == '1'){echo 'Child and Youth';}
                        elseif($sector == '2'){echo 'Older Persons';}
                        elseif($sector == '3'){echo 'Special Needs';}
                        elseif($sector == '4'){echo 'Crisis Situation';}
                        
                        ?></label>
                       <br>

                       <label ><b> PLAN:</b></label>
                       <br>
                       <table class="table centered striped bordered hoverable"  id="myTable">
                        <thead>
                          <th>Task/ Intervention:</th>
                          <th>Person Responsible:</th>
                          <th>Time Start:</th>
                          <th>Time End:</th>
                          <th>Remark/ Status:</th>
                        </thead>
                        <tbody>
                        	<?php 
	
								echo form_hidden('client_id', $client_id);?>
                        
                      <?php foreach($POA_details as $POA)
                      {
                        ?>
                      
                        <tr>
                            <td><?php echo form_input($task); ?></td>
                            <td>
                              <select name="Person_Responsible[]" class="browser-default"> 
                                <option value="" disabled selected>Employees</option>
                                <?php
                                foreach ($employees as $row_employee)
                                {
                                echo"<option value='".$row_employee->id."'>".$row_employee->first_name.'</option>'; 
                                }
                                ?>
                              </select>
                            </td>
                            <td> <input type="date" placeholder="Start date" name="start_date[]" class="datepicker">
                                       <?php echo form_error($start_date['name']); ?><?php echo isset($errors[$start_date['name']])?$errors[$start_date['name']]:''; ?>
                            </td>
                            <td> <input type="date" placeholder="End date" name="end_date[]" class="datepicker">
                                       <?php echo form_error($end_date['name']); ?><?php echo isset($errors[$end_date['name']])?$errors[$end_date['name']]:''; ?>
                            </td>
                           <td><?php echo form_input($Remarks); ?></td>
                          </tr>
                        <?php } ?>

                        <tr>
                            <td><?php echo form_input($task); ?></td>
                            <td>
                              <select name="Person_Responsible[]" class="browser-default"> 
                                <option value="" disabled selected>Employees</option>
                                <?php
                                foreach ($employees as $row_employee)
                                {
                                echo"<option value='".$row_employee->id."'>".$row_employee->first_name.'</option>'; 
                                }
                                ?>
                              </select>
                            </td>
                            <td> <input type="date" placeholder="Start date" name="start_date[]" class="datepicker">
                                       <?php echo form_error($start_date['name']); ?><?php echo isset($errors[$start_date['name']])?$errors[$start_date['name']]:''; ?>
                            </td>
                            <td> <input type="date" placeholder="End date" name="end_date[]" class="datepicker">
                                       <?php echo form_error($end_date['name']); ?><?php echo isset($errors[$end_date['name']])?$errors[$end_date['name']]:''; ?>
                            </td>
                           <td><?php echo form_input($Remarks); ?></td>
                          </tr>
                                                  <tr>
                            <td><?php echo form_input($task); ?></td>
                            <td>
                              <select name="Person_Responsible[]" class="browser-default"> 
                                <option value="" disabled selected>Employees</option>
                                <?php
                                foreach ($employees as $row_employee)
                                {
                                echo"<option value='".$row_employee->id."'>".$row_employee->first_name.'</option>'; 
                                }
                                ?>
                              </select>
                            </td>
                            <td> <input type="date" placeholder="Start date" name="start_date[]" class="datepicker">
                                       <?php echo form_error($start_date['name']); ?><?php echo isset($errors[$start_date['name']])?$errors[$start_date['name']]:''; ?>
                            </td>
                            <td> <input type="date" placeholder="End date" name="end_date[]" class="datepicker">
                                       <?php echo form_error($end_date['name']); ?><?php echo isset($errors[$end_date['name']])?$errors[$end_date['name']]:''; ?>
                            </td>
                           <td><?php echo form_input($Remarks); ?></td>
                          </tr>
                                                  <tr>
                            <td><?php echo form_input($task); ?></td>
                            <td>
                              <select name="Person_Responsible[]" class="browser-default"> 
                                <option value="" disabled selected>Employees</option>
                                <?php
                                foreach ($employees as $row_employee)
                                {
                                echo"<option value='".$row_employee->id."'>".$row_employee->first_name.'</option>'; 
                                }
                                ?>
                              </select>
                            </td>
                            <td> <input type="date" placeholder="Start date" name="start_date[]" class="datepicker">
                                       <?php echo form_error($start_date['name']); ?><?php echo isset($errors[$start_date['name']])?$errors[$start_date['name']]:''; ?>
                            </td>
                            <td> <input type="date" placeholder="End date" name="end_date[]" class="datepicker">
                                       <?php echo form_error($end_date['name']); ?><?php echo isset($errors[$end_date['name']])?$errors[$end_date['name']]:''; ?>
                            </td>
                           <td><?php echo form_input($Remarks); ?></td>
                          </tr>
                                                  <tr>
                            <td><?php echo form_input($task); ?></td>
                            <td>
                              <select name="Person_Responsible[]" class="browser-default"> 
                                <option value="" disabled selected>Employees</option>
                                <?php
                                foreach ($employees as $row_employee)
                                {
                                echo"<option value='".$row_employee->id."'>".$row_employee->first_name.'</option>'; 
                                }
                                ?>
                              </select>
                            </td>
                            <td> <input type="date" placeholder="Start date" name="start_date[]" class="datepicker">
                                       <?php echo form_error($start_date['name']); ?><?php echo isset($errors[$start_date['name']])?$errors[$start_date['name']]:''; ?>
                            </td>
                            <td> <input type="date" placeholder="End date" name="end_date[]" class="datepicker">
                                       <?php echo form_error($end_date['name']); ?><?php echo isset($errors[$end_date['name']])?$errors[$end_date['name']]:''; ?>
                            </td>
                           <td><?php echo form_input($Remarks); ?></td>
                          </tr>
                        </tbody>

                      </table>
                      <br>
                      
                      
                   </div>
                    <div ALIGN="right">
                      </br>
                      <a href="#"  class="btn  waves-effect btn-md  blue z-depth-2 " id="sizebutton" onClick="myFunction()"> Add Row</a>
                      <a href="#" class="btn  waves-effect btn-md  red z-depth-2 " id="sizebutton">Decline</a>
                      <button type="submit" value="view" class="btn  waves-effect btn-md  green z-depth-2">Accept</button>
                    </div>
                   </fieldset>
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
    td1.innerHTML = "<input class=\"form-control\"  type=\"text\" >";
    td2.innerHTML = "<select name=\"Employee\" class=\"browser-default\">  <option value=\"\" disabled selected>Employees</option> <?php foreach ($employees as $row_employee) { echo '<option value='.$row_employee->id.'>'.$row_employee->first_name.'</option>';  } ?>  </select>";
    td3.innerHTML = "<input type='date' placeholder='Start date' name='start_date' class='datepicker'><?php echo form_error($start_date['name']); ?><?php echo isset($errors[$start_date['name']])?$errors[$start_date['name']]:''; ?>";
    td4.innerHTML = "<input type=\"date\" placeholder=\"End date\" name=\"end_date\" class=\"datepicker\"> <?php echo form_error($end_date['name']); ?><?php echo isset($errors[$end_date['name']])?$errors[$end_date['name']]:''; ?>";
    td5.innerHTML = "<input class=\"form-control\"  type=\"text\" > ";
   row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);
    row.appendChild(td4);
    row.appendChild(td5);
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