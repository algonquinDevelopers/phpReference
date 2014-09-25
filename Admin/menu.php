<!DOCTYPE html>
<html>
  <head>
    <title>Admin Panel</title>
	<meta charset='utf-8'>
	<link rel="stylesheet" type='text/css' href="css/temp.css">
    <script src='js/jquery-1.11.1.min.js' type='text/javascript'> </script>
  <script>
  $(function(){
    $('.headblock').click(function(){
	  $(this).next('.bodyblock').toggle()
	
	});
  });
  </script>
  </head>
  
  <body>
  <center>
    <h1>DASHBOARD</h1>
	<hr>
    <a href='../index.php' target="_blank">Home page</a>
	<br />
	<a href='logout.php'>Sign out</a>
  </center>
  
  <div class='headblock'>
  Administrator Options
  </div>
  
  <div class='bodyblock'>
   <ul>
	 <li><a target='home' href='editadmin.php'>Edit Admin Account</a></li>
     <li><a target='home' href='addadmin.php'>Add Coordinator</a></li>
   </ul>
  </div>
  
  <div class='headblock'>
  Students Info.
  </div>
  
  <div class='bodyblock'>
   <ul>
     <li><a target='home' href='studentinfo.php'>View Student Info.</a></li>
   </ul>
  </div>
  
  
  
  </body>
</html>