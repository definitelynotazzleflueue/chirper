<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::count('*') < 3 
                ? collect([
                    User::create([
                        "name"=> "Diablo Reverse",
                        "email"=> "diablo@gmail.com",
                        "password"=> bcrypt("password"),
                            ]),
                 User::create([
                        "name"=> "Lil Lusis",
                        "email"=> "lusis@gmail.com",
                        "password"=> bcrypt("password"),
                            ]),
                 User::create([
                        "name"=> "Cash Malupiton",
                        "email"=> "malupiton@gmail.com",
                        "password"=> bcrypt("password"),
                            ]),           
                        ])
                : User::take(3)->get();
                
                $chirps = [
                    "Just finished a 10k run! Feeling great and energized.",
                    "Loving the new features in Laravel 9. Development has never been this fun!",
                    "Cooked a delicious pasta recipe today. Who wants the recipe?",
                    "Reading a fascinating book on quantum physics. Mind blown!",
                    "Exploring the mountains this weekend. Nature is truly breathtaking.",
                    "puking ina mo boi!",
                ];

        foreach ($chirps as $message) {
             $users->random()->chirps()->create([
                'message' => $message,
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}
