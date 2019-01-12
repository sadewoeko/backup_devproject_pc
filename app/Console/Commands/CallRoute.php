<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Daemon_mass_contact_management\Controllers\Daemon_mass_contact_management as daemon;

class CallRoute extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'daemon:call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call Daemon From CLI';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
//    public function handle() {
//        //
//    }

    public function handle() {
       $run = new daemon;
       return $run->index();
    }

   

}
