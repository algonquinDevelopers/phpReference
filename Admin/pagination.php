<html>
<head>
<link rel="stylesheet" type="text/css" href="css/pagination.css">
<link rel="stylesheet" type="text/css" href="css/temp.css">
</head>
</hr>
<?php
include ('../config.php');
//Reference: http://www.developphp.com/page.php?id=289
// Adam's Custom PHP MySQL Pagination Tutorial and Script
// You have to put your mysql connection data and alter the SQL queries(both queries)
// This script is in tutorial form and is accompanied by the following video:
// http://www.youtube.com/watch?v=K8xYGnEOXYc
//mysql_connect("DB_Host_Here","DB_Username_Here","DB_Password_Here") or die (mysql_error());
//mysql_select_db("DB_Name_Here") or die (mysql_error());
//////////////  QUERY THE MEMBER DATA INITIALLY LIKE YOU NORMALLY WOULD
//$sql = mysql_query("SELECT id, firstname, country FROM myTable ORDER BY id ASC");
//////////////////////////////////// Adam's Pagination Logic ////////////////////////////////////////////////////////////////////////
//$nr = mysql_num_rows($sql); // Get total of Num rows from the database query
/*
$sql = "SELECT * from tblestudentsinfo";
$result = mysqli_query($db,$sql);
$nr = mysqli_num_rows($result);
*/

$sql = "SELECT DISTINCT 
               Student_No,
                       DeptCode,
                       PgmName,
					   PgmCode,
			           CrsNum,
			           CrsName,
			           Grade FROM tblestudentsinfo WHERE Student_No LIKE '%$_GET[studentNumber]%'";
$result = mysqli_query($db,$sql);
$nr = mysqli_num_rows($result);

if (isset($_GET['pn'])) { // Get pn from URL vars if it is present
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); // filter everything but numbers for security(new)
    //$pn = ereg_replace("[^0-9]", "", $_GET['pn']); // filter everything but numbers for security(deprecated)
} else { // If the pn URL variable is not present force it to be value of page number 1
    $pn = 1;
} 
//This is where we set how many database items to show on each page 
$itemsPerPage = 10; 
// Get the value of the last page in the pagination result set
$lastPage = ceil($nr / $itemsPerPage);
// Be sure URL variable $pn(page number) is no lower than page 1 and no higher than $lastpage
if ($pn < 1) { // If it is less than 1
    $pn = 1; // force if to be 1
} else if ($pn > $lastPage) { // if it is greater than $lastpage
    $pn = $lastPage; // force it to be $lastpage's value
} 
// This creates the numbers to click in between the next and back buttons
// This section is explained well in the video that accompanies this script
$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
}
// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
// Now we are going to run the same query as above but this time add $limit onto the end of the SQL syntax
// $sql2 is what we will use to fuel our while loop statement below
//$sql2 = mysql_query("SELECT id, firstname, country FROM myTable ORDER BY id ASC $limit"); 



//////////////////////////////// END Adam's Pagination Logic ////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// Adam's Pagination Display Setup /////////////////////////////////////////////////////////////////////
$paginationDisplay = ""; // Initialize the pagination output variable
// This code runs only if the last page variable is ot equal to 1, if it is only 1 page we require no paginated links to display
if ($lastPage != "1"){
    // This shows the user what page they are on, and the total number of pages
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    // If we are not on page 1 we can place the Back button
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"> <span class="paginationBack"><</span></a> ';
    } 
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
    // If we are not on the very last page we can place the Next button
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> <span class="paginationNext">></span></a> ';
    } 
}
///////////////////////////////////// END Adam's Pagination Display Setup ///////////////////////////////////////////////////////////////////////////
// Build the Output Section Here
//$outputList = '';

$sql = "SELECT DISTINCT 
               Student_No,
               StdName,
			   DeptCode,
			   PgmName,
			   PgmCode
       from tblestudentsinfo ORDER BY student_no ASC $limit";
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


echo "<br />";
echo $paginationDisplay;
echo "<br />";

?>
</html>