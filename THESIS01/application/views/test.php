<?php

$test = array(
	'name'	=> 'test',
	'id'	=> 'test',
	'placeholder'	=> 'test',
	'value' => set_value('test'),
	'maxlength'	=> 50,
	'size'	=> 15,
	'class' => 'form-control',
);

?>







<main >

    <div class="container">
        <div class="row">
          <?php echo form_open('auth/test')?>
          
          <?php echo form_input($test); ?>

          <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>

          <?php echo form_close(); ?>
        </div>
    </div>
</main>

         	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>