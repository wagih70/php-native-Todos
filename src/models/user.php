<?php
include('src/db/database.php');

class User {
     
    public function signup($name,$email,$password,$token){
    	global $connect;
    	try{
    	$stmt = $connect->prepare("INSERT INTO  user (name,email,password,token) VALUES (? ,?, ?, ?)");
    	$stmt->bind_param("ssss", $name,$email,$password,$token);
        $stmt->execute();
        $stmt->close();
        $connect->close();
    	}catch (Exception $e) {
			    echo 'Error signing up';
		}
         
    }	
}

?>