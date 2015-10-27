
<main>
    <div class="col s10">
        <fieldset class="z-depth-2">
            <div class="table-responsive">
                <table class="table table-striped centered table-hover" id="dataTables-example">
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

                        <?php foreach($clients as $row_client){
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $row_client->client_id; ?></td>
                            <td><?php echo $row_client->client_lname; ?></td>
                            <td><?php echo $row_client->client_fname; ?></td>
                            <td class="center"><?php 
                            if ($row_client->gender == 1){echo "Male";}
                            elseif($row_client->gender == 2){echo "Female";} ?> </td>
                            <td class="center"><?php 
                                if ($row_client->client_sector == 1){echo "Child and youth";}
                                elseif($row_client->client_sector == 2){echo "Older Person";}
                                elseif($row_client->client_sector == 3){echo "Special Needs";}
                                elseif($row_client->client_sector == 4){echo "Crisis Situation";} ?> 
                            </td>
                            <td><?php echo $row_client->d_name; ?></td>
                            <td><?php 
                                echo form_open('auth/get_conference_details');
                                echo form_hidden('client_id', $row_client->client_id); ?>
                                    
                                        <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">View </button>
                                        <?php echo form_close(); ?>
                                </div>
                            </td>
                        </tr>        
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</main>