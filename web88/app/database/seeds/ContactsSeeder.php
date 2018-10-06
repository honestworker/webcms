<?php

class ContactsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		Contact::truncate();

		for ($i = 0; $i < 20; $i++)
		{
		Contact::create([
				'first_name' => $faker->sentence(2),
				'last_name' => $faker->sentence(2),
				'email_address' => $faker->email,
				'description' => $faker->paragraph(20)
			]);
	}
		}

}
