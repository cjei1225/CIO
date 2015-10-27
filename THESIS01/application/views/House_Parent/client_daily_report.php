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

foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $gender         = $row_info->gender;
    $birth_place    = $row_info->birthplace;
    $dorm_id        = $row_info->d_name;
    $sw_id          = $row_info->sw_id;
    $birthday       = $row_info->birthday;
    $sector         = $row_info->client_sector;
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
              <div>
                <div class="panel-body" style="height:100%;" >
                  <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside" OnClick="goBack();">Back</button>                   
                 </div>
              </div>
            </div>
          </div> 



          <div class="col s10">
              <fieldset class="z-depth-2">
                  <center>
                    <h5 class="bold">House Reports</h5>
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

                          
           
                                <table class="table centered striped bordered hoverable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Created by</th>
                                            <th>Date:
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach($house_reports as $row_house_report) { ?>
                                        <tr>
                                              <td><?php echo $row_house_report->first_name." ".$row_house_report->last_name; ?></td>
                                              <td><?php echo date('F d Y', strtotime($row_house_report->house_date)); ?>
                                              <td><?php echo $row_house_report->remark; ?></td>
                                        </tr>
                                         <?php } ?>
                                    </tbody>
                                </table>
              </fieldset>
          </div>
      </div>
  </main>