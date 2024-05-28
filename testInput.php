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

function test_numeric($data) {
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
        $data = preg_replace('~\D~', '', $data);
        return $data;
    }
}

function test_email($data) {
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
        if(filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return $data;
        } else {
            return "";
        }
    }
}