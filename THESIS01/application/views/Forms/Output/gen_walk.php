<?php 
$created = $founder_details[0]->created;
$client_id      = $founder_details[0]->client_id;
$fname      = $founder_details[0]->client_fname;
$mname      = $founder_details[0]->client_mname;
$lname      = $founder_details[0]->client_lname;
$nickname   = $founder_details[0]->nickname;
$Civil      = $founder_details[0]->civil_status;
if($founder_details[0]->gender == '1'){$gender= 'Male';}
elseif($founder_details[0]->gender == '2'){$gender = 'Female';}
$religion       = $founder_details[0]->religion;
$birthday       = $founder_details[0]->birthday;
$Birthplace     = $founder_details[0]->birthplace;
$dorm_id        = $founder_details[0]->dorm_id;
$sw_id          = $founder_details[0]->sw_id;
$Birthday     = $founder_details[0]->birthday;
$admitDate    = $founder_details[0]->created;
$sector     = $founder_details[0]->client_sector;
if($founder_details[0]->baptized == '1'){$baptized = 'yes';}
elseif($founder_details[0]->baptized == '0'){$baptized = 'no';}
elseif($founder_details[0]->baptized == '2'){$baptized = 'unknown';}
$nationality = $founder_details[0]->nationality;
$educ_attained = $founder_details[0]->educ_attained;
$school_attended = $founder_details[0]->school_attended;

$emergency_name = $founder_details[0]->emergency_name;
$emergency_add = $founder_details[0]->emergency_add;
$emergency_contact = $founder_details[0]->emergency_contact;
$id_presented = $founder_details[0]->id_presented;
$health_history = $founder_details[0]->health_history;

$sw_name = $founder_details[0]->first_name." ".$founder_details[0]->last_name;

$problem = $founder_details[0]->problem;
$intake_description = $founder_details[0]->intake_desc;

$founder_name = $founder_details[0]->founder_name;
$found_age = $founder_details[0]->founder_age;
$found_gender = $founder_details[0]->founder_gender;
$found_address = $founder_details[0]->founder_address;
$found_contact = $founder_details[0]->founder_contact;
$found_where = $founder_details[0]->founder_where;
$found_when = $founder_details[0]->founder_when;


$admission_type = $founder_details[0]->admission_type;
$status = $founder_details[0]->client_status;


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
                      <label class="right">Date: <?php echo date('m/d/Y', strtotime($created)); ?></label>
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
                         <h5 class="divider black"></h5>
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
                        
                      <?php } ?>
                         <br>
                         <h5 class="divider black"></h5>
                        <?php } ?>
                          <label><b>FOUNDER INFORMATION</b></label>
                          <br>
                          <label >Name: <?php echo $founder_name; ?></label>
                          <br>
                          <label >Age:  <?php echo $found_age; ?></label>
                          <br>
                          <label>Gender: <?php echo $found_gender; ?></label>
                           <br>
                          <label >Address: <?php echo $found_address; ?></label>
                          <br>
                          <label>Contact Number: <?php echo $found_contact; ?></label>
                           <br>
                          <label>Where was the client found?: <?php echo $found_where; ?></label>
                           <br>
                          <label>When was the client found?: <?php echo date('m/d/Y', strtotime($found_when)); ?></label>
                          <br>
                          <h5 class="divider black"></h5>

                         <label><b>Description of client during interview</b></label>
                         <p><?php echo $intake_description; ?>
                         </p>
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