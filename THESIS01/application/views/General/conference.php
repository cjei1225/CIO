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
<main>
    <div class="container">
        <fieldset class="z-depth-2">


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table responsive-table" id="dataTables-example">
                                <thead>
                                    <td>Schedule</td>
                                    <td>Location</td>
                                    <td>Type</td>
                                    <td>Status </td>
                                    <td>Start</td>
                                    <td>End</td>
                                    <td></td>
                                </thead>
                                <tbody>
                                    <?php foreach($conferences as $row_conference) { ?>
                                    <tr>
                                        <td><?php echo date('m/d', strtotime($row_conference->schedule)); ?></td>
                                        <td><?php echo $row_conference->Location; ?></td>
                                        <td><?php   if($row_conference->conference_type == 1){echo 'Intervention Case Conference';}
                                                    elseif($row_conference->conference_type == 2){echo 'Pre Admission Case Conference';}
                                            ?>
                                        </td>
                                        <td><?php if($row_conference->status == 0){echo 'Open';}
                                                    elseif($row_conference->status == 1){echo 'Concluded';}
                                                    elseif($row_conference->status == 2){echo 'Waiting for Minutes';}
                                                    elseif($row_conference->status == 3){echo 'Canceled';} ?></td>
                                        <td><?php echo $row_conference->start_time; ?></td>
                                        <td><?php echo $row_conference->end_time; ?></td>
                                        
                                        <td><?php 
                                            echo form_open('auth/get_conference_details');
                                            echo form_hidden('conference_id', $row_conference->conference_id);
                                            echo form_hidden('conference_type', $row_conference->conference_type);
                                            ?>
                                            <button class="btn  waves-effect green" type="submit" name="action">View</button>
                                            <?php echo form_close();?></td>
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