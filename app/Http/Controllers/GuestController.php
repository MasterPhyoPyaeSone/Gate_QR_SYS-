<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuestQrMail;
use App\Models\Entry_Guest_Data;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class GuestController extends Controller
{
    public function guestForm()
    {
        return view('Guest.guest_register');
    }

    public function creatGuest(Request $request)
    {
        // store in storage/app/public/images
        $user = Guest::create([
            'name' => $request->name,
            'purpose' => $request->purpose,
            'ph_no' => $request->ph_no,
            'email' => $request->email,
            'gender' => $request->gender,
        ]);

        return view('Guest.guest_QRCode',[
            'user'=>$user
        ]);
    }

    public function guest_QRcodeView(Guest $guest)
    {
        return view('Guest.guest_QRCode', [
            'user' => $guest
        ]);
    }

    public function Email_View()
    {
        return view('Guest.send_email_to_student',[
            'user' => Guest::latest()->first()
        ]);
    }

    public function guestsDetailView(Request $request)
    {
        // dd($request(['name']));
        $filter = request(['name', 'roll_number', 'year', 'major']);
        $totalAmount = Guest::count('name');
        return view('Guest.guests_data', [

            'guests' => Guest::filter(request(['name', 'roll_number', 'year', 'major']))
                ->latest()
                ->paginate(5)
                ->withQueryString(),
            'totalAmount' => $totalAmount
        ]);
    }


    public function indexx(Request $request)
    {

        // dd(request()->all());

        return view('Guest/entryData', [
            'entryData' => Entry_Guest_Data::filter(request(['name', 'date', 'state', 'S_time', 'E_time']))
                           ->latest()->paginate(5)->withQueryString(),
            'total' => Entry_Guest_Data::count('name'),
            'in' => Entry_Guest_Data::where('state', 'in')->whereDate('time', Carbon::today())
                ->count(),
            'out' => Entry_Guest_Data::where('state', 'out')->whereDate('time', Carbon::today())
                ->count()

        ]);
    }
    public function Email_Views(Guest $guest){
        return view('Guest.send_email_to_guest',[
            'user' => $guest
        ]);
    }
}
