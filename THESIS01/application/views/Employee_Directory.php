<?php

?>

   <main >    
      <div class="container">
        <div class="col s12">
            <fieldset class="z-depth-2">
              <center><h5 class="bold">LIST OF EMPLOYEES</h5></center>
              <h5 class="divider black"></h5>
              <div class="form-group">    
                <div class="table-responsive">
                  <table class="table centered striped bordered hoverable" id="dataTables-example">
                    <thead>
                      <tr>
                        <th data-field="client_no.">Employee ID.</th>
                        <th data-field="client_name">Employee</th>

                        <th data-field="dorm">Role</th>        
                      </tr>
                    </thead>

                    <tbody>
                        <?php foreach($employee_list as $employee){ ?>
                      <tr>
                        <td><?php echo $employee->id; ?></td>
                        <td><?php echo $employee->first_name." ".$employee->last_name;?> </td>
                        <td><?php if($employee->role == 0){echo 'Admin';}
                                  elseif($employee->role == 1){echo 'Social Worker General';}
                                  elseif($employee->role == 2){echo 'nurse';}
                                  elseif($employee->role == 3){echo 'Psychiatrist';}
                                  elseif($employee->role == 4){echo 'Psychologist';}
                                  elseif($employee->role == 5){echo 'House Parent';}
                                  elseif($employee->role == 6){echo 'Physical Therapist';}
                                  elseif($employee->role == 7){echo 'SW Older';}
                                  elseif($employee->role == 8){echo 'SW Special Needs';}
                                  elseif($employee->role == 9){echo 'SW Crisis Situation';}
                                  elseif($employee->role == 10){echo 'SW Child/ Youth';}
                                  ?>

                      
                      
                      </tr>
                      <?php } ?>  
                    </tbody>
                  </table>
                </div>
              </div>
            </fieldset>   
        </div>
      </div>
    </main>