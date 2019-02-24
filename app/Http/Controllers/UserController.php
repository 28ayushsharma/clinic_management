<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Auth,View,Hash;
use App\User;
use App\Clinic;
use App\ClinicSlot;

class UserController extends Controller{
    /**
    * middleware restriction only superadmin allowed
    *@param null
    *
    * @return view page
    */

    /**
     * Show the application dashboard.
     *@param null
     *
     * @return view page
     */
    public function index(){
        $userData = User::find(Auth::user()->id);
        $clinicData = Clinic::with('clinicSlots')->get();
        
        //restructuring data for ease of display
        $restructuredData = array();
        foreach($clinicData as $index => $slotData){
            foreach($slotData->clinicSlots as $key=> $slot){
                $restructuredData[$slot->day][$key]['slot_id'] = $slot->id;
                $restructuredData[$slot->day][$key]['start_time'] = date("g:i a", strtotime($slot->start_time));
                $restructuredData[$slot->day][$key]['end_time'] = date("g:i a", strtotime($slot->end_time));  
            }
            $clinicData[$index]->clinicSlots = $restructuredData;
            $restructuredData = [];
        }
        return view('index',compact('userData','clinicData'));
    }


    /**
    * Save User data
    *@param null
    *
    * @return view page with success msg
    */
    public function save(Request $request){
        $input_data = $request->get('formData');
        $rules = [
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'phone'     => 'required|numeric',
            'email'     => 'required|email|unique:users,email,',
            'password'  => 'required|min:6',
            ];

        $validator = Validator::make($input_data, $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()->toArray()
            ]);
        }else{
            User::create([
                "first_name"      => ucwords($input_data['first_name']),
                "last_name"      => ucwords($input_data['last_name']),
                "email"     => $input_data['email'],
                "password"  => Hash::make($input_data['password']),
                "phone"  => $input_data['phone'],
                "licence_no" => uniqid().str_random(3)
                
            ]);
            return response()->json([
                'status' => 1,
                'msg'    => "Data saved successfully"
            ]);
        
        }
    }//save() END


    public function uploadPic(Request $request){
        $rules = [
            'pro_pic' => 'image'
            ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()->toArray()
            ]);
        }else{
            if ($request->hasFile('pro_pic')) {
                $image = $request->file('pro_pic');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/profile_images');
                $image->move($destinationPath, $name);
                //storing image to database
                User::find(Auth::user()->id)->update([
                    "photo" => $name
                ]);

                return response()->json([
                    'status' => 1,
                    'image_name'    => $name
                ]);
            }
        }
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required'
            ]);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            if(Auth::attempt(['email' =>$request->input('email'), 'password' =>$request->input('password')])){
                return redirect()->route('dashboard');
            }else{
                $request->session()->flash('status', 'error');
                $request->session()->flash('msg', 'Incorrect credentials');
            }
        } 
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}//User controller END
