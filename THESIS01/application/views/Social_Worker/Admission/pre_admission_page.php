<?php 
$path = array(
    'name'  => 'path',
    'id'    => 'path',
    'value' => set_value('path'),
);

$file = array(
    'name'  => 'file',
    'id'    => 'file',
    'value' => set_value('file'),
);

$file_ploc = array(
    'name'  => 'file_ploc',
    'id'    => 'file_ploc',
    'placeholder' => 'Physical Location',
    'value' => set_value('file_ploc'),
    'class' => 'form-control',
    'length' => 20,

);

$document_type = '20';

foreach($pre_admission_details as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;

    $gender         = $row_info->gender;
    $birth_place    = $row_info->birthplace;
    $dorm_id        = $row_info->dorm_id;
    $sw_id          = $row_info->sw_id;
    $schedule       = $row_info->schedule;
    $conference_id  = $row_info->conference_id;
    $birthday      = $row_info->birthday;
    $admission_type   = $row_info->admission_type;
    $conference_type  = $row_info->conference_type;
    $sector           = $row_info->client_sector;
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


echo $i_am_not_creator;
?>

 <main>
      <div class="container">
            <!-- if(Date('Y-m-d',strtotime($schedule)) == Date('Y-m-d')) -->

      <div class="row">
        <div class="col s2 left">
            <div class=" grey lighten-4" style="height:100%;">
              <div>
                <?php if($conference_type == '1'){ ?>
                <div class="panel-body" style="height:100%;" >


                  <?php
                      echo form_open('auth/pending_client_page');
                      echo form_hidden('client_id', $client_id); ?>

                      <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Back</button>
                      <?php
                      echo form_close();
                    
                    ?>

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
                <?php } elseif($conference_type == '2'){ ?>
                        <div class="panel-body" style="height:100%;" >
                          <?php echo form_open('auth/create_minutes'); 
                    echo form_hidden('conference_id', $conference_id);
                    echo form_hidden('client_id', $client_id);
                    ?>
                   <button class="list-group-item btn waves-effect btn-md  white-text blue lighten-2 z-depth-2" id="userside" type="submit">Create Minutes</button> 
                  <?php echo form_close(); ?>
                          <?php 
                          $file = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Social Case Reports' . DIRECTORY_SEPARATOR; 
                          echo form_open('auth/SW_Discharge');
                          echo form_hidden('client_id',$client_id );

                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Discharge</button>
                          <?php echo form_close(); ?>
                          
                          <?php
                          echo form_open('auth/socialW_medical_profile');
                          echo form_hidden('client_id', $client_id);
                          ?>

                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Medical</button>
                          <?php
                          echo form_close();
                          ?>

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



                          <?php echo form_open('auth/before_inter'); 
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Intervention Material</button>
                          <?php echo form_close(); ?>



                          <?php echo form_open('auth/before_home_report'); 
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Home Visit Report</button>
                          <?php echo form_close(); ?>
                          <?php if($sector == '1')
                          { ?>
                          <?php echo form_open('auth/before_kasunduan');
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Kasunduan</button>
                          <?php echo form_close(); ?>
                          <?php } ?>
                          <?php if($sector == '2')
                          { ?>
                          <?php echo form_open('auth/before_aff_undertaking');
                           echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Affidavit of Undertaking</button>
                          <?php echo form_close(); ?>
                          <?php } ?>
                          <?php echo form_open('auth/create_indi_home_plan'); 
                          echo form_hidden('client_id', $client_id);
                          ?>
                          <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Indi Home Plan</button>
                          <?php echo form_close(); ?>
                        </div>
                <?php } ?>
              </div>
            </div>
        </div> 
        <div class="col s10">
          <?php if($i_am_not_creator == 1)
          { ?>
          <div class="col s12">
            <div class="col s3 left">
              <?php echo form_open('auth/create_minutes'); 
                    echo form_hidden('conference_id', $conference_id);
                    echo form_hidden('client_id', $client_id);
                    ?>
                   <button class="list-group-item btn waves-effect btn-md  white-text blue lighten-2 z-depth-2" id="userside" type="submit">Create Minutes</button> 
                  <?php echo form_close(); ?>
                </div>
          </div>
          <?php } ?>
          <fieldset class="z-depth-2">
              
              <center>
                <?php if($conference_type == '1'){echo ' <h6 ><b>Pre-Admission CASE CONFERENCE ATTENDEES</b></h6>'; ?>
               
                <?php } elseif($conference_type == '2'){echo ' <h6 ><b>INTERVENTION CASE CONFERENCE ATTENDEES</b></h6>';} ?>
              </center>
             
               <h5 class="divider black"></h5>
                 <div class="form-group">
                  <center>
                  <label class="left">Date:<b> <?php echo date('F-d-Y', strtotime($schedule)); ?></b></label>
                  <br>
                  <br>
                   <label class="left">Time:</label>
                  <br>
                  <label class="left">By: <b><?php echo $sw_id; ?></label>
                  <br> 
                  </center>
                   <h5 class="divider black"></h5>
                  <label><b>CLIENT:</b></label>
                  <br>

                   <label >Name: <?php echo $fname." ".$lname; ?></label>
                    <br>
                    <label>Age:<?php echo $age; ?></label>
                     <br>
                     <label >Gender:<?php if ($gender == 1){echo "Male";}
                                    elseif($gender == 2){echo "Female";} ?></label>
                     <br>
                    
                     <br>

                     <label ><b> ATTENDEES: </b></label>
                    <br>
                    <table class="table centered striped bordered hoverable">
                      <thead>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                      
                      <?php   
                      foreach($pre_admission_attendees as $row_attendees)
                        {?> 
                      <tr>
                        <td><?php echo $row_attendees->first_name." ".$row_attendees->last_name;?> </td>
                        <td><?php 
                          if($row_attendees->role == 0){echo "Admin";}
                          else if($row_attendees->role == 1){echo "General Social Worker";}
                          else if($row_attendees->role == 2){echo "Nurse";}
                          else if($row_attendees->role == 3){echo "Psychiatrist";}
                          else if($row_attendees->role == 4){echo "Psychologist";}
                          else if($row_attendees->role == 5){echo "House Parent";}
                          else if($row_attendees->role == 6){echo "Physical Therapist";}
                          else if($row_attendees->role == 7){echo "SW Older";}
                          else if($row_attendees->role == 8){echo "SW Special Needs";}
                          else if($row_attendees->role == 9){echo "SW Crisis Situation";}
                          else if($row_attendees->role == 10){echo "SW Child/ Youth";}
                        ?></td>

                        <td><?php if($row_attendees->status == 0){echo "Pending";}
                                  else if($row_attendees->status == 1){echo "Attending";}
                                  else if($row_attendees->status == 2){echo "Not Attending";}?> </td>
                      </tr>

                      <?php
                        }
                        ?>
                     
                      
                      </tbody>

                    </table>
          </fieldset>
        </div>
      </div>
  </main>

  <script>
function goBack() {
    window.history.back();
}
</script>