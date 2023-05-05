<?php

namespace Tender\Tender\Commands;

use Illuminate\Console\Command;

class TenderCommand extends Command
{
    public $signature = 'tender';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
