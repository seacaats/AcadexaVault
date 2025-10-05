<?php

$env_path = '../../.env';

if (file_exists($env_path)) {
    $lines = file($env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line); //cut trailing whitespaces
        if (empty($line) || strpos($line, '#') === 0) continue; //skip empty lines and comments
        if (strpos($line, '=') == true) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            
            $_ENV[$name] = $value;
            putenv("$name=$value");
        }
    }
} else {
    die('.env file not found!');
}

?>