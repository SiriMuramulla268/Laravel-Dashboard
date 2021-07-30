<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Members;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addUser(Request $request){
       
        $validator = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'company' => 'required|string',
            'mobile' => 'required|min:10'
        ]);

        if($validator){
            $data = $request->all();
            $insertMember = Members::insert(['name'=>$data['name'],'email'=>$data['email'],'company'=>$data['company'],'mobile'=>$data['mobile']]);
            if($insertMember){
                return redirect('admin/userform')->with('success', 'User Added Successful');
            }
        }
    }

    public function userList(){
        $getMembers = Members::get();
        if($getMembers){
            $data = json_decode($getMembers,true);
            return view('userlist',['memberdata'=>$data,'tabname'=>'userlist']);
        }
    }

}

?>