<?php 


$document_type = '20';
include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>
 <main>
      <div class="container">
        <div class="row">
          <?php  include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php'); ?>
          <div class="col s10">
              <fieldset class="z-depth-2">
                  <center>
                    <h5 class="bold">Client</h5>
                  </center>
                  <h5 class="divider black"></h5>
                      <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info.php'); ?>

                        <?php if($role == 7 || $role == 8 || $role == 9 || $role == 10){ ?>
                          <div class="row">
                            <div class="col s12">
                                      <?php
                                        echo form_open('auth/before_scs_report');
                                        echo form_hidden('client_id', $client_id);
                                        echo form_hidden('sw_id', $sw_id);                          
                                      ?>
                                      <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Create new Social Case Study </button>
                                      <?php
                                        echo form_close();
                                      ?>
                            </div>
                          </div>
                          <br>
                          <?php echo form_open_multipart('auth/socialW_upload'); ?>
                          <div class="file-field input-field row">
                              <?php
                              echo form_hidden('client_id', $client_id);
                              echo form_hidden('sw_id', $sw_id); 
                              echo form_hidden('document_type', $document_type);
                              ?>
                              <!-- <?php echo form_upload('userfile'); ?> -->
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

                              <div class="col s3">
                                  <button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Save</button>
                              </div>

                          </div>
                          <?php echo form_close(); ?>
                        <?php } ?>           
                                <table class='bordered'>
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach($files as $row_files) { ?>
                                        <tr>
                                                <?php echo form_open('auth/read_test'); ?>
                                            <td><?php echo $row_files->file_name; ?></td>
                                            <td><?php echo date('m/d/y',strtotime($row_files->created))?></td>
                                            <?php echo form_hidden('path', $row_files->file_location.$row_files->file_name); 
                                                    echo form_hidden('file', $row_files->file_name);
                                                    echo form_hidden('sw_id', $row_files->file_owner); ?>

                                            <td><button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">view</button></td>
                                          
                                        </tr>
                                          <?php echo form_close(); ?>
                                         <?php } ?>

                                         <?php foreach($social_case as $row_social)
                                         {
                                          echo '<tr>'.form_open('auth/mpdf_social_case');
                                          echo form_hidden('client_id', $client_id);
                                          echo form_hidden('social_id', $row_social->social_case_id);
                                          echo '<td>Social Case Study Report</td>';
                                          echo '<td>'.$row_social->created.'</td>';

                                          echo ' <td><button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">view</button></td>';
                                          echo form_close().'</tr>';
                                         }
                                         ?>
                                    </tbody>
                                </table>
              </fieldset>
          </div>
      </div>
  </main>