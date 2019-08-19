<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 15/08/2019
 * Time: 20:05
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

abstract class AbstractCommand extends Command
{
    /** @var string $logTag */
    protected $logTag;

    /**
     * @param string $message the message
     * @param string $type The type of Log, info, debug, alert...
     */
    protected function log($message, $type = "info"): void
    {
        $message = $this->logTag . $message;
        Log::$type($message);
        echo $message . "\n";
    }
}