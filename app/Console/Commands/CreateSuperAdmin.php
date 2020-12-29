<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new super admin user';

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
        $name = $this->ask('What is your name?');
        $email = $this->ask('Please enter an email address');
        $password = $this->secret('Please set a password');
        $cpassword = $this->secret('Please re-enter password');

        $validate = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'cpassword' => $cpassword
        ], [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:cpassword'
        ]);

        if($validate->fails()){
            $this->info('Super Admin not created');
            foreach ($validate->errors()->all() as $error) {
                $this->error($error);
            }
        }

        $superadmin = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => time()
        ]);

        if($superadmin){
            $role = Role::where('name', 'Super Admin')->first();
            $superadmin->assignRole($role);
            $this->info('Super Admin created');
        }else{
            $this->error('Something went wrong!');
        }
    }
}
