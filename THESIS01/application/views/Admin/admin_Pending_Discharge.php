
<main>
    <div class="container">

            <fieldset class="z-depth-2">
                <div class="col s12">
                    <table class="table table-striped " id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Client ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Date Added</th>
                                <th>Social Worker</th>
                                <th>Sector</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($Pending_Clients as $row_pending)
                            { ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row_pending->client_id; ?></td>
                                <td><?php echo $row_pending->client_lname; ?></td>
                                <td><?php echo $row_pending->client_fname; ?></td>
                                <td><?php echo date('F/d/y',strtotime($row_pending->created)); ?></td>
                                <td><?php echo $row_pending->sw_id; ?></td>
                                <td><?php if ($row_pending->client_sector == 1)
                                {echo "Child and youth";}
                                elseif($row_pending->client_sector == 2){echo "Older Person";}
                                elseif($row_pending->client_sector == 3){echo "special Needs";}
                                elseif($row_pending->client_sector == 4){echo "Crisis Situation";} ?>   </td>
                                <td>

                                <?php
                                echo form_open('auth/Admin_Client_Discharge');
                                echo form_hidden('client_id', $row_pending->client_id); ?>
                                <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button>
                                <?php
                                echo form_close();
                                ?>
                                </td>                                                       
                            </tr>
                            <?php } ?>
                           
                        </tbody>
                    </table>

                </div>             
            </fieldset>          
 
    </div>
</main>