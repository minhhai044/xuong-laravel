<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        try {
            $data = $project->tasks;
            return response()->json([
                'messenger' => 'Danh sách Task của Project: ' . $project->project_name,
                'data' => $data
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Lỗi khi lấy danh sách Task: ' . $th->getMessage());
            return response()->json([
                'messenger' => "Lỗi hệ thống"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request, Project $project)
    {
        try {
            $data = $request->all();
            $data['project_id'] = $project->id; // Gán project_id
            $task = Task::query()->create($data);
            return response()->json([
                'messenger' => "Tạo mới thành công!!",
                'data' => $task
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error('Lỗi khi tạo Task: ' . $th->getMessage());
            return response()->json([
                'messenger' => "Lỗi hệ thống"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Project $project, string $id)
    {
        try {
            $task = $project->tasks()->findOrFail($id); // Sử dụng quan hệ để tìm Task theo Project
            return response()->json(['data' => $task], Response::HTTP_OK);
        } catch (ModelNotFoundException $th) {
            return response()->json(['messenger' => "Không tồn tại"], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            Log::error('Lỗi khi lấy Task: ' . $th->getMessage());
            return response()->json(['messenger' => "Lỗi hệ thống"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, Project $project, string $id)
    {
        try {
            $task = $project->tasks()->findOrFail($id); // Sử dụng quan hệ để tìm Task
            $data = $request->all();
            $task->update($data);

            return response()->json(['messenger' => "Cập nhật thành công!!"], Response::HTTP_OK);
        } catch (ModelNotFoundException $th) {
            return response()->json(['messenger' => "Không tồn tại"], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            Log::error('Lỗi khi cập nhật Task: ' . $th->getMessage());
            return response()->json(['messenger' => "Lỗi hệ thống"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Project $project, string $id)
    {
        try {
            $task = $project->tasks()->findOrFail($id); // Sử dụng quan hệ để tìm Task
            $task->delete();

            return response()->json(['messenger' => "Xóa thành công!!"], Response::HTTP_OK);
        } catch (ModelNotFoundException $th) {
            return response()->json(['messenger' => "Không tồn tại"], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            Log::error('Lỗi khi xóa Task: ' . $th->getMessage());
            return response()->json(['messenger' => "Lỗi hệ thống"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
