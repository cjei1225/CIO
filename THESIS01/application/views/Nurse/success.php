<?php
$file_ploc = array(
    'name'  => 'file_ploc',
    'id'    => 'file_ploc',
    'placeholder' => 'Physical Location',
    'value' => set_value('file_ploc'),
    );
    ?>

    <?php echo "<h1> Your file has been uploaded.</h1>"; ?>

<div id="page-wrapper">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-10"  id="forme">
                <?php echo form_open_multipart('auth/success'); ?>
                <div class="form-group">
                    <?php echo form_label('Physical Location', $file_ploc['id']); ?>
                    <?php echo form_input($file_ploc); ?>
                    <div class="btn btn-primary btn-sm" id="remove_design"><?php echo form_submit('save', 'Save'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

                                

