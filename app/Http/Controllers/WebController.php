<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tbl_accdelete_requests;
use App\User_lists;

use DB;
use Hash;
use Auth;
use Response;
use Redirect;
class WebController extends Controller
{
    public function index()
    {
        return view('web.accrequests');
    }
    public function delete_request(Request $request)
    {
        if(!User_lists::where('phnum',$request->phone_number)->exists())
        {
            return Redirect::back()->with('message','Invalid Mobile Number');
        }
        $acc_delete_req=new Tbl_accdelete_requests;
        $acc_delete_req->phone_number=$request->phone_number;
        $acc_delete_req->save();
        return Redirect::back()->with('message','We will veirfy your details and delete your account details');
    }
}