<html>
<head>
    <title>Insert Data</title>
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
        $desc = $_POST["desc"];
        $weight = $_POST["weight"];
        $num = $_POST["num"];
        $cost = $_POST["cost"];
        
        $SQLcmd = " INSERT INTO $table_name VALUES (
                    NULL, '$desc' , $weight , $cost , $num )";
        mysqli_select_db($mysqli, $mydb);
        if (mysqli_query($mysqli, $SQLcmd)) {
            print '<font size="4" color="blue" > DATA INSERTED ';
            print "<i>$desc</i> in table <i>$table_name</i> in database<i>$mydb</i><br></font>";
            print "<br>SQLcmd=$SQLcmd";
        } else {
            die("Insertion failed SQLcmd=$SQLcmd");
            }
        mysqli_close($mysqli);
    }
    ?>
    </body>
</html>