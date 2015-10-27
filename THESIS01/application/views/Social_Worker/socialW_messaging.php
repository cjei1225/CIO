<?php

$msg = array(
    'name'  => 'msg',
    'id'    => 'msg',
    'placeholder' => 'Type your message here...',
    'value' => set_value('msg'),
    'class' => 'form-control input-sm',
    'maxlength' => 100,
);

$user_chat_id = array(
    'name'  => 'user_chat_id',
    'id'    => 'user_chat_id',
    'value' => set_value('user_chat_id'),
);

$user_id = array(
    'name'  => 'user_id',
    'id'    => 'user_id',
    'value' => set_value('user_id'),
);

?>
<style>


</style>
		</nav>
		<!-- Message For All-->
		<div id="page-wrapper">
			<div class="row">
			<div class="col-lg-9 col-md-13">
		<div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments-o fa-fw"></i>
                            Messaging
                        <?php echo form_open('auth/nurse_messaging'); ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" id="messagebody">
                            <ul class="chat">
                                <?php foreach($msge as $msg_list) 
                                { ?>
                                <li class="left clearfix">
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font"><?php echo $username; ?></strong> 
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> <?php echo $msg_list->date_time; ?>
                                            </small>
                                        </div>
                                        <p>
                                           <?php echo $msg_list->message; ?>
                                        </p>
                                    </div>
                                </li>
                            <?php } ?>
 
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                    <?php echo form_input($msg); ?>
                                <span class="input-group-btn">
                                    <div class="btn btn-warning btn-sm"  id="remove_design">
                                       <?php echo form_submit('Send', 'Send'); ?>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            
        </div>
            <div class="col-lg-3 navbar sidebar" id="messageside">
                <div class="chat-panel panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-users fw"></i> List of Users
                           
                        </div>
                        <!-- /.panel-heading -->         
                        <div class="panel-body" id="sideinside">
                            <?php foreach($users as $user_chat)
                            { ?>
                                <a href="#" class="list-group-item" id="userside">
                                    <h6 ><?php echo $user_chat->first_name." ". $user_chat->last_name; ?></h6>
                                    <?php echo form_hidden('user_chat_id', $user_chat->id); ?>
                                </a>
                              <?php } ?> 
                               
                            
                            <!-- /.list-group -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
	
					</div>
			<?php echo form_close(); ?>
		</div>
		<!-- /#page-wrapper -->