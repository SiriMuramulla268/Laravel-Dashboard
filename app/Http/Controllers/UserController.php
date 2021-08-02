<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addUser(Request $request){
        $validator = $request->validate([
            'name' => 'required|unique:users|regex:/^([^0-9]*)$/',
            'email' => 'required|string|unique:users|email',
            'company' => 'required|string',
            'mobile' => 'required|min:10'
        ]);

        if($validator){
            $data = $request->all();
            $insertUser = User::insert(['name'=>$data['name'],'email'=>$data['email'],'company'=>$data['company'],'mobile'=>(int)$data['mobile'],'password'=>Hash::make($data['password'])]);
            if($insertUser){
                return redirect('admin/userform')->with('status', 'User Added Successfully');
            }else{
                return redirect('admin/userform')->with('status', 'Failed');
            }
        }
    }

    public function userList(){
        $getMembers = User::paginate(2);
        if($getMembers){
            return view('admin/userlist',['memberdata'=>$getMembers,'tabname'=>'userlist']);
        }
    }

}

?>