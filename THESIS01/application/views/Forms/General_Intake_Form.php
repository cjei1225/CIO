<?php foreach($client_info as $row_info) 
      {
          $created = $row_info->created;
          $client_id      = $row_info->client_id;
          $fname      = $row_info->client_fname;
          $mname      = $row_info->client_mname;
          $lname      = $row_info->client_lname;
          $nickname   = $row_info->nickname;
          $Civil      = $row_info->civil_status;
          if($row_info->gender == '1'){$gender= 'Male';}
          elseif($row_info->gender == '2'){$gender = 'Female';}
          $religion       = $row_info->religion;
          $birthday       = $row_info->birthday;
          $Birthplace     = $row_info->birthplace;
          $dorm_id        = $row_info->dorm_id;
          $sw_id          = $row_info->sw_id;
          $Birthday     = $row_info->birthday;
          $admitDate    = $row_info->created;
          $sector     = $row_info->client_sector;
          if($row_info->baptized == '1'){$baptized = 'yes';}
          elseif($row_info->baptized == '0'){$baptized = 'no';}
          $nationality = $row_info->nationality;
          $present_add = $row_info->present_add;
          $contact_num = $row_info->contact_num;
          $permanent_add = $row_info->permanent_add;

          if($row_info->educ_attained == '1'){$educ_attained = 'Currently in pre-school';}
          elseif($row_info->educ_attained == '2'){$educ_attained = 'Finished pre-school';}
          elseif($row_info->educ_attained == '3'){$educ_attained = 'Currently in elementary';}
          elseif($row_info->educ_attained == '4'){$educ_attained = 'Finished elementary';}
          elseif($row_info->educ_attained == '5'){$educ_attained = 'Currently in high school';}
          elseif($row_info->educ_attained == '6'){$educ_attained = 'Finished high school';}
          elseif($row_info->educ_attained == '7'){$educ_attained = 'Currently in collage';}
          elseif($row_info->educ_attained == '8'){$educ_attained = 'Finished collage';}


          $emergency_name = $row_info->emergency_name;
          $emergency_add = $row_info->emergency_add;
          $emergency_contact = $row_info->emergency_contact;
          $referral_source = $row_info->referral_source;
          $source_add = $row_info->source_add;
          $source_contact = $row_info->source_contact;
          $id_presented = $row_info->id_presented;


          $sw_name = $row_info->first_name." ".$row_info->last_name;
          
          $problem = $row_info->problem;
          $agent_name = $row_info->agent_name;
          $agent_reason = $row_info->agent_reason;
          $agent_service = $row_info->agent_service;
          $problem_history = $row_info->problem_history;
          $intake_description = $row_info->intake_desc;
          $health_history = $row_info->health_history;
          $family_bg = $row_info->family_bg;
          $assess_problem = $row_info->assess_problem;
          $assess_needs = $row_info->assess_needs;
          $assess_motiv = $row_info->assess_motiv;
          $assess_resource  = $row_info->assess_resource;

          $admission_type = $row_info->admission_type;
      }

      function ageCalculator($birthday){
  if(!empty($birthday)){
    $birthdate = new DateTime($birthday);
    $today   = new DateTime(date("Y/m/d"));
    $age = $birthdate->diff($today)->y;
    return $age;
  }else{
    return 0;
  }
}
$age = ageCalculator($birthday);
      ?>

<main >
  <div class="container">
    <div class="row">
      <div class="col s2 left">
        <div class=" grey lighten-4" style="height:100%;">
          <div>
            <div class="panel-body" style="height:100%;" >
             <?php if($role == "0")
                      { ?>
                      <div class="panel-body" style="height:100%;" >
                          <button onclick="goBack()" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                          <br>
                        <?php
                        echo form_open('auth/view_intake');
                        echo form_hidden('client_id', $client_id); ?>

                        <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">View Intake </button>
                        <?php
                        echo form_close();
                        ?>

                        <?php
                        echo form_open('auth/pre_admission_CC');
                        echo form_hidden('client_id', $client_id);
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
                        echo form_open('auth/view_intake');
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
       <div class="col s10">
          <?php 
          if ($this->uri->uri_string == "auth/Gen_Intake2")
          {
           echo form_open('auth/upload_initial_documents');
           echo form_hidden('client_id', $client_id);
           echo "<button type='submit' class='btn  waves-effect btn-md  blue z-depth-2' id='sizebutton'>Next</button>";
           echo form_close(); 
          }

          ?>
        <fieldset class="z-depth-2">
          <center>
            <h6 >Social Service Department</h6>
           
          </center>
          <center>
            <h6 ><b>GENERAL INTAKE FORM</b></h6>
          </center>
          <center><img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100"></center>
           <h5 class="divider black"></h5>
             <div class="form-group">
              <label class="right">Date: <?php echo $created; ?></label>
              <div class ="row">
                  <div class="col s6">
                    <br>
                    <label><b>CLIENT'S IDENTIFYING INFORMATION</b></label>
                    <br>
                    <label >Name: <?php echo $fname." ".$mname.". ".$lname; ?></label>
                    <br>
                    <label >A.K.A:  <?php echo $nickname; ?></label>
                    <br>
                    <label >Date of Birth: <?php echo $Birthday; ?></label>
                    <br>
                    <label>Age: <?php echo $age; ?></label>
                    <br>
                    <label >Gender: <?php echo $gender; ?></label>
                    <br>
                    <label >Civil Status: <?php echo $Civil; ?></label>
                    <br>
                    <label >Religion: <?php echo $religion; ?></label>
                    <br>
                    <label >Baptized:  <?php echo $baptized; ?></label>
                    <br>
                    <label >Nationality:  <?php echo $nationality; ?></label>
                    <br>
                    <label >Place of Birth:  <?php echo $Birthplace; ?></label>
                      
                    </div>
                    <br><br>
                    <div class="col s6">
                     <label >Present Address:  <?php echo $present_add; ?></label>
                     <br>
                     <label >Tel./ Cel Nos.:  <?php echo $contact_num; ?></label>
                     <br>
                     <label>Permanent Address:  <?php echo $permanent_add; ?></label>
                     <br>
                     <label >Highest Educational Attainment:  <?php echo $educ_attained; ?></label>
                     <br>
                     <label >Contact person in case of emergency:  <?php echo $emergency_name; ?></label>
                     <br>
                     <label >Address:  <?php echo $emergency_add; ?></label>
                     <br>
                     <label >Tel. Nos.:  <?php echo $emergency_contact; ?></label>
                     <br>
                     <label >Source of Referral:  <?php echo $referral_source; ?></label>
                     <br>
                     <label >Address:  <?php echo $source_add; ?></label>
                     <br>
                     <label >Tel./ Cel Nos.:  <?php echo $source_contact; ?></label>
                     <br>
                     <label >I.D. PRESENTED: <?php echo $id_presented; ?>  </label>
                     <br>
                    </div>
                  </div>
                 <label ><b>FAMILY/HOUSEHOLD COMPOSITION:</b></label>
                 <br>
                  <table class="Table bordered centered">
                    <thead>
                      <th>Name</th>
                      <th>Relation-ship to Client</th>
                      <th>Date of Birth</th>
                      <th>Age</th>
                      <th>Civil Status</th>
                      <th>Educational Attainment</th>
                      <th>Occupation/Income</th>
                      <th>Address/Whereabouts</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <label><b>PROBLEM PRESENTED (Immediate cause of client's request for  help)</b></label>

                 <p><?php echo $problem; ?>
                 </p>
                 <br>

                 <label><b>OTHER AGENCY/INSTITUTION APPROACHED BY THE CLIENT (specify)</b></label>
                 <br>
                 <label>Name of Agency/Institutions: <?php echo $agent_name;?></label>
                 <br>
                 <label>Whem/Why? <?php echo $agent_reason;?></label>
                 <br>
                 <label>Sevices Received from the Agency <?php echo $agent_service;?></label>
                 <br>
                 <label><b>BRIEF HISTORY OF THE PROBLEM</b></label>
                  <p> <?php echo $problem_history; ?> </p>
                 <br>
                 <label><b>DESCRIPTION OF THE CLIENT AT INTAKE</b></label>
                 <p> <?php echo $intake_description; ?> </p>
                 <br>

                 <label><b>HEALTH HISTORY</b></label>
                 <p> <?php echo $health_history; ?> </p>
                 <br>


                 <label><b>FAMILY BACKGROUND (for adoption cases please fill-up the attached sheet)</b></label>
                 <p> <?php echo $family_bg; ?> </p>
                 <br>

                 <label><b>ASSESSMENT</b></label>
                 <br>
                 <ul>
                  <li><b>-Immediate problems/needs to be worked out</b></li>
                  <?php echo $assess_problem; ?> </p>
                  <br>
                 <br>
                 <li><b>-Underlying problems/needs</b></li>
                 <p> <?php echo $assess_needs; ?> </p>
                 <br>
                 <br>
                 <li><b>-Motivation and capacity to relate and utilize help (assessment of strenghts & weaknesses)</b></li>
                 <p><?php echo $assess_motiv; ?> </p>
                 <br>
                 <br>
                 <li><b>-Resources (Internal and External)</b></li>
                 <p> <?php echo $assess_resource; ?> </p>
                 <br>
                 <br>
                 </ul>
                <br>
              
                <br>
                <label >Social Worker: <?php echo $sw_name; ?></label>
                
                
             </div>
             <div ALIGN="right">
               </br>
               <button class="btn  waves-effect btn-md  red z-depth-2 " id="sizebutton" onclick="goBack()">Back</button>


            
             </div>
             </fieldset>
          </div>
    </div>
  </div>
</main>
<script>
function goBack() {
    window.history.back();
}
</script>