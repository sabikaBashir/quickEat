<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
        try{
            request()->validate([
                'name' => 'required',
                'email' => 'required|unique:student,email',
                'password' => 'required',
                'student_id' => 'required|unique:student,student_id'
            ]);
        
            $filename = '';
            if ($image_64 = $request->image) {
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf
                $encodedString = explode(',', $image_64, 2);
                $decodedImage = str_replace(' ', '+', $encodedString[1]);
                $filename = 'user-' . time() . '.' . $extension;
                Storage::disk('public')->put($filename,  base64_decode($decodedImage));      
            }
            
            $student = Student::create([
                'name' =>$request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'image' => $filename,
                'student_id' => $request->student_id
            ]);
            if($student){
            //$student->token = $student->createToken('MyAuthApp')->plainTextToken; 
            return response()->json(['success' => true, 'response' => $student]);
            }
            return response()->json(['success' => false,]);
        }catch(\Exception $e){
            return response()->json(['success' => false,'response'=>$e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
       
            $credentials = $request->only('email', 'password');dd(Auth::guart('api'));
            if (Auth::guard('api')->attempt($credentials)) {
                return response()->json(['success' => true, 'response' => $student]);
            }

            return response()->json(['success' => false,]);
        }catch(\Exception $e){
            return response()->json(['success' => false,'response'=>$e->getMessage()]);
        }
    }

    public function checkEmailExist(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required',
            ]);
       
            $existEmail = Student::where('email',$request->email)->count();

            if($existEmail > 0 ){
                return response()->json(['success' => true,'exist' => true]);
            }
                return response()->json(['success' => false,'exist' => false]);
        }catch(\Exception $e){
            return response()->json(['success' => false,'response'=>$e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try{
            $request->validate([
                'id' => 'required',
            ]);
            $input = $request->all();
            $student   = Student::find($request['id']);
            if($student){
                $student->fill($input);
                $student->save();
            }
            if($student){
                return response()->json(['success' => true,'response'=>$student]);
            }
            return response()->json(['success' => false,]);

        }catch(\Exception $e){
            return response()->json(['success' => false,'response'=>$e->getMessage()]);
        }
    }

}
?>