
<html>
<head>
<title> Access the restaurant database with MySQL </title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php

// --Delete customer--
// Connect to MySQL

$servername = "cs100.seattleu.edu";
$username = "user45";
$password = "1234abcdF!";

$conn = mysql_connect($servername, $username, $password);

if (!$conn) {
     print "Error - Could not connect to MySQL ".$servername;
     exit;
}

// db from minh
$dbname = "bw_db45";

$db = mysql_select_db($dbname, $conn);
if (!$db) {
    print "Error - Could not select the database ".$dbname;
    exit;
}

$query = $_POST['query'];
$id = $_POST['BranchID'];

// Clean up the given query (delete leading and trailing whitespace)
trim($query);
trim($id);

// remove the extra slashes
$query = stripslashes($query);
$id = stripslashes($id);

// handle HTML special characters
$query_html = htmlspecialchars($query);

//Delete query
$query = "DELETE FROM `Branch` WHERE BranchID = '$id'";

// Execute the query
$result = mysql_query($query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}else{

    print "<p>";
    print "Branch with BranchID = '$id' was deleted from the database.";
    print "<p>";
}

mysql_close($conn);
?>

<br /> <br />
<a href="http://css1.seattleu.edu/~mnguyen7/dbtest/t.html"> Go to Main Page </a>
</body>
</html>
