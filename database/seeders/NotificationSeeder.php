<?php

namespace Database\Seeders;
use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run()
    {
        Notification::create([
            'title' => 'Nouvelle Notification',
            'message' => 'Ceci est un message de test.',
        ]);
    }
}
