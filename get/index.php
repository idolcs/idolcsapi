<?php

include "../env/db.php";

if(isset($_GET["item"])){

    $item = $_GET["item"];

    if($item == "courses"){
        $query = "SELECT * FROM `courses`";
        $result = mysqli_query($db, $query);
        if($result){
            $rtn_array = [];
            while($row = mysqli_fetch_assoc($result)){
                array_push($rtn_array, $row);
            }
            $json_array = json_encode($rtn_array);
            print_r($json_array);
        }
    }elseif($item == "subjects" && isset($_GET["course"]) && isset($_GET["semester"])){
        $course = $_GET["course"];
        $semester = $_GET["semester"];
        $query = "SELECT * FROM `subjects` WHERE `course`='$course' AND `semester`='$semester'";
        $result = mysqli_query($db, $query);
        if($result){
            $rtn_array = [];
            while($row = mysqli_fetch_assoc($result)){
                array_push($rtn_array, $row);
            }
            $json_array = json_encode($rtn_array);
            print_r($json_array);
        }
    }elseif($item=="notes" && isset($_GET["subject"]) && isset($_GET["course"]) && isset($_GET["semester"])){
        $subject = $_GET["subject"];
        $course = $_GET["course"];
        $semester = $_GET["semester"];

    }

}

?>