
<html>
<head>
<title> Access the restaurant database with MySQL </title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php

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

$var1 = $_POST['OrderID'];
$var2 = $_POST['ostatus'];

// Clean up the given query (delete leading and trailing whitespace)
trim($query);
trim($var1);
trim($var2);

// remove the extra slashes
$query = stripslashes($query);
$var1 = stripslashes($var1);
$var2 = stripslashes($var2);

// handle HTML special characters
$query_html = htmlspecialchars($query);

$query = "UPDATE Orders SET ostatus = '$var2' WHERE OrderId = $var1";

print "<p>Query: ".$query_html."</p>";

// Execute the query
$result = mysql_query($query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

// Display the results in a table
print "<table border='border'><caption> <h2> Query Results </h2> </caption>";
print "<tr align = 'center'>";

mysql_close($conn);
?>

<br /> <br />
<a href="http://css1.seattleu.edu/~mnguyen7/dbtest/t.html"> Go to Main Page </a>
</body>
</html>