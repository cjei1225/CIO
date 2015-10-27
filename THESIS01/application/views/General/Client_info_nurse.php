<center>
<h5 class="bold">Client Information</h5>
</center>
<h5 class="divider black"></h5>
<div class="form-group">
	<?php if($profile_pic == null)
	{ ?>
	<img width="200px" height="200px"src="<?php echo base_url(); ?>materialize/title logo.png" class=" left"> 
	<?php 
	} 
	else{ ?>
	<img width="200px" height="200px"src="<?php echo base_url();echo $profile_pic; ?>" class=" left"> 
	<?php } ?> <label >Name: <?php echo $fname." ".$lname; ?> </label>
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
	<br>                       
</div>
<br>  <br>  