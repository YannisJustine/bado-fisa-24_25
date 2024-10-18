<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class RatingController extends Controller
{
    public function index() {

        $data = $this->getUserComments();
        $comments = $data['comments'];
        $stats = [
            'totalRating' => $data['totalRating'],
            'totalComments' => $data['totalComments'],
            'ratings' => $data['ratings'],
            'averageRating' => $data['totalComments'] ? round($data['totalRating'] / $data['totalComments'], 1) : 0,
        ];
        return view('rating.index', compact('comments', 'stats'));
    }

    public function store(Request $request) {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $commentId = uniqid();
        $userId = Auth::id();

        $commentData = [
            'user_id' => $request->user()->id,
            'rating' => $request->input('rating'),
            'comment' => $request->comment,
            'created_at' => now()->translatedFormat('l j F Y'),
        ];

        Redis::hset("comments", $commentId, json_encode($commentData));

        Redis::rpush("user:$userId:comments", $commentId);

        return redirect()->back();
    }



    private function getUserComments() {
        $ratings = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];
        $totalRating = 0;
        $totalComments = 0;
        $comments = [];
  
        $commentIds = Redis::hgetall("comments");


        $comments = [];
    
        foreach ($commentIds as $comment) {
            $comment = json_decode($comment, true);
            $comment['user'] = User::find($comment['user_id']);
            $ratings[$comment['rating']] = ($ratings[$comment['rating']] ?? 0) + 1;
            $totalRating += $comment['rating'];
            $totalComments++;
            $comments[] = $comment;
        }

        $comments = collect($comments)->sortByDesc('created_at')->paginate(5);

        return [
            'comments' => $comments,
            'ratings' => $ratings,
            'totalRating' => $totalRating,
            'totalComments' => $totalComments,
        ];
    }
}
