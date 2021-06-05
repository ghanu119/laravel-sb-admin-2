<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ResetPasswordLinkRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Mail\ResetPasswordMail;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
 
    /**
     * @name login
     * 
     * Show a login page
     */
    public function login () {
        // $this->createAdminUser();
        return view('admin.auth.login');
    }
 
    /**
     * @name forgotPassword
     * 
     * Show a forgot Password page
     */
    public function forgotPassword () {
        return view('admin.auth.forgot-password');
 
    }

    /**
     * @name doLogin
     * 
     * Create a login and enter into dashboard
     */
    public function doLogin ( LoginRequest $request ) {
        
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        
        $is_remember = $request->has('remember_me');

        if( auth('admin')->attempt( $credentials, $is_remember ) ){
            return redirect()->route('admin.index');
        }else{
            $message = 'Invalid credentials !';
            return redirect()->back()->with('error-message', $message)->withInput();

        }
    }

    /**
     * 
     * @name logout
     * 
     * Expire login session 
     */
    public function logout(){
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }

    /**
     * @name sendResetPasswordLink
     * 
     * TO send a reset password link with token
     * 
     */
    public function sendResetPasswordLink ( ResetPasswordLinkRequest $request ){
        checkToken:
            $token = Str::random( 30 );
            $tokenExists = AdminUser::where('reset_token', $token)->first();
        if( !is_null( $tokenExists ) ){
            goto checkToken;
        }
        AdminUser::where('email', $request->get('email') )
                ->update([
                    'reset_token' => $token
                ]);
                
        Mail::to($request->get('email'))
                ->send( new ResetPasswordMail($token));
        return redirect()->back()->with('success-message', 'Reset password link sent in mail.');
    }

    /**
     * @name showResetPassword
     * 
     * Show a password reset form
     * 
     */
    public function showResetPassword (  $token ){
        $user = AdminUser::where('reset_token', $token)->first();
        if( !is_null( $user ) ){
            $data = [
                'token' => $token
            ];
            return view('admin.auth.reset-password', $data);
        }
        return redirect()->route('admin.auth.forgot-password')->with('error-message', 'Reset password token not found.');
    }

    /**
     * @name resetPassword
     * 
     * Reset password for selected token
     * 
     */
    public function resetPassword (  ResetPasswordRequest $request ){
        $user = AdminUser::where('reset_token', $request->get('token'))->first();
        if( !is_null( $user ) ){
            $user->reset_token = null;
            $user->password = Hash::make( $request->get('password') );
            $user->save();
            return redirect()->route('admin.login')->with('success-message', 'Password has been reset successfully.');
        }
        return redirect()->back()->with('error-message', 'Reset password token not found.');
    }
}
