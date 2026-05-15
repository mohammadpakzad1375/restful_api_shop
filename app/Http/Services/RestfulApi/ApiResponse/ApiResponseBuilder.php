<?php

namespace App\Http\Services\RestfulApi\ApiResponse;

class ApiResponseBuilder
{
    private ApiResponse $fastApiResponse;


    public function __construct()
    {
        $this->fastApiResponse = new ApiResponse();
    }

    public function withResponseMessage(string $responseMessage)
    {
        $this->fastApiResponse->setResponseMessage($responseMessage);
        return $this;
    }

    public function withRejectMessage(string $rejectMessage)
    {
        $this->fastApiResponse->setRejectMessage($rejectMessage);
        return $this;
    }

    public function withData(mixed $data)
    {
        $this->fastApiResponse->setData($data);
        return $this;
    }

    public function withResponseStatus(int $responseStatus)
    {
        $this->fastApiResponse->setResponseStatus($responseStatus);
        return $this;
    }

    public function withRejectStatus(int $rejectStatus)
    {
        $this->fastApiResponse->setRejectStatus($rejectStatus);
        return $this;
    }

    public function withAppends(array $appends)
    {
        $this->fastApiResponse->setAppends($appends);
        return $this;
    }

    public function build(): ApiResponse
    {
        return $this->fastApiResponse;
    }
}
