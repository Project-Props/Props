<?php

class Logger {
  public static function log($message, $data = []) {
    $stream = new Monolog\Handler\StreamHandler('log/log.log', Monolog\Logger::DEBUG);

    $log = new Monolog\Logger('log');
    $log->pushHandler($stream);

    $log->addInfo($message, $data);
  }
}
