<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $email = $row[2];
        $phone = $row[3];

        $existingEmployee = Employee::whereEmail($email)->orWhere('phone', $phone)->first();

        if ($existingEmployee) {

            return null;
        }

        return new Employee([
            'first_name' => $row[0],
            'last_name' => $row[1],
            'email' => $row[2],
            'phone' => $row[3],
            'address' => $row[4],
            'salary' => $row[5],
        ]);
    }
}
