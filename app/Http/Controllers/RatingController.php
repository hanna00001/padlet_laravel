<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function findByEntryID(string $padlet_id, string $entry_id):JsonResponse{
        $rating = Rating::where('entrie_id', $entry_id)
            ->with(['user', 'entrie'])->get();
        return $rating != null ? response()->json($rating, 200) : response()->json(null, 200);
    }

    public function save(Request $request, string $padletID, string $entrieID): JsonResponse
    {
        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            if(isset($request['user_id']) &&isset($request['rating']))
            {
                $rating = Rating::create(
                    [
                        'user_id'=>$request['user_id'],
                        'rating'=>$request['rating'],
                        'entrie_id'=> $entrieID
                    ]
                );
            }
            DB::commit();
            // return a vaild http response
            return response()->json($rating, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("saving rating failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request) : Request {
        //convert date
        $date = new \DateTime($request->create_at);
        $request['create_at'] = $date;
        return $request;
    }
}
