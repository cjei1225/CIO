	
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

}



<main>
    <div class="container">
        <fieldset class="z-depth-2">
            <div class="table-responsive">
               <table class="table centered striped bordered hoverable" id="dataTables-example">
                    <thead>
                        <tr>

                            <th>Last Name</th>
                            <th>First Name</th>

                           <th>Dorm</th>
                           <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($client_list as $row_client){
                        ?>

                         
                        <tr class="even GradeA">
                            <td><?php 
                            
                           ?></td>
                            <td><?php echo form_label($row_client->client_lname, $lname['id']);?>
                               </td>

                            <td><?php echo form_label($row_client->client_fname, $fname['id']); ?> </td>
                           
                           
                           
                            <td><?php echo $row_client->d_name; ?> </td>
                            <td><div class="btn btn-primary btn-sm" id="submit">
                            <?php
                            echo form_open('auth/socialW_client_profile');
                            echo form_hidden('client_id', $row_client->client_id);
                            ?>

                            <button type="submit" value="view" class="btn waves-effect btn-md  blue z-depth-2">Create Initial Social Case Study </button>
                            <?php echo form_close();
                            ?></div></td>
                        </tr>
                        <?php } ?>   
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</main>