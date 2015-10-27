<?php
include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/General/Client_data.php');
?>
<main >

	 <div class="container">
	    <div class="row">
	    <?php include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/Nurse/side_bar_history.php'); ?>
	    	<div class="col s10">
	        <fieldset class="z-depth-1">
	          <?php include($_SERVER['DOCUMENT_ROOT'].'CIO/THESIS01/application/views/General/Client_info_nurse.php'); ?>
	      	    Growth Record
				<table class="table table-striped centered table-hover" >
                    <thead>
                        <tr>
                            <th >Date Added</th>
                            <th >Year / Month</th>
                            <th >Age in Months</th>
                            <th >Weight (kilos)</th>
                            <th >Length/Height (cm/feet)</th>
                            <th >HC (cm)</th>
                            <th >CC (cm)</th>
                            <th >Teeth</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($growth_info as $info){ ?>
                            <tr>
                                <td><?php echo date('M-d-Y',strtotime($info->created)); ?></td>
                                <td><?php echo $info->year_month;  ?></td>
                                <td><?php echo $info->age_month; ?></td>
                                <td><?php echo $info->weight_kilos;  ?></td>
                                <td><?php echo $info->length_height;  ?></td>
                                <td><?php echo $info->HC_cm;  ?></td>
                                <td><?php echo $info->CC_cm;  ?></td>
                                <td><?php echo $info->teeth;  ?></td>
                            </tr>
                            <?php } ?>

                        <?php if($growth_info == null){ ?><tr><td colspan="8"><h6>No data </h6></td></tr> <?php } ?>
                    </tbody>
                </table>
                <br>
                Impairments
                <br>
                <table class="table table-striped centered table-hover" >
                    <thead>
                        <tr>
                            <th >Date Added</th>
                            <th >Body Part</th>
                            <th >Observation</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($impair_info as $info){ ?>
                            <tr>
                                <td><?php echo date('M-d-Y',strtotime($info->created)); ?></td>
                                <td><?php echo $info->body_part;  ?></td>
                                <td><?php echo $info->observation; ?></td>
                               
                            </tr>
                            <?php } ?>

                        <?php if($impair_info == null){ ?><tr><td colspan="3"><h6>No data </h6></td></tr> <?php } ?>
                    </tbody>
                </table>
	      	</div>
	    	 </fieldset>
            </div>
	    </div>
	</div>
</main>
