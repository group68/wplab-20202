<html>
<head>
    <title>Search Data</title>
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
        $name = $_POST['name'];
        $SQLcmd = "SELECT * FROM $table_name WHERE (Product_desc LIKE '%$name%');";
        mysqli_select_db($mysqli, $mydb);
        if ($query = mysqli_query($mysqli, $SQLcmd)) {
            print '<font size="4" color="blue" > $table_name Data';
            print "The query is:";
            print "<br>SQLcmd=$SQLcmd";
            if ($query) {
                print '<table border=1>';
                print '<th>Num<th>Product<th>Cost<th>Weight<th>Count';
                while ($row = mysqli_fetch_row($query)){
                    print '<tr>';
                    foreach ($row as $field) {
                        print "<td>$field</td> ";
                    }
                        print '</tr>';
                    }
            }
        }
        else {
            die("Search failed SQLcmd=$SQLcmd");
        }
        mysqli_close($mysqli);
    }
    ?>
    </body>
</html>