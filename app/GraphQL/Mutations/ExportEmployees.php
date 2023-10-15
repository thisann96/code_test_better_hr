<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;

final class ExportEmployees
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $path = 'exports/employees.xlsx';

        Excel::store(new EmployeeExport, $path);

        return [
            'url' => asset($path),
        ];
    }
}
