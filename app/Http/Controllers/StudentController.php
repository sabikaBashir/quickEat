<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct() {
        if (Auth::check() == false) {
            return redirect()->route("login")->send()->withSuccess('You are not allowed to access');
        }
    }
    public function index()
    {
        $users = Student::all();
        return view('users/view_users',compact('users'));
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Student::find($id);
        return view('users/edit_user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = Student::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $filename = 'item-' . time() . '.' . $image->getClientOriginalExtension(); // set filename to $isbn.jpg
            Storage::disk('public_uploads')->putFileAs('user', $image, $filename);
            $user->image = $filename;
        }
       
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Student::find($id);
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
