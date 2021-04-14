<html>
<head>
    <title>Business</title>
</head>
<body>
    <h1>Business Registration</h1>
    
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

        $query = mysqli_query($mysqli, "SELECT CategoryID, Title FROM Categories");
        
        
        if (isset($_POST['cat'])) {
            $cats = $_POST['cat'];
            $bname = $_POST['bname'];
            $addr = $_POST['addr'];
            $city = $_POST['city'];
            $tele = $_POST['tele'];
            $url = $_POST['url'];
            mysqli_query($mysqli, "INSERT INTO businesses VALUES(NULL,'$bname','$addr','$city','$tele','$url');");
            $getBID = mysqli_query($mysqli,"SELECT businessid FROM businesses where name = '$bname' && City = '$city'");
            $bid = mysqli_fetch_row($getBID)[0];
            foreach ($cats as $cat) {
                mysqli_query($mysqli, "INSERT INTO biz_categories VALUES($bid,'$cat');");
            } 
            print '<p>Record inserted as shown below.';
            print '<br>';
            print 'Selected category values are highlighted';
            print '<form method=POST>';
            print '<select name="cat[]" multiple> disabled';
            while ($row = mysqli_fetch_row($query)) {
                if (in_array($row[0],$cats)){
                    print "<option value=\"$row[0]\" selected disabled>$row[1]";
                    print '</option>';
                } else {
                    print "<option value=\"$row[0]\" disabled>$row[1]";
                    print '</option>';
                }
            }
            print '</select>';
            
            print '<table>';
            print "<tr><td>Business Name:</td>
                <td><input type='text' name='bname' value='$bname' readonly></td></tr>";
            print "<tr><td>Address:</td>
                <td><input type='text' name='addr' value='$addr' readonly></td></tr>";
            print "<tr><td>City:</td>
                <td><input type='text' name='city' value='$city' readonly></td></tr>";
            print "<tr><td>Telephone:</td>
                <td><input type='text' name='tele' value='$tele' readonly></td></tr>";
            print "<tr><td>URL:</td>
                <td><input type='text' name='url' value='$url' readonly></td></tr>";
            print '</table>';
            print '<br>';
            // print '<input type="submit" value="Add Business">';
            print '</form>';

            print '<br>';
            print '<a href="add_biz.php">Add another business</a>';
        } else {      
            print '<p>
                        Click on one, or control-click on multiple categories
                   </p>';
            
            print '<form method=POST>';
            print '<select name="cat[]" multiple> ';
            while ($row = mysqli_fetch_row($query)) {
                print "<option value=\"$row[0]\">$row[1]";
                print '</option>';
            }
            print '</select>';

            print '<br>';
            print '<table>';
            print '<tr><td>Business Name:</td>
            <td><input type="text" name="bname"></td></tr>';
            print '<tr><td>Address:</td>
            <td><input type="text" name="addr"></td></tr>';
            print '<tr><td>City:</td>
            <td><input type="text" name="city"></td></tr>';
            print '<tr><td>Telephone:</td>
            <td><input type="text" name="tele"></td></tr>';
            print '<tr><td>URL:</td>
            <td><input type="text" name="url"></td></tr>';
            print '</table>';
            print '<br>';
            print '<input type="submit" value="Add Business"/>';
            print '<br>';
            print '</form>';
        }
    ?>
</body>