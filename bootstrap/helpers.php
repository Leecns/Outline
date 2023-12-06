<?php

if (! function_exists('api')) {
    function api(string $apiUrl): \App\Services\OutlineVPN\ApiClient
    {
        return new \App\Services\OutlineVPN\ApiClient($apiUrl);
    }
}
