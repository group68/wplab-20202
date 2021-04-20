<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./style.css">
    <title>Business Listings</title>
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
    <h1>Business Listings</h1>
    <?php
        $ini = parse_ini_file('./app.ini');
        $server = $ini['server'];
        $user = $ini['user'];
        $pass = $ini['pass'];
        $mydb = $ini['mydb'];
        $mysqli = mysqli_connect($server, $user, $pass);
        if (!$mysqli) {
            die("Cannot connect to $server using $user");
        }
        mysqli_select_db($mysqli, $mydb);

        print '<table class="table mt-20" cellpadding="0" cellspacing="0" border="0">';
        print '<tr><th>Click on a category to find business listings:</th></tr>';
        $query = mysqli_query($mysqli,"SELECT CategoryID, title FROM Categories;");
        while ($row = mysqli_fetch_row($query)) {
            print '<tr><td>';
            print "<a href='biz_listing.php?cat_id=$row[0]'>$row[1]</a>";
            print '</td></tr>';
        }
        print '</table>';

        if (isset($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            $query = mysqli_query($mysqli,"SELECT * FROM Businesses NATURAL JOIN Biz_Categories WHERE CategoryID = '$cat_id';");
            print '<table class="table mt-20" cellpadding="0" cellspacing="0" border="0">';
            print '<thead>
            <tr><th>ID</th><th>BrandName</th><th>Address</th><th>City</th><th>Tele</th><th>Url</th><th>CategoryID</th></tr>
            </thead>';
            while ($row = mysqli_fetch_row($query)) {
                print '<tr>';
                foreach ($row as $field){
                    print "<td>$field</td> ";
                    }
                print '</tr>';
            }
            print '</table>';
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