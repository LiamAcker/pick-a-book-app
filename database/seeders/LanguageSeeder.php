<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'name' => 'English',
            ],
            [
                'name' => 'Indonesia',
            ],
            [
                'name' => 'Japanese',
            ],
        ];
        foreach($languages as $key => $value){
            Language::create($value);
        }
    }
}
