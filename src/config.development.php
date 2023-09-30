<?php

/**
 * PHPMaker 2023 configuration file (Development)
 */

return [
    "Databases" => [
        "DB" => ["id" => "DB", "type" => "MYSQL", "qs" => "`", "qe" => "`", "host" => "localhost", "port" => "3306", "user" => "root", "password" => "", "dbname" => "jootidigitalhealthcare"]
    ],
    "SMTP" => [
        "PHPMAILER_MAILER" => "smtp", // PHPMailer mailer
        "SERVER" => "mail.theclinicianshub.co.ke", // SMTP server
        "SERVER_PORT" => 993, // SMTP server port
        "SECURE_OPTION" => "ssl",
        "SERVER_USERNAME" => "info@theclinicianshub.co.ke", // SMTP server user name
        "SERVER_PASSWORD" => "theclinicianshub_1044", // SMTP server password
    ],
    "JWT" => [
        "SECRET_KEY" => "V4Ou4i3sz2LvC7e6", // API Secret Key
        "ALGORITHM" => "HS512", // API Algorithm
        "AUTH_HEADER" => "X-Authorization", // API Auth Header (Note: The "Authorization" header is removed by IIS, use "X-Authorization" instead.)
        "NOT_BEFORE_TIME" => 0, // API access time before login
        "EXPIRE_TIME" => 600 // API expire time
    ]
];
