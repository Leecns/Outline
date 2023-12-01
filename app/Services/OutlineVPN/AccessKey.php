<?php

namespace App\Services\OutlineVPN;

use stdClass;

class AccessKey
{
    public string $id;
    public string $name;
    public string $password;
    public int $port;
    public string $method;
    public string $accessUrl;
    public stdClass $dataLimit;

    public static function fromObject(stdClass $input): static
    {
        $key = new static;
        $key->id = $input->id;
        $key->name = $input->name;
        $key->password = $input->password;
        $key->port = $input->port;
        $key->method = $input->method;
        $key->accessUrl = $input->accessUrl;
        $key->dataLimit = $input->dataLimit;

        return $key;
    }
}
