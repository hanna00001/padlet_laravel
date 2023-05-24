<?php

namespace App\Http\Controllers;

use App\Models\Padlet;
use Dotenv\Parser\Entry;
use Faker\Core\Number;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Entrie;
use App\Models\Userright;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PadletController extends Controller
{
    // Funktionen mit Postman testen

    public function index():JsonResponse{
        $padlet = Padlet::with(['user','entries', 'userrights'])->get();
        return response()->json($padlet, 200);
    }

    public function findById (string $id) : JsonResponse {
        $padlet = Padlet::where('id', $id)
            -> with(['user','entries', 'userrights'])->first();
        return $padlet != null ? response()->json($padlet, 200) : response()->json(null, 200);
    }

    public function checkId (string $id) : JsonResponse {
        $padlet = Padlet::where('id', $id)->first();
        return $padlet != null ? response()->json(true, 200) : response()->json(false, 200);
    }


    public function findBySearchTerm (string $searchTerm) : JsonResponse {
        $padlets = Padlet::with(['user','entries', 'userrights'])
            ->where('name', 'LIKE' , '%' . $searchTerm . '%')
            ->orWhereHas('user', function($query) use ($searchTerm){
                $query->where('firstName', 'LIKE','%' . $searchTerm . '%' )
                    ->orWhere('lastName', 'LIKE','%' . $searchTerm . '%' );
            })->get();
        return response()->json($padlets, 200);
    }

    public function save(Request $request) : JsonResponse {
        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            $padlet = Padlet::create($request->all());

            DB::commit();
            return response()->json($padlet,200);

        }
        catch(\Exception $e) {
            DB::rollBack();
            return response()->json("saving padlet failed: " . $e->getMessage(),420);
        }

    }
    private function parseRequest(Request $request) : Request {
        //convert date
        $date = new \DateTime($request->created_at);
        $request['published'] = $date;
        return $request;
    }

    public function update(Request $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $padlet = Padlet::with(['user', 'entries', 'userrights'])
                ->where('id', $id)->first();
            if ($padlet != null) {
                $request = $this->parseRequest($request);
                $padlet->update($request->all());

                $padlet->userrights()->delete();

                //Update Userrights
                if (isset($request['userrights']) && is_array($request['userrights'])) {
                    foreach ($request['userrights'] as $userrights) {

                        $userrights = Userright::firstOrNew(
                            ['padlet_id' => $userrights['padlet_id'],
                                'user_id' => $userrights['user_id'],
                                'read'=>$userrights['read'],
                                'edit'=>$userrights['edit']]);
                        $padlet->userrights()->save($userrights);
                    }
                }

                $padlet->save();
            }
            DB::commit();
            $padlet1 = Padlet::with(['user', 'entries', 'userrights'])
                ->where('id', $id)->first(); // return a vaild http response
            return response()->json($padlet1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating padlet failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(string $id) : JsonResponse {
        $padlet = Padlet::where('id', $id)->first();
        if ($padlet != null) {
            $padlet->delete();
            return response()->json('padlet (' . $id . ') successfully deleted', 200);
        }
        else
            return response()->json('padlet could not be deleted - it does not exist', 422);
    }


}
