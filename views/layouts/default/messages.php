<?php


function _printMessages(){
    $types = array("success", "error", "info");
    foreach ($types as $type) {
        if(isset($_SESSION[$type]) && !empty($_SESSION[$type]) && is_array($_SESSION[$type])) {
            foreach ($_SESSION[$type] as $msg) {
                $shout = strtoupper($type);
                echo "<div class='notification $type' onclick='$(this).fadeOut(650)'> <span class='strong'>$shout!</span> $msg </div>";
            }
            unset($_SESSION[$type]);
        }
    }

}
