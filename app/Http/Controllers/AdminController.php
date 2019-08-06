<?php

namespace App\Http\Controllers;

use App\DuaList;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'OnlyAdmin']);
    }

    public function adminpanel(){
    	return view("admin.home");
    }

    public function checkcategory(){
    	return view("admin.content.category");
    }

    public function allcontent(){
    	return view("admin.content.content");
    }

    public function contentadd(){
    	return view("admin.content.add");
    }
    public function contentedit($id){
    	$content = DuaList::find($id);
    	return view("admin.content.edit", compact("content"));
    }
    public function contentdetails($id){
    	$content = DuaList::find($id);
    	return view("admin.content.details", compact("content"));
    }
    public function contentdelete($id){
    	$content = DuaList::find($id);
    	if($content){
    		DuaList::where("id", $id)->delete();
    	}
    	Session::flash("success", "Content Deleted Successfully");
    	return back();
    }

    public function createcontent(Request $get){

    	$this->validate($get,[
    		"title" => "required",
    		"category" => "required",
    		"description" => "required",
    	],[
    		"title.required" => "Enter Content Title",
    		"category.required" => "Select Category",
    		"description.required" => "Enter Content Descriptions",
    	]);

    	DuaList::insertGetId([
    		"title" => $get->title,
    		"details" => $get->description,
    		"status" => 1,
    		"token" => uniqid(),
    		"category" => $get->category,
    		"created_at" => Carbon::now(),
    	]);
		Session::flash("success", "Content Created Successfully");
    	return back();
    }

    public function updatecontent(Request $get){

    	$this->validate($get,[
    		"title" => "required",
    		"category" => "required",
    		"description" => "required",
    	],[
    		"title.required" => "Enter Content Title",
    		"category.required" => "Select Category",
    		"description.required" => "Enter Content Descriptions",
    	]);

    	DuaList::where("id", $get->id)->update([
    		"title" => $get->title,
    		"details" => $get->description,
    		"category" => $get->category,
    	]);
		Session::flash("success", "Content Updated Successfully");
    	return back();
    }

}
