<?php 
$path = array(
    'name'  => 'path',
    'id'    => 'path',
    'value' => set_value('path'),
);

$file = array(
    'name'  => 'file',
    'id'    => 'file',
    'value' => set_value('file'),
);

$file_ploc = array(
    'name'  => 'file_ploc',
    'id'    => 'file_ploc',
    'placeholder' => 'Physical Location',
    'value' => set_value('file_ploc'),
    'class' => 'form-control',
    'length' => 20,

);
$document_type = '20';
include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>
 <main>
      <div class="container">
        <div class="row">
          <?php if($client_status == 1){
             include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');
              }
              elseif($client_status == 0)
              {
                include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_admission.php');
              }

          ?>

          <div class="col s10">
              <fieldset class="z-depth-2">
                  <center>
                    <h5 class="bold">Conferences</h5>
                  </center>
                  <h5 class="divider black"></h5>
                  <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info.php'); ?>
                          
           
                                <table class="table centered striped bordered hoverable">
                                    <thead>
                                        <tr>
                                            <th>Date </th>
                                            <th>Location</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach($conference_history as $conference) { ?>
                                        <tr>

                                              <td><?php echo $conference->schedule; ?>
                                              <td><?php echo $conference->Location; ?>
                                              <td>
                                                <?php echo form_open('auth/create_minutes');
                                                echo form_hidden('client_id', $conference->client_id);
                                                echo form_hidden('conference_id', $conference->conference_id);
                                                echo form_hidden('conference_type', $conference->conference_type);
                                                ?>
                                                <button class="btn  waves-effect btn-md  blue z-depth-2" type="submit" name="action">view</button>
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