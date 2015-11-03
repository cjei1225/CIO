          <div class="col s2 left">
            <div class=" grey lighten-4" style="height:100%;">
              <div  >
                <div class="panel-body" style="height:100%;" >
                  <?php  
                  if($role == '5')
                        { ?>
                              <div class="panel-body" style="height:100%;" >
                                    <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                              </div>
                 <?php } ?>

                    <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                          <br>
                  <?php  
                  if($role == 7 || $role == 8 || $role == 9 || $role == 10)
                  {
                        $file = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Social Case Reports' . DIRECTORY_SEPARATOR; 
                        echo form_open('auth/SW_Discharge');
                        echo form_hidden('client_id',$client_id );
                              
                        ?>
                        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Discharge</button>
                        <?php echo form_close(); 
                  }?>
                  
                  <?php
                  echo form_open('auth/socialW_case_profile');
                  echo form_hidden('client_id', $client_id);
                  echo form_hidden('sw_id', $sw_id);                          
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Case</button>
                  <?php
                  echo form_close();


                  echo form_open('auth/socialW_client_documents');
                  echo form_hidden('client_id', $client_id);
                  echo form_hidden('sw_id', $sw_id);                          
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Documents</button>
                  <?php
                  echo form_close();

                  echo form_open('auth/view_gen_intake');
                  echo form_hidden('client_id', $client_id); ?>

                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">View Intake </button>
                  <?php
                  echo form_close();


                  echo form_open('auth/socialW_medical_profile');
                  echo form_hidden('client_id', $client_id);
                  ?>

                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Medical</button>
                  <?php
                  echo form_close();


                  echo form_open('auth/get_client_checklist_items');
                  echo form_hidden('client_id', $client_id); ?>

                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Check List</button>
                  <?php
                  echo form_close();

                  echo form_open('auth/POA_list');
                  echo form_hidden('client_id', $client_id);
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Plan Of Action</button>
                  <?php
                  echo form_close();
         

                  echo form_open('auth/get_house_reports');
                  echo form_hidden('client_id', $client_id); ?>

                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">House Reports</button>
                  <?php
                  echo form_close();
                  ?>

                  <?php echo form_open('auth/conference_history'); 
                  echo form_hidden('client_id', $client_id);
                  echo form_hidden('conference_type', '1');
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Client Conferences</button>
                  <?php echo form_close();


                  echo form_open('auth/home_visit_page'); 
                  echo form_hidden('client_id', $client_id);
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Home Visit Report</button>
                  <?php echo form_close(); 

                  echo form_open('auth/indi_home_plan_page'); 
                  echo form_hidden('client_id', $client_id);
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Indi Home Plan</button>
                  <?php echo form_close();

                  if($sector == '1')
                  { ?>
                        <?php echo form_open('auth/before_kasunduan');
                        echo form_hidden('client_id', $client_id);
                        ?>
                        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Kasunduan</button>
                        <?php echo form_close(); 
                  } 


                  if($sector == '2' && ($role == 7 || $role == 8 || $role == 9 || $role == 10))
                  { 
                        echo form_open('auth/before_aff_undertaking');
                        echo form_hidden('client_id', $client_id);
                  ?>
                        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Affidavit of Undertaking</button>
                        <?php echo form_close();
                  }  
                  ?>

                   <?php
                  echo form_open('auth/mpdf_files');
                  echo form_hidden('client_id', $client_id);
                  echo form_hidden('sw_id', $sw_id);                          
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">MPDF Files</button>
                         
                 </div>
              </div>
            </div>
          </div> 