<?php
    $db_server=getenv("MYSQLHOST");  // ← Railway value
    $db_user=getenv("MYSQLUSER");
    $db_pass=getenv("MYSQLPASSWORD");
    $db_name=getenv("MYSQLDATABASE");
    $db_port = getenv("MYSQLPORT");

    $conn="";

    try{
        $conn=mysqli_connect($db_server,
                        $db_user,
                        $db_pass,
                        $db_name,
                        $db_port);
    }

    catch(mysqli_sql_exception){
        echo "could not connect<br>";
    }
?>