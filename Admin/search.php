<?php
include ('../config.php');
include ('Search-engine.php');
echo "<center>";
include ('pagination.php');

if (!empty($_GET['studentNumber'])){
	echo "<table border='0'>
<tr>
<th>Student No</th>
<th>DeptCode</th>
<th>PgmName</th>
<th>PgmCode</th>
<th>CrsNum</th>
<th>CrsName</th>
</tr>";
	
$sql = "SELECT DISTINCT 
                       Student_No,
                       StdName,
                       DeptCode,
					   PgmName,
			           PgmCode
					   FROM tblestudentsinfo WHERE Student_No LIKE '%$_GET[studentNumber]%' limit $pn, $itemsPerPage";
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
}
echo "</table>";
}
else{
echo "No records to display";
}

echo "</center>";
echo "<hr>";
echo "<a href='./StudentInfo.php'>Go Back</a>";

?>