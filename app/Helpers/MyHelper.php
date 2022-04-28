<?php

function prx($data)
{
    echo "<pre> data \n";;
    print_r($data);
    exit;
}
function pr($data)
{
    echo "<pre> data \n";;
    print_r($data);
}

function f1($a, $b)
{
    $c = $a . "," . bin2hex($b);
    return $c;
}
function f2($a)
{
    $b = hash('sha256', $a);
    return $b;
}