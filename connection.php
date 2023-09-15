<?php
//info de connection à la BD
$dbname= "film_api";
$host= "localhost";
$username= "root";
$password= "";

//connection à la BD
$con = mysqli_connect($host, $username, $password, $dbname);

//verification
if (!$con){
   echo "Message: impossible de se connecter à la bd" ;
 else();
}

/*
1.Get
2. Insert
3.Update
4.Delete
*/

    


?>