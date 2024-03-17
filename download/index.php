<?php

include "../env/db.php";
include "../env/tg.php";

if (isset ($_GET["item"])) {
    $item = $_GET["item"];

    if ($item == "notes" && isset ($_GET["notes_id"])) {
        $notes_id = $_GET["notes_id"];
        $query_1 = "SELECT `file_id` FROM `notes` WHERE id='$notes_id'";
        $result_1 = mysqli_query($db, $query_1);
        
        if ($result_1) {
            $row = mysqli_fetch_assoc($result_1);
            $file_id = $row["file_id"];
            $url = "https://api.telegram.org/bot" . $tg_token . "/getFile?file_id=" . $file_id;
            $file_path = json_decode(file_get_contents($url), true)["result"]["file_path"];
            $filedl_url = "https://api.telegram.org/file/bot" . $tg_token . "/" . $file_path; 
            header('Content-Type: application/octet-stream');  
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"" . basename($filedl_url) . "\"");
            readfile($filedl_url);
        }
    }
}
