<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;

final class ImportEmployees
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file = $args['file'];

        Excel::import(new EmployeeImport, $file);

        return [
            'success' => true,
            'message' => 'Employees imported successfully.',
        ];
    }
}
