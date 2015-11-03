<?php 
$created = $agency_details[0]->created;
$client_id      = $agency_details[0]->client_id;
$fname      = $agency_details[0]->client_fname;
$mname      = $agency_details[0]->client_mname;
$lname      = $agency_details[0]->client_lname;
$nickname   = $agency_details[0]->nickname;
$Civil      = $agency_details[0]->civil_status;
if($agency_details[0]->gender == '1'){$gender= 'Male';}
elseif($agency_details[0]->gender == '2'){$gender = 'Female';}
$religion       = $agency_details[0]->religion;
$birthday       = $agency_details[0]->birthday;
$Birthplace     = $agency_details[0]->birthplace;
$dorm_id        = $agency_details[0]->dorm_id;
$sw_id          = $agency_details[0]->sw_id;
$Birthday     = $agency_details[0]->birthday;
$admitDate    = $agency_details[0]->created;
$sector     = $agency_details[0]->client_sector;
if($agency_details[0]->baptized == '1'){$baptized = 'yes';}
elseif($agency_details[0]->baptized == '0'){$baptized = 'no';}
elseif($agency_details[0]->baptized == '2'){$baptized = 'unknown';}
$nationality = $agency_details[0]->nationality;
$educ_attained = $agency_details[0]->educ_attained;
$school_attended = $agency_details[0]->school_attended;

$emergency_name = $agency_details[0]->emergency_name;
$emergency_add = $agency_details[0]->emergency_add;
$emergency_contact = $agency_details[0]->emergency_contact;
$id_presented = $agency_details[0]->id_presented;


$sw_name = $agency_details[0]->first_name." ".$agency_details[0]->last_name;
$agenName = $agency_details[0]->agency_name;
$agenAdd = $agency_details[0]->agency_add;
$agenContact = $agency_details[0]->agency_contact;
$agenSW = $agency_details[0]->agency_sw_name;
$agenSWContact = $agency_details[0]->agency_sw_contact;
$agenReason = $agency_details[0]->agency_reason;
$agenServices = $agency_details[0]->agency_service;
$health_history = $agency_details[0]->health_history;

$problem = $agency_details[0]->problem;
$intake_description = $agency_details[0]->intake_desc;      

$prob_when = $agency_details[0]->problem_when;
$prob_circumstances = $agency_details[0]->problem_circums;
$prob_duration = $agency_details[0]->problem_duration;
$prob_self_diagnosis = $agency_details[0]->problem_self_diag;
$assess_problem = $agency_details[0]->assess_problem;
$assess_needs = $agency_details[0]->assess_needs;
$assess_motiv = $agency_details[0]->assess_motiv;
$assess_resource  = $agency_details[0]->assess_resource;

$admission_type = $agency_details[0]->admission_type;
$status = $agency_details[0]->client_status;

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
            <?php 
              if($status == 0)
                  {
                    include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_admission.php');
                  }
                  elseif($status == 1)
                  {
                    include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_custody.php');
                  }
                  ?>
          <div class="col s10">
            
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
                    <label class="right">Date: <?php echo date('m/d/Y', strtotime($created); ?></label>
                    <div class ="row">
                      <div class="col s6">
                        <br>
                        <label><b>CLIENT INFORMATION</b></label>
                        <br>
                         <label >Name: <?php echo $fname." ".$mname.". ".$lname; ?></label>
                          <br>
                          <label >A.K.A:  <?php echo $nickname; ?></label>
                          <br>
                          <label >Date of Birth: <?php echo date('m/d/Y', strtotime($Birthday)); ?></label>
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
                           <label >School Attended:  <?php echo $school_attended; ?></label>
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
                       <?php if($family != null){ ?>
                        <label><b>FAMILY BACKGROUND</b></label>
                        <br>
                        <table class="Table bordered centered">
                            <thead>
                              <th>Name</th>
                              <th>Relationship to Client</th>
                              <th>Age</th>
                              <th>Civil Status</th>
                              <th>Educational Attainment</th>
                              <th>Occupation/Income</th>
                              <th>Address/Whereabouts</th>
                            </thead>
                            <tbody>
                              <?php foreach($family as $member){ ?>
                                <tr>
                                  <td><?php echo $member->name; ?></td>
                                  <td><?php echo $member->relationship; ?></td>
                                  <td><?php echo $member->age; ?></td>
                                  <td><?php echo $member->civil_status; ?></td>
                                  <td><?php echo $member->educ_attained; ?></td>
                                  <td><?php echo $member->occupation; ?></td>
                                  <td><?php echo $member->address; ?></td>
                                </tr>
                              <?php }?>
                            </tbody>
                        </table>
                        <br>
                      <?php } ?>

                           
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

                       <label><b>Description of client during interview</b></label>
                       <p><?php echo $intake_description; ?>
                       </p>
                       <br>
                        // comment - not sure kung dapat kasama pa to
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
                       
                       // comment - not sure kung dapat kasama pa to
                       <label><b>MEDICAL HISTORY</b></label>
                       <p> <?php echo $health_history; ?> </p>
                       <br>
                       // comment - not sure kung dapat kasama pa to
                       <label><b>ASSESSMENT</b></label>
                       <br>
                       <ul>
                       <li><b>-Immediate problems/needs to be worked out</b></li>
                       <p><?php echo $assess_problem; ?> </p>
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