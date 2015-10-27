<main>
    <div class="container">
        <fieldset class="z-depth-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped centered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Client ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Date Added</th>
                                            <th>Sector</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter = 0;
                                        foreach($Pending_Clients as $row_pending)
                                        { $counter++?>


                                        <tr class="odd gradeX">
                                            <td><?php echo $row_pending->client_id; ?></td>

                                            <td><?php echo $row_pending->client_lname; ?></td>
                                            <td><?php echo $row_pending->client_fname; ?></td>
                                            <td><?php echo date('m/d/y',strtotime($row_pending->admitdate)); ?></td>
                                            <td><?php if ($row_pending->client_sector == 1)
                                            {echo "Child and youth";}
                                            elseif($row_pending->client_sector == 2){echo "Older Person";}
                                            elseif($row_pending->client_sector == 3){echo "special Needs";}
                                            elseif($row_pending->client_sector == 4){echo "Crisis Situation";} ?>   </td>

                                            <td>
                                         <?php
                                          echo form_open('auth/pending_client_page');
                                          echo form_hidden('client_id', $row_pending->client_id); ?>

                                          <button type="submit" value="view" class="btn waves-effect  blue z-depth-2">Details </button>
                                          <?php
                                          echo form_close();
                                          ?>
                                      </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</main>