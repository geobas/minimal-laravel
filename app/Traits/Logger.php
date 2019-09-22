<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Logger
{
    /**
     * Error logging level.
     *
     * @param \Throwable $t
     * @return void
     */
    protected function LogError($t)
    {
        Log::error($this->formatMessage($t));

        abort(500);
    }

    /**
     * Warning logging level.
     *
     * @param \Throwable $t
     * @return void
     */
    protected function LogWarning($t)
    {
        Log::warning($this->formatMessage($t));

        abort(500);
    }

    /**
     * Info logging level.
     *
     * @param \Throwable $t
     * @return void
     */
    protected function LogInfo($t)
    {
        Log::info($this->formatMessage($t));
    }

    /**
     * Formats error message output.
     *
     * @param  \Throwable $t
     * @return string
     */
    private function formatMessage($t)
    {
        return 'Exception: ' . (new \ReflectionClass($t))->getShortName() . ' - Message: ' . $t->getMessage() . ' - File: ' . $t->getFile() . ' at line: ' . $t->getLine();
    }
}
