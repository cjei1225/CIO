<?php foreach($surrender_details as $row_info) 
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
          $health_history = $row_info->health_history;

          $sw_name = $row_info->first_name." ".$row_info->last_name;
          
          $problem = $row_info->problem;
          $intake_description = $row_info->intake_desc;

          $surrenderer_name = $row_info->surrender_name;      
          $surrenderer_rel = $row_info->surrender_rel;      
          $surrenderer_age = $row_info->surrender_age;      
          $surrenderer_gender = $row_info->surrender_gender;      
          $surrenderer_add = $row_info->surrender_address;      
          $surrenderer_contact = $row_info->surrender_contact;      
          $surrenderer_reason = $row_info->surrender_reason;      
          

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
                        <label><b>FAMILY BACKGROUND</b></label>
                       <br>
                        <table class="Table bordered centered">
                          <thead>
                            <th>Name</th>
                            <th>Relation-ship to Client</th>
                            <th>Age</th>
                            <th>Civil Status</th>
                            <th>Educational Attainment</th>
                            <th>Occupation/Income</th>
                            <th>Address/Whereabouts</th>
                          </thead>
                          <tbody>
                            <?php foreach($family as $member)
                            { ?>
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