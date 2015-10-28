<?php 

include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');


?>
<main>
    <div class="container">
        <div class="row">

<?php 
        if($status == 0)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_admission.php');
        }
        elseif($status == 1)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_custody.php');
        }

        ?>

            <div class="col s10"> 
                <fieldset class="z-depth-2">                               
                        <center>
                          <h5 class="bold">Client</h5>
                        </center>
                        <h5 class="divider black"></h5>
                            <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_info.php');  ?>
                        
                    
                    <div class="col s12">
                        <div class="">
                            <table class="table table-striped " id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>File name</th>
                                        <th>Uploaded On </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php foreach($files as $row_files) { ?>
                                   
                                    <tr class="">
                                        
                                        <td><?php echo $row_files->file_name; ?></td>
                                        <td><?php echo date('m/d/y',strtotime($row_files->created))?></td>
                                       

                                        <td>
                                        <?php 
                                        echo form_open('auth/read_test');
                                        echo form_hidden('path', $row_files->file_location.$row_files->file_name); 
                                        echo form_hidden('file', $row_files->file_name);
                                        echo form_hidden('sw_id', $sw_id);
                                        ?>
                                        <button type="submit" value="view" class="btn waves-effect  blue z-depth-2">View </button>
                                        <?php

                                          echo form_close();?>
                                      </td>
                                      
                                    </tr>
                                    
                                     <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </fieldset>
            </div>
        </div> 
    </div>
</main>
        <!-- /#page-wrapper -->