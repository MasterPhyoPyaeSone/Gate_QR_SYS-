<?php

namespace App\Http\Controllers;

use App\Models\Entry_Data;
use App\Models\Students;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Exception;


class StudentController extends Controller
{


    public function StudentForm(Request $request)
    {

        return view('Students/student_register');
    }

    public function createStudent(Request $request)
    {
        // dd($request->gender);
        try {
        $path = $request->file('image')->store('Student_image', 'public');
        // store in storage/app/public/images
        $user = Students::create([
            'roll_number' => $request->roll_number,
            'name' => $request->name,
            'major' => $request->major,
            'year' => $request->year,
            'ph_no' => $request->ph_no,
            'email' => $request->email,
            'image' => $path,
            'gender' => $request->gender,
            'qr_image' => 'default'
        ]);

        return view('Students.student_QRCode', [
            'user' => Students::latest()->first()
        ]);
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong. Please try again!');
    }
    }

    public function student_QRcodeView( Students $student)
    {
        return view('Students.student_QRCode', [
            'user' => $student
        ]);
    }


    public function studentsDetailView(Request $request)
    {
        // dd($request(['name']));
        $filter = request(['name', 'roll_number', 'year', 'major']);
        $totalAmount = Students::count('name');
        return view('Students/students_data', [

            'students' => Students::filter(request(['name', 'roll_number', 'year', 'major']))
                ->latest()
                ->paginate(5)
                ->withQueryString(),
            'totalAmount' => $totalAmount
        ]);
    }



    public function student_edit(Students $student)
    {

        return view('Students.student_edit', [
            'student' => $student
        ]);
    }

    public function student_update(Students $student)
    {


        $cleanData = request()->all();
        if ($file = request('image')) {
            // dd($student->image);
            if ($path = 'storage/' . $student->image) {
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $cleanData['image'] = $file->store('/Student_image', 'public');
        }
        try {
            $student->update($cleanData);

            return back()->with('success', 'Data saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Database error: ' . $e->errorInfo[2]);
        }
    }

    public function student_Detail(Students $student)
    {

        return view('Students.student_detail', [
            'student' => $student
        ]);
    }

    public function student_Detail_Delete(Students $student)
    {
        $student->delete();
        $data = Entry_Data::where('user_id', $student->roll_number)->delete();

        return back()->with('success', 'Data saved successfully!');;
    }

    public function Email_View(Students $student){
        return view('Students.send_email_to_student',[
            'user' => $student
        ]);
    }
}
