<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./style.css">
    <title>Category</title>
</head>
<body>
<div class="container-fluid mt-20 h-100">
        <div class="intro row">
            <div class="bg-image h-100">
                <div class="mask d-flex vertical-center align-items-center justify-content-center h-100"
                    >
                    <div class="container mw-80 auto-margin ">
                        <div class="card mask-custom p-4 align-items-center justify-content-center">
                            <div class="card-body auto-padding">
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
        print '<td><input type="text" size="20" maxlength="20" color="black" name="id"</td>';
        print '<td><input type="text" size="30" maxlength="30" name="title"</td>';
        print '<td><input type="text" size="50" maxlength="50" name="desc"</td>';
        print '</tr>';
        print '</table>';
        print '<input type="submit" size="30" class = "btn btn-submit" value="Click to submit">';
        print '</form>';
        

        mysqli_close($mysqli);
        function show_all($connect, $database, $table_name){
            $SQLcmd = "SELECT * from $table_name";
            $query = mysqli_query($connect,$SQLcmd);
            print '<table class="table mt-20" cellpadding="0" cellspacing="0" border="0"> ';
            print '<div class="tbl-header">';
            print '<thead class="thead-dark tbl-header">';
            print '<tr><th>CatID</th>
            <th>Product</th><th>Title</th>
            </tr></thead></div>';
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

</body>
</html>
