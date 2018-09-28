<?php
include('src/db/database.php');

class Todo {

    public function index($user_id)
    {
        global $connect;
        $stmt = $connect->prepare("SELECT * FROM todo WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
        $stmt->close();
        $connect->close();
    }

    public function show($user_id,$id)
    {
    	global $connect;
    	$stmt = $connect->prepare("SELECT body FROM todo where id=? AND user_id=?");
    	$stmt->bind_param("ii", $user_id,$id);
        $stmt->execute();
        return $stmt->get_result();
        $stmt->close();
        $connect->close();
    }

    public function create($body,$user_id)
    {
    	global $connect;
    	try{
    	$stmt = $connect->prepare("INSERT INTO  todo (body, user_id) VALUES (?, ?)");
    	$stmt->bind_param("si", $body,$user_id);
        $stmt->execute();
        $stmt->close();
        $connect->close();
    	}catch (Exception $e) {
			    echo 'Error creating todo';
		}
    }

    public function update($body,$id)
    {
    	global $connect;
    	try{
    	$stmt = $connect->prepare("UPDATE todo SET body=? WHERE id=?");
    	$stmt->bind_param("si", $body,$id);
        $stmt->execute();
        $stmt->close();
        $connect->close();
    	}catch (Exception $e) {
			    echo 'Error creating todo';
		}
    }
    
    public function delete($id)
    {
    	global $connect;
    	try{
    	$stmt = $connect->prepare("DELETE FROM todo WHERE id=?");
    	$stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
        $connect->close();
    	}catch (Exception $e) {
			    echo 'Error creating todo';
		}
    }
}


?>