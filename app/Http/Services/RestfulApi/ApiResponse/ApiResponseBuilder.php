<?php

namespace App\Http\Services\RestfulApi\ApiResponse;

class ApiResponseBuilder
{
    private ApiResponse $apiResponse;


    public function __construct()
    {
        $this->apiResponse = new ApiResponse();
    }

    public function withSuccess(bool $success)
    {
        $this->apiResponse->setSuccess($success);
        return $this;
    }

    public function withResponseMessage(string $responseMessage)
    {
        $this->apiResponse->setResponseMessage($responseMessage);
        return $this;
    }

    public function withRejectMessage(string $rejectMessage)
    {
        $this->apiResponse->setRejectMessage($rejectMessage);
        return $this;
    }

    public function withData(mixed $data)
    {
        $this->apiResponse->setData($data);
        return $this;
    }

    public function withResponseStatus(int $responseStatus)
    {
        $this->apiResponse->setResponseStatus($responseStatus);
        return $this;
    }

    public function withRejectStatus(int $rejectStatus)
    {
        $this->apiResponse->setRejectStatus($rejectStatus);
        return $this;
    }

    public function withAppends(array $appends)
    {
        $this->apiResponse->setAppends($appends);
        return $this;
    }

    public function build(): ApiResponse
    {
        return $this->apiResponse;
    }
}
