<?php
$gestationAge = array(
	'name'	=> 'gestationAge',
	'id'	=> 'gestationAge',
	'value'	=> set_value('gestationAge'),
);

$deliType = array(
	'name'	=> 'deliType',
	'id'	=> 'deliType',
	'value'	=> set_value('deliType'),
);


$forcep = array(
	'name'	=> 'forcep',
	'id'	=> 'forcep',
	'value'	=> set_value('forcep'),
);

$bornAt = array(
	'name'	=> 'bornAt',
	'id'	=> 'bornAt',
	'value'	=> set_value('bornAt'),
);

$deliverBy = array(
	'name'	=> 'deliverBy',
	'id'	=> 'deliverBy',
	'value'	=> set_value('deliverBy'),
);

$deliverName = array(
	'name'	=> 'deliverName',
	'id'	=> 'deliverName',
	'value'	=> set_value('deliverName'),
);

$compli = array(
	'name'	=> 'compli',
	'id'	=> 'compli',
	'value'	=> set_value('compli'),
);

$weightBirth = array(
	'name'	=> 'weightBirth',
	'id'	=> 'weightBirth',
	'value'	=> set_value('weightBirth'),
);

$lengthBirth = array(
	'name'	=> 'lengthBirth',
	'id'	=> 'lengthBirth',
	'value'	=> set_value('lengthBirth'),
);

$headCirBirth = array(
	'name'	=> 'headCirBirth',
	'id'	=> 'headCirBirth',
	'value'	=> set_value('headCirBirth'),
);

$chestCirBirth = array(
	'name'	=> 'chestCirBirth',
	'id'	=> 'chestCirBirth',
	'value'	=> set_value('chestCirBirth'),
);

$apgarScore = array(
	'name'	=> 'apgarScore',
	'id'	=> 'apgarScore',
	'value'	=> set_value('apgarScore'),
);

$abnormalBirth = array(
	'name'	=> 'abnormalBirth',
	'id'	=> 'abnormalBirth',
	'value'	=> set_value('abnormalBirth'),
);

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

<main >

 <div class="container">
     <div class="row">
       <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/Nurse/side_bar_custody.php'); ?>
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
	       
	      	
	      	<?php 

			foreach($birth_info as $info){
			   
			    $forcep_db = $info->forcep; 
			    $born_at = $info->born_at;
			    $deliver_by = $info->deliver_by; 
			    $deliver_name = $info->deliver_name;
			    $complication_db = $info->complication; 
			    $weight_birth = $info->weight_birth;
			    $length_birth = $info->length_birth; 
			    $head_cir_birth = $info->head_cir_birth;
			    $chest_cir_birth = $info->chest_cir_birth; 
			    $apgar_score = $info->apgar_score;
			    $abnormal_birth = $info->abnormal_birth; 
			    
			}

			if($birth_info == null)
			{
			$forcep_db = "No data";

			$born_at = "No data";
			$deliver_by = "No data";

			$deliver_name = "No data";
			$complication_db = "No data";
			$weight_birth = "No data";
			$length_birth = "No data";
			$head_cir_birth = "No data ";
			$chest_cir_birth = "No data ";
			$apgar_score = "No data ";
			$abnormal_birth = "No data ";
			}
			else
			{
				if(is_null($forcep_db)){$forcep_db = 'unknown';}
				if(is_null($born_at)){$born_at = 'unknown';}
				if(is_null($deliver_by)){$deliver_by = 'unknown';}
				if(is_null($complication_db)){$complication_db = 'unknown';}
				if(is_null($weight_birth)){$weight_birth = 'unknown';}
				if(is_null($length_birth)){$length_birth = 'unknown';}
				if(is_null($head_cir_birth)){$head_cir_birth = 'unknown';}
				if(is_null($chest_cir_birth)){$chest_cir_birth = 'unknown';}
				if(is_null($apgar_score)){$apgar_score = 'unknown';}
				if(is_null($abnormal_birth)){$abnormal_birth = 'unknown';}

			}
		
			
	      	?>
	      	
	      	
	          <center>
	            <h5 class="bold">Previous Input</h5>
	          </center>
	          <h5 class="divider black"></h5>
	          <div class="form-group">
	          	<div class="row">
		          	<div class="col s6">
			           
			            <label >Forceps:  <?php echo $forcep_db; ?> </label>
			            <br>
			            <label>Delivered by:  <?php echo $deliver_name." (".$deliver_by.")"; ?></label>
			            <br>
			            <label>Birth weight: <?php echo $weight_birth; ?></label>
			            <br>
			            <label>Head Circumference: <?php echo $head_cir_birth; ?></label>
			            <br>
			            <label>Apgar Score: <?php echo $apgar_score; ?></label>
			            <br>

			        </div>
					<div class="col s6">
			            
			            <label>Born At: <?php echo $born_at; ?></label>
			            <br>
			            <label>Complications: <?php echo $complication_db; ?></label>
			            <br>
			            <label>Length: <?php echo $length_birth; ?></label>
			            <br>
			            <label>Chest Circumference:  <?php echo $chest_cir_birth; ?></label>
			            <br>
			            <label>Abnormalities at birth: <?php echo $abnormal_birth; ?></label>
			            <br>
		            </div>
	            </div>         
	          </div>
	        
	        
     	<?php echo form_open("auth/insert_birth_history"); ?>
    
        	<center><h5 class="bold">BIRTH HISTORY</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<?php echo form_hidden('client_id', $client_id);
				?>

					<div class="input-field col s6 ">
					Born at<br>
					<input type="radio" name="bornAt" value="home" id="bornHome" class="with-gap"><label for="bornHome">Home</label>
					<input type="radio" name="bornAt" value="hospital" id="bornHos" class="with-gap"><label for="bornHos">Hospital</label>
					<input type="radio" name="bornAt" value="other" id="bornOth" class="with-gap"><label for="bornOth">Other</label>
					</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Forceps ', $forcep['id']); ?>
				<?php echo form_input($forcep); ?>
				</div>
					<div class="input-field col s6 ">
					<input type="radio" name="deliverBy" value="Midwife" id="deliMidwife" class="with-gap"><label for="deliMidwife">Midwife</label>
					<input type="radio" name="deliverBy" value="Nurse" id="deliNurse" class="with-gap"><label for="deliNurse">Nurse</label>
					<input type="radio" name="deliverBy" value="Self" id="deliSelf" class="with-gap"><label for="deliSelf">Self</label>
					<input type="radio" name="deliverBy" value="Others" id="deliOthers" class="with-gap"><label for="deliOthers">Others</label>
					</div>

					<div class="input-field col s6 ">
					<?php echo form_label('Delivered by (name)', $deliverName['id']); ?>
					<?php echo form_input($deliverName, $deliverName['id']); ?>
					</div>


				<div class="input-field col s6 ">
				<?php echo form_label('Complications ', $compli['id']); ?>
				<?php echo form_input($compli); ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Birth weight ', $weightBirth['id']); ?>
				<?php echo form_input($weightBirth); ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Length ', $lengthBirth['id']); ?>
				<?php echo form_input($lengthBirth); ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Head circumference ', $headCirBirth['id']); ?>
				<?php echo form_input($headCirBirth); ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Chest circumference ', $chestCirBirth['id']); ?>
				<?php echo form_input($chestCirBirth); ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Apgar Score ', $apgarScore['id']); ?>
				<?php echo form_input($apgarScore); ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Abnormalities at birth (please describe)', $abnormalBirth['id']); ?>
				<?php echo form_input($abnormalBirth); ?>
				</div>
				
				<div>
           			<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
           	 	</div>
			</div>
        </fieldset>
               		<?php echo form_close(); ?>
	    </div>
	</div>
	</div>
</main>