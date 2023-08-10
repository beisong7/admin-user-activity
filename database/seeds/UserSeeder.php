<?php

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
        $emails = [
            'user1@app.com',
            'user2@app.com',
            'user3@app.com',
            'user4@app.com',
            'user5@app.com',
        ];
        foreach($emails as $email){
            factory(User::class, 1)->create(['email'=>$email]);
        }
        factory(User::class, 3)->create();
    }
}
