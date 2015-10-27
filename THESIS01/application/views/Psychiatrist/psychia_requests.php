            
<?php
$client_id = array(
    'name'  => 'client_id',
    'id'    => 'client_id',
    'value' => set_value('client_id'),
);
$fname = array(
    'name'  => 'fname',
    'id'    => 'fname',
    'value' => set_value('fname'),
);
$lname = array(
    'name'  => 'lname',
    'id'    => 'lname',
    'value' => set_value('lname'),
);
$gender = array(
    'name'  => 'gender',
    'id'    => 'gender',
    'value' => set_value('gender'),
);
$sw_id = array(
    'name'  => 'sw_id',
    'id'    => 'sw_id',
    'value' => set_value('sw_id'),
);
$age = array(
    'name'  => 'age',
    'id'    => 'age',
    'value' => set_value('age'),
);


?>
        <style>
#nurse input
{
background-color:transparent;
border:0px;
}
        </style>

		  <div id="page-wrapper">
		  	 <div class="row">
                <div class="col-lg-12" >
                    <h1 class="page-header">List of Clients</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="headhead">
                            Client Directory
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Client No.</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Gender</th>
                                            <th>Sector</th>
                                            <th>Dorm</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php foreach($request as $row_client){
                                         ?>
                                        <tr class="odd gradeX">
                                            <td><?php 
                                            echo form_label($row_client->client_id, $client_id['id']); ?>
                                         
                                            <td><?php echo form_label($row_client->client_lname, $lname['id']);?>
                                            </td>

                                            <td><?php echo form_label($row_client->client_fname, $fname['id']); ?> </td>
                                         
                                            <td class="center"><?php echo form_label($row_client->Gender, $gender['id']);?>
                                                            </td>

                                            <td class="center"><?php if ($row_client->client_sector == 1)
                                            {echo "Child and youth";}
                                            elseif($row_client->client_sector == 2){echo "Older Person";}
                                            elseif($row_client->client_sector == 3){echo "special Needs";}
                                            elseif($row_client->client_sector == 4){echo "Crisis Situation";} ?>                           
                                            </td>
                                            <td></td>
                                            <td><div class="btn btn-primary btn-sm" id="nurse">
                                            <?php echo form_open('auth/nurse');
                                            echo form_hidden('client_id', $row_client->client_id);
                                            echo form_hidden('lname', $row_client->client_lname);
                                            echo form_hidden('fname', $row_client->client_fname);
                                            echo form_hidden('gender', $row_client->Gender); 
                                            echo form_hidden('age', $row_client->Age);
                                            echo form_hidden('sw_id', $row_client->sw_id); 
                                            echo form_submit('View', 'View');
                                            echo form_close();
                                            ?></div></td>
                                        </tr>
                                        <?php } ?>
                                    
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        
        </div>
        <!-- /#page-wrapper -->