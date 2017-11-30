<?php
header('Content-Type: text/html; charset=utf-8');


function connect($host, $r, $pass, $bd) {
    return mysqli_connect($host, $r, $pass, $bd);
}


function query($link, $query) {
    if(!empty($link) && !empty($query)) {
        return mysqli_query($link, $query);
    } else return false;
}


function fetch_assoc($res) {
    if(!empty($res)) {
        return mysqli_fetch_assoc($res);
    } else return false;
}


function fetch_assoc_all($res) {
    if(!empty($res)) {
        $array = array();
        while ($r = mysqli_fetch_assoc($res)) {
            $array[] = $r;
        }
        return $array;
    } else return false;
}


function close($link) {
    if (empty(mysqli_connect_errno ())) mysqli_close($link);
}
