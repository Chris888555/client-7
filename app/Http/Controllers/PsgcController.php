<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PsgcController extends Controller
{
    public function index()
    {
        $regions = Http::get('https://psgc.gitlab.io/api/regions.json')->json();
        return view('address-form', compact('regions'));
    }

    // Will return provinces for most regions, or districts for NCR (Region 13)
   public function getProvinces($regionCode)
{
    // Make sure the region code is a string of numbers (e.g., '130000000' for NCR)
    if ($regionCode === '130000000') {
        // NCR uses districts instead of provinces
        $districts = Http::get("https://psgc.gitlab.io/api/regions/{$regionCode}/districts.json")->json();
        return response()->json($districts);
    }

    // For other regions, fetch provinces
    $provinces = Http::get("https://psgc.gitlab.io/api/regions/{$regionCode}/provinces.json")->json();
    return response()->json($provinces);
}


    // Will return cities from province or district code
    public function getCities($code)
    {
        // Common NCR district codes (you may expand this list if needed)
        $ncrDistrictCodes = ['133900000', '137400000', '137500000', '137600000'];

        if (in_array($code, $ncrDistrictCodes)) {
            $cities = Http::get("https://psgc.gitlab.io/api/districts/{$code}/cities-municipalities.json")->json();
        } else {
            $cities = Http::get("https://psgc.gitlab.io/api/provinces/{$code}/cities-municipalities.json")->json();
        }

        return response()->json($cities);
    }

    // Return barangays for given city
    public function getBarangays($cityCode)
    {
        $barangays = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/barangays.json")->json();
        return response()->json($barangays);
    }
}
