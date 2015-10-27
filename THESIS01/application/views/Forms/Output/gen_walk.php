<?php foreach($founder_details as $row_info) 
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
         
          $founder_name = $row_info->founder_name;
          $found_age = $row_info->founder_age;
          $found_gender = $row_info->founder_gender;
          $found_address = $row_info->founder_address;
          $found_contact = $row_info->founder_contact;
          $found_where = $row_info->founder_where;
          $found_when = $row_info->founder_when;
          

          $admission_type = $row_info->admission_type;
          $status = $row_info->client_status;
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
              <?php
                if($status == 0)
                    {
                      include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/header_footer/side_bar_admission.php');
                    }
                    elseif($status == 1)
                    {
                      include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/header_footer/side_bar_custody.php');
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
                        <?php 
                        if($family != null)
                        { ?>
   

                        <label><b>FAMILY BACKGROUND </b></label>
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

                         <label><b>PROBLEM PRESENTED (Immediate cause of client's request for  help )</b></label>

                         <p><?php echo $problem; ?>
                         </p>
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