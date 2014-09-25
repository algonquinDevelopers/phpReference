<?php
//include ('../../config.php');
//include ('Search-engine.php');

$stdLevels = "SELECT DISTINCT
                       ALevel
       from tblestudentsinfo order by ALevel ASC";

$stdLevels2 = mysqli_query($db,$stdLevels);
 
while($myrow = mysqli_fetch_array($stdLevels2)) {


$ALevel = $myrow['ALevel'];

 echo "<table border='0'>
<tr>
<td class='viewstd'>Level : $ALevel</td>
</tr>";
//<th>Options</th>

echo "<table border='0'>
<tr>
<th>Student No</th>
<th>DeptCode</th>
<th>PgmName</th>
<th>PgmCode</th>
<th>CrsNum</th>
<th>CrsName</th>
<th>Grade</th>
</tr>";
echo "<hr>";

if(isset($_POST['viewstudent'])){
$ViewStudent = "SELECT DISTINCT
                       Student_No,
                       DeptCode,
                       PgmName,
					   PgmCode,
			           CrsNum,
			           CrsName,
			           Grade,
					   ALevel
       from tblestudentsinfo where ALevel = '$ALevel' And Student_No = '$_POST[hidden]' ";
mysqli_query($db,$ViewStudent);
};
$result2 = mysqli_query($db,$ViewStudent);
 
while($myrow = mysqli_fetch_array($result2)) {

$LevelChecker = $myrow['Student_No'];
}
if (!empty($LevelChecker)){
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

$result = mysqli_query($db,$ViewStudent);

while($myrow = mysqli_fetch_array($result)) {
 // echo "<form action=viewstudent.php method=post>";
 
  echo "<tr>";
  echo "<td>" . $myrow['Student_No'] . "</td>";
  echo "<td>" . $myrow['DeptCode'] . "</td>";
  echo "<td>" . $myrow['PgmName'] . "</td>";
  echo "<td>" . $myrow['PgmCode'] . "</td>";
  echo "<td>" . $myrow['CrsNum'] . "</td>";
  echo "<td>" . $myrow['CrsName'] . "</td>";
  if(empty($myrow['Grade'])){
  echo "<td class='uncomplete'>" . $myrow['Grade'] = 'Uncomplete' . "</td>";
  }
  else if ($myrow['Grade'] == "W" || $myrow['Grade'] == "F"){
  echo "<td class='uncomplete'>" . $myrow['Grade']. "</td>";
  }else
  echo "<td>" . $myrow['Grade'] . "</td>";
  echo "</tr>";
  
}
}else
  echo "No records to display";

echo "</table>";
echo "<br />";
}
//include ('unregcourse.php');

?>