<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function open($username)
    {
        session_start();
        $users = DbHandlerController::queryAll("SELECT * FROM Users WHERE Username=?", $username);
        $isFollowed = 0;
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
        $follows = DbHandlerController::query('SELECT isFollowed FROM IsFollowed WHERE Follower=? AND `Following`=?', $_SESSION['username'], $username);
        foreach($follows as $follow)
        {
            $isFollowed = $follow["isFollowed"];
        }
        $action = "";
        $text = "Follow";
        $class = "btn btn-secondary mt-5 fs-6";
        if($isFollowed == 1)
        {
            $text = "Following";
            $class = "btn btn-outline-danger mt-5 fs-6";
        }
        if ($username == $_SESSION['username']) 
        {
            $action = "<a href='/editProfile/$username' class='btnedit btn btn-secondary mt-5 fs-6'>Edit Profile</a>";
        }
        else
        {
            $action = "<form action='/ajaxfollow' method='post' id='addFollow'>
                            <input type='hidden' name='username' value='$username'>
                            <button type='submit' id='btnFollow' class='$class'>$text</button>
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

    public function follow(Request $request)
    {
        session_start();
        $data = new \stdClass();
        $data->username = $request->username; //the dude who is receiving a follow
        $follower = $_SESSION['username']; //the dude that clicks the follow button
        $isFollowed = 0;
        $users = DbHandlerController::queryAll('SELECT * FROM IsFollowed WHERE Follower=? AND `Following`=?', $follower, $data->username);
        foreach($users as $user)
        {
            $isFollowed = $user['isFollowed'];
        }
        if($isFollowed == 0)
        {
            //adding a follow
            $isFollowed++;
            DbHandlerController::query('INSERT INTO IsFollowed (Follower, `Following`, isFollowed) VALUES (?, ?, ?)', $follower, $data->username, $isFollowed);
        }
        else
        {
            //removing a follow
            $isFollowed--;
            DbHandlerController::query('DELETE FROM IsFollowed WHERE Follower=? AND `Following`=?', $follower, $data->username);
        }
        return response()->json(['Username' => $data->username]);
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
        if(!empty($name))
        {
            DbHandlerController::query("UPDATE Users SET `Name` = ? WHERE Username = ?", $name, $_SESSION['username']);
        }
        if(!empty($username))
        {
            DbHandlerController::query("UPDATE Users SET Username = ? WHERE Username = ?", $username, $_SESSION['username']);
            $_SESSION['username'] = $username;
        }
        if(!empty($bio))
        {
            DbHandlerController::query("UPDATE Users SET Bio = ? WHERE Username = ?", $bio, $_SESSION['username']);
        }
        
        
        $result = "saves made successfully";
        return view('editProfile')->with([
            'name' => $name,
            'username' => $username,
            'bio' => $bio,
            'result' => $result
        ]);     
    }

}
