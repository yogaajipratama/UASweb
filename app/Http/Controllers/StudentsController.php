<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = [
            'title' => 'Students',
            'links' => [
                1 => '<link rel="stylesheet" href="/assets/css/students.css">'
            ],
            'students' => collect(Students::all())
        ];
        return view('Students.Students', $dt);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $Student)
    {

        echo $Student;
        echo Departments::where('kdprodi', $Student->kdprodi)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dt = [
            'title' => 'Students | add',
            'links' => [
                1 => '<link rel="stylesheet" href="/assets/css/students.css">'
            ],
            'departments' =>  collect(Departments::all())
        ];
        return view('Students.StudentsAdd', $dt);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'sex' => 'required',
            'nim' => 'required|digits_between:5,10|unique:students',
            'name' => 'required|max:100|min:3',
            'email' => 'required|email:dns|max:50|unique:students',
            'tlp' => 'required|numeric|digits_between:10,15',
            'kdprodi' => 'required|numeric'
        ]);

        try {
            Students::create($validate);
            $request->session()->flash('add_success', Lang::get('add_success'));
            return redirect('/Students');
        } catch (\Exception $e) {
            $request->session()->flash('add_failed', Lang::get('add_failed') . "\n " . $e->getMessage());
            return redirect('/Students/create');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $Student)
    {
        $dt = [
            'title' => 'Students',
            'links' => [
                1 => '<link rel="stylesheet" href="/assets/css/students.css">'
            ],
            'student' => Students::find($Student->student_id),
            'departments' =>  collect(Departments::all())
        ];
        return view('Students.StudentsEdit', $dt);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $Student)
    {
        $validate = $request->validate([
            'sex' => 'required',
            'nim' => 'required|digits_between:5,10',
            'name' => 'required|max:100|min:3',
            'email' => 'required|email:dns|max:50',
            'tlp' => 'required|numeric|digits_between:10,15',
            'kdprodi' => 'required|numeric'
        ]);

        //additional validatioon to ignore old unique value
        Validator::make($validate, [
            'email' => [
                Rule::unique('students')->ignore($Student->email),
            ],
            'nim' => [
                Rule::unique('students')->ignore($Student->nim),
            ],
        ]);
        try {
            Students::where('student_id', $Student->student_id)->update($validate);
            return redirect('/Students')->with('edit_success', Lang::get('edit_success'));
        } catch (\Exception $e) {
            return redirect('/Students/' . $Student->student_id . '/edit')->with('edit_failed', Lang::get('edit_failed') . " " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $Student)
    {
        try {
            Students::destroy($Student->student_id);
            return redirect('/Students')->with('del_success', Lang::get('del_success'));
        } catch (\Exception $e) {
            return redirect('/Students')->with('del_failed', Lang::get('del_failed'));
        }
    }
}