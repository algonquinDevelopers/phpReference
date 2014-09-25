<html>
<head>
<link rel="stylesheet" type="text/css" href="css/temp.css">

	<title>Student Information</title>
</head>
<body>

<?php
include ('../config.php');
//include ('Search-engine.php');

echo "<table border='0'>
<tr>
<td class='viewstd'>Student Name</td>
<td class='viewstd'>Student No</td>
</tr>";

if(isset($_POST['viewstudent'])){
$ViewStudent2 = "SELECT DISTINCT
                       LastName,
					   FirstName,
                       Student_No
       from tblestudentsinfo where Student_No = '$_POST[hidden]' ";
mysqli_query($db,$ViewStudent2);
};

$result2 = mysqli_query($db,$ViewStudent2);
while($myrow = mysqli_fetch_array($result2)) {
 // echo "<form action=viewstudent.php method=post>";
  echo "<tr>";
  echo "<td>" . $myrow['LastName'] ."," . $myrow['FirstName'] . "</td>";
  echo "<td>" . $myrow['Student_No'] . "</td>";
  echo "</tr>";
}
echo "</table>";
echo "<hr>";
echo "<br />";
include ('courselevels.php');

?>
</body>
</html>