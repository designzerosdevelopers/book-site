<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
    
        $token = Str::random(60);
        $hashedToken = bcrypt($token);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $hashedToken,
                'created_at' => Carbon::now(),
            ]
        );

        // Create the reset link URL
        $resetLink = URL::signedRoute('password.reset', ['token' => $token, 'email' => $request->email]);

        try {
            // Define the mail configuration
            $config = [
                'host' => \App\Helpers\SiteviewHelper::getsettings('MAIL_HOST'), // Specify your SMTP host
                'port' => \App\Helpers\SiteviewHelper::getsettings('MAIL_PORT'), // Specify the port number
                'from' => ['address' => \App\Helpers\SiteviewHelper::getsettings('MAIL_FROM_ADDRESS'), 'name' => \App\Helpers\SiteviewHelper::getsettings('MAIL_FROM_NAME')],
                'encryption' => \App\Helpers\SiteviewHelper::getsettings('MAIL_ENCRYPTION'), // Specify the encryption type (tls or ssl)
                'username' => \App\Helpers\SiteviewHelper::getsettings('MAIL_USERNAME'), // Specify your SMTP username
                'password' => \App\Helpers\SiteviewHelper::getsettings('MAIL_APP_PASSWORD'), // Specify your SMTP password
            ];

            config([
                'mail.mailers.smtp' => array_merge(config('mail.mailers.smtp'), $config)
            ]);

            Mail::mailer('smtp')->to($request->email)->send(new PasswordResetLink($resetLink));
            $status = 'Reset link sent';
            return  redirect()->back()->with('status', __($status));
            Session::flash('repurchases', 'Your purchase was successful! You can now download your book and check your email for further instructions.');
        } catch (\Exception $e) {
            return redirect()->back()->with('status',' Something went wrong'.$e);
        }

        
       
      
                 
                    

        

















        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );



        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
                            
    }
}
