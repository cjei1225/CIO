<?php 

foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   = $row_info->client_fname;
    $lname   = $row_info->client_lname;
    $age            = $row_info->age;
    $gender         = $row_info->gender;
    $birth_place     = $row_info->birthplace;
    $dorm_id        = $row_info->dorm_id;
    $sw_id          = $row_info->sw_id;
    $sector         = $row_info->client_sector;
}
?>

 <main>
      <div class="container">                            
        <div class = "row">
            <div class=" grey lighten-4" style="height:100%;">
              <div >
                <div class="panel-body">
                  <?php echo form_open('auth/mpdf_kasunduan'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view" >Kasunduan</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_general'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Intake</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_health'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Health</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_psycho'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Psychological Rep</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_media'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Media</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_aff_undertaking'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Aff Undertaking</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_dis_adop'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Dis Adop</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_dis_slip'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Dis Slip</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_dis_sum'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Dis Sum</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_home_visit'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Home Visit</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_inter_cc'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Inter CC</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_social'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">Social</button>
                  <?php echo form_close(); ?>

                  <?php echo form_open('auth/mpdf_pt_prog'); 
                  echo form_hidden('client_id', $client_id); ?>
                  <button class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" type="submit" value="view">PT Prog</button>
                  <?php echo form_close(); ?>

                  
                 </div>
              </div>
            </div>
        </div>
      </div>
  </main>