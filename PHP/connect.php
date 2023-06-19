<?php
    $db = new mysqli("localhost","root","","hospital");
    $db->set_charset("utf8");

    function query($query){
        global $db;
        return $db->query($query);
    }
?>