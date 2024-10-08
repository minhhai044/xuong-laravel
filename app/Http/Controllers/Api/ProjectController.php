<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function index()
    {
        $data = Project::query()->latest('id')->paginate(10);
        return response()->json([
            'data' => $data
        ], Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $datas = Project::query()->create($data);
            return response()->json([
                'messenger' => "Tạo mới thành công!!",
                'data' => $datas
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'messenger' => "Lỗi hệ thống",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function show(string $id)
    {
        try {
            $data = Project::query()->findOrFail($id);
            return response()->json([
                'data' => $data
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'messenger' => "Không tồn tại"
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'messenger' => "Lỗi hệ thống"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $project = Project::query()->find($id);
            $data = $request->all();
            $project->update($data);
            return response()->json([
                'messenger' => "Update thành công!!",

            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'messenger' => "Lỗi hệ thống",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(string $id)
    {
        try {
            $project = Project::query()->find($id);

            $project->delete();
            return response()->json([
                'messenger' => "Xóa thành công!!",

            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'messenger' => "Lỗi hệ thống",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
