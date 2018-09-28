<?php
include('src/db/database.php');
session_start();


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

    public function login($email,$password){
    	global $connect;
    	
    	$stmt = $connect->prepare("SELECT * FROM user where email=? AND password=?");
    	$stmt->bind_param("ss", $email,$password);
        $stmt->execute();
        return $stmt->get_result();
        $stmt->close();
        $connect->close();
    	
    }

    public function generateToken($email,$password,$token){
    	global $connect;
    	
    	$stmt = $connect->prepare("UPDATE user SET token = ? WHERE email=? And password=?");
    	$stmt->bind_param("sss", $token,$email,$password);
        $stmt->execute();
        return $stmt->get_result();
        $stmt->close();
        $connect->close();
    	
    }	

    public function fetchByToken($token){
        global $connect;
    	
    	try{
    	$stmt = $connect->prepare("SELECT * FROM user where token=?");
    	$stmt->bind_param("s", $token);
        $stmt->execute();
        return $stmt->get_result();
        $stmt->close();
        $connect->close();
    	}catch(Exception $e){
    		echo $e->message;
    	}

    }
}

?>