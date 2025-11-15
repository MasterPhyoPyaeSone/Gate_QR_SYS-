<?php

namespace App\Http\Controllers;

use App\Models\Entry_Data;
use App\Models\Staff;
use App\Models\Students;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;

class QrLoginController extends Controller
{   // this Function show that Page we want to loging by Scanner of QrCode
	public function index(Request $request)
	{
		// dd($request);
		return view('QrLogin');
	}

	// this Function Allow to User log or no log that do by Scanner of QrCode
	public function checkUser(Request $request)
	{
		// return response()->json($request->all()); 
		//  $result =0;
		// 	if ($request->data) {
		// 		$user = Students::where('name',$request->data)->first();
		// 		if ($user) {
		// 			// Auth::login($user);
		// 		    $result =1;
		// 		 }else{
		// 		 	$result =0;
		// 		 }
		//     }
		// 	return $result;

		$qrData = $request->input('qr_data');
		

		// QR data ထဲကနေ User ID & Name ကို regex နဲ့ ခွဲထုတ်မယ်
		preg_match('/User ID:\s*(\S+)/', $qrData, $idMatch);
		preg_match('/Name:\s*(.+)/', $qrData, $nameMatch);

		$userId = $idMatch[1] ?? null;   // eg. MUB_1268
		$name   = $nameMatch[1] ?? null; // eg. Phyo Lay

		if (!$userId || !$name) {
			return response()->json(0); // invalid QR format
		}

		$student = Students::where('roll_number',$userId)->exists();
		$teacher = Teacher::where('teacher_id',$userId)->exists();
		$staff = Staff::where('staff_id',$userId)->exists();



		// students table ထဲမှာ စစ်မယ်
		if ($staff) {
			$exit = Staff::where('staff_id', $userId)
				->orWhere('name', $name)
				->exists();
			if ($exit) {
				// user ရှိပါပြီ
				// Get last entry status to toggle between "in" and "out"
				$lastState = Entry_Data::where('user_id', $userId)
					->latest()
					->value('state');

				$newState = ($lastState === 'in') ? 'out' : 'in';

				// Create new entry record
				Entry_Data::create([
					'user_id' => $userId,
					'name' => $name,
					'state' => $newState,
					'time' => now()
				]);
				return response()->json(1);
			} else {
				// user မရှိပါ
				return response()->json(0);
			}
		}

		if ($teacher) {
			$exit = Teacher::where('teacher_id', $userId)
				->orWhere('name', $name)
				->exists();
			if ($exit) {
				// user ရှိပါပြီ
				// Get last entry status to toggle between "in" and "out"
				$lastState = Entry_Data::where('user_id', $userId)
					->latest()
					->value('state');

				$newState = ($lastState === 'in') ? 'out' : 'in';

				// Create new entry record
				Entry_Data::create([
					'user_id' => $userId,
					'name' => $name,
					'state' => $newState,
					'time' => now()
				]);
				return response()->json(1);
			} else {
				// user မရှိပါ
				return response()->json(0);
			}
		}
		if ($student) {
			$exit = Students::where('roll_number', $userId)
				->orWhere('name', $name)
				->exists();
			if ($exit) {
				// user ရှိပါပြီ
				// Get last entry status to toggle between "in" and "out"
				$lastState = Entry_Data::where('user_id', $userId)
					->latest()
					->value('state');

				$newState = ($lastState === 'in') ? 'out' : 'in';

				// Create new entry record
				Entry_Data::create([
					'user_id' => $userId,
					'name' => $name,
					'state' => $newState,
					'time' => now()
				]);
				return response()->json(1);
			} else {
				// user မရှိပါ
				return response()->json(0);
			}
		}
	}
}
