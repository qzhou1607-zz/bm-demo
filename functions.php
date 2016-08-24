<?php

function prd($var) {
    echo '<pre>';
    print_r($var);
    die();
}

function get($var) {
    if (isset($var)) {
        return $var;
    } else {
        return null;
    }
}

