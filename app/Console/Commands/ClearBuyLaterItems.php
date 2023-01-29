<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Actions\ClearBuyLaterItems as Action;

class ClearBuyLaterItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:clear-buy-later';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Items set to buy later';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Action $action): void
    {
	    $action();

		$this->info('Buy later Items cleared.');
    }
}
