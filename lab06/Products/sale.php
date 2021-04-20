<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../search.css">
    <title>sale</title>
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
                                    $SQLcmd = "SELECT COUNT(PRODUCTID) FROM $table_name; ";
                                    mysqli_select_db($mysqli, $mydb);
                                    if (isset($_POST['input'])) {
                                        $input = $_POST['input'];
                                        foreach ($input as $inp) {
                                                mysqli_query($mysqli, "UPDATE $table_name SET NUMB = NUMB - 1 WHERE product_desc = '$inp'");
                                        }
                                    } else print '<p> You did not sell anything!</p>';
                                    
                                    $SQLcmd = "SELECT * FROM $table_name; ";
                                    $query = mysqli_query($mysqli, $SQLcmd);
                                    print "<br>The query is:";
                                    print "<br>SQLcmd=$SQLcmd";
                                    if ($query) {
                                        print
                                            '<table class="table table-striped mt-20">
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
                                    } else {
                                        die("Query failed SQLcmd=$SQLcmd");
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