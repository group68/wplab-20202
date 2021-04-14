<html>
<head>
    <title>sale</title>
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
        $SQLcmd = "SELECT COUNT(PRODUCTID) FROM $table_name; ";
        mysqli_select_db($mysqli, $mydb);
        if ($query = mysqli_query($mysqli, $SQLcmd)) {
            $num = mysqli_fetch_array($query)[0];
            $num = intval($num);
            for ($i = 0; $i < $num; $i++) {
                $input = "input" . $i;
                if (isset($_POST["$input"])){
                    $input = $_POST["$input"];
                    mysqli_query($mysqli,"UPDATE $table_name SET NUMB = NUMB - 1 WHERE product_desc = '$input'");
                }
            }
        }
        $SQLcmd = "SELECT * FROM $table_name; ";
        $query = mysqli_query($mysqli, $SQLcmd);
        print "<br>The query is:";
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
        else {
            die("Query failed SQLcmd=$SQLcmd");
        }
        mysqli_close($mysqli);
    }
    ?>
    </body>
</html>