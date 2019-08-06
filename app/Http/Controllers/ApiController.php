<?php

namespace App\Http\Controllers;

use App\DuaList;
use App\MainCategory;
use App\SaveDua;
use App\User;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Validator;

class ApiController extends Controller
{
    public function allcontent(){
    	$content = DuaList::join('main_categories', 'dua_lists.category', '=', 'main_categories.id')
            ->select('dua_lists.*', 'main_categories.title as category_title', 'main_categories.id as category_id')
            ->latest()
            ->get();
    	return response()->json(["error" => false, "count" => $content->count(), "content" => $content], 201);
    }

    public function allcontentbyid($id){
    	$content = DuaList::where("category", $id)
    				->join('main_categories', 'dua_lists.category', '=', 'main_categories.id')
    				->select('dua_lists.*', 'main_categories.title as category_title', 'main_categories.id as category_id')
		            ->latest()
		            ->get();
    	return response()->json(["error" => false, "count" => $content->count(), "content" => $content], 201);	
    }

    public function getsavedpostschecked($postid, $userid){
    	$content = SaveDua::join('main_categories', 'save_duas.category', '=', 'main_categories.id')
    				->join('dua_lists', 'save_duas.dua', '=', 'dua_lists.id')
	    			->select('dua_lists.*', 'main_categories.title as category_title', 'main_categories.id as category_id')
	    			->where("save_duas.category", $postid)->where("save_duas.user", $userid)
	    			->latest()->get();
    	return response()->json(["error" => false, "count" => $content->count(), "content" => $content]);	
    }

    public function singleContent($id){
    	$content =  DuaList::where("id", $id)->first();
    	if($content){
    		$error = false;
    	}else{
    		$error = true;
    	}
    	return response()->json($content, 201);	
    }


    public function registernow(Request $get){
    	$validate = Validator::make($get->all(),[
    		"username" => "required",
    		"useremail" => "required|unique:users,email",
    		"password" => "required|min:6",
    	],[
    		"username.required" => "Enter your name",
    		"useremail.required" => "Enter your email",
    		"useremail.unique" => "This email has been taken",
    		"password.required" => "Enter a password",
    	]);

    	if($validate->fails()){
    		return response()->json(["error" => true, "message" => $validate->errors()]);
    	}else{
    		$userid = User::insertGetId([
    			"name" => $get->username,
    			"email" => $get->useremail,
    			"password" => Hash::make($get->password),
    			"gender" => 0,
    			"phone" => $get->useremail,
    			"created_at" => Carbon::now()
    		]);
    		$getuser = User::find($userid);
			return response()->json(["error" => false, "message" => "Register Successfull", "user" => $getuser]);
    	}
    }

    public function loginnow(Request $get){
    	$validate = Validator::make($get->all(),[
    		"useremail" => "required|exists:users,email",
    		"password" => "required",
    	],[
    		"useremail.required" => "Enter your email",
    		"useremail.exists" => "Sorry Login information wrong",
    		"password.required" => "Enter your password",
    	]);

    	if($validate->fails()){
    		return response()->json(["error" => true, "message" => $validate->errors()]);
    	}else{
    		$user = User::where('email', $get->useremail)->first();
    		if($user){
    			if(Hash::check($get->password, $user->password)){
	               $getuser = $user;
	               	return response()->json([
	               		"error" => false, 
	               		"message" => "Login Successfull", 
	               		"user" => $getuser
	               	]);
	            }else{
	                return response()->json([
	               		"error" => true, 
	               		"errormessage" => "Your login information not matched"
	               	]);
	            }
    		}else{
    			return response()->json([
               		"error" => true, 
               		"errormessage" => "Your login information not matched"
               	]);
    		}
    	}
    }

    public function checksavedPosts(Request $get){
    	if($get->userId && $get->postId){
    		$getdua = SaveDua::where('user', $get->userId)->where("dua", $get->postId)->first();
    		if($getdua){
    			return response()->json(["error" => false, "found" => true]);
    		}else{
    			return response()->json(["error" => false, "found" => false]);
    		}
    	}else{
    		return response()->json(["error" => true, "found" => false]);
    	}
    }

    public function checksavedPostsbyUser(Request $get){
    	if($get->userId && $get->postId){
    		$getdua = DuaList::find($get->postId);
    		$getuser = User::find($get->userId);
    		if($getdua && $getuser){
    			$getsaveddua = SaveDua::where('user', $getuser->id)->where("dua", $getdua->id)->first();
	    		if($getsaveddua){
	    			SaveDua::where('user', $getuser->id)->where("dua", $getdua->id)->delete();
	    			return response()->json(["error" => false, "found" => true, "delete" => true]);
	    		}else{    			
	    			SaveDua::Insert([
	    				"user" => $getuser->id,
	    				"dua" => $getdua->id,
	    				"category" => $getdua->category,
	    				"created_at" => Carbon::now(),
	    			]);
	    			return response()->json(["error" => false, "found" => false, "delete" => false]);
	    		}	
    		}else{
    			return response()->json(["error" => true, "found" => false, "delete" => false]);	
    		}    		
    	}else{
    		return response()->json(["error" => true, "found" => false, "delete" => false]);
    	}
    }



}
