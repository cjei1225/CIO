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

$document_type = '36';

foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   = $row_info->client_fname;
    $lname   = $row_info->client_lname;
      $birthday      = $row_info->birthday;
    $gender         = $row_info->gender;
    $birth_place     = $row_info->birthplace;
    $dorm_id        = $row_info->dorm_id;
    $sw_id          = $row_info->sw_id;
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
        <fieldset class="z-depth-2">
               <center>
                    <h5 class="bold">Physical Therapist files</h5>
                  </center>
                  <h5 class="divider black"></h5>
                    <div class="form-group">
                      <img src="<?php echo base_url(); ?>materialize/title logo.png" class=" left"> 
                      <label >Name: <?php echo $fname." ".$lname; ?> </label>
                        <br>
                      <label>Age: <?php echo $age; ?></label>
                         <br>
                      <label >Gender: <?php if ($gender == 1){echo "Male";}
                                      elseif($gender == 2){echo "Female";} ?></label>
                         <br>
                      <label >Place of Birth: <?php echo $birth_place; ?></label>
                          <br>
                      <label >Dorm: <?php echo $dorm_id; ?></label>
                          <br>                       
                      </div>
                 
                            <?php echo form_open_multipart('auth/physicalT_upload'); ?>
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
                                <div class="col s1">&nbsp
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
                            
                            <div class="col s7">
                                <?php echo form_open('auth/create_PT'); 
                                echo form_hidden('client_id', $client_id);
                                ?>
                           

                                <button class="btn  waves-effect btn-md  blue" type="submit" name="action">Create PT Report and Plan</button>
                                <?php echo form_close(); ?>
                            </div>
                            
                  
          
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="headhead">
                            File List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
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
                            </div>
                            <!-- /.table-responsive -->  
                        </div>
        <!-- /#page-wrapper -->
                    </div>
        <!-- /#page-wrapper -->
                </div>
    <!-- /#wrapper -->
            </div>
            </fieldset>
        </div>
    </div>
</main>