<?php

namespace Isaiahiroko\Structure\Commands;

use Illuminate\Console\Command;

use Isaiahiroko\Structure\Common\Helpers;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'structure:install {--A|all=false:false runs bootsrap for this package only, true runs it for all foundation aware packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bootstrap this package and make it ready to use or bootstrap all available foundation aware packages. The former is the default.';

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
        $all = $this->option('all');

        if($all){
            $this->all();
        }
        else{
            $this->migrate();
            $this->seed();
            $this->publish();
        }
    }

    private function migrate()
    {
        $this->info('pending migration: '.$this->signature);
        $this->call('migrate', ['--path' => __DIR__.'/../migrations']);
        $this->info('completed migration: '.$this->signature);
    }

    private function seed()
    {
        $this->info('pending seeding: '.$this->signature);
        $this->call('db:seed', ['--class' => 'Isaiahiroko\Structure\Seeds\DatabaseSeeder']);
        $this->info('completed seeding: '.$this->signature);
    }

    private function publish()
    {
        $this->info('pending publishing: '.$this->signature);
        $this->call('vendor:publish', ['--tag' => 'lvr-structure', '--force' => 1]);
        $this->info('completed publishing: '.$this->signature);
    }

    private function all()
    {
        $this->call('migrate:refresh', []);

        $commands = config('structure.commands');
        foreach ($commands as $command => $args) {
            $this->info('running: '.$command);
            if(Helpers::commandExists($command)){
                $this->call($command, $args);
                $this->info('completed running: '.$command);
            }
            else{
                $this->info('This command does not exist: '.$command);
            }
        }

    }
}
