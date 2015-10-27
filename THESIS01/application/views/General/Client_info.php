<div class="form-group">
	<?php if($profile_pic == null)
	{ ?>
	<img width="200px" height="200px"src="<?php echo base_url(); ?>materialize/title logo.png" class=" left"> 
	<?php 
	} 
	else{ ?>
	<img width="200px" height="200px"src="<?php echo base_url();echo $profile_pic; ?>" class=" left"> 
	<?php } ?><label >Name: <?php echo $fname." ".$lname; ?> </label>
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
<br><br>
<br><br>