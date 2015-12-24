<?php
if (file_exists('./../config.php')) {
    header('Location: ./../');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Installation of My_PHPMyAdmin" />
  <title>Installing My_PHPMyAdmin</title>
  <link media="all" type="text/css" rel="stylesheet" href="./../media/css/mui.min.css" />
  <link media="all" type="text/css" rel="stylesheet" href="./../media/css/materialize.min.css" />
  <link media="all" type="text/css" rel="stylesheet" href="./../media/css/google_material_icons.css" />
  <link media="all" type="text/css" rel="stylesheet" href="./install.css" />
  <script src="./../media/js/jquery-2.1.4.min.js"></script>
  <script src="./../media/js/mui.min.js"></script>
  <script src="./../media/js/materialize.min.js"></script>
  <script src="./install.js"></script>
</head>
<body>
  <div class="container">
    <ul class="collapsible popout collapsible-accordion big_form_install" data-collapsible="accordion">
      <li>
        <div class="collapsible-header"><div class="form_install" id="form_install_admin_profile"><i class="large material-icons">face</i>Admin Profile <span class="not_complete">Not complete</span></div></div>
        <div class="collapsible-body">
          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix">perm_identity</i>
              <input name="first_name" id="first_name" type="text">
              <label for="first_name">First Name</label>
            </div>
            <div class="input-field col s6">
              <i class="material-icons prefix">perm_identity</i>
              <input name="last_name" id="last_name" type="text">
              <label for="last_name">Last Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix">account_circle</i>
              <input name="username" id="username" type="text" >
              <label for="username">Username</label>
            </div>
            <div class="input-field col s6">
              <i class="material-icons prefix">security</i>
              <input name="password" id="password" type="password" >
              <label for="password">password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">date_range</i>
              <input type="date" id="birthdate" name="birthdate" class="datepicker">
              <label for="birthdate">Birthdate</label>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="collapsible-header"><div class="form_install"><i class="large material-icons">settings</i>Database Settings</div></div>
        <div class="collapsible-body">
          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix">dns</i>
              <input name="host" id="host" type="text" value="localhost">
              <label for="first_name">Host</label>
            </div>
            <div class="input-field col s6">
              <i class="material-icons prefix">perm_identity</i>
              <input name="db_username" id="db_username" type="text" value="root">
              <label for="db_username">Username</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">security</i>
              <input name="db_password" id="db_password" type="password" >
              <label for="db_password">password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">web</i>
              <input type="text" id="db_name" name="db_name" value="my_phpmyadmin">
              <label for="db_name">Database Name</label>
            </div>
          </div>
          <div class="row">
            <div class="container"> 
             <button class="btn waves-effect waves-light floated-left" id="db_create" type="button">
               CREATE DATABASE
             </button>
             <button class="btn waves-effect waves-light floated-right" id="db_test" type="button">
               TRY CONNECTION
             </button>
           </div>
         </div>
         <div class="row">
           <div class="title" id="finish_install">
             <div class="container">
               <button class="btn waves-effect waves-light" id="button_finish_install" type="button">
                 FINISH INSTALL
               </button>
             </div>
           </div>
         </div>
       </div>
     </li>
   </ul>
 </div>
</body>
</html>