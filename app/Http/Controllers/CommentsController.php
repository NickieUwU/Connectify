<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function addComment(Request $request)
    {
        $data = new \stdClass();
        $data->commentContent = $request->input('commentContent');
        $data->ID = $request->ID;
        $data->postID = $request->postID;
        if(empty($data->commentContent))
        {
            return redirect()->back();
        }
        DbHandlerController::query('INSERT INTO Comments (ID, Post_ID, CommentContent) VALUES (?, ?, ?)', $data->ID, $data->postID, $data->commentContent);
        return redirect()->back();
    }
}
