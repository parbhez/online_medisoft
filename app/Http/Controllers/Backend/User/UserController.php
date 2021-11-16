<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Backend\Models\Users\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Custom\Helper;
use Session;
use DB;
use Image;
use File;

class UserController extends Controller
{
    public $view_page_url;

	public function __construct()
	{
		$this->view_page_url = 'Backend.users.';
	}

    public function addUser()
    {
    	return view($this->view_page_url.'addUser');
    }



     public function saveUser(Request $request)
    {

        $validated = $request->validate([
        'user_name' => 'required|unique:users|max:255',
        'email' => 'required|unique:users|max:255',
        ]);
    
    	try{
    		DB::beginTransaction();
    		$saveUser = DB::table('users')->insertGetId([
    			'first_name'        => $request->first_name,
    			'last_name'    => $request->last_name,
    			'user_name'=> $request->user_name,
    			'dob' => $request->dob,
    			'email' => $request->email,
    			'gender'       => $request->gender,
    			'mobile_number'		     => $request->mobile_number,
    			'password'		 => bcrypt($request->password),
    			'show_password'			 => $request->password,
    			'user_type'       => $request->user_type,
    			'present_address'      => $request->present_address,
                'permanent_address'      => $request->permanent_address,
    			'created_at'         => date('Y-m-d'),
                'created_by'         => 1
    			]);
    		
            //create a row size
    		if($saveUser){
    			if ($request->hasFile('profile_image')) {
                    $pimage = $request->file('profile_image');
                    $fileName = $saveUser. '-' .time() . '.' . $pimage->getClientOriginalExtension();
                    Image::make($pimage)->resize(350, 350)->save(public_path('images/users/' . $fileName));
                if($fileName != null){
                        $uploadImage = DB::table('users')->where('user_id',$saveUser)
                            ->update([
                                'profile_image' => $fileName,
                                'updated_by'    => 1,
                                'updated_at'    => date('Y-m-d'),
                            ]);
                }    
            }

    		DB::commit();
    		Session::flash('success', 'User Added Successfully !!');
    	}else{
    		DB::rollback();
    		Session::flash('error', 'Something Went Wrong');
          
    	}		
    	}catch(\Exception $e){
    		DB::rollback();
    		return $e;
    		Session::flash('error', $e->errorInfo[2]);
    	}
    	return redirect()->route('users.add-user');

    }

    public function viewUser()
    {
        $users = User::whereIn('status',[1,0])->get();

        return view($this->view_page_url.'viewUser',compact("users"));
    }

    public function statusUpdate($modelReference,$action,$id)
    {
        // $modelName = "";
        // foreach (explode("-", $modelReference) as $value) {
        //  $modelName .= ucwords($value);
        // }
        // $filterColumn = implode("_",explode("-", $modelReference)) .'_id';
        // $modelPath = 'App\Backend\Models\Settings\\'.$modelName;
        // $model = new $modelPath();


        $modelName = '';
        $stringToArryConvert = explode("-",$modelReference);
        foreach ($stringToArryConvert as $value) {
             $modelName .= ucwords($value);
         }
         $arrayToStringConvert = implode("_",$stringToArryConvert);
         $filterColumn = $arrayToStringConvert."_id";
         $modelPath = 'App\Backend\Models\Users\\'.$modelName;
         $model = new $modelPath();
        try{
            DB::beginTransaction();
            $result = $model::where($filterColumn,$id)
                    ->update([
                        'status' =>Helper::getStatus($action),
                        'updated_by' => 1
                    ]);
            if($result){
                DB::commit();
                return response()->json(['success' => true, 'message' => ucwords($action) . ' Successfull !!']);
                //Session::flash('success', ucwords($action) . ' Successfull !!');
            }else{
                DB::rollback();
                return response()->json(['error' => true, 'message' => 'Something Went Wrong !!']);
            }       
        }catch(\Exception $e){
            DB::rollback();
            //return $e;
            return response()->json(['error' => true, 'message' => $e->errorInfo[2]]);
        }
        
    }

    public function editUser($user_id)
    {
        //dd($user_id);
        $editUser = User::where('user_id',$user_id)->first();
        return view($this->view_page_url.'editUser',compact("editUser"));

    }

    public function updateUser(Request $request,$user_id)
    {
        $validated = $request->validate([
        'user_name' => 'required|unique:users|max:255',
        'email' => 'required|unique:users|max:255',
        ]);


         $findUser = User::where('user_id',$user_id)->first();

         if($findUser)
         {
            try{
            DB::beginTransaction();
            $updateUser = User::where('user_id',$findUser->user_id)
            ->update([
                'first_name'        => $request->first_name,
                'last_name'    => $request->last_name,
                'user_name'=> $request->user_name,
                'dob' => $request->dob,
                'email' => $request->email,
                'gender'       => $request->gender,
                'mobile_number'          => $request->mobile_number,
                'user_type'       => $request->user_type,
                'present_address'      => $request->present_address,
                'permanent_address'      => $request->permanent_address,
                'updated_at'         => date('Y-m-d'),
                'updated_by'         => 1
                ]);
            
            //create a row size
            if($updateUser){
                if($request->hasFile('profile_image')){
                    $pimage = $request->file('profile_image');
                    $fileName = $findUser->user_id . '-' .time() . '.' .$pimage->getClientOriginalExtension();
                $img = Image::make($pimage)->resize(350, 350)->save(public_path('images/users/' . $fileName));
                if($fileName != null){
                    $updateUserImage = User::where('user_id',$findUser->user_id)
                        ->update([
                            'profile_image' => $fileName,
                            'updated_at'    => date("Y-m-d"),
                            'updated_by'    => 1
                        ]);
                   }
                   //===========@ Old Image remove panel start @===================
                if ($findUser->profile_image != $fileName) {
                $oldImagePath = 'images/users/'.$findUser->profile_image;
                File::delete(public_path($oldImagePath));
                    }  
                 //==============@old image remove panel End @===============   
                }

            DB::commit();
            Session::flash('success', 'User Added Successfully !!');
        }else{
            DB::rollback();
            Session::flash('error', 'Something Went Wrong');
          
        }       
        }catch(\Exception $e){
            DB::rollback();
            return $e;
            Session::flash('error', $e->errorInfo[2]);
        }
         }

         return redirect()->route('users.view-user');
    }
}
