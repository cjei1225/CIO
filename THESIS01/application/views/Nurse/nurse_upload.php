<?php
$file_path = array(
    'name'  => 'file_path',
    'id'    => 'file_path',
    'value' => set_value('file_path'),
);
$file_name = array(
    'name'  => 'file_name',
    'id'    => 'file_name',
    'value' => set_value('file_name'),
);
$file_ploc = array(
    'name'  => 'file_ploc',
    'id'    => 'file_ploc',
    'placeholder' => 'Physical Location',
    'value' => set_value('file_ploc'),
    'class' => 'form-control',
    'length' => 50,

);

$document_type = '33';

foreach($client_info as $row_info) 
{
  $client_id      = $row_info->client_id;
  $fname   = $row_info->client_fname;
  $mname  = $row_info->client_mname;
  $lname   = $row_info->client_lname;
  $gender         = $row_info->gender;
  $sw_id          = $row_info->sw_id;
  $mname  = $row_info->client_mname;
  $admitDate = $row_info->created;
  $sector = $row_info->client_sector;
  $birthday       = $row_info->birthday;
  $d_name        = $row_info->d_name;
  $religion       = $row_info->religion;
  $client_status   = $row_info->client_status;

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
                  echo form_open('auth/health_profile');
                  echo form_hidden('client_id', $client_id);
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Health Profile</button>
                  <?php
                  echo form_close();
                  ?>

                  <?php
                  echo form_open('auth/health_history');
                  echo form_hidden('client_id', $client_id);
                  ?>
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text deep-purple lighten-2 z-depth-2" id="userside">Medical History</button>
                  <?php
                  echo form_close();
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
              <img src="<?php echo base_url(); ?>materialize/title logo.png" class="right"> 
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
         
                      
                            <?php echo form_open_multipart('auth/nurse_upload'); ?>
                            <div class="file-field input-field">
                                <?php
                                echo form_hidden('client_id', $client_id);
                                echo form_hidden('sw_id', $sw_id); 
                                echo form_hidden('document_type', $document_type);
                                ?>
                                <!-- <?php echo form_upload('userfile'); ?> -->
                                <div class="col s4">
                                    <input class="file-path validate" type="hidden"/>
                                    <div class="btn">
                                        <span> File </span>
                                        <input type='file' name="userfile"/>
                                    </div>
                                </div>
                                <div class="col s2">&nbsp
                                </div>
                                <div class="col s4">
                                    <select name="file_ploc" class="browser-default">
                                        <?php foreach ($locations as $row_location){ echo"<option value="; echo "'".$row_location->location_name."'"; echo">";  echo $row_location->location_name; echo '</option>'; }?>
                                    </select>
                                </div>
                                <div class="col s3">
                                    <button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Save</button>
                                </div>

                            </div>
                            <?php echo form_close(); ?>

		  		  
		  
            

                                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                      <thead>
                                          <tr>
                                              <th>File</th>
                                              
                                              <th>Uploaded On:</th>
                                           
                                              <th>Action</th>
                                          </tr>
                  
                                      </thead>
                                      <tbody>
                                           <?php foreach($file_cham as $files_row) { ?>
                                          <tr class="odd gradeX">
                                              <td><?php echo $files_row->file_name; ?></td>
                                              <td><?php echo $files_row->created; ?></td>
                                              <td>
                                              <?php 
                                              echo form_open('auth/get_file');
                                              echo form_hidden('file_path', $files_row->file_location.$files_row->file_name); 
                                              echo form_hidden('sw_id', $sw_id); 
                                              echo form_hidden('file_name', $files_row->file_name); ?>
                                             <button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Save</button>
                                          </td>
                                          </tr>
                                          <?php echo form_close(); ?>
                                         <?php } ?>
                                      </tbody>
                                  </table>
                         
              
            </fieldset>
        </div>
        </div>
    </div>
</main>