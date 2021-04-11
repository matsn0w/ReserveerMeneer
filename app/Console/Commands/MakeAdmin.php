<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:admin
        {username=admin : The user\'s name}
        {email=admin@localhost : The user\'s email address}
        {phonenumber=0612345678 : the user\'s phone number}
        {password=admin : The user\'s password}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register an admin account';

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
     * @return int
     */
    public function handle()
    {
        // ask for details
        $answers = $this->askQuestions();

        // ask if the info is correct
        if (!$this->confirmUser($answers)) {
            $this->info('Aborted.');
            return 0;
        }

        $this->info("Creating admin account for user '{$answers['name']}'...");

        $role_id = Role::where('name', '=', 'ADMIN')->first()->id;

        // create the user account
        $user = User::make();
        $user->name = $answers['name'];
        $user->email = $answers['email'];
        $user->phonenumber = $answers['phone'];
        $user->password = Hash::make($answers['password']);
        $user->save();

        DB::table('role_user')->insert([
            'role_id' => $role_id,
            'user_id' => $user->id
        ]);

        $this->info('User successfully created!');

        return 0;
    }

    private function askQuestions() {
        $name = $this->ask('Enter a name:');
        $email = $this->ask('Enter an email address:');
        $phone = $this->ask('Enter a phone number');
        $password = $this->secret('Enter a password:');

        $answers = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password
        ];

        return $answers;
    }

    private function confirmUser($user)
    {
        $this->info("Username: {$user['name']}");
        $this->info("Email: {$user['email']}");
        $this->info("Phone: {$user['phone']}");
        $this->info("Password: {$user['password']}");

        return $this->confirm('Is this correct?', true);
    }
}
