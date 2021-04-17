<?php

use Config\App;
use Config\Services;

// --------------------------------------------------------------------

function traitResponse(string $status, int $code, $message = '', $data = [])
{
    return [
        'status'  => $status,
        'code'    => $code,
        'message' => $message,
        'data'    => $data,
    ];
}

// --------------------------------------------------------------------
// 200
function ok($message = '', $data = [])
{
    return traitResponse('Ok', 200, $message, $data);
};

function created($message = '', $data = [])
{
    return traitResponse('Created', 201, $message, $data);
};

// --------------------------------------------------------------------
// 400
function badRequest($message = '', $data = [])
{
    return traitResponse('Bad Request', 400, $message, $data);
}

function unauthorized($message = '', $data = [])
{
    return traitResponse('unauthorized', 400, $message, $data);
}

function notFound($message = '', $data = [])
{
    return traitResponse('Not Found', 404, $message, $data);
}

function conflict($message = '', $data = [])
{
    return traitResponse('Conflict', 409, $message, $data);
}
