<?php

declare(strict_types=1);

namespace Ions\Seeders;

use Faker\Factory;

/**
 * ===========================
 * Ions Users Seeders ========
 * ===========================
 */

class UserSeeder
{
    private $faker;
    private $data = [];

    public function __construct()
    {
        $this->faker = Factory::create();
    }
    /**
     * Run the database seeders.
     */
    public function seed(int $count = null)
    {
        $data = [];

        if (is_null($count)) {
            $count = 1;
        }

        for ($i = 0; $i < $count; $i++) {
            $name = $this->faker->name;
            $email = $this->faker->safeEmail($name);
            $password = $this->faker->password;

            $this->data[] = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];
        }

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }
}
