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
<?php     if($status == 0)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_admission.php');
        }
        elseif($status == 1)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');
        } ?>


          <div class="col s10">
              <fieldset class="z-depth-2">
                  <center>
                    <h5 class="bold">House Reports</h5>
                  </center>
                  <h5 class="divider black"></h5>
                   <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info.php'); ?>

                          
           
                                <table class="table centered striped bordered hoverable">
                                    <thead>
                                        <tr>
                                            
                                            <th>Created by</th>
                                            <th>Date: </th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach($house_reports as $row_house_report) { ?>
                                        <tr>
                                              <td><?php echo $row_house_report->first_name." ".$row_house_report->last_name; ?></td>
                                              <td><?php echo date('F d Y', strtotime($row_house_report->house_date)); ?> </td>
                                              <td><?php echo $row_house_report->remark; ?></td>
                                        </tr>
                                         <?php } ?>
                                    </tbody>
                                </table>
              </fieldset>
          </div>
      </div>
  </main>