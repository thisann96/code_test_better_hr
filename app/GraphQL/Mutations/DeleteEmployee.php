<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Employee;

final class DeleteEmployee
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = $args['id'];

        $employee = Employee::find($id);

        if (!$employee) {

            return [
                'success' => false,
                'message' => 'Employee is not exists.',
            ];
        }

        $success = $employee->delete();

        return [
            'success' => $success,
            'message' => 'Employee deleted successfully.',
        ];
    }
}
