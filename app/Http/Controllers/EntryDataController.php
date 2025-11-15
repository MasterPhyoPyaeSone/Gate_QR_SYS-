<?php

namespace App\Http\Controllers;

use App\Models\Entry_Data;
use Carbon\Carbon;
use Dotenv\Parser\Entry;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zxing\QrReader;


class EntryDataController extends Controller
{

    public function indexx(Request $request)
    {

        return view('Entry/entryData', [
            'entryData' => Entry_Data::with('student', 'teacher')->filter(request(['name', 'user_id', 'date', 'state', 'S_time', 'E_time']))
                ->latest()->paginate(5)->withQueryString(),
            'total' => Entry_Data::count('name'),
            'in' => Entry_Data::where('state', 'in')->whereDate('time', Carbon::today())
                ->count(),
            'out' => Entry_Data::where('state', 'out')->whereDate('time', Carbon::today())
                ->count()

        ]);
    }
    public function entry_scan_view()
    {
        // Retrieve all scanned QR codes from the database
        $qrCodes = Entry_Data::all();
        return view('entry_scan', compact('qrCodes'));
    }

    public function entry_data_store(Request $request)
    {
        // dd($request);
        // Validate the uploaded file
        // $request->validate([
        //     'qr_image' => 'required|image|max:2048',
        // ]);

        // Store the uploaded image
        $path = $request->file('qr_image')->store('QR_image', 'public');
        $fullpath = 'storage/' . $path;

        // Use the QR reader to decode the QR code
        $qrReader = new QrReader($fullpath);
        $text = $qrReader->text();


        // Extract data from QR text
        $pattern = '/User ID:\s*(.*)\s*Name:\s*(.*)/';
        preg_match($pattern, $text, $matches);
        if (count($matches) === 3) {
            $userId = trim($matches[1]);  // "MUB_1260"
            $name = trim($matches[2]);    // "phyopyaesone"

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

            $message = "Entry recorded: $name is now $newState";
        } else {
            $message = "Invalid QR code format";
        }


        // Redirect back with a success message
        return redirect()->back()->with('success', 'QR code scanned and stored successfully!');
    }


    public function entry_data_storeByScann(Request $request)
    {
        dd("dd");
        if ($request->wantsJson() || $request->isJson()) {
            $data = $request->validate([
                'qr_text' => 'required|string',
            ]);
            // $qr = ScannedQR::create([
            //     'content' => $data['qr_text'],
            //     'image_path' => null
            // ]);
            return response()->json([
                'success' => true,
                'data' => $qr
            ]);
        }
        // Handle file upload requests
        // $request->validate([
        //     'qr_image' => 'required|image|max:2048',
        // ]);

        // $path = $request->file('qr_image')->store('qr-images');
        // $fullPath = storage_path('app/' . $path);
        // $qrReader = new QrReader($fullPath);
        // $text = $qrReader->text();
        // $qr = ScannedQR::create([
        //     'content' => $text,
        //     'image_path' => $path
        // ]);
        return redirect()->back()->with('success', 'QR code scanned and stored successfully!');
    }






    public function index(Request $request)
    {

        return view('QrLogin');
    }

    // this Function Allow to User log or no log that do by Scanner of QrCode
    public function checkUser(Request $request)
    {

        $result = 0;
        if ($request->data) {
            $user = User::where('name', $request->data)->first();
            if ($user) {
                Auth::login($user);
                $result = 1;
            } else {
                $result = 0;
            }
        }
        return $result;
    }
}
