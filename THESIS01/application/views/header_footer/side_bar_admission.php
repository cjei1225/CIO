      <div class="col s2 left">
        <div class=" grey lighten-4" style="height:100%;">
          <div>
            <div class="panel-body" style="height:100%;" >
             <?php 
                  if($role == '5'){ ?>
                  <div class="panel-body" style="height:100%;" >
                   <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                 </div>
                  <?

                    elseif($role == "0")
                      { ?>
                      <div class="panel-body" style="height:100%;" >

                        <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                        <br>
                        <?php
                        echo form_open('auth/view_gen_intake');
                        echo form_hidden('client_id', $client_id); ?>

                        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">View Intake </button>
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
                      <?php } 
                      else { ?>
                      <div class="panel-body" style="height:100%;" >

                       <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                       <br>
                        <?php
                        if($role == 2){
                          echo form_open('auth/measurement');
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Initial Medical examination</button>
                          <?php
                          echo form_close();
                          }
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
                    <?php }?>
            </div>
          </div>
        </div>
      </div> 
  