<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Members;

class UserController extends Controller
{
    public function addUser(Request $request){
       $data = $request->all();
       $insertMember = Members::insert(['name'=>$data['name'],'email'=>$data['email'],'company'=>$data['company'],'mobile'=>$data['mobile']]);
       if($insertMember){
        return redirect('userform');
       }else{
           return 0;
       }
    }

    public function userList(){
        $getMembers = Members::get();
        if($getMembers){
            $data = json_decode($getMembers,true);
            return view('userlist',['memberdata'=>$data]);
        }
    }

}

?>