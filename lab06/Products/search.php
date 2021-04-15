<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../search.css">
    <title>Search Data</title>
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
                                    $name = $_POST['name'];
                                    $SQLcmd = "SELECT * FROM $table_name WHERE (Product_desc LIKE '%$name%');";
                                    mysqli_select_db($mysqli, $mydb);
                                    if ($query = mysqli_query($mysqli, $SQLcmd)) {
                                        // print '<font size="4" color="blue" > $table_name Data';
                                        // print "The query is:";
                                        // print "<br>SQLcmd=$SQLcmd";

                                        print '<div class = "sub-title text-center">';
                                        print '<font size="5">';
                                        print "$table_name Data</font><br>";
                                        print "The query is <i>$SQLcmd </i><br>";
                                        print '</div>';
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
                                        die("Search failed SQLcmd=$SQLcmd");
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