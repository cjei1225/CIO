<?php

?>

   <main >    
      <div class="container">
        <div class="col s12">
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

                        <th data-field="dorm">Dormitory</th>    
                        <th data-field="view"> Action</th>    
                      </tr>
                    </thead>

                    <tbody>
                        <?php foreach($client_list as $row_client){ ?>
                      <tr>
                        <td><?php echo $row_client->client_id; ?></td>
                        <td><?php echo $row_client->client_lname." ".$row_client->client_fname;?> </td>
                       
                       
                        <td><?php echo $row_client->d_name; ?></td>
                      
                        <td>                                            
                          <?php
                            echo form_open('auth/socialW_client_profile');
                            echo form_hidden('client_id', $row_client->client_id);
                            echo form_hidden('sw_id', $row_client->sw_id);                          
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
    </main>