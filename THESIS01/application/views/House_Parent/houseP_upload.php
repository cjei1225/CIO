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
?>

          <div id="page-wrapper">
            <div class="panel-body">
                <div class="row">
                    <div>
                        <h5>Name: </h5><h5 id="name_C"><?php echo $fname." ".$lname; ?> </h5><br/><br/>
                        <h5>Age: </h5><h5 id="name_C"><?php echo $age; ?></h5><br/><br/>
                        <h5>Gender: </h5><h5 id="name_C"><?php if ($gender == 1){echo "Male";}
                                    elseif($gender == 2){echo "Female";} ?></h5><br/><br/>
                    </div>
                    <div class="col-lg-10"  id="forme">
                    
                            <div class="form-inline col-lg-5">
                                <?php echo form_open_multipart('auth/houseP_upload'); ?>
                                <?php echo form_hidden('client_id', $client_id); ?>
                                <?php echo form_hidden('sw_id', $sw_id); ?> 
                                <?php echo form_label('Physical Location', $file_ploc['id']); ?>
                                 <select name="file_ploc">
                                    <?php
                                    foreach ($locations as $row_location)
                                    {
                                    echo"<option value="; echo "'".$row_location->location_name."'"; echo">";  echo $row_location->location_name; echo '</option>'; 
                                    }
                                    ?>
                                    </select>
                                <br/><br/>
                                <div class="btn btn-primary btn-sm" id="remove_design"> <?php echo form_upload('userfile'); ?></div>
                                <div class="btn btn-primary btn-sm" id="remove_design">  <?php echo form_submit('save', 'Save'); ?></div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                
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
                                            <td><div class="btn btn-primary btn-sm" id="remove_design"> 
                                            <?php echo form_open('auth/get_file');
                                            echo form_hidden('file_path', $files_row->file_location.$files_row->file_name); 
                                            echo form_hidden('sw_id', $sw_id); 
                                            echo form_hidden('file_name', $files_row->file_name);
                                            echo form_submit('Download', 'Download'); ?>
                                        </div></td>
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
        </div>