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

foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $gender         = $row_info->gender;
    $birth_place    = $row_info->birthplace;
    $d_name       = $row_info->d_name;
    $sw_id          = $row_info->sw_id;
    $birthday       = $row_info->birthday;
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
	  		<div class="row">
                <div>
                        
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
                      <label >Dorm: <?php echo $d_name; ?></label>
                          <br>                       
                      </div>
                      <br>                  
                <?php 
                    $Physical = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Physical Therapy Reports' . DIRECTORY_SEPARATOR;
                    $Social = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Social Case Reports' . DIRECTORY_SEPARATOR;
                    $House = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'House Reports' . DIRECTORY_SEPARATOR;
                    $medical = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Medical Reports' . DIRECTORY_SEPARATOR;
                    $psychiatric = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Psychiatric Reports' . DIRECTORY_SEPARATOR;
                    $psychological = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'Psychological Reports' . DIRECTORY_SEPARATOR;
                    $Discharge = "./uploads". DIRECTORY_SEPARATOR . $client_id . DIRECTORY_SEPARATOR . 'General Documents' . DIRECTORY_SEPARATOR;
                ?>
                </div>
	  		
                <div class="col s12">
                      <div class="panel-body">
                        <div class="col s12">
                            <ul class="tabs" data-persist="true">
                              
                                <li class="tab col "><a href="#view1">General Reports</a></li>
                                <li class="tab col "><a href="#view7">Social Case Studies</a></li>
                                <li class="tab col "><a href="#view2">Medical</a></li>
                                <li class="tab col "><a href="#view3">Psychiatric</a></li>
                                <li class="tab col "><a href="#view4">Psychological</a></li>
                                <li class="tab col "><a href="#view5">Physical Therapy</a></li>
                                <li class="tab col "><a href="#view6">Home Life</a></li>

                            </ul> 
                        </div>


                            <div class="tabcontents" >
                                
                                <div id="view1">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach($file_GD as $row_files) { ?>
                                        
                                        <tr class="odd gradeX">
                                            
                                            <td><?php echo $row_files; ?></td>
                                            <?php echo form_open('auth/read_test'); ?>
                                            <?php echo form_hidden('path', $Discharge.$row_files); 
                                                    echo form_hidden('sw_id', $sw_id);
                                                    echo form_hidden('file', $row_files); ?>

                                            <td><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                                          
                                        </tr>
                                          <?php echo form_close(); ?>
                                         <?php } ?>

                                         <?php foreach($document_list as $document) { ?>
                                        <tr>
                                              <td><?php echo $document->file_name; ?></td>
                                              
                                              <td>
                                                <button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">view</button>
                                              </td>
                                        </tr>
                                         <?php } ?>
                                    </tbody>
                                    </table>
                                </div>
                                <div id="view2">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      
                                    	<?php foreach($file_MR as $row_files) { ?>
                                        
                                        <tr class="odd gradeX">
                                            
                                            <td><?php echo $row_files; ?></td>
                                            <?php echo form_open('auth/read_test'); ?>
                                            <?php echo form_hidden('path', $medical.$row_files); 
                                                    echo form_hidden('sw_id', $sw_id);
                                                    echo form_hidden('file', $row_files); ?>

                                           <td><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                                        </tr>
                                        <?php echo form_close(); ?>
                                         <?php } ?>
                                    </tbody>
                                    </table>
                                </br>
                                </div>
                                <div id="view3">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                       <?php foreach($file_PsychiR as $row_files) { ?>
                                        
                                        <tr class="odd gradeX">
                                            
                                            <td><?php echo $row_files; ?></td>
                                                <?php echo form_open('auth/read_test'); ?>
                                                <?php echo form_hidden('path', $psychiatric.$row_files); 
                                                    echo form_hidden('sw_id', $sw_id);
                                                    echo form_hidden('file', $row_files); ?>

                                           <td><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                                        </tr>
                                        <?php echo form_close(); ?>
                                         <?php } ?>
                                    </tbody>
                                    </table>
                                </div>
                                <div id="view4">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                  
                                       
                                       <?php foreach($file_PsychoR as $row_files) { ?>
                                       
                                        <tr class="odd gradeX">
                                            
                                            <td><?php echo $row_files; ?></td>
                                                <?php echo form_open('auth/read_test'); ?>
                                                <?php echo form_hidden('path', $psychological.$row_files); 
                                                    echo form_hidden('sw_id', $sw_id);
                                                    echo form_hidden('file', $row_files); ?>

                                           <td><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                                        </tr>
                                        <?php echo form_close(); ?>
                                         <?php } ?>
                                    </tbody>
                                    </table>
                                </div>
                                <div id="view5">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                  
                                       
                                       <?php foreach($file_Physical as $row_files) { ?>
                                       
                                        <tr class="odd gradeX">
                                            
                                            <td><?php echo $row_files; ?></td>
                                                <?php echo form_open('auth/read_test'); ?>
                                                <?php echo form_hidden('path', $Physical.$row_files); 
                                                    echo form_hidden('sw_id', $sw_id);
                                                    echo form_hidden('file', $row_files); ?>

                                           <td><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                                        </tr>
                                        <?php echo form_close(); ?>
                                         <?php } ?>
                                    </tbody>
                                    </table>
                                </div>
                                <div id="view6">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                  
                                       
                                       <?php foreach($file_House as $row_files) { ?>
                                       
                                        <tr class="odd gradeX">
                                            
                                            <td><?php echo $row_files; ?></td>
                                                <?php echo form_open('auth/read_test'); ?>
                                                <?php echo form_hidden('path', $House.$row_files); 
                                                    echo form_hidden('sw_id', $sw_id);
                                                    echo form_hidden('file', $row_files); ?>

                                           <td><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                                        </tr>
                                        <?php echo form_close(); ?>
                                         <?php } ?>
                                         <?php foreach($home_plans as $home_plan){ ?>
                                        <?php 
                                        echo form_open('auth/view_indi_home_plan'); 
                                        echo form_hidden('home_plan_id', $home_plan->home_plan_id);
                                        echo form_hidden('client_id', $home_plan->client_id);?><tr>
                                          <td><?php echo date('M d Y', strtotime($home_plan->created)); ?></td>
                                          <td><button class="btn  waves-effect btn-md  green z-depth-2" type="submit" name="action">View</button></td>
                                        </tr>
                                          <?php echo form_close(); } ?>
                                       
                                    </tbody>
                                    </table>
                                    </div>
                                <div id="view7">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File name</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                  
                                       
                                       <?php foreach($file_Social as $row_files) { ?>
                                       
                                        <tr class="odd gradeX">
                                            
                                            <td><?php echo $row_files; ?></td>
                                                <?php echo form_open('auth/read_test'); ?>
                                                <?php echo form_hidden('path', $Social.$row_files); 
                                                    echo form_hidden('sw_id', $sw_id);
                                                    echo form_hidden('file', $row_files); ?>

                                           <td><button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button></td>
                                        </tr>
                                        <?php echo form_close(); ?>
                                         <?php } ?>
                                         <?php foreach($social_case as $row_social)
                                         {
                                          echo '<tr>'.form_open('auth/mpdf_social_case');
                                          echo form_hidden('client_id', $client_id);
                                          echo form_hidden('social_id', $row_social->social_case_id);
                                          echo '<td>Social Case Study Report</td>';
                                          

                                          echo ' <td><button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">view</button></td>';
                                          echo form_close().'</tr>';
                                         }
                                         ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
<main>
