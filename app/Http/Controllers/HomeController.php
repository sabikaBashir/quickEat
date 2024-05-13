<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Models\User;
use App\Models\Student;
use Hash;
use DB;
class HomeController extends Controller
{
    public function index()
    {

        if(Auth::check()){
            return redirect('dashboard');
        }

        return redirect("login");
    }

    public function login()
    {
        return view('auth.login');
    }  

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function dashboard()
    {
        if (Auth::check()) {
           
            $tot_user    = DB::collection('student')->count();
            $tot_order   = DB::collection('order')->count();
            $tot_ads     = DB::collection('advertisment');
            $tot_vendor  = DB::collection('user')->where('role','vendor')->count();
            $tot_item    = DB::collection('item')->where('category_id',Auth::user()->category_id)->count();
            $pending_order    = DB::collection('order')->where('status','pending')->count();

            if(Auth::user()->role == 'vendor'){
                $tot_ads = $tot_ads->where('added_by',Auth::user()->id);
            }
            $tot_ads = $tot_ads->count();

            return view('dashboard',compact('tot_user','tot_order','tot_ads','tot_vendor','tot_item','pending_order'));
    }
        return redirect("login")->withSuccess('You are not allowed to access');

    } 

    public function editProfile() {
        $user = Auth::user();
        return view('update_profile',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $Vendor = User::find(Auth::user()->id);
        $Vendor->name = $request->name;
        $Vendor->email = $request->email;
        
        if($request->password){
            $Vendor->password = Hash::make($request->password);
        }

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = 'item-' . time() . '.' . $image->getClientOriginalExtension(); // set filename to $isbn.jpg
            Storage::disk('public_uploads')->putFileAs('vendor', $image, $filename);
            $Vendor->image = $filename;
        }

        $Vendor->save();

        return redirect()->route('dashboard')
            ->with('success', 'Profile updated successfully');
    
    }

}
