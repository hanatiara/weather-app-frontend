<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class WeatherController extends Controller
{
    private $apikey;
    private $url;
    private $location;
    private $backend_url;

    public function __construct()
    {
       $this->apikey = env('API_KEY');
       $this->url = env('API_URL');
       $this->location = env('LOCATION_URL');
       $this->backend_url = env('BACKEND_URL');
    }

    // Get semua list lokasi
    private function getAllLocation(){
        $file = File::get(base_path('city.list.json'));
        $data = json_decode($file);

        $kota = array();

        if($data) {
            foreach ($data as $d) {
                // dd($d->country);
                if ($d->country == "ID") {
                    array_push($kota,$d->name);
                }
            }

        }
        // dd($kota);

        return $kota;
    }

    // Menampilkan page
    public function show($location = "Malang")
    {
        // dd($this->getLocation());
        // dd($this->fetchData($this->getLocation($location)->lat,$this->getLocation($location)->lon));
        // dd(base_path('city.list.json'));
        // dd($this->getAllLocation());

        // return view('weather-index')->with([
        //     'key' => $this->apikey,
        //     'data' => $this->fetchData($this->getLocation($location)->lat,$this->getLocation($location)->lon),
        //     'location' => $this->getLocation("location"),
        // ]);

        return view('weather-index')->with([
            'title' => "Prediksi Cuaca",
            'data' => $this->getAllLocation(),
            'location' => $this->getLocation("location"),
        ]);
    }

    // Get lan dan lon dari input query Lokasi
    private function getLocation($location) {
        $response = Http::get($this->location, [
            'q' => $location,
            'limit' => '1',
            'appid' => $this->apikey
        ]);

        $result = json_decode($response->body())[0];

        return $result;

    }


    private function fetchData($lat, $lon){
        //lat = latitude
        //lon = longitude

        $response = Http::get($this->url, [
            'lat' => $lat,
            'lon' => $lon,
            'appid' => $this->apikey
        ]);

        $result = json_decode($response->body());

        return $result;

    }


    public function fetchDataFromBackend(Request $request) {
        // dd($request->bulan);
        // dd($this->backend_url);
        $data = [
            'city' => strtolower($request->kota),
            'month' => strtolower($request->bulan)
        ];
        $response = Http::GET($this->backend_url."/calculate", $data);

        $result = json_decode($response->body());

        // if ($result->message)

        // dd($result->message[0]->Clouds);
        $data = [
            'result' => $result->message[0]->Clouds,
            'title' => "Prediction Result"
        ];

        return view('/weather-result',$data);
    }
}
