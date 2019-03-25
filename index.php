<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

session_start();

if (isset($_POST["action"])) {
    $db = new DB();
    $db->connect();
    $result = $db->query("SELECT * FROM employee WHERE username = '".$_POST["username"]."'");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["username"] == $_POST["username"] && $row["password"] == md5($_POST["password"])) {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["userID"] = $row["employee_id"];
                $_SESSION["displayName"] = $row["employee_name"]." ".$row["employee_lastname"];
                session_write_close();

                if ($row["username"] == "admin") {
                  header("location: dashboard/");
                } else {
                  header("location: product/");
                }
                
            } else {
                break;
            }
        }
    }
    $db->close();
} else {
  session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Stock</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="shortcut icon" href="/stock/asset/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/stock/asset/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="asset/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="asset/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="asset/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="asset/css/font.css" type="text/css" cache="false" />
  <link rel="stylesheet" href="asset/css/plugin.css" type="text/css" />
  <link rel="stylesheet" href="asset/css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="asset/js/ie/respond.min.js" cache="false"></script>
    <script src="asset/js/ie/html5.js" cache="false"></script>
    <script src="asset/js/ie/fix.js" cache="false"></script>
  <![endif]-->
  <style>
    body {
    background-color: #4b4276;
  }
  </style>
</head>

<body>
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="row m-n">
      <div class="col-md-4 col-md-offset-4 m-t-lg">
        <section class="panel">
          <div>
            <center><img src="/stock/asset/images/logo.png"></center>
          </div>
          <form method="post" action="index.php" name="login-form" class="panel-body">
            <div class="form-group">
              <label class="control-label">Username</label>
              <input type="text" placeholder="Username" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label">Password</label>
              <input type="password" id="inputPassword" name="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" name="action" value="login" class="btn btn-info btn-block">Sign in</button>
          </form>
        </section>
      </div>
    </div>
  </section>
  <script src="asset/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="asset/js/bootstrap.js"></script>
  <!-- app -->
  <script src="asset/js/app.js"></script>
  <script src="asset/js/app.plugin.js"></script>
  <script src="asset/js/app.data.js"></script>
</body>

</html>