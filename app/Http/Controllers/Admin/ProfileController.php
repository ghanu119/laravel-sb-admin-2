<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminProfilePasswordChangeRequest;
use App\Http\Requests\Admin\AdminProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
 
    /**
     * @name index
     * 
     */
    public function index ( ) {
        $user = auth()->user();
        return view('admin.profile.edit', compact('user') );
    }

    /**
     * @name store
     * 
     */
    public function store ( AdminProfileUpdateRequest $request ) {
        $messageKey = 'success-message';
        $message = 'Profile has been updated successfully';
        
        $adminUser = auth()->user();

        $adminUser->name = $request->get('name');
        $adminUser->email = $request->get('email');
        $adminUser->save();
        
        return redirect()->back()->with( $messageKey, $message );
        
    }

    /**
     * @name changePassword
     * 
     */
    public function changePassword ( ) {
        return view('admin.profile.change_password' );
    }

    /**
     * @name updatePassword
     * 
     */
    public function updatePassword ( AdminProfilePasswordChangeRequest $request ) {
        $messageKey = 'success-message';
        $message = 'Password has been updated successfully';
        
        $adminUser = auth()->user();
        if( Hash::check( $request->password, $adminUser->password ) ){

            $adminUser->password = Hash::make( $request->password );
            $adminUser->save();
        }else{
            throw ValidationException::withMessages([
                    'current_password' => 'Password incorrect.'
                ]);

        }
        
        return redirect()->back()->with( $messageKey, $message );
        
    }

}
