<?php
$client_id = array(
    'name'  => 'client_id',
    'id'    => 'client_id',
    'value' => set_value('client_id'),
);
$fname = array(
    'name'  => 'fname',
    'id'    => 'fname',
    'value' => set_value('fname'),
);
$lname = array(
    'name'  => 'lname',
    'id'    => 'lname',
    'value' => set_value('lname'),
);
$gender = array(
    'name'  => 'gender',
    'id'    => 'gender',
    'value' => set_value('gender'),
);
$sw_id = array(
    'name'  => 'sw_id',
    'id'    => 'sw_id',
    'value' => set_value('sw_id'),
);
$age = array(
    'name'  => 'age',
    'id'    => 'age',
    'value' => set_value('age'),
);


?>

   <main >
          
        <div class="container">
          <div  class="col s12">
            <div>
              <fieldset class="z-depth-2">
                <center><h5 class="bold">LIST OF CLIENTS</h5></center>
                <h5 class="divider black"></h5>
                <div class="form-group">   
                  <div class="table-responsive">
                    <table class="table centered striped bordered hoverable" id="dataTables-example">
                      <thead>
                        <tr>
                          <th data-field="client_no.">Client No.</th>
                          <th data-field="client_name">Clent Name</th>
                          <th data-field="client_sector">Sector</th>
                          <th data-field="dorm">Dormitory</th>
                          <th data-field="view"> View Profile</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($client_list as $row_client){ ?>
                        <tr>
                          <td><?php echo $row_client->client_id; ?></td>
                          <td><?php echo $row_client->client_lname." ".$row_client->client_fname;?> </td>
                          <td><?php if ($row_client->client_sector == 1){echo "Child and youth";}
                                    elseif($row_client->client_sector == 2){echo "Older Person";}
                                    elseif($row_client->client_sector == 3){echo "special Needs";}
                                    elseif($row_client->client_sector == 4){echo "Crisis Situation";} ?>
                          </td>
                          <td><?php echo $row_client->d_name; ?></td>
                          <td>                                            
                              <?php
                                  echo form_open('auth/socialW_medical_profile');
                                  echo form_hidden('client_id', $row_client->client_id);
                                 ?>

                                  <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button>
                                  <?php
                                  echo form_close();
                                  ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>     
              </fieldset>         
            </div>
          </div>
        </div>
      </main>