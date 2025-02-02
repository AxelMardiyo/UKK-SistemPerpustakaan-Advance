<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeAdminFilament extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-admin-filament';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creat Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->ask('Username');

        if(Anggota::where('username', $username)->exists()) {
            $this->error('Username already exists');
            return;
        }

        $email = $this->ask('Email');
        $password = $this->secret('Password');
        
    }
}
