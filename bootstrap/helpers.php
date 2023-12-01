<?php

if (! function_exists('api')) {
    function api() {
        return app(\App\Services\OutlineVPN\ApiClient::class);
    }
}
