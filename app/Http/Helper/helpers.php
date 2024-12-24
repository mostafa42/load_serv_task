<?php

use Illuminate\Support\Facades\Config;

function success()
{
    return 1;
}

function error()
{
    return 0;
}

function blocked()
{
    return 400;
}

function expired()
{
    return 0;
}


function failed()
{
    return 0;
}
function res($lang, $status, $key, $data = null)
{
    $lang="en";
    $response['status'] = $status;
    $response['message'] = Config::get('response.' . $key . '.' . $lang);
    if ($data != null) {
        $response['data'] = $data;
    } else {
        $response['data'] = [];
    }
    return $response;
}

