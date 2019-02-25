<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Auth,View,Hash;
use App\User;
use App\Clinic;
use App\ClinicSlot;
use App\UserExperience;

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
        $clinicData = Clinic::where('user_id',Auth::user()->id)->with('clinicSlots')->get();
        $userExpData = UserExperience::where('user_id',Auth::user()->id)->get();
        
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
        return view('index',compact('userData','clinicData','userExpData'));
    }


    /**
    * signup user
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
            'password'  => 'required|min:6|max:255',
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

    /**
     * user image upload
     */
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

    /**
     * save user experience
     */
    public function saveUserExperience(Request $request){
        $rules = [
            'role'      => 'required|max:255',
            'from_year' => 'required|digits:4',
            'to_year'   => 'required|digits:4|after:from_year',
            'company'   => 'required|max:255'
        ];

        $messages = [
            'from_year.required' => 'Required',
            'to_year.required' => 'Required',
            'to_year.digits' => 'Invalid',
            'from_year.digits' => 'Invalid',
            'to_year.after' => 'To year must be greater than from year.'
        ];

        $validator = Validator::make($request->all(),$rules ,$messages);

        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()->toArray()
            ]);
        }else{
            UserExperience::create([
               "user_id" => Auth::user()->id,
               "role"    => $request->get('role'),
               "from_year" => $request->get('from_year'),
               "to_year" => $request->get('to_year'),
               "clinic_name" => $request->get('company')
            ]);
            return response()->json([
                'status' => 1,
                'msg'    => "User Experienced saved successfully."
            ]);
        }

    }

    public function renderUserExperience(){
        $userExpData = UserExperience::where('user_id',Auth::user()->id)->get();
        return view('partial.renderUserExperience',compact('userExpData'));
    }

    /**
     * delete user experience
     */
    public function deleteUserExperience(Request $request){
        $result = UserExperience::find($request->get("experience_id"))->delete();
        if($result){
            return response()->json([
                'status' => 1,
                'msg'    => "User experience deleted successfully."
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'msg'    => "Some error occured."
            ]);
        }

    }

    /**
     * save user profile data
     */
    public function saveUserData(Request $request){

        $rules = [
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'phone'      => 'required|numeric',
            'about_user' => 'required'
            ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()->toArray()
            ]);
        }else{
            User::find(Auth::user()->id)->update([
                "first_name"    => ucwords($request->get('first_name')),
                "last_name"     => ucwords($request->get('last_name')),
                "phone"         => $request->get('phone'),
                "about_user"    => $request->get('about_user')
            ]);
            return response()->json([
                'status' => 1,
                'msg'    => "Data saved successfully"
            ]);
        
        }

    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|max:255'
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
