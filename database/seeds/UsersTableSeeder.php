<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = factory(User::class)->times(2)->make()->each(function ($user, $index) {
            if ($index == 0) {
                 $user->name = 'admin';
                 $user->email = 'admin@56br.com';
                 $user->status = '1';
            }

            if ($index == 1) {
                $user->name = 'wll';
                $user->email = 'wll@56br.com';
                $user->status = '1';
            }
        });

        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1);
        // 初始化用户角色，将 1 号用户指派为『超级管理员』
        $user->assignRole('Administrator');
        $user->avatar = 'images/avatar/201803/04/9CT3XvX0Jcv8QEEzPCzgg8k0NXJVwrMsaKKf1iN9.jpeg';
        $user->save();

        // 将 2 号用户指派为『站长』
        $user = User::find(2);
        $user->assignRole('Founder');
    }

}

