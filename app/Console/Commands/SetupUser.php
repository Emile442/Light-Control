<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SetupUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup - Create User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function notNullAsk(string $ask, bool $secret = false)
    {
        if ($secret)
            $name = $this->secret($ask);
        else
            $name = $this->ask($ask);
        if ($name != "") {
            return ($name);
        }
        return ($this->notNullAsk($ask));
    }

    private function askPassword() : string
    {
        $password = $this->notNullAsk("Password", true);
        $passwordConfim = $this->notNullAsk("Password Confirmation", true);

        if ($password != $passwordConfim) {
            $this->line("Password missmatch");
            return ($this->askPassword());
        }
        return ($password);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->notNullAsk("Name");
        $email = $this->notNullAsk("email");
        $password = $this->askPassword();

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'api_token' => Str::random(80)
        ]);
        $this->line("{$user->name} has been created.");
    }
}
