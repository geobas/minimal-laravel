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
        Log::error($t->getMessage());

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
        Log::warning($t->getMessage());

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
        Log::info($t->getMessage());
	}
}