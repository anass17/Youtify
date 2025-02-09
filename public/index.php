<?php

    session_start();

    include '../app/config/config.php';

    spl_autoload_register(function ($className) {
        if (file_exists(APPROOT . '/libraries/' . $className . '.php')) {
            require APPROOT . '/libraries/' . $className . '.php';
        } else {
            require APPROOT . '/models/' . $className . '.php';
        }
    });

    $router = new Router();
    $db = Database::getInstance();

?>