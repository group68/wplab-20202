<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../search.css">
    <title>Create Table</title>
</head>
<body>
<div class="container-fluid mw-60 h-100">
        <div class="intro row">
            <div class="col-12">
                <div class="min-vh-100 d-flex flex-column  align-items-center justify-content-center auto-margin">
                    <div class="mask">
                        <div class="card mask-custom p-4 align-items-center justify-content-center">
                            <div class="card-body">
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
        $SQLcmd = "CREATE TABLE IF NOT EXISTS $table_name (
                    ProductID INT UNSIGNED NOT NULL
                    AUTO_INCREMENT PRIMARY KEY,
                    Product_desc VARCHAR(50),
                    Cost INT, Weight INT, Numb INT)";
        mysqli_select_db($mysqli, $mydb);
        if (mysqli_query($mysqli, $SQLcmd)) {
            print '<font size="4" color="white" >Created Table ';
            print "<i>$table_name</i> in database <i>$mydb</i><br></font>";
            print "<br>SQLcmd=$SQLcmd";
        } else {
            die("Table Create Creation Failed SQLcmd=$SQLcmd");
        }
        mysqli_close($mysqli);
    }
    ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    </body>
</html>