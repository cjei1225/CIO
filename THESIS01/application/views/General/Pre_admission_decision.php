<?php
$e = 0;
foreach($conference_details as $row_info) 
{
    $conference_id  = $row_info->conference_id;
    $client_id      = $row_info->client_id;
    $schedule       = $row_info->schedule;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $birthday       = $row_info->birthday;
    $gender         = $row_info->gender;
    $start_time     = $row_info->start_time;
    $end_time       = $row_info->end_time;
    $conference_type = $row_info->conference_type;
    $status         = $row_info->astatus;
    $admission_type = $row_info->admission_type;
    $d_name        = $row_info->d_name;
    $sector         = $row_info->client_sector;
    $religion       = $row_info->religion;
    $mname  = $row_info->client_mname;
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



<main>
    <div class="container">
      <div class="row"> 
        <div class="col s2 left">
          <div class=" grey lighten-4" style="height:100%;">
            <div  >
              <div class="panel-body" style="height:100%;" >

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
            </div>
          </div>
        </div> 
        <div class="col s10">
        <fieldset class="z-depth-1">
          <center>
            <h5 class="bold">Client Information</h5>
          </center>
          <h5 class="divider black"></h5>
          <div class="form-group">
            <img src="<?php echo base_url(); ?>materialize/title logo.png" class=" right"> 
            <label >Name: <?php echo $fname." ".$mname." ".$lname; ?> </label>
            <br>
            <label>Age: <?php echo $age; ?></label>
            <br>
            <label >Gender: <?php if ($gender == 1){echo "Male";}
            elseif($gender == 2){echo "Female";} ?></label>
            <br>
            <label >Date of Birth: <?php echo date('M-d-Y',strtotime($birthday)); ?></label>
            <br>
            <label >Dorm: <?php echo $d_name; ?></label>
            <br> 
            <label >Sector: <?php if ($sector == 1){echo "Child and Youth";}
            elseif($sector == 2){echo "Older Person";}
            elseif($sector == 3){echo "Person with Special Needs";} 
            elseif($sector == 4){echo "Person in Crisis Situation";}?></label>
            <br>     
            <label >Religion: <?php echo $religion; ?></label>                
          </div>
        </fieldset>
      </div>

        <div class="col s10">
          <fieldset class="z-depth-2">
            <center>
              <h6 >Social Service Department</h6>
            </center>
            <center>
              <?php if($conference_type =='1'){echo '<h6 ><b>PRE-ADMISSION CASE CONFERENCE</b></h6>';}
                    elseif($conference_type =='2'){echo '<h6 ><b>INTERVENTION CASE CONFERENCE</b></h6>';}
              ?>
              <h6>CONFIRMATION</h6>
            </center>
           
            <h5 class="divider black"></h5>
              <div class="form-group">
                <center>
                <label class="left">Date: <?php echo date('F d Y', strtotime($schedule)); ?></label>
                <br>
                 <label class="left">Time: <?php echo $start_time." - ".$end_time;?></label>
                <br>
                </center>
                 <h5 class="divider black"></h5>
                <label><b>CLIENT:</b></label>
                <br>

                <label >Name:<?php echo $fname." ".$lname; ?></label>
                <br>
                <label>Age: <?php echo $age; ?></label>
                <br>
                <label >Gender: <?php if ($gender == 1){echo "Male";}
                                      elseif($gender == 2){echo "Female";} ?> </label>
                <br>
                
              </div>
              <br>
                <div ALIGN="left">
                  
                 <?php if($status == '0')
                 { ?>
                  <div class="col s2">
                  <?php echo form_open('auth/confirm_attendance');
                  echo form_hidden('decision', '1'); 
                  echo form_hidden('conference_id', $conference_id);
                  ?><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Attending</button>
                  <?php echo form_close();?>
                </div>
                <div class="col s5">
                  <?php echo form_open('auth/confirm_attendance');
                  echo form_hidden('decision', '2'); 
                  echo form_hidden('conference_id', $conference_id);
                  ?> <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Not Attending </button>
                   <?php echo form_close();?>
                 </div>
                 <?php }
                 elseif($status == '1'){ echo'You are attending';} elseif($status=='2'){echo 'Your are not attending';} ?>

                </div>
          </fieldset>
        </div>
      </div>
    </div>
</main>