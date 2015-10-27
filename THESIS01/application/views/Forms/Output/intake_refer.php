<?php foreach($agency_details as $row_info) 
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
          elseif($row_info->baptized == '2'){$baptized = 'unknown';}
          $nationality = $row_info->nationality;
          $educ_attained = $row_info->educ_attained;


          $emergency_name = $row_info->emergency_name;
          $emergency_add = $row_info->emergency_add;
          $emergency_contact = $row_info->emergency_contact;
          $id_presented = $row_info->id_presented;


          $sw_name = $row_info->first_name." ".$row_info->last_name;
          $agenName = $row_info->agency_name;
          $agenAdd = $row_info->agency_add;
          $agenContact = $row_info->agency_contact;
          $agenSW = $row_info->agency_sw_name;
          $agenSWContact = $row_info->agency_sw_contact;
          $agenReason = $row_info->agency_reason;
          $agenServices = $row_info->agency_service;
          $health_history = $row_info->health_history;
          
          $problem = $row_info->problem;
          $intake_description = $row_info->intake_desc;      

          $prob_when = $row_info->problem_when;
          $prob_circumstances = $row_info->problem_circums;
          $prob_duration = $row_info->problem_duration;
          $prob_self_diagnosis = $row_info->problem_self_diag;
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
          <div class="col s3">
            <ul class="menu">

                <li><a href="#" ><span>Step 1: Admission Type</span></a></li>
                <li><a href="#"><span>Step 2: Guardian Information</span></a></li>
                <li><a href="#"><span>Step 3: Client Information</span></a></li>
                <li><a href="#"><span>Step 4: Background Info</span></a></li>
                <li><a href="#" class="active"><span>Step 5: View Intake Output</span></a></li>
                  <li><a href="#"><span>Step 6: Upload Documents</span></a></li>
            </ul>
          </div>

              <div  class="col s9" >
                <?php echo form_open('auth/upload_initial_documents');
                    echo form_hidden('client_id', $client_id);
                    ?>
                    
                    <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Next</button>

              <?php echo form_close(); ?>
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
                        <label><b>CLIENT INFORMATION</b></label>
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
                          
                          </div>
                          <br><br>
                          <div class="col s6">
                          <label >Nationality:  <?php echo $nationality; ?></label>
                          <br>
                           <label >Place of Birth:  <?php echo $Birthplace; ?></label>
                          <br>
                           <label >Highest Educational Attainment:  <?php echo $educ_attained; ?></label>
                           <br>
                           <label >Contact person in case of emergency:  <?php echo $emergency_name; ?></label>
                           <br>
                           <label >Address:  <?php echo $emergency_add; ?></label>
                           <br>
                           <label >Tel. Nos.:  <?php echo $emergency_contact; ?></label>
                           <br>
                           <label >I.D. PRESENTED: <?php echo $id_presented; ?>  </label>
                           <br>
                         </div>
                       </div>
                       <?php if($family != null)
                       { ?>
                        <label><b>FAMILY BACKGROUND (for adoption cases please fill-up the attached sheet)</b></label>
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
                       
                      <?php } ?>
                      <br>
                        <label><b>AGENCY INFORMATION</b></label>
                        <br>
                        <label >Name of Agency/Institution: <?php echo $agenName; ?></label>
                        <br>
                        <label>Address: <?php echo $agenAdd; ?></label>
                        <br>
                        <label >Contact Number:  <?php echo $agenContact; ?></label>
                        <br>
                        <label>Social Worker In-charge: <?php echo $agenSW; ?></label>
                         <br>
                        <label >Social Worker Contact Number: <?php echo $agenSWContact; ?></label>
                        <br>
                        <label>Reason: <?php echo $agenReason; ?></label>
                        <br>
                        <label>Services Received from the Agency: <?php echo $agenServices; ?></label>
                         <br>

                       

                       <label><b>PROBLEM PRESENTED (Immediate cause of client's request for  help)</b></label>

                       <p><?php echo $problem; ?>
                       </p>
                       <br>

                       <label><b>Description of client during interview</b></label>
                       <p><?php echo $intake_description; ?>
                       </p>
                       <br>

                     
                       <label><b>BRIEF HISTORY OF THE PROBLEM</b></label>
                        <p> 
                         <label>When did it start? <br> --<?php echo $prob_when; ?></label>
                         <br>
                         <label>Circumstances that led to the problem? <br> --<?php echo $prob_circumstances; ?></label>
                         <br>
                         <label>How long has the been happening (duration)? :<br> --<?php echo $prob_duration; ?></label>
                         <br>
                         <label>What did the client do about the problem ot has done about it? <br> --<?php echo $prob_self_diagnosis; ?></label>
                         <br>
                        </p>
                       <br>
                       <label><b>DESCRIPTION OF THE CLIENT AT INTAKE</b></label>
                       <p> <?php echo $intake_description; ?> </p>
                       <br>

                       <label><b>MEDICAL HISTORY</b></label>
                       <p> <?php echo $health_history; ?> </p>
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
                     <?php 
                      if ($this->uri->uri_string == "auth/view_intake_admit")
                      {
                       echo form_open('auth/upload_initial_documents');
                       echo form_hidden('client_id', $client_id);
                       echo "<button type='submit' class='btn  waves-effect btn-md  green z-depth-2 right' id='sizebutton'>Next</button>";
                       echo form_close(); 
                      }

                       ?>


                  
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