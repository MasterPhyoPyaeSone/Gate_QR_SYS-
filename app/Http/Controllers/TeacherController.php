<?php

namespace App\Http\Controllers;

use App\Models\Entry_Data;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\File;



class TeacherController extends Controller
{
    public function teacherForm()
    {
        return view('Teacher.teaher_register');
    }

    public function createTeacher(Request $request)
    {

        $path = $request->file('image')->store('Teacher_image', 'public');
        // store in storage/app/public/images
        $user = Teacher::create([
            'teacher_id' => $request->teacher_id,
            'name' => $request->name,
            'department' => $request->department,
            'position' => $request->position,
            'ph_no' => $request->ph_no,
            'email' => $request->email,
            'image' => $path,
            'gender' => $request->gender,
            'qr_image' => 'default'
        ]);

      

        return view('Teacher.teacher_QRCode', [
            'user' => Teacher::latest()->first()
        ]);
    }

    public function teacher_QRcodeView(Teacher $teacher)
    {
        return view('Teacher.teacher_QRCode', [
            'user' => $teacher
        ]);
    }

    public function teachersDetailView(Request $request)
    {

        $filter = request(['name', 'teacher_id', 'position', 'department']);
        // dd($filter);
        $totalAmount = Teacher::count('name');
        return view('Teacher/teachers_data', [

            'teachers' => Teacher::filter(request(['name', 'teacher_id', 'position', 'department']))
                ->latest()
                ->paginate(5)
                ->withQueryString(),
            'totalAmount' => $totalAmount
        ]);
    }

    public function teacher_edit(Teacher $teacher)
    {

        return view('Teacher.teacher_edit', [
            'teacher' => $teacher
        ]);
    }


    public function teacher_update(Teacher $teacher)
    {
        try {
            $cleanData = request()->all();
            if ($file = request('image')) {
                // dd($teacher->image);
                if ($path = 'storage/' . $teacher->image) {
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }

                $cleanData['image'] = $file->store('/Teacher_image', 'public');
            }

            if (request('name') !== $teacher->name || request('teacher_id') !== $teacher->teacher_id) {

                Entry_Data::where('user_id', $teacher->teacher_id)
                    ->update([
                        'user_id' => request('teacher_id'),
                        'name'   => request('name'),
                    ]);
            }

            $teacher->update($cleanData);
        return back()->with('success', 'Data saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Database error: ' . $e->errorInfo[2]);
        }
    }

    public function teacher_Detail_Delete(Teacher $teacher)
    {
        $teacher->delete();
        $data = Entry_Data::where('user_id', $teacher->teacher_id)->delete();
        return back()->with('delete', 'Data delete successfully!');
    }

    public function teacher_Detail(Teacher $teacher)
    {

        return view('Teacher.teacher_detail', [
            'teacher' => $teacher
        ]);
    }

    public function Email_View(Teacher $teacher){
        return view('Teacher.send_email_to_teacher',[
            'user' => $teacher
        ]);
    }
}
