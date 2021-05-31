<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../style.css">
    <title>Display Data</title>
</head>

<body>
    <div class="container-fluid mw-60 mt-20">
        <div class="row">
            <div class="col-12">
                <div id="shadow-box" class="jumbotron min-vh-100 m-0 bg-info d-flex flex-column  ">
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
                            print '<div class = "row sub-title text-center">';
                            print '<font size="5">';
                            print "$table_name Data</font><br>";
                            print "The query is <i>$SQLcmd </i><br>";
                            print '</div>';
                            // print '<font size="4" color="blue" > $table_name Data';
                            // print "The query is:";
                            // print "<br>SQLcmd=$SQLcmd";
                            if ($query) {
                                print
                                    '<table class="table table-striped ">
                                    <thead class="thead-dark">
    <tr>
      <th scope="col">ProductID</th>
      <th scope="col">Product</th>
      <th scope="col">Cost</th>
      <th scope="col">Weight</th>
      <th scope="col">Count</th>
    </tr>
  </thead>
  <tbody>';
                                while ($row = mysqli_fetch_row($query)) {
                                    print '<tr >';
                                    foreach ($row as $field) {
                                        print "<td>$field</td> ";
                                    }
                                    print '</tr>';
                                }
                                print '
                                </tbody>
                              </table>';
                            }
                        } else {
                            die("Query failed SQLcmd=$SQLcmd");
                        }
                        mysqli_close($mysqli);
                    }
                    ?>
</body>

</html>