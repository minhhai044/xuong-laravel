<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Passport;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataStudent = Student::with(

            'classroom'
        )->latest('id')->paginate(3);

        return view('students.index', compact('dataStudent'));
    }

    public function search(Request $request)
    {
        $key = $request->keyword;
        $search = Student::with('classroom')
        ->whereAny(['name'], 'LIKE', "%$key%")
        ->orWhereHas('classroom', function ($query) use ($key) {
            $query->where('name', 'LIKE', "%$key%");
        })->get();
        return view('students.search',compact('search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::query()->pluck('name', 'id');
        $supjects = Subject::query()->pluck('name', 'id');
        return view('students.create', compact('classrooms', 'supjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student.classroom_id' => 'required',
            'student.name' => 'required',
            'student.email' => ['required', Rule::unique(Student::class, 'email')],

            'passport.passport_number' => 'required',
            'passport.issued_date' => 'required',
            'passport.expiry_date' => 'required',

            'subject' => 'required|array',
            'subject.*' => 'required|integer',
        ]);
        $dataStudent = $request->student;
        $datasubject = $request->subject;
        $dataPassport = $request->passport;
        try {
            DB::transaction(function () use ($dataStudent, $dataPassport, $datasubject) {
                $data = Student::query()->create($dataStudent);
                $data->passport()->create($dataPassport);

                $data->subjects()->attach($datasubject);
            });
            return redirect()->route('students.index')->with('success', 'Them moi thanh cong !!!');
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [$th->getMessage()]);
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataStudent = Student::with(
            'passport',
            'classroom',
            'subjects'
        )->findOrFail($id);
        return view('students.show', compact('dataStudent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $dataStudent = Student::with(
            'passport',
            'classroom',
            'subjects'
        )->findOrFail($id);
        $classrooms = Classroom::query()->pluck('name', 'id');
        $datasubjects = $dataStudent->subjects()->pluck('id')->all();
        $supjects = Subject::query()->pluck('name', 'id');
        return view('students.edit', compact('classrooms', 'supjects', 'dataStudent', 'datasubjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'student.classroom_id' => 'required',
            'student.name' => 'required',
            'student.email' => ['required', Rule::unique(Student::class, 'email')->ignore($id)],

            'passport.passport_number' => 'required',
            'passport.issued_date' => 'required',
            'passport.expiry_date' => 'required',

            'subject' => 'required|array',
            'subject.*' => 'required|integer',
        ]);
        $dataStudent = $request->student;
        $datasubject = $request->subject;
        $dataPassport = $request->passport;
        try {
            DB::transaction(function () use ($dataStudent, $dataPassport, $datasubject, $id) {
                $data = Student::find($id);
                $data->update($dataStudent);

                $data->passport()->where('student_id', '=', $id)->update($dataPassport);

                $data->subjects()->sync($datasubject);
            });
            return redirect()->route('students.index')->with('success', 'Update thanh cong !!!');
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [$th->getMessage()]);
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $dataStudent = Student::query()->findOrFail($id);

                $dataStudent->subjects()->sync([]);

                $dataStudent->passport()->delete();

                $dataStudent->delete();
            });
            return redirect()->route('students.index')->with('success', 'Xoa thanh cong !!!');
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [$th->getMessage()]);
            return back()->with('error', $th->getMessage());
        }
    }
}
