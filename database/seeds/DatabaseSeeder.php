<?php

use Illuminate\Database\Seeder;
use app\User;
use app\Ad;
use app\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $faker = Faker\Factory::create();

        User::create([
            'name'  => 'Naimul Hasan',
            'gender' => 'Male',
            'email' => 'admin@gmail.com',
            'phone' => '01838388807',
            'password' => bcrypt('aaaaaaaa')
        ]);
        User::create([
            'name'  => 'ndmin',
            'gender' => 'Female',
            'email' => 'nadmin@gmail.com',
            'phone' => '01927228335',
            'password' => bcrypt('aaaaaaaa')
        ]);
        
        $gender = ['Male','Female'];
        $dept=['CSE','EEE','PHY','MATH'];
        $session=['2015-16','2016-17','2017-18','2018-19'];
        for($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'gender'=>$gender[rand(0,1)],
                'phone' => $faker->phoneNumber,
                'email' => $faker->safeEmail,
                'password' => bcrypt('aaaaaaaa')
            ]);
        }

        //Seeding Ads

        $categories = ['Flower Plants','Fruit tree','Herbal Tree','orchids','Furtilizer','Pots','Accesorries'];
        $conditions = ['Germinated','From seed'];
        
        for($i=0; $i<100; $i++){
            $img="https://picsum.photos/id/".rand(1,900)."/600/400";
            Ad::create([
                'user_id'=>rand(1,10),
                'name'=>ucfirst($faker->sentence($nbWords = 3, $variableNbWords = true) ),
                'price'=>rand(100,5000),
                'category'=>$categories[rand(0,6)],
                'description'=>$faker->paragraph,
                'available'=>rand(0,1),
                'image'=>$img
            ]);
        }

        //Seeding Categories 

        for($i=0; $i<7; $i++){
            $count=Ad::where('category',$categories[$i])->count();
            Category::create([
                'category'=>$categories[$i],
                'plants'=> $count
            ]);
        }

    }
}
