<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function findByEntrieID(string $padlet_id, string $entry_id):JsonResponse{
        $comment = Comment::where('entrie_id', $entry_id)
            ->with(['user', 'entrie'])->get();
        return $comment != null ? response()->json($comment, 200) : response()->json(null, 200);
    }

    public function save(Request $request, string $padlet_id, string $entrieID): JsonResponse
    {
        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            if(isset($request['user_id']) && isset($request['comment']))
            {
                $comment = Comment::create(
                    [
                        'comment'=>$request['comment'],
                        'user_id'=>$request['user_id'],
                        'entrie_id'=> $entrieID
                    ]
                );
            }
            DB::commit();
            // return a vaild http response
            return response()->json($comment, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("saving comment failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request) : Request {
        //convert date
        $date = new \DateTime($request->create_at);
        $request['create_at'] = $date;
        return $request;
    }
}
