<?php

$referral =  'referral';
?>







<main >
	<div class="container">
	    <ul class="menu">
	        <li><a href="#" class="active"><span>Step 1:The client is?</span></a></li>
	        <li><a href="#" target="_self"><span>Step 2:Sector</span></a></li>
	        <li><a href="#"><span>Step 3: General Intake</span></a></li>
	        <li><a href="#"><span>Step 4: Upload Documents</span></a></li>
	  	</ul>
	</div>
    <div class="container">
        <div id="loginsize" style="margin-top:-120px; width:70%;">
          	<fieldset class="z-depth-2">
            	<center><h5 class="bold">The Client is?</h5></center>
                <h5 class="divider black"></h5>
                <div class="row">
	                <div class="col s6">
	                 	<?php echo form_open('auth/step2_client'); ?>
						<?php echo form_hidden('client_type', 'referral'); ?>
						<button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Referral</button>
	               		<?php echo form_close(); ?>
	                 </div>
	                 <div class="col s6">
	               	<?php echo form_open('auth/step2_client'); ?>
						<?php echo form_hidden('client_type', 'Walk-in'); ?>
						<button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">Walk in</button>
	               	<?php echo form_close(); ?>
	                </div>
            </div>
            </fieldset>
        </div>
    </div>
</main>

         	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>