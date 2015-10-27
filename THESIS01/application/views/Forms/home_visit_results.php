<?php

$response = array(
	'name'	=> 'response',
	'id'	=> 'response',
	'value'	=> set_value('response'),
);

$visitDate = array(
	'name'	=> 'visitDate',
	'id'	=> 'visitDate',
	'value'	=> set_value('visitDate'),
	'placeholder' => 'yyyy/mm/dd',
);

$visitPlace = array(
	'name'	=> 'visitPlace',
	'id'	=> 'visitPlace',
	'value'	=> set_value('visitPlace'),
);

$obj = array(
	'name'	=> 'obj',
	'id'	=> 'obj',
	'value' => set_value('obj'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$narra = array(
	'name'	=> 'narra',
	'id'	=> 'narra',
	'value' => set_value('narra'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$assess = array(
	'name'	=> 'assess',
	'id'	=> 'assess',
	'value' => set_value('assess'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$actionPlan = array(
	'name'	=> 'actionPlan',
	'id'	=> 'actionPlan',
	'value' => set_value('actionPlan'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);
foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $birthday       = $row_info->birthday;
    $gender         = $row_info->gender;
    $birth_place    = $row_info->birthplace;
    $dorm_id        = $row_info->dorm_id;
    $sw_id          = $row_info->sw_id;
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

<main >

 <div class="container">
    <div class="row">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');?>
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

                     	<?php echo form_open("auth/home_visit_report"); ?>

                        	<center><h5 class="bold">HOME VISIT FEEDBACK REPORT</h5></center>
                            <h5 class="divider black"></h5>
                           	<div class="form-group">
                           		
                				<?php echo form_hidden('client_id', $client_id); ?>
                				<?php echo form_label('Re', $response['id']); ?>
                				<?php echo form_input($response);?>
                				<?php echo form_label('Date of Visit', $visitDate['id']); ?>
                				<input type="text" name="visitDate" id="datepicker">
                				<?php echo form_label('Place of Visit', $visitPlace['id']); ?>
                				<?php echo form_input($visitPlace);?>
                				<?php echo form_label('Objective', $obj['id']); ?>
                				<?php echo form_textarea($obj);?>
                				<?php echo form_label('Narrative', $narra['id']); ?>
                				<?php echo form_textarea($narra);?>
                				<?php echo form_label('Assessment', $assess['id']); ?>
                				<?php echo form_textarea($assess);?>
                				<?php echo form_label('Plan of Action', $actionPlan['id']); ?>
                				<?php echo form_textarea($actionPlan);?>


			<div>
           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
            </div>
            </fieldset>
               		<?php echo form_close(); ?>
               	</div>
        </div>
    </div>
</main>


<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
</script>