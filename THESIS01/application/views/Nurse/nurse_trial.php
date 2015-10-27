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
		<!-- Message For All-->
		<div id="page-wrapper">



            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" style="width:100%;">
                    
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" >
                                <ul class="tabs" data-persist="true">

                                    <?php $usersC = 0; foreach ($users as $user_chat)
                                    { 
                                        while($usersC != 8)
                                        {
                                            $usersC++; ?>



                                            <li><a href="#<?php echo $usersC; ?>">
                                                <?php echo $user_chat->first_name." ". $user_chat->last_name; ?>

                                                <?php echo form_hidden('user_chat_id', $user_chat->id); ?>

                                            </a></li>  <?php echo form_close(); ?> 
                                            <?php }
                                        } ?> 

                                    </ul>


                                    <div class="tabcontents" >
                                        <div id="1">
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
                                             </div>
                                             <div id="2">
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
                                             </div>
                                             <div id="3">
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
                                             </div>
                                             <div id="4">
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
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>


