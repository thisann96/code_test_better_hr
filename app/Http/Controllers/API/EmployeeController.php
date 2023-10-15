<?php

namespace App\Http\Controllers\API;

use App\Exceptions\UserNotExists;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Employee\DeleteRequest;
use App\Http\Requests\API\Employee\StoreRequest;
use App\Http\Requests\API\Employee\UpdateRequest;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;
use App\Trait\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    use ResponseHelper;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::paginate($request->per_page);

        return $this->responseCollection(['data' => new EmployeeCollection($employees)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $employee = Employee::create($request->all());

        return $this->responseSucceed(['employee' => new EmployeeResource($employee)], status_code: Response::HTTP_CREATED, message: 'Employee created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);

        return $this->responseSucceed(data: ['employee' => new EmployeeResource($employee)], status_code: Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        $employee = Employee::find($request->id);

        if (!$employee) {

            throw new UserNotExists();
        }

        $employee->update($request->all());

        return $this->responseSucceed(status_code: Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request)
    {
        $employee = Employee::find($request->id);

        if (!$employee) {

            throw new UserNotExists();
        }

        $employee->delete();

        return $this->responseSucceed(status_code: Response::HTTP_OK, message: 'Employee deleted successfully.');
    }
}
