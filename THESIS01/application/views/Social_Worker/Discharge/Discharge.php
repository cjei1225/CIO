<?php
$file_ploc = array(
    'name'  => 'file_ploc',
    'id'    => 'file_ploc',
    'placeholder' => 'Physical Location',
    'value' => set_value('file_ploc'),
    'class' => 'form-control',
    'length' => 20,

);
include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col s2 left">
                <div class=" grey lighten-4" style="height:100%;">
                  <div  >
                    <div class="panel-body" style="height:100%;" >
                        <?php echo form_close(); ?>
                        <?php echo form_open('auth/socialW_client_profile'); 
                        echo form_hidden('client_id', $client_id);
                        ?>
                        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text blue lighten-2 z-depth-2" id="userside">Back</button>
                        <?php echo form_close(); ?>
                        <?php
                          if ($sector == 1){
                          echo form_open('auth/before_dis_adop'); 
                          echo form_hidden('client_id', $client_id);
                          echo '<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Slip</button>';
                          }
                          elseif ($sector == 2){
                          echo form_open('auth/before_dis_slip'); 
                          echo form_hidden('client_id', $client_id);
                          echo '<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Slip</button>';
                          }
                          elseif ($sector == 3){
                          echo form_open('auth/before_dis_slip'); 
                          echo form_hidden('client_id', $client_id);
                          echo '<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Slip</button>';
                          }
                          elseif ($sector == 4){
                          echo form_open('auth/before_dis_slip'); 
                          echo form_hidden('client_id', $client_id);
                          echo '<button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Slip</button>';
                          }
                          ?>
                          <?php echo form_close(); ?>
                          <?php echo form_open('auth/before_dis_sum'); 
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Summary</button>
                          <?php echo form_close(); ?>
                     </div>
                  </div>
                </div>
            </div> 
            <div class="col s10">
                <div class="col s12">

                  <fieldset class="z-depth-2">
                      <center>
                          <h5 class="bold">Discharge Client</h5>
                      </center>
                      <h5 class="divider black"></h5>
                      
                      <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_info.php'); ?>
                  <!--	<?php echo form_open_multipart('auth/Discharge_client');?>
                  		<div class="file-field input-field row">
                              <?php 
                              echo form_hidden('client_id', $client_id); 
                              echo form_hidden('sw_id', $sw_id); 
                              ?> 
                              <div class="col s3">
                                  <input class="file-path validate" type="hidden"/>
                                  <div class="btn">
                                      <span> File </span>
                                      <input type='file' name="userfile"/>
                                  </div>
                              </div>

                          <div class="col s1">&nbsp
                                      </div>
                                      <div class="col s4">
                                          <select name="file_ploc" class="browser-default">
                                              <?php foreach ($locations as $row_location){ echo"<option value="; echo "'".$row_location->location_name."'"; echo">";  echo $row_location->location_name; echo '</option>'; }?>
                                          </select>
                                      </div>
                              <br>
                                                          <div class="col s3">
                                          <button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Save</button>
                                      </div>
                          </div>
                      <?php echo form_close(); ?> -->
                      
                 </fieldset>
            </div>
        </div>
    </div>
</main>