<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
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
        $item = Item::with('category')->get(); 
        return view('item.list',compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $category = Category::all(); 
        return view('item.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'status' => 'required',
            'ingredients' => 'required'
        ]);
        $filename = '';
        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $filename = 'item-' . time() . '.' . $image->getClientOriginalExtension(); // set filename to $isbn.jpg
            Storage::disk('public_uploads')->putFileAs('item', $image, $filename);
            
        }
        Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $filename,
            'category_id' => Auth::user()->category_id,
            'price'       => $request->price,
            'ingredients' => $request->ingredients,
        ]);

        return redirect()->route('item.index')
            ->with('success', 'Item created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);
        $category = Category::all(); 
        return view('item.edit',compact('item','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'status' => 'required',
            'ingredients' => 'required',
        ]);

        $item = Item::find($id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = Auth::user()->category_id;
        $item->price = $request->price;
        $item->status = $request->status;    
        $item->ingredients = $request->ingredients; 

        if ($request->hasFile('file')) {

            $image = $request->file('file');
            $filename = 'item-' . time() . '.' . $image->getClientOriginalExtension(); // set filename to $isbn.jpg
            Storage::disk('public_uploads')->putFileAs('item', $image, $filename);
            $item->image = $filename;
        }

        $item->save();

        return redirect()->route('item.index')
            ->with('success', 'Item created successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('item.index')
            ->with('success', 'item deleted successfully');
    }
}
