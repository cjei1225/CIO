<?php 
foreach($conference_details as $confe)
{
  $conference_id = $confe->conference_id;
  $conference_type = $confe->conference_type;
  $schedule = $confe->schedule;
  $start_time = $confe->start_time;
  $end_time = $confe->end_time;
  $location = $confe->Location;
  $status   = $confe->status;
  $capacity = $confe->capacity;
}


$i = 0;

$q = 0
?>


<main>
  <div class="container">
    <div class="row"> 
          <div class="col s2 left">
            <div class=" grey lighten-4" style="height:100%;">
              <div  >
                <div class="panel-body" style="height:100%;" >
                    <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                </div>
              </div>
            </div>
          </div>

      
      <div class="col s10">
        <fieldset class="z-depth-2">
          <div class="center">
            <h6 >Social Service Department</h6>
            <?php if($conference_type =='2'){echo '<h6 ><b>PRE-ADMISSION CASE CONFERENCE</b></h6>';}
                  elseif($conference_type =='1'){echo '<h6 ><b>INTERVENTION CASE CONFERENCE</b></h6>';}
            ?>
          </div>
         
          <h5 class="divider black"></h5>
          <?php if($role == 0)
                {
                  echo form_open('auth/end_conference'); 
                  echo form_hidden('conference_id', $conference_id);?>
                  <button class="btn  waves-effect btn-md right green z-depth-2 <?php if(date("Y/m/d") != date('Y/m/d', strtotime($schedule))) {echo "disabled";} ?> " type="submit" name="action" >End</button>
                <?php echo form_close(); 
                }?>
            <div class="form-group">
              <center>
              <label class="left">Date: <?php echo date('F d Y', strtotime($schedule)); ?></label>
              <br>
               <label class="left">Time: <?php echo $start_time." - ".$end_time;?></label>
              <br>
              <label class="left">Capacity: <?php echo $capacity;?></label>
              <br>
              <label class="left">Location: <?php echo $location;?></label>
              <br>
              </center>
               <h5 class="divider black"></h5>
              <br>

              <table <?php if($status == 0){if($role == 7 || $role == 8|| $role == 9|| $role == 10){echo "class='col s7'"; }}?>>
                <thead>
                  <td>Client</td>
                  <td>Sector</td>
                  <td>Social Worker</td>
                  <td colspan = "2"></td>
                </thead>
                <tbody>
                  <?php foreach($conference_attendees as $attendee)
                  { ?>
                  <tr>
                    <td><?php echo $attendee->client_fname; ?></td>
                    <td><?php if($attendee->client_sector == 1){echo 'Child and Youth'; }
                              elseif($attendee->client_sector == 2){echo 'Older Persons'; }
                              elseif($attendee->client_sector == 3){echo 'Special needs'; }
                              elseif($attendee->client_sector == 4){echo 'Crisis Situation'; }

                    ?></td>
                    <td><?php echo $attendee->first_name; ?></td>
                    <td> 
                      <?php 
                      echo form_open('auth/pending_client_page');
                      echo form_hidden('client_id', $attendee->client_id);
                      $i++;
                      ?>
                       <button class="btn  waves-effect btn-md  green z-depth-2 col " type="submit" name="action">View</button>
                        <?php echo form_close(); ?>

                    </td>
                    <td>
                      <?php if($status == 2)
                              { 
                                if($role == 7 || $role == 8|| $role == 9|| $role == 10)
                                {
                                  if($user_id == $attendee->sw_id)
                                    { 
                                      echo form_open('auth/create_minutes');
                                      echo form_hidden('client_id', $attendee->client_id);
                                      echo form_hidden('conference_id', $conference_id);?>

                                      <button class="btn  waves-effect btn-md  col green z-depth-2 " type="submit" name="action">Create Notes</button>
                              <?php echo form_close(); 
                                    }
                                }
                              }?>
                    </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              
            </div> 
        


        <?php if($status == 0){if($role == 7 || $role == 8|| $role == 9|| $role == 10)
          { if($capacity != $i){?>
  

           <?php 
                echo form_open('auth/Conference_add_client');
                echo form_hidden('capacity', $capacity);
                echo form_hidden('counter', $i);

                ?>
                  <div class="table-responsive col s5">
                      <table class=>
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Gender</th>
                                  
                                  <th>Admit Date</th>
                              </tr>
                          </thead>
                          <tbody>

                              <?php foreach($clients as $row_client){
                                $q++;
                              ?>
                              <tr>
                                  <td><input id="check[<?php echo $q; ?>]" name="check[<?php echo $q; ?>]" type="checkbox" value="<?php echo $row_client->client_id; ?>"><label for="check[<?php echo $q; ?>]"><?php echo $row_client->client_lname." ".$row_client->client_fname; ?></label></td>
                                  <td><?php 
                                    if($row_client->gender == 1){echo "Male";}
                                    elseif($row_client->gender == 2){echo "Female";} ?> </td>
                                  
                                  
                                  <td><?php echo date('F d Y', strtotime($row_client->created)); ?></td>
                                  <td></td>
                              </tr>        
                                  <?php } ?>
                          </tbody>
                      </table>
                  </div>                
                <?php 
                
                  echo form_hidden('conference_id', $conference_id);
                  echo form_hidden('conference_type', $conference_type);
                  if($capacity == $i){}
                    else{
                ?>
                 <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text blue lighten-2 z-depth-2" id="userside">Add Client</button>
                <?php 
              }echo form_close(); ?>
            <?php }}} ?>
          </div>
        
       </fieldset>
    </div>
  </div>
</main>