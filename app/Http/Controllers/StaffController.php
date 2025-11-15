<?php

namespace App\Http\Controllers;

use App\Models\Entry_Data;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Nette\Schema\Expect;

class StaffController extends Controller
{
    public function staffForm()
    {
        return view('Staff.staff_register');
    }

    public function createStaff(Request $request)
    {

        $path = $request->file('image')->store('Staff_image', 'public');
        // store in storage/app/public/images
        $user = Staff::create([
            'staff_id' => $request->staff_id,
            'name' => $request->name,
            'position' => $request->position,
            'ph_no' => $request->ph_no,
            'email' => $request->email,
            'image' => $path,
            'gender' => $request->gender,
            'qr_image' => 'default'
        ]);

       
        return view('Staff.Staff_QRCode', [
            'user' => Staff::latest()->first()
        ]);
    }

    public function staffsDetailView(Request $request)
    {

        $filter = request(['name', 'staff_id', 'position']);

        $totalAmount = staff::count('name');
        return view('Staff/staffs_data', [

            'staffs' => staff::filter(request(['name', 'staff_id', 'position']))
                ->latest()
                ->paginate(3)
                ->withQueryString(),
            'totalAmount' => $totalAmount
        ]);
    }

    public function staff_Detail(Staff $staff)
    {

        return view('Staff.staff_detail', [
            'staff' => $staff
        ]);
    }

    public function staff_edit(Staff $staff)
    {

        return view('Staff.staff_edit', [
            'staff' => $staff
        ]);
    }

    public function staff_update(Staff $staff)
    {

        $cleanData = request()->all();
        if ($file = request('image')) {
            // dd($staff->image);
            if ($path = 'storage/' . $staff->image) {
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $cleanData['image'] = $file->store('/Staff_image', 'public');
        }

        if (request('name') !== $staff->name || request('staff_id') !== $staff->staff_id) {

            Entry_Data::where('user_id', $staff->staff_id)
                ->update([
                    'user_id' => request('staff_id'),
                    'name'   => request('name'),
                ]);
        }
        try {
            $staff->update($cleanData);

            return back()->with('success', 'Data saved successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Database error: ' . $e->errorInfo[2]);
        }
    }
    public function staff_Detail_Delete(Staff $staff)
    {
        $staff->delete();
        $data = Entry_Data::where('user_id', $staff->staff_id)->delete();

        return back();
    }

    public function staff_QRcodeView(Staff $staff)
    {
        return view('Staff.staff_QRCode', [
            'user' => $staff
        ]);
    }
    public function Email_View(Staff $staff){
        return view('Staff.send_email_to_staff',[
            'user' => $staff
        ]);
    }
}
