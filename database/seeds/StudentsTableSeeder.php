<?php
use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\Student;
class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Student::truncate();
        foreach(range(1,200) as $data){
            $student = [
                'name' => $faker->name,
                'mobile' => $faker->phoneNumber,
                'address' => $faker->address
            ];
            Student::create($student);
        }
    }
}
