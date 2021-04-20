<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../search.css">
    <title>Start sale</title>
</head>

<body>
    <div class="container-fluid mw-60 h-100">
        <div class="intro row">
            <div class="col-12">
                <div class="min-vh-100 d-flex flex-column  align-items-center justify-content-center auto-margin">
                    <div class="mask">
                        <div class="card mask-custom p-4 align-items-center justify-content-center">
                            <div class="card-body auto-padding d-flex align-items-center justify-content-center">
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
                                        print '<font size="5" color="#ffe3fe" > Select Product We Just Sold</font>';
                                        print '<br>';
                                        $name_query = mysqli_query($mysqli, "SELECT product_desc FROM products;");
                                        print '<form action="./sale.php" method="POST">';
                                        $i = 1;
                                        while ($row = mysqli_fetch_row($name_query)) {

                                            foreach ($row as $field) {
                                                if ($i % 3 == 0) {
                                                    print "<div class = 'row'>";
                                                }
                                                print "<div class = 'col-sm-4'>";
                                                echo "<input type=\"checkbox\" value = '$field' name=\"input[]\"/> $field ";
                                                print "</div>";
                                                if ($i % 3 == 0) {
                                                    print "</div>";
                                                }
                                            }
                                            $i++;
                                        }
                                        print "<div class = 'row mw-40'>";
                                        echo '<br>';

                                        echo '<div class = "col-sm-6 mt-20">
            <tr><th><input type="submit" class="btn btn-submit btn-block mw-20" value="Submit"></th>
            </div>
            ';
                                        echo '<div class = "col-sm-6 mt-20">
            <th><input type="reset" class="btn btn-reset btn-block mw-20" value = "Reset"></th></tr>
            </div>';
                                        print '</div>';
                                        echo '</form>';
                                        print "<br>The query is:";
                                        print "<br>SQLcmd=$SQLcmd";
                                        if ($query) {
                                            print "<div class = 'row ' >";
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
                              </table> </div>';
                                        }
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