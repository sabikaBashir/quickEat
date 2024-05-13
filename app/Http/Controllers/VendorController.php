<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class VendorController extends Controller
{
    public function __construct() {
        if (Auth::check() == false) {
            return redirect()->route("login")->send()->withSuccess('You are not allowed to access');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $vendor = User::where('role','vendor')->get(); 
        return view('vendor.list',compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all(); 
        return view('vendor.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'category' => 'required'
        ]);
       
        $filename = '';
        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $filename = 'item-' . time() . '.' . $image->getClientOriginalExtension(); // set filename to $isbn.jpg
            Storage::disk('public_uploads')->putFileAs('vendor', $image, $filename);
            
        }

        User::create([
            'name' =>$request->input('name'),
            'email' => $request->input('email'),
            'role'  => 'vendor',
            'password' => Hash::make($request->input('password')),
            'image' => $filename,
            'category_id' => $request->category
        ]);
        return redirect()->route('vendor.index')
            ->with('success', 'vendor created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = User::find($id);
        $category = Category::all(); 
        return view('vendor.edit',compact('vendor','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'category' => 'required'
        ]);

        $Vendor = User::find($id);
        $Vendor->name = $request->name;
        $Vendor->email = $request->email;
        $Vendor->category_id = $request->category;

        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $filename = 'item-' . time() . '.' . $image->getClientOriginalExtension(); // set filename to $isbn.jpg
            Storage::disk('public_uploads')->putFileAs('vendor', $image, $filename);
            $Vendor->image = $filename;
        }

        $Vendor->save();

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Vendor = User::find($id);
        $Vendor->delete();
        return redirect()->route('vendor.index')
            ->with('success', 'Vendor deleted successfully');
    }
}
