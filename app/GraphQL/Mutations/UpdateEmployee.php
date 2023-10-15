<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Employee;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Validation\ValidationException;

final class UpdateEmployee
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $employee = Employee::find($args['id']);

        if (!$employee) {

            return [
                'success' => false,
                'message' => 'Employee is not exists.',
            ];
        }

        $uniqueValidationRules = [
            'email' => 'unique:employees,email,' . $employee->id,
            'phone' => 'unique:employees,phone,' . $employee->id,
        ];

        $validator = validator($args['input'], [
            'email' => $uniqueValidationRules['email'],
            'phone' => $uniqueValidationRules['phone'],
        ]);

        if ($validator->fails()) {

            throw new ValidationException($validator);
        }

        // Update employee
        $employee->update($args['input']);

        return [
            'success' => true,
            'message' => 'Employee updated successfully.',
            'employee' => $employee,
        ];
    }
}
