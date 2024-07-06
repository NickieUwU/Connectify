<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function open($username)
    {
        session_start();
        $users = DbHandlerController::queryAll("SELECT * FROM Users WHERE Username=?", $username);
        if($users == null)
        {
            return redirect('/home');
        }
        foreach($users as $user)
        {
            $name = $user["Name"];
            $joinDate = $user["JoinDate"];
            $bio = $user["Bio"];
        }
        $action = "";
        if ($username == $_SESSION['username']) 
        {
            $action = "<a href='/editProfile/$username' class='btnedit btn btn-secondary mt-5 fs-6'>Edit Profile</a>";
        }
        else
        {
            $action = "<form action='/profile/$username' method='post'>
                            <button type='submit' class='btnedit btn btn-secondary mt-5 fs-6'>Follow</button>
                        </form> ";
        }
        
        return view('profile', [
            'username' => $username,
            'name' => $name,
            'bio' => $bio,
            'joinDate' => $joinDate,
            'action' => $action
        ]);
    }

    public function follow($username)
    {
        session_start();
        
    }
    public function openEdit($username)
    {
        session_start();
        $result = "";
        $users = DbHandlerController::queryAll("SELECT * FROM Users WHERE Username=?", $username);
        foreach($users as $user)
        {
            $name = $user["Name"];
            $bio = $user['Bio'];
        }
        if($username != $_SESSION['username']) return redirect('/editProfile/'.$_SESSION['username'])->with([
            'name' => $name,
            'username' => $username,
            'bio' => $bio,
            'result' => $result
        ]);
        else return view('editProfile')->with([
            'name' => $name,
            'username' => $username,
            'bio' => $bio,
            'result' => $result
        ]);
        
    }

    public function save(Request $request)
    {
        session_start();
        $name = $request->Name;
        $username = $request->Username;
        $bio = $request->Bio;
        DbHandlerController::query("UPDATE Users SET `Name` = ?, Username = ?, Bio = ? WHERE Username = ?", $name, $username, $bio, $_SESSION['username']);
        
        
        $result = "saves made successfully";
        return view('editProfile')->with([
            'name' => $name,
            'username' => $username,
            'bio' => $bio,
            'result' => $result
        ]);     
    }

}
