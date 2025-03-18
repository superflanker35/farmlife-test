<?php

namespace App\Console\Commands;

use App\Farm\Farm;
use Illuminate\Console\Command;

class FarmLife extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:life';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    	$farm = Farm::getInstance();

    	$arr = ['Cow'=>10,'Hen'=>20];

    	$farm->addAnimalsToBarn($arr);
    }
}
