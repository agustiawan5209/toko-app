<?php

namespace App\Actions\Fortify;

use App\Models\Supplier;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role_id' => '1',
            'phone' => ['required'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            $num = ltrim($input['phone'], '0');
            $number = '62' . $num;
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'role_id' => 1,
                'phone' => intval($number),
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
                $this->CreateSupplier($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }
    protected function CreateSupplier(User $user)
    {
        $user->save(Supplier::UpdateOrCreate([
            'supplier' => $user->name,
            'no_telpon' => $user->phone,
        ]));
    }
}
