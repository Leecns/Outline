<?php

namespace App\Services\OutlineVPN;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    public function __construct(protected string $apiUrl)
    {
    }

    public function server(): ApiResponse
    {
        $response = $this->http()->get('/server');

        return $this->createApiResponse($response);
    }

    public function setHostName(string $hostnameOrIpAddress): ApiResponse
    {
        $response = $this->http()->put('/server/hostname-for-access-keys', [
            'hostname' => $hostnameOrIpAddress,
        ]);

        return $this->createApiResponse($response);
    }

    public function setServerName(string $name): ApiResponse
    {
        $response = $this->http()->put('/name', [
            'name' => $name,
        ]);

        return $this->createApiResponse($response);
    }

    public function setKeyPort(int $port): ApiResponse
    {
        $response = $this->http()->put('/server/port-for-new-access-keys', [
            'port' => $port
        ]);

        return $this->createApiResponse($response);
    }

    public function metricsTransfer(): ApiResponse
    {
        $response = $this->http()->get('/metrics/transfer');

        return $this->createApiResponse($response);
    }

    public function keys(): ApiResponse
    {
        $response = $this->http()->get('/access-keys');

        return $this->createApiResponse($response);
    }

    public function createKey(): ApiResponse
    {
        $response = $this->http()->post('/access-keys', [
            'method' => config('outline.encryption_method'),
        ]);

        return $this->createApiResponse($response);
    }

    public function renameKey(int $id, string $name): ApiResponse
    {
        $response = $this->http()->put("/access-keys/{$id}/name", [
            'name' => $name,
        ]);

        return $this->createApiResponse($response);
    }

    public function deleteKey(int $id): ApiResponse
    {
        $response = $this->http()->delete("/access-keys/${id}");

        return $this->createApiResponse($response);
    }

    public function setDataLimitForKey(int $id, int $limitInBytes): ApiResponse
    {
        $response = $this->http()->put("/access-keys/{$id}/data-limit", [
            'limit' => [
                'bytes' => $limitInBytes
            ]
        ]);

        return $this->createApiResponse($response);
    }

    public function removeDataLimitForKey(int $id): ApiResponse
    {
        $response = $this->http()->delete("/access-keys/{$id}/data-limit");

        return $this->createApiResponse($response);
    }

    protected function http(): PendingRequest
    {
        return Http::baseUrl($this->apiUrl)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->timeout(config('outline.server_availability_check_timeout'))
            ->withoutVerifying();
    }

    protected function createApiResponse(\Illuminate\Http\Client\Response $response): ApiResponse
    {
        $statusCode = $response->status();
        $result = json_decode($response->getBody()->getContents());

        if ($statusCode >= Response::HTTP_OK && $statusCode <= Response::HTTP_IM_USED) {
            return ApiResponse::succeed(
                statusCode: $statusCode,
                result: $result
            );
        }

        if ($statusCode === Response::HTTP_UNAUTHORIZED) {
            ApiResponse::unauthenticated();
        }

        if ($statusCode === Response::HTTP_FORBIDDEN) {
            ApiResponse::unauthorized();
        }

        return ApiResponse::error(statusCode: $statusCode, message: $result->message ?? null, errors: $result->errors ?? []);
    }
}
