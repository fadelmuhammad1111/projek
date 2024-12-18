<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    public function getProvinces()
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        return response()->json($response->json());
    }

    public function getRegencies($provinceId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinceId}.json");
        return response()->json($response->json());
    }

    public function getDistricts($regencyId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$regencyId}.json");
        return response()->json($response->json());
    }

    public function getVillages($districtId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$districtId}.json");
        return response()->json($response->json());
    }

}
