<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Configuration;
use App\Traits\Helpers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class CompatibilityController extends Controller
{
    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('adminhtml.tools.compatibility.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
    public function check(Request $request)
    {
        try {
            $token = self::altanGetToken()->accessToken;

            $configuration = Configuration::wherein('code', [
                'altan_device_info_endpoint',
                'altan_identificator'
            ])->get();

            $response = Http::withToken($token)->get($configuration[0]->value, [
                'identifierValue' => $request->imei,
                'identifierType' => $configuration[1]->value
            ]);

            $device = json_decode($response);

            //ddd($device->deviceFeatures->band28);

            return view('adminhtml.tools.compatibility.check', [
                'device' => $device
            ]);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function checkImei(Request $request)
    {

        try {
            $imei = $this->getCheckImei(auth()->user()->brand_id, $request->imei);
            return $imei;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    protected function altanGetToken()
    {
        $configuration = Configuration::wherein('code', [
            'altan_auth_endpoint',
            'altan_token'
        ])->get();

        $endpoint = $configuration[0]->value . '?grant-type=client_credentials';

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $configuration[1]->value,
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8'
        ])->post($endpoint);

        return json_decode($response);
    }
}
