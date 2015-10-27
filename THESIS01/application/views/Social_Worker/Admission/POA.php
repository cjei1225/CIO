<?php 
$Remarks = array(
	'name'  => 'Remarks[]',
	'id'    => 'Remarks',
	'value' => set_value('Remarks'),
	);
$Person_responsible = array(
	'name'  => 'Person_responsible[]',
	'id'    => 'Person_responsible',
	'value' => set_value('Person_responsible'),
	);
$task = array(
  'name'  => 'task[]',
  'id'    => 'task',
  'value' => set_value('task'),
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

include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/General/Client_data.php');
?>



<main >
          
          <div class="container">
            
            <div class="row">
  <?php
    if($status == 0)
        {
          include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/header_footer/side_bar_admission.php');
        }
        elseif($status == 1)
        {
          include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/header_footer/side_bar_custody.php');
        }

        ?>> 
              <div class="col s10">
                <fieldset class="z-depth-2">
                    <div class="form-group">
                      <center>
                        <h6 ><b>Client Info</b></h6>
                      </center>
                   <h5 class="divider black"></h5>
                      <img src="<?php echo base_url(); ?>materialize/title logo.png" class=" left"> 
                      <label >Name: <?php echo $fname." ".$lname; ?> </label>
                      <br>
                      <label>Age: <?php echo $age; ?></label>
                      <br>
                      <label >Gender: <?php if ($gender == 1){echo "Male";}
                      elseif($gender == 2){echo "Female";} ?></label>
                      <br>
                      <label >Place of Birth: <?php echo $birth_place; ?></label>
                      <br>
                      <label >Dorm: <?php echo $d_name; ?></label>
                      <br>                       
                    </div>
                    </fieldset>
                    <br>
                <fieldset class="z-depth-2">
                <?php  echo form_open('auth/create_POA'); ?>
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
                   <div class="col s6" align="left">
                     <button type="button" onclick=myFunction() value="view" class="btn  waves-effect btn-md  blue z-depth-2">Add row</button>
                   </div>
                    <div class="col s6" ALIGN="right">
                      </br>

                      <button type="submit" value="view" class="btn  waves-effect btn-md  green z-depth-2">Submit</button>
                      <?php echo form_close(); ?>
                      <?php echo form_open('auth/POA_list');
                      echo form_hidden('client_id', $client_id); ?>
                       <button type="submit" value="view" class="btn  waves-effect btn-md  red z-depth-2">Cancel</button>
                      <?php echo form_close(); ?>
                    </div>
                   </fieldset>
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