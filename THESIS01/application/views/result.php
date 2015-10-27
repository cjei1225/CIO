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


          <?php foreach($data as $row)
          {
            echo $row->client_fname;
          } ?> 

        </div>
    </div>
</main>

     