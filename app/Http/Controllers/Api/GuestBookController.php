<?php

namespace App\Http\Controllers\Api;

use App\Enums\DiskEnum;
use App\Http\Controllers\Controller;
use App\Models\GuestBook;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $guestBook = GuestBook::get();
        return response()->json($guestBook);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'no_barcode' => 'required|string|unique:guest_books,no_barcode',
            'description' => 'nullable|string',
            'photo' =>  'nullable|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'no_barcode' => $request->no_barcode,
            'description' => $request->description
        ];

        if ($request->has('photo')) {
            $path = $request->file('photo')
                ->store(config('constants.storage_path.guest_photo'),
                    DiskEnum::PUBLIC);

            $data['type'] = $request->file('photo')->getClientOriginalExtension();
            $data['mime_type'] = $request->file('photo')->getMimeType();
            $data['disk'] = DiskEnum::PUBLIC;
            $data ['photo'] = $path;
        }

        $guestBook = GuestBook::create($data);
        return response()->json($guestBook);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request)
    {
        $guestBook = GuestBook::where('id','=',$request->id)->first();

        if (blank($guestBook)){
            return response()->json(['message' => 'Data not found'], 422);
        }else{
            return response()->json($guestBook);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {

    }
}
