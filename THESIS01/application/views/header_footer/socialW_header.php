<?php
$Search = array(
	'name'	=> 'Search',
	'id'	=> 'Search',
	'value' => set_value('Search'),
	'maxlength'	=> 20,
	'size'	=> 15,
	
);
?>

<html lang="en">

<head>
<title> Hospicio de San Jose </title>
  <meta charset="utf-8">
  <meta http-equiv="X-Compatible-UA" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/materialize/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/materialize/css/style.css"  />
      <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/materialize/css/morris.css"  />


      <link href="<?php echo base_url(); ?>/materialize/css/dataTables.bootstrap.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>/materialize/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <script src="<?php echo base_url(); ?>/bootstrap/js/plupload.full.min.js"></script>
    

    </head>

<body class="grey lighten-4">
  <div>
    <header>
      <!-- Logo -->
      <div class="container">
      <div  class="nav-wrapper" id="logo"></div>
  </div>

      
  <div class="container">
        <!-- Dropdown Structure -->
         <ul id="admissiondrop" class="dropdown-content">
                <li id="textzied"><a href="admission_type">Create Client</a></li>
                <li class="divider"></li> 
                <li id="textzied"><a href="SW_pending_client_list">Pending admissions</a></li>
                <li class="divider"></li> 
              
         </ul>

         <!-- Dropdown Structure -->
         <ul id="custodydrop" class="dropdown-content">
                <li id="textzied"><a href="client_list">Client List</a></li>
                <li class="divider"></li> 
         </ul>

         <!-- Dropdown Structure -->
         <ul id="dischargeddrop" class="dropdown-content">
                <li id="textzied"><a href="Pending_Discharge">Pending Discharge</a></li>
                <li class="divider"></li> 
         </ul>
  <!-- Dropdown Others Structure -->
                <ul id="othersdrop" class="dropdown-content">
                <li id="textzied"><a href="archive">Archives</a></li>
                <li class="divider"></li> 
                <li id="textzied"><a href="Employee_Directory">Employee Directory</a></li>
                <li class="divider"></li> 
                <li id="textzied"><a href="get_conferences">Conferences</a></li>
                <li class="divider"></li>
          </ul>
          <!-- Dropdown User Structure -->
          <ul id="userdrop" class="dropdown-content">
                <li id="textzied"><a href="Profile">Profile</a></li>
                <li class="divider"></li> 
                <li id="textzied"><a href="logout">Log Out</a></li>
                <li class="divider"></li> 
          </ul>

          <!-- Dropdown Notification Structure -->

          <ul id="notifdrop" class="dropdown-content">

                        <?php foreach ($notification as $notif)
                        { 
                            
                        ?>
                        <li>
                            <a href="alert/<?=$notif->notification_id;?>/socialW_medical" class="list-group-item <?=($notif->seen)? 'read' : 'active';?>">
                                <p class="list-group-item-heading"><i class="fa fa-envelope"></i> <?=$notif->notification_message;?></p>
                                <p class="list-group-item-text text-muted"><?=$notif->created;?></p>
                            </a>
                        </li>
                         <li class="divider"></li> 
                       
                            
                        
                        <?php } ?>
                    </ul>

                <!-- Dropdown Messenger Structure --> 
          <ul id="messagedrop" class="dropdown-content">
                <li id="textzied"><a href="Profile">Profile</a></li>
                <li class="divider"></li> 
                <li id="textzied"><a href="Login.html">Log Out</a></li>
                <li class="divider"></li> 
          </ul>

      <!-- Navigation -->
      <nav class="light-green lighten-2">
        <div class="nav-wrapper">

          <ul class="left side-nav">
            <li id="homeicon" class="center"><a href="auth"><i class="mdi-action-home"></i></a></li>
            <li id="navsize" class="center "><a href="#" class="dropdown-button" data-activates="admissiondrop">Admission<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <li id="navsize" class="center "><a href="#" class="dropdown-button" data-activates="custodydrop">Custody<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <li id="navsize" class="center "><a href="#" class="dropdown-button" data-activates="dischargeddrop">Discharged<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <li id="navsize"><a href="#" class="dropdown-button" data-activates="othersdrop">Others<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          </ul>


          <ul class="right side-nav">
            <li class="center"><a href="#" class="dropdown-button" data-activates="messagedrop"><i class="mdi-communication-email center">   </i><span class="badge white-text ">1</span></a></li>
            <li class="center"><a href="#" class="dropdown-button" data-activates="notifdrop">  <i class="mdi-social-notifications center">  </i><span class="badge white-text"><?=$notification_count;?></span></a></li>
            <li class="center"><a href="#" class="dropdown-button" data-activates="userdrop">   <i class="mdi-action-account-circle center"> </i><span class="badge white-text"> <?php echo $username ?> </span></a></li>
          </ul>
        </div>
      </nav>
    </div>  
      </header>
        </br>
        <script type="text/javascript" src="<?php echo base_url(); ?>/bootstrap/js/jquery.js"></script>
        <script>
  function goBack() {
      window.history.back()
  }
</script>