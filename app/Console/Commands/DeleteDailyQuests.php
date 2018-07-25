<?php

namespace App\Console\Commands;

use App\PlayerQuest;
use Illuminate\Console\Command;

class DeleteDailyQuests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quests:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $playerQuests = new PlayerQuest();
        $playerQuests->setConnection('alive_test');

        $array = [

            'googleID' => '123123',
            'type' => 'simple',
            'progress' => 11,
            'questID' => 11,
        ];

        $playerQuests->create($array)->save();

//        $playerQuests->where('type', 'simple')->delete();
    }
}
