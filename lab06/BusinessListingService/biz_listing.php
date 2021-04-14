<html>
<head>
    <title>Business Listings</title>
</head>
<body>
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

        print '<table border=1>';
        print '<tr><th>Click on a category to find business listings:</th></tr>';
        $query = mysqli_query($mysqli,"SELECT CategoryID, title FROM categories;");
        while ($row = mysqli_fetch_row($query)) {
            print '<tr><td>';
            print "<a href='biz_listing.php?cat_id=$row[0]'>$row[1]</a>";
            print '</td></tr>';
        }
        print '</table>';

        if (isset($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            $query = mysqli_query($mysqli,"SELECT * FROM Businesses JOIN Biz_Categories ON (businesses.BusinessID = biz_categories.BusinessID) WHERE CategoryID = '$cat_id';");
            print '<table border=1>';
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
</body>