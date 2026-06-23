<?php

namespace App\Http\Services\RestfulApi\ApiResponse;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResponse
{
    private bool $success = true;
    private ?string $responseMessage = null;
    private ?string $rejectMessage = 'Something went wrong. try again later';
    private mixed $data = null;
    private int $responseStatus = 200;
    private int $rejectStatus = 500;
    private array $appends = [];

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * @param string|null $responseMessage
     */
    public function setResponseMessage(?string $responseMessage): void
    {
        $this->responseMessage = $responseMessage;
    }

    /**
     * @param string|null $rejectMessage
     */
    public function setRejectMessage(?string $rejectMessage): void
    {
        $this->rejectMessage = $rejectMessage;
    }

    /**
     * @param mixed $data
     */
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    /**
     * @param int $responseStatus
     */
    public function setResponseStatus(int $responseStatus): void
    {
        $this->responseStatus = $responseStatus;
    }

    /**
     * @param int $rejectStatus
     */
    public function setRejectStatus(int $rejectStatus): void
    {
        $this->rejectStatus = $rejectStatus;
    }

    /**
     * @param array $appends
     */
    public function setAppends(array $appends): void
    {
        $this->appends = $appends;
    }

    public function response(bool $success)
    {
        $body = [];

        if ($success) {

            $body['success'] = $this->success;

            !is_null($this->responseMessage) && $body['message'] = $this->responseMessage;
            $body = $body + $this->appends;

            if ($this->data instanceof ResourceCollection)
            {
                //withBody method belongs to ApiResourceCollection class
                $this->data->withBody($body);
                return $this->data;

            } else {
                !is_null($this->data) && $body['data'] = $this->data;

                return response()->json($body,$this->responseStatus);
            }

        } else {

            $body['success'] = false;

            if ($this->rejectMessage) {
                $body['message'] = $this->rejectMessage;
            } else {
                $body['message'] = $this->data;
            }

            return response()->json($body,$this->rejectStatus);
        }
    }
}
