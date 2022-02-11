<?php
  $fn = fopen("file.txt","r");
  
  while(! feof($fn))  {
	$result = fgets($fn);
	$query='select A.baseUrl, B.isblocked from detail as A inner join ost_ticket as B on A.ticketId=B.ticketID 
			where B.isblocked=1 and A.baseUrl=$result';
	$conn = mysqli_connect("localhost", "root", "asd123");
	$db = mysqli_select_db($conn, "asts");
	$result = mysqli_query($conn,$query) or die("Error: ".mysqli_error($conn));
	foreach($result as $rows){
		echo $result[1]+' '+$result[2]+'<br>';
		  }
	//echo $result.'<br>';
  }

  fclose($fn);
?>