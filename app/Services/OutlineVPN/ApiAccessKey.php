<?php

namespace App\Services\OutlineVPN;

class ApiAccessKey
{
    public string $id;
    public string $name;
    public string $password;
    public int $port;
    public string $method;
    public string $accessUrl;
    public ?int $dataLimitInBytes;

    public static function fromObject(?object $input): static
    {
        $key = new static;
        $key->id = $input->id;
        $key->name = $input->name;
        $key->password = $input->password;
        $key->port = $input->port;
        $key->method = $input->method;
        $key->accessUrl = $input->accessUrl;

        if (isset($input->dataLimit))
            $key->dataLimitInBytes = $input->dataLimit->bytes;
        else
            $key->dataLimitInBytes = null;

        return $key;
    }
}
