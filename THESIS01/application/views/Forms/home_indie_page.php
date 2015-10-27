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

                      <div class="row">
                        <div class="col s12">

                                  <?php
                                  if($role == 7 || $role == 8 || $role == 9 || $role == 10){
                                    echo form_open('auth/create_indi_home_plan');
                                    echo form_hidden('client_id', $client_id);
                                    echo form_hidden('sw_id', $sw_id);                          
                                  ?>
                                  <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Create Home Plan</button>
                                  <?php
                                    echo form_close();
                                  } ?>
                                </div>
                              </div>
                        <br>                        
                                <table class='bordered'>
                                    <thead>
                                        <tr>
                                            <th>Date created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach($home_plans as $home_plan){ ?>
                                        <?php 
                                        echo form_open('auth/view_indi_home_plan'); 
                                        echo form_hidden('home_plan_id', $home_plan->home_plan_id);
                                        echo form_hidden('client_id', $home_plan->client_id);?><tr>
                                          <td><?php echo date('M d Y', strtotime($home_plan->created)); ?></td>
                                          <td><button class="btn  waves-effect btn-md  green z-depth-2" type="submit" name="action">View</button></td>
                                        </tr>
                                          <?php echo form_close(); } ?>
                                       
                                    </tbody>
                                </table>
              </fieldset>
          </div>
      </div>
  </main>