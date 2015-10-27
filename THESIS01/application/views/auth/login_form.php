<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'placeholder'	=> 'Username',
	'class' => 'form-control',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Username';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'placeholder'	=> 'Password',
	'class' => 'form-control',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);

$lol = array(
	'target' => '_blank');
?>





        <main>
        <div class="container">
          <div id="loginsize">
          <?php echo form_open($this->uri->uri_string()); ?>
           	              <fieldset class="z-depth-2">
                            <center><h5 class="bold">LOGIN</h5></center>
                               <h5 class="divider black"></h5>
                               
                                <div class="form-group">
                                    <?php echo form_label($login_label, $login['id']); ?>
									<?php echo form_input($login); ?>
									<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
                                </div>
                                </br>
                                <div class="form-group">
                                    <?php echo form_label('Password', $password['id']); ?>
									<?php echo form_password($password); ?>
									<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
                                </div>
                                </br>
                                
                               
                                </br>

                                <div ALIGN=center>
                                	
                               	  	<button class="btn  waves-effect btn-md  green z-depth-2" id="sizebutton" type="submit" name="action">Submit
					                <i class="mdi-content-send right"></i>
					              </button>

                                </div>
                            </fieldset>
                         <?php echo form_close(); ?>
          </div>
      </div>
        </main>