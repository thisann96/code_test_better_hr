<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Employee;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;

final class Employees
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $perPage    = $args['per_page'] ?? 10;
        $page       = $args['page'] ?? 1;

        $employees = Employee::paginate($perPage, ['*'], 'page', $page);

        return [
            'data' => $employees->items(),
            'meta' => [
                'total' => $employees->total(),
                'per_page' => $employees->perPage(),
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
            ],
        ];
    }
}
