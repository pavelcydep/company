<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        $company= \App\Models\Company::factory()->create([
            'company' => 'Аутсорсинговая Компания',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'ул.Николая Ершова, 18',
            'points'=>'55.791845,49.157645',
        ]);
        $company= \App\Models\Company::factory()->create([
            'company' => 'Чулпан-Мед',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, улица Карла Маркса, 49/13',
            'points'=>'55.795712,49.132708',
        ]);
        $company= \App\Models\Company::factory()->create([
            'company' => 'Сетевая Компания',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, Вахитовский район, улица Татарстан, 55',
            'points'=>'55.773834,49.106333',
        ]);

        $company= \App\Models\Company::factory()->create([
            'company' => 'Татнефтехиминвест-холдинг',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, улица Николая Ершова, 29А',
            'points'=>'55.79428,49.16873',
        ]);

        $company= \App\Models\Company::factory()->create([
            'company' => 'Транспортная компания "Энергия"',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, Клубная улица, 18',
            'points'=>'55.798723,49.225926',
        ]);

        $company= \App\Models\Company::factory()->create([
            'company' => 'Сувар -Казань',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, Клубная улица, 4',
            'points'=>'55.8006,49.226609',
        ]);

        $company= \App\Models\Company::factory()->create([
            'company' => 'Сувар -Плаза',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, Клубная улица, 4',
            'points'=>'55.8006,49.226609',
        ]);

        $company= \App\Models\Company::factory()->create([
            'company' => 'ЦСТ-КАЗАНЬ',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, улица Восход, 5',
            'points'=>'55.827247,49.071092',
        ]);
        $company= \App\Models\Company::factory()->create([
            'company' => 'ООО «Технократия»',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, Кремлёвская улица, 21А',
            'points'=>'55.793819,49.117086',
        ]);
        $company= \App\Models\Company::factory()->create([
            'company' => 'Казанская транспортная компания',
            'email' => 'test2@example.com',
            'logo' =>'https://via.placeholder.com/100x100.png/001100?text=animals+error',
            'addres'=>'Россия, Республика Татарстан, Казань, улица Аделя Кутуя, 161',
            'points'=>'55.769054,49.189014',
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'test@example.com',
            'company_id'=>'1',
            'password' => Hash::make('password')
        ]);
        $user = \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'test2@example.com',
            'company_id'=>'1',
            'password' => Hash::make('password')
        ]);
    }
}
