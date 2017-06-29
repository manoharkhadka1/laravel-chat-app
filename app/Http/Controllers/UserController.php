<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use \Response;

class UserController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function register(Request $request) {
        if ($request->file('image') !== null) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            // image with path
            $imagePath = url('uploads/user/'.$imageName);
            //Move Uploaded File
            $destinationPath = 'uploads/user';
            if($file->move($destinationPath,$imageName)) {
                $request['image_path'] = $imagePath;
            }
        }

        if(User::create($request->all())) {
            $status = 1;
             return redirect(route('home'));
        } else {
            $status = 0; // error
        }        
    }
}
