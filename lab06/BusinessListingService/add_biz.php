<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./style.css">
    <title>Business</title>
</head>
<body>
<div class="container-fluid mt-20 h-100">
        <div class="intro row">
            <div class="bg-image h-100">
                <div class="mask d-flex vertical-center align-items-center justify-content-center h-100"
                    >
                    <div class="container mw-40 auto-margin ">
                        <div class="card mask-custom p-4 align-items-center justify-content-center">
                            <div class="card-body auto-padding d-flex horizontal-center">
    <h1 class="mb-20">Business Registration</h1>
    
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
        
        if (!empty($_POST) && !isset($_POST['cat'])) {
            print '<p> You must select category!</p>';
        }

        if (isset($_POST['cat'])) {
            $cats = $_POST['cat'];
            $bname = $_POST['bname'];
            $addr = $_POST['addr'];
            $city = $_POST['city'];
            $tele = $_POST['tele'];
            $url = $_POST['url'];
            mysqli_query($mysqli, "INSERT INTO Businesses VALUES(NULL,'$bname','$addr','$city','$tele','$url');");
            $getBID = mysqli_query($mysqli,"SELECT businessid FROM Businesses where name = '$bname' && City = '$city'");
            $bid = mysqli_fetch_row($getBID)[0];
            foreach ($cats as $cat) {
                mysqli_query($mysqli, "INSERT INTO Biz_Categories VALUES($bid,'$cat');");
            } 
            print '<p>Record inserted as shown below.';
            print '<br>';
            print '<form method=POST>';
            print '<select class="form-select form-select-lg mb-20" aria-label=".form-select-lg example" name="cat[]" multiple> disabled';
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
            print '<select class="form-select form-select-lg mb-20" aria-label=".form-select-lg example" name="cat[]" multiple> ';
            while ($row = mysqli_fetch_row($query)) {
                print "<option value=\"$row[0]\">$row[1]";
                print '</option>';
            }
            print '</select>';

            print '<br>';
            print '<table class = "mt-20">';
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
            print '<input class="btn btn-submit mt-20" type="submit" value="Add Business"/>';
            print '<br>';
            print '</form>';
        }
    ?>
</body>