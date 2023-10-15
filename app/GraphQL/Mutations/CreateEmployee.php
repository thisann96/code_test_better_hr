<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Employee;
use App\GraphQL\Inputs\EmployeeInput;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Validator;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Validation\ValidationException;

final class CreateEmployee
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        $validator = validator($args['input'], [
            'email' => 'unique:employees,email',
            'phone' => 'unique:employees,phone',
        ]);

        if ($validator->fails()) {

            throw new ValidationException($validator);
        }

        $input = $args['input'];

        $employee = Employee::create($input);

        return [
            'success' => true,
            'message' => 'Employee created successfully.',
            'employee' => $employee,
        ];
    }
}
