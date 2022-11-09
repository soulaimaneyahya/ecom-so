<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = max((int)$this->command->ask("How many users would you like ?",10), 1);
        $admin = User::factory()->admin()->create();
        $john = User::factory()->john()->create();
        $user = User::factory($usersCount)->create();
    }
}
