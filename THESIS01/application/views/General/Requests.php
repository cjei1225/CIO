            
<?php

?>
   <main >    
      <div class="container">
        <div class="col s12">
            <fieldset class="z-depth-2">
              <center><h5 class="bold">Requests</h5></center>
              <h5 class="divider black"></h5>
              <div class="form-group">    
                <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Client No.</th>
                                            <th>Last Name</th>
                                            
                                            <th>Gender</th>
                                            <th>Sector</th>
                                            <th>Dorm</th>
                                            <th> Reason </th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php foreach($request as $row_client){
                                         ?>
                                        <tr class="odd gradeX">
                                            <td><?php 
                                            echo form_label($row_client->client_id); ?>
                                         
                                            <td><?php echo form_label($row_client->client_lname)." ".form_label($row_client->client_fname); ?> 
                                            </td>

                                           
                                         
                                            <td class="center"><?php 
                                            if($row_client->gender == '1'){echo "Male";}
                                            elseif($row_client->gender == '2'){echo "Female";}?>
                                                            </td>

                                            <td class="center"><?php if ($row_client->client_sector == 1)
                                            {echo "Child and youth";}
                                            elseif($row_client->client_sector == 2){echo "Older Person";}
                                            elseif($row_client->client_sector == 3){echo "special Needs";}
                                            elseif($row_client->client_sector == 4){echo "Crisis Situation";} ?>                           
                                            </td>
                                            <td><?php echo form_label($row_client->d_name);?></td>
                                            <td> <?php echo $row_client->Reason; ?></td>
                                            <td>
                                            <?php 
                                            if($role == '2')
                                                {
                                                    echo form_open('auth/nurse_medical');
                                                }
                                            if($role == '3')
                                                {
                                                    echo form_open('auth/psychia_medical');
                                                }
                                            if($role == '4')
                                                {
                                                    echo form_open('auth/psycho_medical');
                                                }
                                            if($role == '6')
                                                {
                                                    echo form_open('auth/physicalT_medical');
                                                }
                                            echo form_hidden('client_id', $row_client->client_id);
                                            echo form_hidden('lname', $row_client->client_lname);
                                            echo form_hidden('fname', $row_client->client_fname);
                                            echo form_hidden('gender', $row_client->gender); 

                                            echo form_hidden('sw_id', $row_client->sw_id); 
                                            ?>
                                            <button type="submit" value="view" class="btn  waves-effect btn-md  blue z-depth-2">View</button>
                                            <?php
                                            echo form_close();
                                            ?></td>
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