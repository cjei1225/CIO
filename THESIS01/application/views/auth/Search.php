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
?>

		  <div id="page-wrapper">
		  	<div class="panel-body">
		  		<div class="row">
		  			<img src="<?php echo base_url(); ?>/bootstrap/img/H logo.png"/>  <!-- dpat galing database yung pic-->
		  		

		  		</div>
		  		
		  	</div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" style="width:100%;">
                    
                        <!-- /.panel-heading -->
                        <div class="panel-body">
           
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>    
                                            <th>File name</th>
                                            <th>Created</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach($search as $row_files) { ?>
                                     
                                        <tr class="odd gradeX">
                                            
                                            
                                            <td><?php echo $row_files->file_name; ?></td>
                                            <td><?php echo  date('m/d/y', strtotime($row_files->created)); ?></td>
                                            <?php 
                                            ?>

                                            <td><?php 
                                            echo form_open('auth/read_test');
                                            echo form_hidden('path', $row_files->file_location.$row_files->file_name); 
                                            echo form_hidden('file', $row_files->file_name); 
                                            echo form_hidden('sw_id', $row_files->file_owner);
                                            echo form_submit('View', 'View'); 
                                            echo form_close(); 
                                            ?></td>
                                          
                                        </tr>
                                         
                                         <?php } ?>
                                    </tbody>
                                </table>
                            <!-- /.table-responsive -->
    
        <!-- /#page-wrapper -->