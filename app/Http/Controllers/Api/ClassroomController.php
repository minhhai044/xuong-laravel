<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Classroom::query()->latest('id')->paginate();
        return response()->json([
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $classroom = $request->validate([
            'name' => 'required',
            'teacher_name' => 'required',
        ]);
        try {
            $data = Classroom::query()->create($classroom);
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
            $data = Classroom::query()->findOrFail($id);
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
        $dataClassroom = $request->validate([
            'name' => 'required',
            'teacher_name' => 'required',
        ]);
        try {
            $classroom = Classroom::query()->find($id);
            $data = $classroom->update($dataClassroom);
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
            $classroom = Classroom::query()->find($id);
            $classroom->delete();
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
