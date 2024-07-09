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
            $followers = $user["Followers"];
            $following = $user["Following"];
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
            'followers' => $followers,
            'following' => $following,
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
        $followers = 0;
        $following = 0;
        $follows = DbHandlerController::queryAll('SELECT * FROM IsFollowed WHERE Follower=? AND `Following`=?', $follower, $data->username);
        foreach($follows as $follow)
        {
            $isFollowed = $follow['isFollowed'];
        }
        $users1 = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username=?', $data->username);
        foreach($users1 as $user1)
        {
            $followers = $user1['Followers'];
        }
        $users2 = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username=?', $follower);
        foreach($users2 as $user2)
        {
            $following = $user2['Following'];
        }
        
        if($isFollowed == 0)
        {
            //adding a follow
            $isFollowed++;
            $followers++;
            $following++;
            DbHandlerController::query('INSERT INTO IsFollowed (Follower, `Following`, isFollowed) VALUES (?, ?, ?)', $follower, $data->username, $isFollowed);
            DbHandlerController::query('UPDATE Users SET Followers=? WHERE Username=?', $followers, $data->username);
            DbHandlerController::query('UPDATE Users SET `Following`=? WHERE Username=?', $following, $follower);
        }
        else
        {
            //removing a follow
            $isFollowed--;
            $followers--;
            $following--;
            DbHandlerController::query('DELETE FROM IsFollowed WHERE Follower=? AND `Following`=?', $follower, $data->username);
            DbHandlerController::query('UPDATE Users SET Followers=? WHERE Username=?', $followers, $data->username);
            DbHandlerController::query('UPDATE Users SET `Following`=? WHERE Username=?', $following, $follower);
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

    public function suspend(Request $request)
    {
        $data = new \stdClass();
        $data->reportID = $request->reportID;
        DbHandlerController::query('UPDATE Users SET Suspended=? WHERE ID=?', 1, $data->reportID);
        DbHandlerController::query('DELETE FROM Reports WHERE ID=?', $data->reportID);
        return redirect('/reports');
    } 
}