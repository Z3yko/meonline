<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_contact;
use App\Models\User_info;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'z3ykola',
            'email' => 'mcprof014@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User_info::create([
            'user_id' => $user->id,
            'd_name' => 'Abdurhman AlSobhi',
            'img' => 'avatars/1.png',
            'location' => 'Badr, SA',
            'bio' => 'A passionate full-stack web developer working with laravel and Vue',
            'dark_mode' => 0,
            'bg_img' => ''
        ]);

        User_contact::create([
            'user_id' => $user->id,
            'c_email' => 'me@banadora.net',
            'phone' => '00966550961377',
            'social' => 'twitter::::https://twitter.com/ALSOBHIAA;;;;twitter::::https://snapchat.com/add/abdurhman_harb',
            'website' => 'company::::https://banadora.net;;;;website::::https://meonline.me'
        ]);

        \App\Models\User::factory()->count(5)->hasInfo(1)->hasContact(1)->create();

    }
}
