    <div class="col s2 left">
          <div class=" grey lighten-4" style="height:100%;">
            <div>
            	<?php 
                if($client_status == '0')
                  { ?>
                  <div class="panel-body" style="height:100%;" >
                  <?php 
                    if($role == "0")
                        { ?>
                        <div class="panel-body" style="height:100%;" >
                          <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                          <br>
                          <?php
                          echo form_open('auth/socialW_client_documents');
                          echo form_hidden('client_id', $client_id);
                          echo form_hidden('sw_id', $sw_id);                          
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Documents</button>
                          <?php
                          echo form_close();
                          ?>

                          <?php
                          echo form_open('auth/view_gen_intake');
                          echo form_hidden('client_id', $client_id); ?>

                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">View Intake </button>
                          <?php
                          echo form_close();
                          ?>

                          <?php
                          echo form_open('auth/get_client_checklist_items');
                          echo form_hidden('client_id', $client_id); ?>

                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Check List</button>
                          <?php
                          echo form_close();
                          
                          echo form_open('auth/pre_admission_CC');
                          echo form_hidden('client_id', $client_id);
                          echo form_hidden('conference_type', '2');
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">preadmission</button>
                          <?php
                          echo form_close();
                          ?>
                          <?php
                          echo form_open('auth/POA_list');
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Plan Of Action</button>
                          <?php
                          echo form_close();
                          ?>
                          <?php
                          if($admission_type == '3')
                          {
                            echo form_open('auth/media_certificate');
                            echo form_hidden('client_id', $client_id);
                            ?>
                            <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Media Certificate</button>
                            <?php
                            echo form_close();
                          }
                          else{}

                          ?>
                        </div>
                        <?php 
                        } 
                        else
                        { ?>
                        <div class="panel-body" style="height:100%;" >
                          <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                          <br>
                          <?php
                          echo form_open('auth/socialW_client_documents');
                          echo form_hidden('client_id', $client_id);
                          echo form_hidden('sw_id', $sw_id);                          
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Documents</button>
                          <?php
                          echo form_close();
                          ?>

                          <?php
                          echo form_open('auth/view_gen_intake');
                          echo form_hidden('client_id', $client_id); ?>

                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">View Intake </button>
                          <?php
                          echo form_close();
                          ?>

                          <?php
                          echo form_open('auth/get_client_checklist_items');
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit"  value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Check List </button>
                          <?php
                          echo form_close();
                          ?>
                          <?php
                          echo form_open('auth/pre_admission_CC');
                          echo form_hidden('client_id', $client_id);
                          echo form_hidden('conference_type', '2');
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">preadmission</button>
                          <?php
                          echo form_close();
                          ?>
                          <?php
                          echo form_open('auth/POA_list');
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Plan Of Action</button>
                          <?php
                          echo form_close();
                          ?>

                          <?php
                          if($admission_type == '3')
                          {
                            echo form_open('auth/media_certificate');
                            echo form_hidden('client_id', $client_id);
                            ?>
                            <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Media Certificate</button>
                            <?php
                            echo form_close();
                          }
                          else{}
                          ?>
                        </div>
                        <?php 
                        }?>
                  </div>
                  <?php 
                  }
                elseif($client_status == "1"){ ?>

              <div class="panel-body" style="height:100%;" >
                  <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                          <br>
                <?php 
                if($role == 7 || $role == 8 || $role == 9 || $role == 10)
                {
                  $file = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Social Case Reports' . DIRECTORY_SEPARATOR; 
                  echo form_open('auth/SW_Discharge');
                  echo form_hidden('client_id', $client_id );

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
                ?>
                <?php
                echo form_open('auth/socialW_client_documents');
                echo form_hidden('client_id', $client_id);
                echo form_hidden('sw_id', $sw_id);                          
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Documents</button>
                <?php
                echo form_close();
                ?>
                 <?php
                echo form_open('auth/view_gen_intake');
                echo form_hidden('client_id', $client_id); ?>

                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">View Intake </button>
                <?php
                echo form_close();
                ?>
                <?php
                echo form_open('auth/socialW_medical_profile');
                echo form_hidden('client_id', $client_id);
                ?>

                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Medical</button>
                <?php
                echo form_close();
                ?>

                <?php
                echo form_open('auth/get_client_checklist_items');
                echo form_hidden('client_id', $client_id); ?>

                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Check List</button>
                <?php
                echo form_close();
                ?>

                <?php
                echo form_open('auth/get_house_reports');
                echo form_hidden('client_id', $client_id); ?>

                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">House Reports</button>
                <?php
                echo form_close();
                ?>



                <?php echo form_open('auth/conference_history'); 
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Client Conferences</button>
                <?php echo form_close(); ?>



                <?php echo form_open('auth/before_home_report'); 
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Home Visit Report</button>
                <?php echo form_close(); ?>
                
                <?php echo form_open('auth/create_indi_home_plan'); 
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Indi Home Plan</button>
                <?php echo form_close(); ?>

                <?php if($sector == '1' && ($role == 7 || $role == 8 || $role == 9 || $role == 10))
                { ?>
                <?php echo form_open('auth/before_kasunduan');
                echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Kasunduan</button>
                <?php echo form_close(); ?>
                <?php } ?>
                <?php if($sector == '2' && ($role == 7 || $role == 8 || $role == 9 || $role == 10))
                { ?>
                <?php echo form_open('auth/before_aff_undertaking');
                 echo form_hidden('client_id', $client_id);
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Affidavit of Undertaking</button>
                <?php echo form_close(); ?>
                <?php } ?>

                 
               </div>
              <?php } ?>
            </div>
          </div>
        </div>  