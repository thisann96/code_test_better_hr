<?php

namespace App\Http\Resources\Employee;

use App\Actions\Pagination;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'employees' => $this->collection,
            ...(new Pagination())->getLinks($this),
        ];
    }
}
