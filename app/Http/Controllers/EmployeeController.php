<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $employees = Employee::query()->latest('id')->paginate(5);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $storeEmployeeRequest)
    {
        // dd(base64_encode(file_get_contents($storeEmployeeRequest->file('profile_picture')->getRealPath())),base64_decode(file_get_contents($storeEmployeeRequest->file('profile_picture')->getRealPath())));
        try {
            DB::transaction(function () use ($storeEmployeeRequest) {
                $data = $storeEmployeeRequest->all();
                if ($storeEmployeeRequest->hasFile('profile_picture')) {
                    $data['profile_picture'] = base64_encode(file_get_contents($storeEmployeeRequest->file('profile_picture')->getRealPath()));
                }
                $data['is_active'] ?? $data['is_active'] = "0";
                Employee::query()->create($data);
            });
            return redirect()->route('employees.index')->with('success', 'Thêm mới thành công !!!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {

        // Trả về nội dung nhị phân với header Content-Type thích hợp
        $photo = base64_decode($employee->profile_picture);
        return Response::make($photo, 200, [
            'Content-Type' => 'image/jpeg', //chuyển đổi đoạn mã hóa thành 
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $updateEmployeeRequest, Employee $employee)
    {
        try {
            DB::transaction(function () use ($updateEmployeeRequest,$employee){
                $data=[
                    'first_name' => $updateEmployeeRequest->first_name ,
                    'last_name' => $updateEmployeeRequest->last_name ,
                    'email' => $updateEmployeeRequest->email ,
                    'phone' => $updateEmployeeRequest->phone ,
                    'date_of_birth' => $updateEmployeeRequest->date_of_birth ,
                    'hire_date' => $updateEmployeeRequest->hire_date ,
                    'is_active' => $updateEmployeeRequest->is_active ,
                    'address' => $updateEmployeeRequest->address ,
                ];
                if($updateEmployeeRequest->hasFile('profile_picture')){
                    $data['profile_picture'] = base64_encode(file_get_contents($updateEmployeeRequest->file('profile_picture')->getRealPath()));
                };
                $data['is_active'] ?? $data['is_active'] = '0';
                Employee::query()->where('id',$employee->id)->update($data);
            });
            return back()->with('success','Update Thành công !!');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            DB::transaction(function () use ($employee) {
                $employee->delete();
            });
            return redirect()->route('employees.index')->with('success', 'Xóa thành công !!!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
