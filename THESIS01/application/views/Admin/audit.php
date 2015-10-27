


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" >
                    <h1 class="page-header">Pending Discharge</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Event</th>
                                            <th>Done By</th>
                                            <th>Date Done</th>
  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($audit_files as $row_pending)
                                        { ?>


                                        <tr class="odd gradeX">
                                            <td><?php echo $row_pending->file_name; ?></td>
                                            <td><?php echo $row_pending->a_action; ?></td>
                                            <td><?php echo $row_pending->user_id; ?></td>
                                            <td><?php echo date('m/d/y',strtotime($row_pending->a_datetime)); ?></td>
                                          
    

                                        </tr>
                                     <?php } ?>
                                       
                                    </tbody>
                                </table>
                        </div>

                    </div>
                            <!-- /.table-responsive -->
                        
        </div>