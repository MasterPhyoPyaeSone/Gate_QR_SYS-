<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImageMail; // Update this to your new mail class

class MailController extends Controller
{
    public function form()
    {
        return view('send',[
        ]);
    }

    // image 1
    public function send(Request $request)
    {
        $data = $request->validate([
            'to' => ['required', 'email'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10240'], // 10MB
        ]);

        $to = $data['to'];
        $subject = $data['subject'] ?? 'Image from your app';
        $messageText = $data['message'] ?? 'Please find the attached image.';

        // Get uploaded file info
        $uploaded = $request->file('image');
        $realPath = $uploaded->getRealPath();
        $originalName = $uploaded->getClientOriginalName();

        // Send mail
        Mail::to($to)->send(new ImageMail($subject, $messageText, $realPath, $originalName));

        // return back()->with('status');
        return back()->with('success', 'Data saved successfully!');

    }


//     // image 2
//     public function send(Request $request)
// {
//     $data = $request->validate([
//         'to' => ['required', 'email'],
//         'subject' => ['nullable', 'string', 'max:255'],
//         'message' => ['nullable', 'string', 'max:5000'],
//         'images' => ['required'],
//         'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10240'], // each file max 10MB
//     ]);

   

//     $to = $data['to'];
//     $subject = $data['subject'] ?? 'Images from your app';
//     $messageText = $data['message'] ?? 'Please find the attached images.';

//     // Collect uploaded images
//     $attachments = [];
//     if ($request->hasFile('images')) {
//         foreach ($request->file('images') as $uploaded) {
//             $attachments[] = [
//                 'path' => $uploaded->getRealPath(),
//                 'name' => $uploaded->getClientOriginalName(),
//             ];
            
//         }
//     }
    
//     // Send mail with multiple attachments
//     Mail::to($to)->send(new ImageMail($subject, $messageText, $attachments));
// dd('hh');
//     return back()->with('status', 'Email sent successfully!');
// }

}
