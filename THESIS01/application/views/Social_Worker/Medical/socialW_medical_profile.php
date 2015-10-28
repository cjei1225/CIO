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


$Reason = array(
    'name'  => 'Reason',
    'id'    => 'Reason',
    'value' => set_value('Reason'),
    'class' => 'form-control',
    'length' => 200,
);

 include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');

$medical = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Medical Reports' . DIRECTORY_SEPARATOR;
$psychiatric = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Psychiatric Reports' . DIRECTORY_SEPARATOR;
$psychological = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Psychological Reports' . DIRECTORY_SEPARATOR; 
$physical = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Physical Therapy Reports' . DIRECTORY_SEPARATOR; 
?>


<main>
  <div class="container">
    <div class="row">
      <?php     include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_custody.php'); ?>
      <div class="col s10">
      <div class="col s12">
        <ul class="tabs" width="100%;">
          <li class="tab col s3"><a class="active" href="#test1">Nurse</a></li>
          <li class="tab col s3"><a href="#test2">Psychologist</a></li>
          <li class="tab col s3"><a href="#test3">Psychiatrist</a></li>
          <li class="tab col s3"><a href="#test4">Physical Therapist</a></li>
        </ul>
      </div>
      <div id="test1" class="col s12">
        </br>
        <fieldset class="z-depth-2">
          <center><h5 class="bold">Medical EXAMINATION</h5></center>
          <h5 class="divider black"></h5>
          <div class="form-group">
            <div class="table-responsive">
              <table class="table centered striped bordered hoverable">
                <thead>
                  <tr>
                    <th data-field="name">File Name</th>
                    <th data-field="Date">Uploaded On</th>
                    <th data-field="Uploader">Uploaded By</th>
                    <th data-field="File"> File</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach($medical_files as $row_medical){?>
                  <tr>
                    <td><?php echo $row_medical->file_name; ?></td>
                    <td><?php echo date('F d Y', strtotime($row_medical->created)); ?></td>
                    <td><?php echo $row_medical->first_name." ".$row_medical->last_name; ?></td>
                    <td><?php echo form_open('auth/read_test');
                              echo form_hidden('path', $row_medical->file_location.$row_medical->file_name); 
                              echo form_hidden('file', $row_medical->file_name);
                              echo form_hidden('sw_id', $row_medical->file_owner);?>
                              <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                        <?php echo form_close(); ?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>  
        </fieldset>
        <br>

        <?php if($role == 7 || $role == 8 || $role == 9 || $role == 10){ ?>
        <div ALIGN=right>
              <a href="#requestmodal1" class="btn waves-effect btn-md  modal-trigger Blue z-depth-2" id="sizebutton">REQUEST EXAMINATION</a>                
              
        </div>

        <div id="requestmodal1" class="modal modal-fixed-footer" style="width:30%" ALIGN=center>
            <?php echo form_open('auth/Request_test'); ?>
              <div class="modal-content">

                  <?php $report_type = '2';
                    
                    echo form_hidden('client_id', $client_id);
                    echo form_hidden('sw_id', $sw_id);
                    echo form_hidden('report_type', $report_type);
                    echo form_label('Please state you reason', $Reason['id']);
                    echo form_input($Reason);
                   ?>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col s12"> <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Submit </button> </div>
                  <div class="col s12"><a href="#" class="btn waves-effect red modal-action modal-close" id="sizebutton">Cancel</a></div>
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
        <?php } ?>
      </div>     

      <div id="test2" class="col s12">
        </br>
        <fieldset class="z-depth-2">
          <center><h5 class="bold">Psychological EXAMINATION</h5></center>
          <h5 class="divider black"></h5>
          <div class="form-group">
            <div class="table-responsive">
              <table class="table centered striped bordered hoverable">
                <thead>
                  <tr>
                    <th data-field="name">File Name</th>
                    <th data-field="Date">Uploaded On</th>
                    <th data-field="Uploader">Uploaded By</th>
                    <th data-field="File"> File</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach($psychologist_files as $row_medical){?>
                  <tr>
                    <td><?php echo $row_medical->file_name; ?></td>
                    <td><?php echo date('F d Y', strtotime($row_medical->created)); ?></td>
                    <td><?php echo $row_medical->first_name." ".$row_medical->last_name; ?></td>
                    <td><?php echo form_open('auth/read_test');
                              echo form_hidden('path', $row_medical->file_location.$row_medical->file_name); 
                              echo form_hidden('file', $row_medical->file_name);
                              echo form_hidden('sw_id', $row_medical->file_owner);?>
                              <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                        <?php echo form_close(); ?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>  
        </fieldset>
        <br>

        <?php if($role == 7 || $role == 8 || $role == 9 || $role == 10){ ?>
        <div ALIGN=right>
              <a href="#requestmodal2" class="btn waves-effect btn-md  modal-trigger Blue z-depth-2" id="sizebutton">REQUEST EXAMINATION</a>                
             
        </div>

        <div id="requestmodal2" class="modal modal-fixed-footer" style="width:30%" ALIGN=center>
            <?php echo form_open('auth/Request_test'); ?>
              <div class="modal-content">

                  <?php $report_type = '4';
                    
                    echo form_hidden('client_id', $client_id);
                    echo form_hidden('sw_id', $sw_id);
                    echo form_hidden('report_type', $report_type);
                    echo form_label('Please state you reason', $Reason['id']);
                    echo form_input($Reason);
                   ?>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col s12"> <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Submit </button> </div>
                  <div class="col s12"><a href="#" class="btn waves-effect red modal-action modal-close" id="sizebutton">Cancel</a></div>
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
        <?php } ?>
      </div>     

      <div id="test3" class="col s12">
        </br>


          <fieldset class="z-depth-2">
            <center><h5 class="bold">Psychiatric EXAMINATION</h5></center>
            <h5 class="divider black"></h5>
            <div class="form-group">
              <div class="table-responsive">
                <table class="table centered striped bordered hoverable">
                  <thead>
                  <tr>
                    <th data-field="name">File Name</th>
                    <th data-field="Date">Uploaded On</th>
                    <th data-field="Uploader">Uploaded By</th>
                    <th data-field="File"> File</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach($psychiatric_files as $row_medical){?>
                  <tr>
                    <td><?php echo $row_medical->file_name; ?></td>
                    <td><?php echo date('F d Y', strtotime($row_medical->created)); ?></td>
                    <td><?php echo $row_medical->first_name." ".$row_medical->last_name; ?></td>
                    <td><?php echo form_open('auth/read_test');
                              echo form_hidden('path', $row_medical->file_location.$row_medical->file_name); 
                              echo form_hidden('file', $row_medical->file_name);
                              echo form_hidden('sw_id', $row_medical->file_owner);?>
                              <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                        <?php echo form_close(); ?>
                  </tr>
                  <?php } ?>
                </tbody>
                </table>
              </div>
            </div>  
          </fieldset>
          <br>

          <?php if($role == 7 || $role == 8 || $role == 9 || $role == 10){ ?>
          <div ALIGN=right>
            <a href="#requestmodal3" class="btn waves-effect btn-md  modal-trigger Blue z-depth-2" id="sizebutton">REQUEST EXAMINATION</a>                
                          
          </div>

          <div id="requestmodal3" class="modal modal-fixed-footer" style="width:30%" ALIGN=center>
            <?php echo form_open('auth/Request_test'); ?>
              <div class="modal-content">

                  <?php $report_type = '3';
                    
                    echo form_hidden('client_id', $client_id);
                    echo form_hidden('sw_id', $sw_id);
                    echo form_hidden('report_type', $report_type);
                    echo form_label('Please state you reason', $Reason['id']);
                    echo form_input($Reason);
                   ?>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col s12"> <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Submit </button> </div>
                  <div class="col s12"><a href="#" class="btn waves-effect red modal-action modal-close" id="sizebutton">Cancel</a></div>
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <?php } ?>
      </div>      

      <div id="test4" class="col s12">
        </br>


          <fieldset class="z-depth-2">
            <center><h5 class="bold">Physical Therapy EXAMINATION</h5></center>
            <h5 class="divider black"></h5>
            <div class="form-group">
              <div class="table-responsive">
                <table class="table centered striped bordered hoverable">
                  <thead>
                  <tr>
                    <th data-field="name">File Name</th>
                    <th data-field="Date">Uploaded On</th>
                    <th data-field="Uploader">Uploaded By</th>
                    <th data-field="File"> File</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach($physical_files as $row_medical){?>
                  <tr>
                    <td><?php echo $row_medical->file_name; ?></td>
                    <td><?php echo date('F d Y', strtotime($row_medical->created)); ?></td>
                    <td><?php echo $row_medical->first_name." ".$row_medical->last_name; ?></td>
                    <td><?php echo form_open('auth/read_test');
                              echo form_hidden('path', $row_medical->file_location.$row_medical->file_name); 
                              echo form_hidden('file', $row_medical->file_name);
                              echo form_hidden('sw_id', $row_medical->file_owner);?>
                              <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                        <?php echo form_close(); ?>
                  </tr>
                  <?php } ?>
                </tbody>
                </table>
              </div>
            </div>  
          </fieldset>
          <br>
            <?php if($role == 7 || $role == 8 || $role == 9 || $role == 10){ ?>
          <div ALIGN=right>
              <a href="#requestmodal4" class="btn waves-effect btn-md  modal-trigger Blue z-depth-2" id="sizebutton">REQUEST EXAMINATION</a>                
              
          </div>

          <div id="requestmodal4" class="modal modal-fixed-footer" style="width:30%" ALIGN=center>
            <?php echo form_open('auth/Request_test'); ?>
              <div class="modal-content">

                  <?php $report_type = '6';
                    
                    echo form_hidden('client_id', $client_id);
                    echo form_hidden('sw_id', $sw_id);
                    echo form_hidden('report_type', $report_type);
                    echo form_label('Please state you reason', $Reason['id']);
                    echo form_input($Reason);
                   ?>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col s12"> <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Submit </button> </div>
                  <div class="col s12"><a href="#" class="btn waves-effect red modal-action modal-close" id="sizebutton">Cancel</a></div>
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <?php } ?>
      </div>  
      </div>    
    </div>
  </div>      
</main>