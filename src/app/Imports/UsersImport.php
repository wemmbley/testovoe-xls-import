<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['full_name'],
            'job_title' => $row['job_title'],
            'department' => $row['department'],
            'business_unit' => $row['business_unit'],
            'gender' => $row['gender'],
            'ethnicity' => $row['ethnicity'],
            'age' => $row['age'],
            'salary' => $row['annual_salary'],
            'country' => $row['country'],
            'city' => $row['city'],
            'email' => fake()->email(),
            'password' => fake()->password(),
        ]);
    }
}
