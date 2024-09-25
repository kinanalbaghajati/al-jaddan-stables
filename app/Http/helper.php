<?php

if (!function_exists('createNotification')) {
    function createNotification($alertType, $message) {
        return [
            'message' => $message,
            'alert-type' => $alertType
        ];
    }
}
