
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

$var1 = $_POST['BranchID'];
$var2 = $_POST['bname'];
$var3 = $_POST['bphone'];
$var4 = $_POST['street'];
$var5 = $_POST['city'];
$var6 = $_POST['state'];
$var7 = $_POST['zip'];

// Clean up the given query (delete leading and trailing whitespace)
trim($query);
trim($var1);
trim($var2);
trim($var3);
trim($var4);
trim($var5);
trim($var6);
trim($var7);

// remove the extra slashes
$query = stripslashes($query);
$var1 = stripslashes($var1);
$var2 = stripslashes($var2);
$var3 = stripslashes($var3);
$var4 = stripslashes($var4);
$var5 = stripslashes($var5);
$var6 = stripslashes($var6);
$var7 = stripslashes($var7);

// handle HTML special characters
$query_html = htmlspecialchars($query);

$query ="Insert into `Branch` (`BranchID`,`bname`,`bphone`,`street`,`city`,`state`,`zip`) values ('$var1', '$var2', '$var3', '$var4', '$var5', '$var6', '$var7');";

// Execute the query
$result = mysql_query($query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysql_error();
    print "<p>" . $error . "</p>";
    exit;
}

// Display the results in a table
$num_rows = mysql_num_rows($result);
$num_fields = mysql_num_fields($result);
$row = mysql_fetch_array($result);

// Display the results in a table
print "<table border='border'><caption> <h2> Query Results </h2> </caption>";
print "<tr align = 'center'>";

// Produce the column labels
$keys = array_keys($row);
for ($index = 0; $index < $num_fields; $index++) 
    print "<th>" . $keys[2 * $index + 1] . "</th>";

print "</tr>";

// Output the values of the fields in the rows
for ($row_num = 0; $row_num < $num_rows; $row_num++) {

    print "<tr align = 'center'>";
    $values = array_values($row);
	
    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<td>" . $value . "</td> ";
    }

    print "</tr>";
    $row = mysql_fetch_array($result);
}

print "</table>";

print "New branch was inserted into Branch with <p>";
print "BranchID = '$var1',<p> bname = '$var2',<p> bphone = '$var3',<p> street = '$var4',<p> city = '$var5',<p> state = '$var6',<p> zip = '$var7' <p>";
print "<p>";


mysql_close($conn);
?>

<br /> <br />
<a href="http://css1.seattleu.edu/~mnguyen7/dbtest/t.html"> Go to Main Page </a>
</body>
</html>
