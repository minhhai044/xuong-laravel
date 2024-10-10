<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::query()->latest('id')->paginate();
        return response()->json([
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Student = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique(Student::class)],
            'classroom_id' => ['required'],

        ]);
        try {
            $data = Student::query()->create($Student);
            return response()->json([
                'mess' => 'Them moi thanh cong !!!',
                'data' => $data
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'mess' => 'Them moi khong thanh cong !!!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Student::with('passport', 'classroom', 'subjects')->findOrFail($id);
            return response()->json([
                'data' => $data
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'mess' => 'Khong ton tai'
                ], Response::HTTP_OK);
            }
            return response()->json([
                'mess' => 'Loi he thong'
            ], Response::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)

    {
        $dataStudent = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique(Student::class,'email')->ignore($id)],
            'classroom_id' => ['required'],
        ]);
        try {
            $Student = Student::query()->find($id);
            $data = $Student->update($dataStudent);
            return response()->json([
                'mess' => 'Update thanh cong',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'mess' => 'Update khong thanh cong',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $Student = Student::query()->find($id);
            $Student->delete();
            return response()->json([
                'mess' => 'xoa thanh cong',

            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'mess' => 'xoa khong thanh cong',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
