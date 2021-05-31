<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../style.css">
  <title>Insert Data</title>
</head>

<body>
  <div class="container-fluid mw-60 mt-20">
    <div class="row">
      <div class="col-12">
        <div id="shadow-box" class="jumbotron min-vh-100 m-0 bg-info d-flex flex-column text-center  ">
          <?php
          $ini = parse_ini_file('./app.ini');
          $server = $ini['server'];
          $user = $ini['user'];
          $pass = $ini['pass'];
          $mydb = $ini['mydb'];
          $table_name = $ini['table_name'];
          $mysqli = mysqli_connect($server, $user, $pass);
          if (!$mysqli) {
            die("Cannot connect to $server using $user");
          } else {
            $desc = $_POST["desc"];
            $weight = $_POST["weight"];
            $num = $_POST["num"];
            $cost = $_POST["cost"];

            $SQLcmd = " INSERT INTO $table_name VALUES (
                    NULL, '$desc' , $weight , $cost , $num )";
            mysqli_select_db($mysqli, $mydb);
            if (mysqli_query($mysqli, $SQLcmd)) {
              print '<font size="4" color="blue"\ > DATA INSERTED ';
              print "<font color='orange' /><i >$desc</i>";
              print '<font size="4" color="blue"\ > in table ';
              print "<font color='orange' /><i color='orange'>$table_name</i>";
              print '<font size="4" color="blue"\ > in database ';
              print "<font color='orange' /><i color='orange'>$mydb</i><br></font>";
              print "<font size='4' color='black'<br>SQLcmd=$SQLcmd";
            } else {
              die("Insertion failed SQLcmd=$SQLcmd");
            }
            mysqli_close($mysqli);
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>