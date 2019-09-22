<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;
use Exception;

class DeleteClientException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        Log::error('Error while deleting client.');
    }
}
