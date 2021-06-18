<?php
	
	$con=mysqli_connect('localhost:3306','popular2_admin','123456','popular2_new_database');
    
    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
?>