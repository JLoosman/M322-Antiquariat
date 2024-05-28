<?php
function test_input($data) {
    if(is_array($data)) {
        $arr = [];
        foreach ($data as $dataset) {
            array_push($arr, test_input($dataset));
        }
        return $arr;
    } else {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>