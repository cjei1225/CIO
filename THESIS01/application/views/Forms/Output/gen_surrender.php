<?php 
$created = $surrender_details[0]->created;
$client_id      = $surrender_details[0]->client_id;
$fname      = $surrender_details[0]->client_fname;
$mname      = $surrender_details[0]->client_mname;
$lname      = $surrender_details[0]->client_lname;
$nickname   = $surrender_details[0]->nickname;
$Civil      = $surrender_details[0]->civil_status;
if($surrender_details[0]->gender == '1'){$gender= 'Male';}
elseif($surrender_details[0]->gender == '2'){$gender = 'Female';}
$religion       = $surrender_details[0]->religion;
$birthday       = $surrender_details[0]->birthday;
$Birthplace     = $surrender_details[0]->birthplace;
$dorm_id        = $surrender_details[0]->dorm_id;
$sw_id          = $surrender_details[0]->sw_id;
$Birthday     = $surrender_details[0]->birthday;
$admitDate    = $surrender_details[0]->created;
$sector     = $surrender_details[0]->client_sector;
if($surrender_details[0]->baptized == '1'){$baptized = 'yes';}
elseif($surrender_details[0]->baptized == '0'){$baptized = 'no';}
elseif($surrender_details[0]->baptized == '2'){$baptized = 'unknown';}
$nationality = $surrender_details[0]->nationality;
$educ_attained = $surrender_details[0]->educ_attained;
$school_attended = $surrender_details[0]->school_attended;

$emergency_name = $surrender_details[0]->emergency_name;
$emergency_add = $surrender_details[0]->emergency_add;
$emergency_contact = $surrender_details[0]->emergency_contact;
$id_presented = $surrender_details[0]->id_presented;
$health_history = $surrender_details[0]->health_history;

$sw_name = $surrender_details[0]->first_name." ".$surrender_details[0]->last_name;

$problem = $surrender_details[0]->problem;
$intake_description = $surrender_details[0]->intake_desc;

$surrenderer_name = $surrender_details[0]->surrender_name;      
$surrenderer_rel = $surrender_details[0]->surrender_rel;      
$surrenderer_age = $surrender_details[0]->surrender_age;      
$surrenderer_gender = $surrender_details[0]->surrender_gender;      
$surrenderer_add = $surrender_details[0]->surrender_address;      
$surrenderer_contact = $surrender_details[0]->surrender_contact;      
$surrenderer_reason = $surrender_details[0]->surrender_reason;      


$admission_type = $surrender_details[0]->admission_type;
$status = $surrender_details[0]->client_status;
      

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

      <main>
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
                  <h6 ><b>GENERAL INTAKE FORM</b></h6>
                  <img src="<?php echo base_url(); ?>materialize/title logo.png" width="100" height="100">
                </center>
                <h5 class="divider black"></h5>
                <div class="form-group">
                  <label class="right">Date: <?php echo date('m/d/y', strtotime($created)); ?></label>
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
                   

                  <label><b>SURRENDER INFORMATION</b></label>
                  <br>
                  <label >Name: <?php echo $surrenderer_name; ?></label>
                  <br>
                  <label>Relationship: <?php echo $surrenderer_rel; ?></label>
                  <br>
                  <label >Age:  <?php echo $surrenderer_age; ?></label>
                  <br>
                  <label>Gender: <?php echo $surrenderer_gender; ?></label>
                  <br>
                  <label >Address: <?php echo $surrenderer_add; ?></label>
                  <br>
                  <label>Contact Number: <?php echo $surrenderer_contact; ?></label>
                  <br>
                  <label>Reason: <?php echo $surrenderer_reason; ?></label>
                  <br>
                  <br>

                   <label><b>Description of client during interview</b></label>
                   <p><?php echo $intake_description; ?>
                   </p>
                   <br>

                  
                   <br>
                   <label >Social Worker: <?php echo $sw_name; ?></label>
                      
                      
                  </div>
              </fieldset>
            </div>
          </div>
        </div>
      </main>