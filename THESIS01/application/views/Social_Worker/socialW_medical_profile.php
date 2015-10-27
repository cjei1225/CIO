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
    'length' => 20,
);


foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   = $row_info->client_fname;
    $lname   = $row_info->client_lname;
    $age            = $row_info->age;
    $gender         = $row_info->gender;
    $birth_place     = $row_info->birthplace;
    $dorm_id        = $row_info->dorm_id;
}
                        $file = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'General Documents' . DIRECTORY_SEPARATOR; 
                        $medical = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Medical Reports' . DIRECTORY_SEPARATOR;
                        $psychiatric = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Psychiatric Reports' . DIRECTORY_SEPARATOR;
                        $psychological = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Psychological Reports' . DIRECTORY_SEPARATOR; 


?>

  <main>
      <div class="container">
          <div class="col s12">
              <fieldset class="z-depth-2">
                  <center>
                    <h5 class="bold">Medical Background</h5>
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
                    
                    <center><h5 class="bold">UPLOADED FILE</h5></center>
                    <h5 class="divider black"></h5>
                    <div class="form-group">
                      <div class="table-responsive">
                        <table class="table centered striped bordered hoverable" id="dataTables-example">
                          <thead>
                            <tr>
                              <th data-field="name">Uploaded By</th>
                              <th data-field="Date">Uploaded On</th>
                              <th data-field="File"> File</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Alvin</td>
                              <td>Male</td>
                              <td><a <button type="button" class="btn waves-effect btn-md  blue z-depth-2" onClick="Client()"> Download</button></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  <div ALiGN=right>
                    <a href="socialW_medical" class="btn waves-effect btn-md  red z-depth-2" id="sizebutton">BACK</a>
                  </div>
              </fieldset>
          </div>
      </div>
  </main>