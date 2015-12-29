<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Welcome to My_PHPMyAdmin" />
  <title>Welcome to My_PHPMyAdmin</title>
  <?php
  include './views/header.php';
  ?>
  <script src="./media/js/index.js"></script>
</head>
<body>
  <div class="container">
    <div class="mui-panel title">
      <img class="activator" src="./media/img/logo.png">
      <div class="title"><span class="card-title grey-text text-darken-4">Connection</span></div>
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">perm_identity</i>
          <input name="username" id="username" type="text">
          <label for="username">Username</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">security</i>
          <input name="password" id="password" type="password">
          <label for="password">password</label>
        </div>
      </div>
      <button class="waves-effect waves-light btn-flat" id="connection">Connection</button>
    </div>
  </div>
</body>
</html>