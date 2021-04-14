<html>
<head>
    <title>Create Table</title>
</head>
<body>
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
        $SQLcmd = "CREATE TABLE $table_name (
                    ProductID INT UNSIGNED NOT NULL
                    AUTO_INCREMENT PRIMARY KEY,
                    Product_desc VARCHAR(50),
                    Cost INT, Weight INT, Numb INT)";
        mysqli_select_db($mysqli, $mydb);
        if (mysqli_query($mysqli, $SQLcmd)) {
            print '<font size="4" color="blue" >Created Table';
            print "<i>$table_name</i> in database<i>$mydb</i><br></font>";
            print "<br>SQLcmd=$SQLcmd";
        } else {
            die("Table Create Creation Failed SQLcmd=$SQLcmd");
        }
        mysqli_close($mysqli);
    }
    ?>
    </body>
</html>