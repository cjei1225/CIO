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

foreach($pre_admission_page_details as $row_info) 
{
  $client_id      = $row_info->client_id;
  $fname   = $row_info->client_fname;
  $lname   = $row_info->client_lname;
  $gender         = $row_info->gender;
  $birth_place     = $row_info->birthplace;
  $birthday       =$row_info->birthday;
  $dorm_id        = $row_info->dorm_id;
  $sw_id          = $row_info->sw_id;
  $d_name         = $row_info->d_name;
  $admission_type = $row_info->admission_type;
  $sector         = $row_info->client_sector;
  $profile_pic    = $row_info->profile_pic;
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
      <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_admission.php');  ?>


      <div class="col s10">
        <fieldset class="z-depth-2">
          <center>
            <h5 class="bold">Pending Client</h5>
          </center>
          <h5 class="divider black"></h5>
          <div class="form-group">
            <?php if($profile_pic == null)
            { ?>
            <img width="200px" height="200px"src="<?php echo base_url(); ?>materialize/title logo.png" class=" left"> 
            <?php 
            } 
            else{ ?>
            <img width="200px" height="200px"src="<?php echo base_url();echo $profile_pic; ?>" class=" left"> 
            <?php } ?><label >Name: <?php echo $fname." ".$lname; ?> </label>
            <br>
            <label>Age: <?php echo $age; ?></label>
            <br>
            <label >Gender: <?php if ($gender == 1){echo "Male";}
            elseif($gender == 2){echo "Female";} ?></label>
            <br>
            <label >Place of Birth: <?php echo $birth_place; ?></label>
            <br>
            <label >Dorm: <?php echo $d_name; ?></label>
            <br>                       
          </div>
          <div class="row">
            <div class="col s12">
              <?php
              if($role=="0")
              {
              ?> 
              <div class='col s2'>
              <?php
              echo form_open('auth/Admin_Client_approval');
              echo form_hidden('client_id', $client_id);
              echo form_hidden('sw_id', $sw_id);                          
              ?>
              <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Accept Client </button>
              
              <?php
              echo form_close();
              ?>
            </div>
            <div class="col s2">
              <?php
              echo form_open('auth/Admin_Client_reject');
              echo form_hidden('client_id', $client_id);
              echo form_hidden('sw_id', $sw_id);                          
              ?>
              <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Reject Client </button>
              <?php
              echo form_close();
              ?>
            </div>
            <?php
              }
              elseif($role == 7 || $role == 8 || $role == 9 || $role == 10)
              {
              echo form_open('auth/intial_case');
              echo form_hidden('client_id', $client_id);
              echo form_hidden('sw_id', $sw_id);                          
              ?>
              <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Create Initial Social Case Study </button>
              <?php
              echo form_close();

              $document_type = 33;

              echo form_open_multipart('auth/client_picture'); ?>
                            <div class="file-field input-field row">
                                <?php
                                echo form_hidden('client_id', $client_id);
                                echo form_hidden('sw_id', $sw_id); 
                                echo form_hidden('document_type', $document_type);
                                ?>
                                <!-- <?php echo form_upload('userfile'); ?> -->
                                <div class="col s3">
                                    <input class="file-path validate" type="hidden"/>
                                    <div class="btn">
                                        <span> File </span>
                                        <input type='file' name="userfile"/>
                                    </div>
                                </div>

                                <div class="col s1">&nbsp &nbsp &nbsp
                                </div>

                                  <?php echo form_hidden('file_ploc', 'lol'); ?>

                                <div class="col s3">
                                    <button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Save</button>
                                </div>

                            </div>
                            <?php echo form_close(); ?>

              <?php

              }
              ?>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </main>