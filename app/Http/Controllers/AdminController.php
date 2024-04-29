<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;

class AdminController extends Controller
{
   //todo: admin login form
   public function login_form()
   {
       return view('admin.login-form');
   }

   //todo: admin login functionality
   public function login_functionality(Request $request){
       $request->validate([
           'email'=>'required',
           'password'=>'required',
       ]);

       if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect()->route('dashboard');
       }else{
           Session::flash('error-message','Invalid Email or Password');
           return back();
       }
   }

   public function dashboard()
   {

       return view('admin.dashboard');
   }
   


   //todo: admin logout functionality
   public function logout(){
       Auth::guard('admin')->logout();
       return redirect()->route('login.form');
   }

   public function changePassword(Request $request)
   {
        $user = Auth::guard('admin')->user();
        $adminId = $user->id;
        // dd($adminId);

       $student =Admin::get();
       return view('admin.reset-password', compact('student'));
   }

   public function updatePassword(Request $request)
   {
        $user = Auth::guard('admin')->user();
        $adminId = $user->id;
   
       $this->validate($request, [
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
       ]);
       try {
        $user = Admin::find($adminId);
        $user->password = Hash::make($request->password);
        $user->save();
            return response()->json(['success'=>'successfully Changed.']);
       }catch (\Exception $e) {
           return back()->with('error','somethingwrong');
       }
   }
}
