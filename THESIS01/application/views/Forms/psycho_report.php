<?php


$referBy = array(
	'name'	=> 'referBy',
	'id'	=> 'referBy',
	'value' => set_value('referBy'),
);

$referDate = array(
	'name'	=> 'referDate',
	'id'	=> 'referDate',
	'value' => set_value('referDate'),
	'placeholder' => 'yyyy/mm/dd',
);

$referReason = array(
	'name'	=> 'referReason',
	'id'	=> 'referReason',
	'value' => set_value('referReason'),
);

$caseBG = array(
	'name'	=> 'caseBG',
	'id'	=> 'caseBG',
	'value' => set_value('caseBG'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$observedBeh = array(
	'name'	=> 'observedBeh',
	'id'	=> 'observedBeh',
	'value' => set_value('observedBeh'),
	'rows' 	=> '5',
	'cols' 	=> '150',
	'class' => 'materialize-textarea',
);

$intAbility = array(
	'name'	=> 'intAbility',
	'id'	=> 'intAbility',
	'value' => set_value('intAbility'),
);

$emoStat = array(
	'name'	=> 'emoStat',
	'id'	=> 'emoStat',
	'value' => set_value('emoStat'),
);

$impre = array(
	'name'	=> 'impre',
	'id'	=> 'impre',
	'value' => set_value('impre'),
);

$recom = array(
	'name'	=> 'recom',
	'id'	=> 'recom',
	'value' => set_value('recom'),
);

$psycho = array(
	'name'	=> 'psycho',
	'id'	=> 'psycho',
	'value' => set_value('psycho'),
);

$test1 = array(
	'name'	=> 'test1',
	'id'	=> 'test1',
	'value' => set_value('test1'),
);

$test2 = array(
	'name'	=> 'test2',
	'id'	=> 'test2',
	'value' => set_value('test2'),
);

$test3 = array(
	'name'	=> 'test3',
	'id'	=> 'test3',
	'value' => set_value('test3'),
);

$test4 = array(
	'name'	=> 'test4',
	'id'	=> 'test4',
	'value' => set_value('test4'),
);

$test5 = array(
	'name'	=> 'test5',
	'id'	=> 'test5',
	'value' => set_value('test5'),
);

$test6 = array(
	'name'	=> 'test6',
	'id'	=> 'test6',
	'value' => set_value('test6'),
);

$test7 = array(
	'name'	=> 'test7',
	'id'	=> 'test7',
	'value' => set_value('test7'),
);

$test8 = array(
	'name'	=> 'test8',
	'id'	=> 'test8',
	'value' => set_value('test8'),
);

$test9 = array(
	'name'	=> 'test9',
	'id'	=> 'test9',
	'value' => set_value('test9'),
);

$test10 = array(
	'name'	=> 'test10',
	'id'	=> 'test10',
	'value' => set_value('test10'),
);

$dateTest1 = array(
	'name'	=> 'dateTest1',
	'id'	=> 'dateTest1',
	'value' => set_value('dateTest1'),
	'placeholder' => 'yyyy/mm/dd',
);

$dateTest2 = array(
	'name'	=> 'dateTest2',
	'id'	=> 'dateTest2',
	'value' => set_value('dateTest2'),
);

$dateTest3 = array(
	'name'	=> 'dateTest3',
	'id'	=> 'dateTest3',
	'value' => set_value('dateTest3'),
);

$dateTest4 = array(
	'name'	=> 'dateTest4',
	'id'	=> 'dateTest4',
	'value' => set_value('dateTest4'),
);

$dateTest5 = array(
	'name'	=> 'dateTest5',
	'id'	=> 'dateTest5',
	'value' => set_value('dateTest5'),
);

$dateTest6 = array(
	'name'	=> 'dateTest6',
	'id'	=> 'dateTest6',
	'value' => set_value('dateTest6'),
);

$dateTest7 = array(
	'name'	=> 'dateTest7',
	'id'	=> 'dateTest7',
	'value' => set_value('dateTest7'),
);

$dateTest8 = array(
	'name'	=> 'dateTest8',
	'id'	=> 'dateTest8',
	'value' => set_value('dateTest8'),
);

$dateTest9 = array(
	'name'	=> 'dateTest9',
	'id'	=> 'dateTest9',
	'value' => set_value('dateTest9'),
);

$dateTest10 = array(
	'name'	=> 'dateTest10',
	'id'	=> 'dateTest10',
	'value' => set_value('dateTest10'),
);


foreach($client_info as $row_info) 
{
    $client_id      = $row_info->client_id;
    $fname   		= $row_info->client_fname;
    $lname  		= $row_info->client_lname; 
    $mname  		= $row_info->client_mname;
    $educ_attained  = $row_info->educ_attained;
    $gender         = $row_info->gender;
    $birthplace    	= $row_info->birthplace;
    $dorm_id        = $row_info->dorm_id;
    $sw_id          = $row_info->sw_id;
    $religion       = $row_info->religion;
    $birthday   	= $row_info->birthday;
    $admitDate 		= $row_info->created;
    $sector 		= $row_info->client_sector;

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
     	<?php echo form_open("auth/create_psycho"); ?>
      	<fieldset class="z-depth-2">
        	<center><h5 class="bold">PSYCHOLOGICAL REPORT</h5></center>
            <h5 class="divider black"></h5>
           	<div class="form-group">

				<?php echo form_hidden('client_id', $client_id); ?>
				<?php echo "IDENTIFYING INFORMATION"; ?></br>
				<?php echo form_label('Name:'); ?>
				<?php echo $fname." ".$mname." ".$lname; ?></br>
				<?php echo form_label('Birthday:'); ?>
				<?php echo $birthday; ?></br>
				<?php echo form_label('Age:'); ?>
				<?php echo $age; ?></br>
				<?php echo form_label('Gender:'); ?>
				<?php if ($gender == 1){echo "Male";}
				elseif($gender == 2){echo "Female";} ?></br>
				<?php echo form_label('Religion:'); ?>
				<?php echo $religion; ?></br>
				<?php echo form_label('Educational Attainment:'); ?>
				<?php echo $educ_attained; ?><br>
				<?php echo form_hidden('educAttain',$educ_attained); ?>
				<?php echo form_label('Referred by', $referBy['id']); ?>
				<?php echo form_input($referBy); ?>
				<?php echo form_label('Date Referral', $referDate['id']); ?>
				<input type="date" placeholder="Date Referred" name="referDate" class="datepicker">
				<?php echo form_label('Reason for Referral', $referReason['id']); ?>
				<?php echo form_input($referReason); ?>

				<?php echo form_label('Case Background', $caseBG['id']); ?>
				<?php echo form_textarea($caseBG); ?>
				</br>
				<?php echo "EVALUATION PROCEDURES"; ?></br>


				<table class="centered" >
					<thead>
						<tr>
							<th data-field="test">Tests</th>
							<th data-field="dateTest">Date Taken</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo form_input($test1); ?></td>
							<td><input type="date" placeholder="Date of test" name="dateTest1" class="datepicker"></td>
						</tr>
						<tr>
							<td><?php echo form_input($test2); ?></td>
							<td><?php echo form_input($dateTest2); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($test3); ?></td>
							<td><?php echo form_input($dateTest3); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($test4); ?></td>
							<td><?php echo form_input($dateTest4); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($test5); ?></td>
							<td><?php echo form_input($dateTest5); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($test6); ?></td>
							<td><?php echo form_input($dateTest6); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($test7); ?></td>
							<td><?php echo form_input($dateTest7); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($test8); ?></td>
							<td><?php echo form_input($dateTest8); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($test9); ?></td>
							<td><?php echo form_input($dateTest9); ?></td>
						</tr>
						<tr>
							<td><?php echo form_input($test10); ?></td>
							<td><?php echo form_input($dateTest10); ?></td>
						</tr>
					</tbody>
				</table>

				<?php echo form_label('Behavioral Observation', $observedBeh['id']); ?>
				<?php echo form_textarea($observedBeh); ?>

				<?php echo "FINDINGS"; ?></br>
				<?php echo form_label('Intellectual Ability', $intAbility['id']); ?>
				<?php echo form_input($intAbility); ?>
				<?php echo form_label('Emotional Status', $emoStat['id']); ?>
				<?php echo form_input($emoStat); ?>
				<?php echo form_label('Impression', $impre['id']); ?>
				<?php echo form_input($impre); ?>
				<?php echo form_label('Recommendation', $recom['id']); ?>
				<?php echo form_input($recom); ?>

				<?php echo "Prepared by"; ?></br>
				<u><?php echo "button here for e-signature"; ?></u></br>
				<?php echo "Name of the psychologist"; ?></br>
				<?php echo form_label('Psychologist'); ?>

			<div>
           		<button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
            </div>
            </fieldset>
               		<?php echo form_close(); ?>
        </div>
    </div>
</main>

 	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>