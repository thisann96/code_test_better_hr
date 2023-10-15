<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;

final class ExportEmployees
{
    public function __construct()
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '1024M');
    }

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
