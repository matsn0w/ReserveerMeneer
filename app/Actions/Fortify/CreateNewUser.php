<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'phonenumber' => ['required', 'phone'],
            'password' => $this->passwordRules(),
        ])->validate();

        $role_id = Role::where('name', '=', 'DEFAULT')->first()->id;

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phonenumber' => $input['phonenumber'],
            'password' => Hash::make($input['password']),
        ]);

        DB::table('role_user')->insert([
            'role_id' => $role_id,
            'user_id' => $user->id
        ]);

        return $user;
    }
}
