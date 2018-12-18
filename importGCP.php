<?php

// This file takes a csv file and does a insert/replace into a MYSQL database

$conn = mysqli_connect($_ENV["GCP_DB"], $_ENV["GCP_USER"], $_ENV["GCP_PW"], $_ENV["GCP_DB"]);
if (!$conn) {
    die('Connect Error');
}

//Select Database
$db_selected = mysqli_select_db($conn, $_ENV["GCP_DB"]);
if (!$db_selected) {
    die ('Can\'t use db : ');
}

//Perform Query

$filename=$_GET['filename'];

$i = 0;

	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {

			if (empty($getData[0])) { $value1=' '; }  else { $value1=$getData[0]; }
			if (empty($getData[1])) { $value2=' '; }  else { $value2=$getData[1]; }
			if (empty($getData[2])) { $value3=' '; }  else { $value3=$getData[2]; }
 
	           $sql = "REPLACE into table (value1, value2, value3)
                   values ('".$value1."','".$value2."','".$value3."')";

                   $result = mysqli_query($conn, $sql);

                                if($result !=1) { echo "There was a problem with upload."; echo "----\n" . $sql . "----\n"; } else { echo "Result was success."; }

				if(!isset($result))
				{
					echo "Please upload CSV file";
				}
				else {
					  echo "line " . $i . " complete. \n";
					  $i = $i + 1;
				}
	         }
		 echo "All done.\n";
 ?>


