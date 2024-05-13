<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function __construct() {
        if (Auth::check() == false) {
            return redirect()->route("login")->send()->withSuccess('You are not allowed to access');
        }
    }
    
    public function index()
    {
        $advertisment = Advertisement::select('*');
        if(Auth::user()->role == 'vendor'){
        $advertisment = $advertisment->where('added_by',Auth::user()->id);
        }
        $advertisment = $advertisment->get();
        return view('advertisement.list',compact('advertisment'));
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $advertisement = Advertisement::find($id);
        return view('advertisement.edit',compact('advertisement'));
    }

    public function create()
    {
        return view('advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'heading' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $filename = '';
        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $filename = 'add-' . time() . '.' . $image->getClientOriginalExtension(); // set filename to $isbn.jpg
            Storage::disk('public_uploads')->putFileAs('advertisement', $image, $filename);
            
        }
        Advertisement::create([
            'heading' => $request->heading,
            'description' => $request->description,
            'status' => $request->status,
            'image'  => $filename,
            'added_by' => Auth::user()->id
        ]);

        return redirect()->route('advertisement.index')
            ->with('success', 'Advertisement created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'heading' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        
        $add = Advertisement::find($id);
        
        $add->heading = $request->heading;
        $add->description = $request->description;
        $add->status = $request->status;
        $add->added_by = Auth::user()->id;

        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $filename = 'add-' . time() . '.' . $image->getClientOriginalExtension(); // set filename to $isbn.jpg
            Storage::disk('public_uploads')->putFileAs('advertisement', $image, $filename);
            $add->image  = $filename;
            
        }
        $add->save();

        return redirect()->route('advertisement.index')
            ->with('success', 'advertisement updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $advertisement = Advertisement::find($id);
        $advertisement->delete();
        return redirect()->route('advertisement.index')
            ->with('success', 'advertisement deleted successfully');
    }

    public function editApprovel(string $id,String $status)
    {
        $add = Advertisement::find($id);
        $add->approve = $status;
        $add->save();

        return redirect()->route('advertisement.index')
            ->with('success', 'advertisement updated successfully');
    
    }
}
