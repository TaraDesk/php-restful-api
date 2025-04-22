<?php

function handleException(Throwable $exception) {
    $code = $exception->getCode();

    if ($code < 100 || $code > 599) {
        $code = 500;
    }

    http_response_code($code);

    header("Content-type: application/json; charset=UTF-8");

    echo json_encode([
        'error' => true,
        'message' => $exception->getMessage(),
        'code' => $code,
    ]);
}

set_exception_handler('handleException');

?>