<?php

include "../env/db.php";
include "../env/tg.php";


if (isset ($_POST["item"])) {

    $item = $_POST["item"];

    if ($item == "course") {

        $alias = $_POST["alias"];
        $course_name = $_POST["course_name"];
        $total_sems = $_POST["total_sems"];

        $stmt = $db->prepare("INSERT INTO `courses` (alias, course_name, total_sems) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $alias, $course_name, $total_sems);
        $result = $stmt->execute();
        if ($result) {
            global $alias;
            $rtn_message = $alias . " successfully created";
            echo $rtn_message;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

    } elseif ($item == "subject") {

        $alias = $_POST["alias"];
        $name = $_POST["name"];
        $semester = $_POST["semester"];
        $course = $_POST["course"];

        $stmt_1 = $db->prepare("SELECT * FROM `subjects` WHERE semester=? AND course=? AND alias=?");
        $stmt_1->bind_param("iis", $semester, $course, $alias);
        $result_1 = $stmt_1->execute();

        if ($result_1) {

            $result_set = $stmt_1->get_result();

            if (mysqli_num_rows($result_set) > 0) {
                echo "Error: Alias name already exists";
                $stmt_1->close();
            } else {

                $stmt_1->close();
                $stmt_2 = $db->prepare("INSERT INTO `subjects` (alias, name, semester, course) VALUES (?, ?, ?, ?)");
                $stmt_2->bind_param("ssii", $alias, $name, $semester, $course);
                $result_2 = $stmt_2->execute();

                if ($result_2) {
                    global $alias;
                    $rtn_message_2 = $alias . " successfully created";
                    echo $rtn_message_2;
                } else {
                    echo "Error: " . $stmt_2->error;
                }
                $stmt_2->close();
            }

        }
    } elseif ($item == "notes" && isset ($_POST["title"]) && isset ($_POST["description"]) && isset ($_FILES["file_0"]) && isset($_POST["subject_id"])) {

        $title = $_POST["title"];
        $description = $_POST["description"];
        $subject_id = $_POST["subject_id"];
        $file_0 = $_FILES["file_0"];
        $image = curl_file_create($file_0["tmp_name"], $file_0["type"], $file_0["name"]);

        $query = "SELECT `id` FROM `notes` ORDER BY `id` DESC LIMIT 1";
        $result = mysqli_query($db, $query);

        if($result){
            $row = mysqli_fetch_assoc($result);
            $expected_id = (int)$row["id"] + 1;
        }else{
            $expected_id = -1;
        }


        $caption = "notes id = $expected_id";
        

        $url = 'https://api.telegram.org/bot' . $tg_token . '/sendDocument';

        $post_fields = array(
            'chat_id' => $tg_chat_id,
            'document' => $image,
            'caption' => $caption,
            'parse_mode' => "html"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);https://api.telegram.org/file/7047137904:AAGNGGGIWfJssjl9qE03zkXFAVKqeJS8DRU/documents/file_2.jpg

        $result = json_decode($result, true);

        $file_id = $result["result"]["document"]["file_id"];

        $query = "INSERT INTO `notes` (subject_id, title, file_id, description) VALUES ('$subject_id', '$title', '$file_id', '$description')";
        $result_2 = mysqli_query($db, $query);

        if($result_2){
            echo "Success";
        }else{
            echo "Error";
        }
        

    }
}

?>