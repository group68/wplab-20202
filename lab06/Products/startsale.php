<html>
<head>
    <title>Start sale</title>
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
        $SQLcmd = "SELECT * FROM $table_name; ";
        mysqli_select_db($mysqli, $mydb);
        if ($query = mysqli_query($mysqli, $SQLcmd)) {
            print '<font size="4" color="blue" > Select Product We Just Sold</font>';
            print '<br>';
            $name_query = mysqli_query($mysqli,"SELECT product_desc FROM products;") ;
            print '<form action="./sale.php" method="POST">';
            $i = 0;
            while ($row = mysqli_fetch_row($name_query)) {
                  
                foreach ($row as $field) {
                    echo "<input type=\"checkbox\" value = $field name=\"input$i\"/> $field ";
                }
                $i++;   
                
            }
            echo '<br>';
            echo '<tr><th><input type="submit" value="Click to submit"></th>';
            echo '<th><input type="reset" value = "Click to reset"></th></tr>';
            echo '</form>';
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
        }
        else {
            die("Query failed SQLcmd=$SQLcmd");
        }
        mysqli_close($mysqli);
    }
    ?>
    </body>
</html>