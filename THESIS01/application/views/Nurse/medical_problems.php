<?php
$medClient = array(
	'name'	=> 'medClient',
	'id'	=> 'medClient',
	'value'	=> set_value('medClient'),
);

$medTake = array(
	'name'	=> 'medTake',
	'id'	=> 'medTake',
	'value'	=> set_value('medTake'),
);

$medPhysician = array(
	'name'	=> 'medPhysician',
	'id'	=> 'medPhysician',
	'value'	=> set_value('medPhysician'),
);

$medReason = array(
	'name'	=> 'medReason',
	'id'	=> 'medReason',
	'value'	=> set_value('medReason'),
);

$medSeizure = array(
	'name'	=> 'medSeizure',
	'id'	=> 'medSeizure',
	'value'	=> set_value('medSeizure'),
);

$medChronic = array(
	'name'	=> 'medChronic',
	'id'	=> 'medChronic',
	'value'	=> set_value('medChronic'),
);

$medAllergic = array(
	'name'	=> 'medAllergic',
	'id'	=> 'medAllergic',
	'value'	=> set_value('medAllergic'),
);

$medAllergicMed = array(
	'name'	=> 'medAllergicMed',
	'id'	=> 'medAllergicMed',
	'value'	=> set_value('medAllergicMed'),
);

$dentalHealth = array(
	'name'	=> 'dentalHealth',
	'id'	=> 'dentalHealth',
	'value'	=> set_value('dentalHealth'),
);

$dentalProgress = array(
	'name'	=> 'dentalProgress',
	'id'	=> 'dentalProgress',
	'value'	=> set_value('dentalProgress'),
);

include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/General/Client_data.php');
?>

<main >

 <div class="container">
     <div class="row">
	     <?php include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/Nurse/side_bar_custody.php'); ?>
        <div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/General/Client_info_nurse.php'); ?>
     	<?php echo form_open("auth/insert_medical_problems"); ?>
      
        	<center><h5 class="bold">MEDICAL PROBLEMS</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">
           		<?php echo form_hidden('client_id', $client_id);		
				?>

                <div class="input-field col s6 ">
				Is the client on medication? <br>
				<input type="radio" name="medClient" value="Yes" id="medYes" class="with-gap"><label for="medYes">Yes</label>
                <input type="radio" name="medClient" value="No" id="medNo" class="with-gap"><label for="medNo">No</label>
                <input type="radio" name="medClient" value="Not sure" id="mednotsure" class="with-gap"><label for="mednotsure">Not sure</label>
                </div>
                <div class="input-field col s6 ">
				<?php echo form_label('If yes, what medication, dosage, times per day ', $medTake['id']); ?>
				<?php echo form_input($medTake); ?>
                </div>
                <div class="input-field col s6 ">
				<?php echo form_label('Who prescribed it? ', $medPhysician['id']); ?>
				<?php echo form_input($medPhysician); ?>
                </div>
                <div class="input-field col s6 ">
				<?php echo form_label('Why?', $medReason['id']); ?>
				<?php echo form_input($medReason); ?>
                </div>
                <div class="input-field col s6 ">
				Is the client known to have seizures?<br>
				<input type="radio" name="medSeizure" value="Yes" id="seiYes" class="with-gap"><label for="seiYes">Yes</label>
                <input type="radio" name="medSeizure" value="No" id="seiNo" class="with-gap"><label for="seiNo">No</label>
                <input type="radio" name="medSeizure" value="Not sure" id="seiNotsure" class="with-gap"><label for="seiNotsure">Not sure</label>
                </div>
                <div class="input-field col s6 ">
				<?php echo form_label('Any chronic illnesses or contagious diseases known? ', $medChronic['id']); ?>
				<?php echo form_input($medChronic); ?>
                </div>
                <div class="input-field col s6 ">
				Is the client allergic to any particular type of medication?<br>
				<input type="radio" name="medAllergic" value="Yes" id="medAYes" class="with-gap"><label for="medAYes">Yes</label>
                <input type="radio" name="medAllergic" value="No" id="medANo" class="with-gap"><label for="medANo">No</label>
                <input type="radio" name="medAllergic" value="Not sure" id="medAnotsure" class="with-gap"><label for="medAnotsure">Not sure</label>
                </div>
                <div class="input-field col s6 ">
				<?php echo form_label('If yes, please indicate: ', $medAllergicMed['id']); ?>
				<?php echo form_input($medAllergicMed); ?>
                </div>
                <div class="input-field col s6 ">
				Dental Health <br>
				<input type="radio" name="dentalHealth" value="good" id="dentGood" class="with-gap"><label for="dentGood">Good</label>
				<input type="radio" name="dentalHealth" value="fair" id="dentFair" class="with-gap"><label for="dentFair">Fair</label>
				<input type="radio" name="dentalHealth" value="poor" id="dentPoor" class="with-gap"><label for="dentPoor">Poor</label>
                </div>
                <div class="input-field col s6 ">
				<?php echo form_label('Is dental care in progress? ', $dentalProgress['id']); ?>
				<?php echo form_input($dentalProgress); ?>
				</div>
				<div>
           			<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Next</button>
           	 	</div>
			</div>
        </fieldset>
               		<?php echo form_close(); ?>
	    	</div>
	    </div>
	</div>
</main>