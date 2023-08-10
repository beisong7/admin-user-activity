<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emails = [
            'admin1@app.com',
            'admin2@app.com',
            'admin3@app.com',
            'admin4@app.com',
            'admin5@app.com',
        ];
        foreach($emails as $email){
            factory(Admin::class, 1)->create(['email'=>$email]);
        }

    }
}
