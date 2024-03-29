<?php

namespace App\Http\Controllers\Api;

use App\Enums\DiskEnum;
use App\Http\Controllers\Controller;
use App\Models\GuestBook;
use App\Services\Helpers\DownloadService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function homeContent(Request $request)
    {
        $request->validate([
            "client_id" => 'required|string',
            "client_secret" => 'required|string',
        ]);
        
        $baseUri = env('APP_URL');
        $oauth = Http::asForm()->withBasicAuth( $request->client_id, $request->client_secret)
            ->post($baseUri . '/oauth/token', [
            'grant_type' => 'client_credentials',
        ])->json();

        if(blank($oauth) || blank( $oauth['access_token'] ?? null)){
            return response()->json(['message'=> "Authentication errror!"], 422);
        }



        return response()->json([
            'title' =>  'Welcome to',
            'title_additional' => 'Our Wedding',
            'title_text' => 'Wahyu & Ema',
            'scan_description' =>'to enter our Wedding Ceremony',
            'asset' => [
                'cover' => asset('img/background/front.jpg'),
                'default' => asset('img/background/default.jpg')
            ],
            'access_token' => $oauth['access_token']
        ]);

    }

    public function updateGuest(Request $request){
        $request->validate([
            'no_barcode' => 'required|string',
            'scan' => 'nullable|numeric|min:1|max:1',
            'photo' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $guestBook = GuestBook::where('no_barcode','=',$request->no_barcode)->first();

        if (blank($guestBook)){
            return response()->json(['message' => 'Data not found'], 422);
        }

        if (!blank($guestBook->scan_at)){
            return response()->json(['message' => 'Barcode has been use']);
        }

        $payload = [];

        if ($request->has('photo')){
            $path = $request->file('photo')
                ->store(config('constants.storage_path.guest_photo'),
                    DiskEnum::PUBLIC);
            $payload = [
                'type' => $request->file('photo')->getClientOriginalExtension(),
                'mime_type' => $request->file('photo')->getMimeType(),
                'disk' => DiskEnum::PUBLIC,
                'photo' => $path,
            ];
        }


        if ($request->has('scan') && $request->scan == 1 ){
            $payload['scan_at'] = now();
        }

        $guestBook->update($payload);

        return response()->json($guestBook);
    }

    public function generatePdf(Request $request)
    {
        if ($request->download == 'pdf') {
            $responseData = '';
            $start = '';
            $until = '';
            $pdfLink = (new DownloadService())
                ->handle($request, $responseData, $start, $until, 'income');
            return response()->json($pdfLink);
        }
    }
}
