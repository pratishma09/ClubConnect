<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\VerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        $verificationCode = rand(100000, 999999);
        VerificationCode::updateOrCreate(
            ['email' => $request->email],
            ['code' => $verificationCode]
        );

        Mail::to($request->email)->send(new VerificationCodeMail($request->email, $verificationCode));

        // Store the email in the session
        session(['verification_email' => $request->email]);

        return redirect()->route('users.verify')->with('success', 'Verification code sent to your email!');
    }

    public function showVerificationForm(Request $request)
    {
        // Check if the query parameters are present and automatically fill in the code
        if ($request->has(['email', 'code'])) {
            session(['verification_email' => $request->email]);
            return view('users.verify', ['code' => $request->code]);
        }
        return view('users.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        // Retrieve the email from the session
        $email = session('verification_email');

        if (!$email) {
            return redirect()->route('home')->with('error', 'No email found in session. Please try again.');
        }

        $verification = VerificationCode::where('email', $email)
                            ->where('code', $request->code)
                            ->first();

        if ($verification) {
            Subscription::create(['email' => $email]);
            $verification->delete(); // Delete the verification code after successful verification

            // Clear the email from the session
            session()->forget('verification_email');

            return redirect()->route('home')->with('success', 'Subscription successful!');
        } else {
            return redirect()->route('users.verify')->with('error', 'Invalid verification code!');
        }
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|unique:subscriptions,email',
    //     ]);

    //     Subscription::create($request->only('email'));

    //     return redirect()->back()->with('success', 'Subscription successful!');
    // }
}
