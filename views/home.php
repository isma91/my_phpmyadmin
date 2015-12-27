<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="My_PHPMyAdmin" />
  <title>My_PHPMyAdmin</title>
  <?php
  include './views/header.php';
  ?>
  <link media="all" type="text/css" rel="stylesheet" href="./media/css/sideNavBar.css" />
  <script src="./media/js/sideNavBar.js"></script>
  <script src="./media/js/home.js"></script>
</head>
<body>
  <div class="mui-container">
    <div id="sidedrawer" class="mui--no-user-select">
      <div id="sidedrawer-brand" class="mui--appbar-line-height mui--text-title"><img class="imgLogo" src="./media/img/logo.png"></div>
      <div class="mui-divider"></div>
      <ul>
        <li>
          <strong>Database 1</strong>
          <ul>
            <li><a href="#">Table 1</a></li>
            <li><a href="#">Table 2</a></li>
            <li><a href="#">Table 3</a></li>
          </ul>
        </li>
        <li>
          <strong>Database 2</strong>
          <ul>
            <li><a href="#">Table 1</a></li>
            <li><a href="#">Table 2</a></li>
            <li><a href="#">Table 3</a></li>
          </ul>
        </li>
        <li>
          <strong>Database 3</strong>
          <ul>
            <li><a href="#">Table 1</a></li>
            <li><a href="#">Table 2</a></li>
            <li><a href="#">Table 3</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <header id="header">
      <div class="mui-appbar mui--appbar-line-height">
        <div class="mui-container-fluid">
          <a class="sidedrawer-toggle mui--visible-xs-inline-block js-show-sidedrawer">☰</a>
          <a class="sidedrawer-toggle mui--hidden-xs js-hide-sidedrawer">☰</a>
          <span class="mui--text-title mui--visible-xs-inline-block">My_PHPMyAdmin</span>
        </div>
      </div>
    </header>
    <div id="content-wrapper">
      <div class="mui--appbar-height"></div>
      <div class="mui-container-fluid">
      </div>
    </div>
  </div>
</body>
</html>