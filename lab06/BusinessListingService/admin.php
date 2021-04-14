<html>
<head>
    <title>Category</title>
</head>
<body>
    <h1>Category Administration</h1>
    <?php
        $ini = parse_ini_file('./app.ini');
        $server = $ini['server'];
        $user = $ini['user'];
        $pass = $ini['pass'];
        $mydb = $ini['mydb'];
        $table_name = 'categories';

        $mysqli = mysqli_connect($server, $user, $pass);
        if (!$mysqli) {
            die("Cannot connect to $server using $user");
        }
        mysqli_select_db($mysqli, $mydb);

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (isset($_POST['title'])) $title = $_POST['title']; else $title = '';
            if (isset($_POST['desc'])) $desc = $_POST['desc']; else $desc = '';
            $query = mysqli_query($mysqli,"INSERT INTO $table_name VALUES ('$id','$title','$desc');");
        }

        show_all($mysqli,$mydb,$table_name);
        print '<form method=POST>';
        print '<tr>';
        print '<td><input type="text" size="20" maxlength="20" name="id"</td>';
        print '<td><input type="text" size="30" maxlength="30" name="title"</td>';
        print '<td><input type="text" size="50" maxlength="50" name="desc"</td>';
        print '</tr>';
        print '</table>';
        print '<tr><th><input type="submit" value="Click to submit"></th></tr>';
        print '</form>';
        

        mysqli_close($mysqli);
        function show_all($connect, $database, $table_name){
            $SQLcmd = "SELECT * from $table_name";
            $query = mysqli_query($connect,$SQLcmd);
            print '<table border=1><th>CatID</th>
            <th>Product</th><th>Title</th>
            ';
            if (!$query) {
                print 'Query failed!';
            } else {
            while ($row = mysqli_fetch_row($query)) {
                print '<tr>';
                foreach ($row as $field){
                    print "<td>$field</td> ";
                    }
                print '</tr>';
            }
        }
        }
    ?>
</body>
