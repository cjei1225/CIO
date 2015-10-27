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

include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>
<main>
    <div class="container">
  		<div class="row">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php'); ?>
        <div class="col s10">
  	  		<fieldset class="z-depth-2">
            <center>
              <h5 class="bold">Client</h5>
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
            <br>
            <div class="col-lg-12"> 
              <div class="form-inline col-lg-5">
                <?php 
                  echo form_open('auth/Admin_Discharge');
                  echo form_hidden('client_id2',$client_id ); 
                ?>
                <br><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Approve Discharge </button>
                  <?php echo form_close(); ?>
              </div>  
            </div>            
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                  <tr>
                                      <th>File name</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              	<?php 
                                  $file_path = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'General Documents' . DIRECTORY_SEPARATOR . 'Discharge' . DIRECTORY_SEPARATOR;
                                  foreach($file_Discharge as $row_files) { ?>
                               
                                  <tr class="odd gradeX">
                                      <td><?php echo $row_files; ?></td>
                                      <td>
                                          <?php echo form_open('auth/read_test'); 
                                              echo form_hidden('path', $file_path.$row_files); 
                                              echo form_hidden('file', $row_files); ?>
                                              <div class="btn btn-primary btn-sm" id="remove_design"><?php echo form_submit('View', 'Download'); 
                                              echo form_close(); ?></div></td>
                                  </tr>
                                 
                                   <?php } ?>
                              </tbody>
              </table>
            </div> 
          </fieldset>
        </div>
      </div>
    </div>
</main>