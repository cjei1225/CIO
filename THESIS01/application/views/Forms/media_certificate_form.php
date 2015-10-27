<?php

$skin = array(
	'name'	=> 'skin',
	'id'	=> 'skin',
	'value'	=> set_value('skin'),
);
$bodyBuilt = array(
	'name'	=> 'bodyBuilt',
	'id'	=> 'bodyBuilt',
	'value'	=> set_value('bodyBuilt'),
);
$healthStat = array(
	'name'	=> 'healthStat',
	'id'	=> 'healthStat',
	'value'	=> set_value('healthStat'),
);

$bioMom = array(
	'name'	=> 'bioMom',
	'id'	=> 'bioMom',
	'value'	=> set_value('bioMom'),
);
$lastAdd = array(
	'name'	=> 'lastAdd',
	'id'	=> 'lastAdd',
	'value'	=> set_value('lastAdd'),
);
$bioDad = array(
	'name'	=> 'bioDad',
	'id'	=> 'bioDad',
	'value'	=> set_value('bioDad'),
);
$foundDate = array(
	'name'	=> 'foundDate',
	'id'	=> 'foundDate',
	'value'	=> set_value('foundDate'),
	'placeholder' => 'yyyy/mm/dd',
);
$foundPlace = array(
	'name'	=> 'foundPlace',
	'id'	=> 'foundPlace',
	'value'	=> set_value('foundPlace'),
);
$foundPerson = array(
	'name'	=> 'foundPerson',
	'id'	=> 'foundPerson',
	'value'	=> set_value('foundPerson'),
);
$foundPerAdd = array(
	'name'	=> 'foundPerAdd',
	'id'	=> 'foundPerAdd',
	'value'	=> set_value('foundPerAdd'),
);
$tvRadioProg = array(
	'name'	=> 'tvRadioProg',
	'id'	=> 'tvRadioProg',
	'value'	=> set_value('tvRadioProg'),
);
$airedTime = array(
	'name'	=> 'airedTime',
	'id'	=> 'airedTime',
	'value'	=> set_value('airedTime'),
);
$airedDate = array(
	'name'	=> 'airedDate',
	'id'	=> 'airedDate',
	'value'	=> set_value('airedDate'),
	'placeholder' => 'yyyy/mm/dd',
);
$announcer = array(
	'name'	=> 'announcer',
	'id'	=> 'announcer',
	'value'	=> set_value('announcer'),
);
$person1 = array(
	'name'	=> 'person1',
	'id'	=> 'person1',
	'value'	=> set_value('person1'),
);
$person2 = array(
	'name'	=> 'person2',
	'id'	=> 'person2',
	'value'	=> set_value('person2'),
);
$person3 = array(
	'name'	=> 'person3',
	'id'	=> 'person3',
	'value'	=> set_value('person3'),
);
        

foreach($complete_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname          = $row_info->client_fname;
    $lname          = $row_info->client_lname;
    $mname          = $row_info->client_mname;
    $present_add	= $row_info->present_add;
    $nickname       = $row_info->nickname;
    $gender         = $row_info->gender;
    $birthday       = $row_info->birthday;
    $birthplace     = $row_info->birthplace;
    $sector         = $row_info->client_sector;
    $sw_id          = $row_info->sw_id;
    $admitDate      = $row_info->created;
    $health_stat 	= $row_info->health_stat;
    $weight 		= $row_info->weight;
    $height 		= $row_info->height;
    $mark 			=$row_info->marks_physical;
    $skin_color		= $row_info->skin_color;
  $admission_type = $row_info->admission_type;


  $founder_name		= $row_info->founder_name;
  $founder_address	= $row_info->founder_address;
  $found_date		= $row_info->founder_when;
  $found_place		= $row_info->founder_where;
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
    <div id="loginsize">
     	<?php echo form_open("auth/create_media"); ?>
      	<fieldset class="z-depth-2">
        	<center><h5 class="bold">MEDIA CERTIFICATION Form</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<div class="row">



				<?php echo form_hidden('client_id', $client_id); ?>
				<div class=" col s6 ">
				<?php echo form_label('Name'); ?>
				<?php echo form_hidden($fname." ".$mname." ".$lname);
				 echo $fname." ".$mname." ".$lname; ?>
				</div>
				<div class="col s6 ">
				<?php echo form_label('Alias'); ?>
				<?php echo $nickname; ?>
				</div>
				<div class="col s6 ">
				<?php echo form_label('Age'); ?>
				<?php echo $age; ?>
				</div>
				<div class="col s6 ">
				<?php echo form_label('Place of Birth'); ?>
				<?php echo $birthplace; ?>
				</div>
				<div class="col s6 ">				
				<?php echo form_label('Date of Birth'); ?>
				<?php echo $birthday; ?>
				</div>
				<div class="col s6 ">				
				<?php echo form_label('Weight'); ?>
				<?php echo $weight;?>
				</div>
				<div class="col s6 ">				
				<?php echo form_label('Height'); ?>
				<?php echo $height;?>
				</div>
				<div class="col s6 ">				
				<?php echo form_label('Complexion'); ?>
				<?php echo $skin_color;?>
				</div>
				<div class="col s6 ">				
				<?php echo form_label('Health Status'); ?>
				<?php echo $health_stat;?>
				</div>
				<div class="col s6 ">				
				<?php echo form_label('Distinguishing Mark/s Disability:'); ?>
				<?php echo $mark;?>
				</div>
				<div class="col s6 ">
				<?php echo form_label('Date Found'); ?>
				<?php echo $found_date;?>
				</div>
				<div class="col s6 ">
				<?php echo form_label('Place Found '); ?>
				<?php echo $found_place;?>
				</div>
				<div class=" col s6 ">
				<?php echo form_label('Person Who Found the Child'); ?>
				<?php echo $founder_name; ?>
				</div>
				<div class="col s6 ">
				<?php echo form_label('Address of Founder'); ?>
				<?php echo $founder_address; ?>
				</div>
				<div class=" col s6 ">
				<?php echo form_label('Last Known Address'); ?>
				<?php echo $present_add;?>
				</div>
				<div class="input-field col s6 ">				
				<?php echo form_label('Body Built', $bodyBuilt['id']); ?>
				<?php echo form_input($bodyBuilt);?>
				</div>
				<div class="input-field col s6 ">		
				<?php echo form_label('Biological Mother’s Name', $bioMom['id']); ?>
				<?php echo form_input($bioMom);?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Biological Father’s Name', $bioDad['id']); ?>
				<?php echo form_input($bioDad);?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('TV/ Radio Program', $tvRadioProg['id']); ?>
				<?php echo form_input($tvRadioProg); ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Time Aired', $airedTime['id']); ?>
				<?php echo form_input($airedTime); ?>
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Date Aired', $airedDate['id']); ?>
				<input type="date" name="airedDate" class="datepicker">
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Announcer', $announcer['id']); ?>
				<?php echo form_input($announcer); ?>

				</div>
				<div class="col s12 center" ><?php echo "WITNESS"; ?></div>
						
				<div class="input-field col s6 ">
				<?php echo form_label('Witness', $person1['id']); ?><?php echo form_input($person1); ?>
				
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Witness', $person2['id']); ?><?php echo form_input($person2); ?>
				
				</div>
				<div class="input-field col s6 ">
				<?php echo form_label('Witness', $person3['id']); ?><?php echo form_input($person3); ?>
				</div>
			</div>
			<div>
           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
            </div>
            </fieldset>
               		<?php echo form_close(); ?>
        </div>
    </div>
</main>
