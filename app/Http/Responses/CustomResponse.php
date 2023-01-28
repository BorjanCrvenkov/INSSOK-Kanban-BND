<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CustomResponse extends Response
{
    /**
     * @param string $message
     * @param array|ResourceCollection|JsonResource|null $data
     * @param array|null $auth
     * @return JsonResponse
     */
    public function success(string $message = 'Success', array|ResourceCollection|JsonResource $data = null, array $auth = null): JsonResponse
    {
        return $this->getResponseStructure(self::HTTP_OK, $message, $data, $auth);
    }

    /**
     * @return JsonResponse
     */
    public function noContent(): JsonResponse
    {
        return $this->getResponseStructure(self::HTTP_NO_CONTENT, 'No content.');
    }

    /**
     * @return JsonResponse
     */
    public function invalidLoginCredentials(): JsonResponse
    {
        return $this->getResponseStructure(self::HTTP_BAD_REQUEST, 'Invalid login credentials.');
    }

    /**
     * @param int $code
     * @param string $message
     * @param array|ResourceCollection|JsonResource|null $data
     * @param array|null $auth
     * @return JsonResponse
     */
    public function getResponseStructure(int $code, string $message, array|ResourceCollection|JsonResource $data = null, array $auth = null): JsonResponse
    {
        $meta = [
            'code'    => $code,
            'message' => $message,
        ];

        return response()->json(array_filter([
            'meta' => $meta,
            'auth' => $auth,
            'data' => $data
        ]), $code);
    }
}
