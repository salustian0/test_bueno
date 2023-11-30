<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

class ValidationServiceException extends Exception
{

    public function __construct(
        private Validator $validator,
        string $message = 'Houve um erro na validacao dos dados.',
        int $code = JsonResponse::HTTP_BAD_REQUEST,
        ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getErrors() : MessageBag{
        return $this->validator->errors();
    }

}
