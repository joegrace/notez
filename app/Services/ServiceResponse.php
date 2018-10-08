<?php

namespace App\Services;


class ServiceResponse implements \JsonSerializable {
    public $success;
    public $message;
    public $errors;

    public function jsonSerialize() {
        return $this;
    }
}