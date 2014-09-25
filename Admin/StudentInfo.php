<html>
  <head>
    <title>Admin Panel</title>
	<meta charset='utf-8'>
	<link rel="stylesheet" type='text/css' href="css/temp.css">
<body>

<?php
include ('../config.php');
include ('Search-engine.php');

echo "<center>";

include ('pagination.php');

 echo "<table border='0'>
<tr>
<th>Student No</th>
<th>StdName</th>
<th>DeptCode</th>
<th>PgmName</th>
<th>PgmCode</th>
<th>Options</th>
</tr>";

//$pn = 1;
//$itemsPerPage = 10;

$sql = "SELECT DISTINCT 
               Student_No,
               StdName,
			   DeptCode,
			   PgmName,
			   PgmCode
       from tblestudentsinfo limit $pn, $itemsPerPage";
/*
$_Student_No = $_GET['Student_No'];
$_StdName = $_GET['StdName'];
$_DeptCode = $_GET['DeptCode'];
$_SectNum = $_GET['SectNum'];
$_PgmCode = $_GET['PgmCode'];
$_PgmName = $_GET['PgmName'];
$_Term = $_GET['Term'];
$_CrsName = $_GET['CrsName'];
$_CrsNum = $_GET['CrsNum'];
$_ALevel = $_GET['ALevel'];
$_Grade = $_GET['Grade'];
*/

$result = mysqli_query($db,$sql);
 
while($myrow = mysqli_fetch_array($result)) {
  echo "<form action=viewstudent.php method=post>";
  echo "<tr>";
  echo "<td>" . $myrow['Student_No'] . "</td>";
  echo "<td>" . $myrow['StdName'] . "</td>";
  echo "<td>" . $myrow['DeptCode'] . "</td>";
  echo "<td>" . $myrow['PgmName'] . "</td>";
  echo "<td>" . $myrow['PgmCode'] . "</td>";
  echo "<td>". "<input class='minimal' type=submit name=viewstudent value='Edit Student'>" ."</td>";
  echo "<input type=hidden name=hidden value=" . $myrow['Student_No'] . ">";
  echo "</tr>";
  echo "</from>";
}
echo "</table>";
echo "</center>";
?>

</body>