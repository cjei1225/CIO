<main>

<?php 
include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>
 <main>
      <div class="container">
        <div class="row">
          <?php     if($status == 0)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_admission.php');
        }
        elseif($status == 1)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');
        } ?>
        <?php if($role == 7 ||$role == 8 ||$role == 9 ||$role == 10 ){ ?>
          <div class="col s10">
            <div class="col s4">
              <?php
                echo form_open('auth/Plan_of_action');
                echo form_hidden('client_id', $client_id); ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text blue lighten-2 z-depth-2" id="userside">Create</button>
                <?php
                echo form_close();
              ?>
            </div>
          </div>
          <?php } ?>
          <div class="col s10">
              <fieldset class="z-depth-2">
                  <center>
                    <h5 class="bold">Plan of action</h5>
                  </center>
                  <h5 class="divider black"></h5>
                    <div class="form-group">
                      <img src="<?php echo base_url(); ?>materialize/title logo.png" class=" left"> 
                      <label >Name: <?php echo $fname." ".$lname; ?> </label>
                        <br>
                      <label>Age: <?php echo $age; ?></label>
                         <br>
                      <label >Gender: <?php if ($gender == 1){echo "Male";}
                                      elseif($gender == 2){echo "Female";} ?></label>
                         <br>
                      <label >Place of Birth: <?php echo $birth_place; ?></label>
                          <br>
                      <label >Dorm: <?php echo $dorm_id; ?></label>
                          <br>                       
                      </div>
                      <table class="table centered striped bordered hoverable">
                          <thead>
                              <tr>
                                  
                                  <th>Plan ID</th>
                                  <th>Date Created</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          	<?php foreach($POA_list as $POA) { ?>
                              <tr>
                              	<td><?php echo $POA->plan_of_action_id; ?></td>
                                  <td><?php echo $POA->created; ?></td>
                                  <td>
                                    	<?php 
                                    	echo form_open("auth/get_POA");

                                    	echo form_hidden("plan_of_action_id", $POA->plan_of_action_id);
                                    	echo form_hidden('client_id', $POA->client_id);?>

                                    	<button type="submit" value="view" class="btn waves-effect  blue z-depth-2">Details </button>
                                    	<?php echo form_close(); ?>
                                  </td>
                              </tr>
                               <?php } ?>
                          </tbody>
                      </table>
              </fieldset>
          </div>
      </div>
  </main>
</main>