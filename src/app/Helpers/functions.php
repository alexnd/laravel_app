<?php

if (!function_exists('is_ff')) {
    function is_ff($id) {
        return \App\Helpers\FlagsConfig::get($id);
    }
}

if (!function_exists('ff_all')) {
    function ff_all($client = false) {
        if ($client) return \App\Helpers\FlagsConfig::allClient();
        return \App\Helpers\FlagsConfig::all();
    }
}

if (!function_exists('ff_sync_default')) {
    function ff_sync_default() {
        \App\Helpers\FlagsConfig::syncWithDefault();
    }
}

if (!function_exists('userip')) {
    function userip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}

if (!function_exists('is_xhr_request')) {
    function is_xhr_request() {
        $http_x_requested_with = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? false;
        if (!empty($http_x_requested_with) && strtolower($http_x_requested_with) == 'xmlhttprequest') {
            return true;
        }
        $http_content_type = $_SERVER['HTTP_ACCEPT'] ?? false;
        if (!empty($http_content_type) && preg_match('!application/json!', $http_content_type)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('gen_uuid')) {
    function gen_uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}

if (!function_exists('is_uuid')) {
    function is_uuid($v)
    {
        return preg_match(
            '!^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$!', $v
        );
    }
}

if (!function_exists('is_phone')) {
    function is_phone($v)
    {
        return preg_match('!^[+]?[0-9]{7,20}$!', $v);
    }
}

if (!function_exists('str_filter_phone')) {
    function str_filter_phone($v)
    {
        return preg_replace('/[^+0123456789]/', '', $v);
    }
}
