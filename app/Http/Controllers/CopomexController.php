<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Configuration;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CopomexController extends Controller
{

    use Helpers;
    public function create()
    {

        $postcode = request('postcode');
        $postcode = trim($postcode);

        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'url_postal_code_bip_sandbox',
            'url_postal_code_bip'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'url_postal_code_bip_sandbox') {
                $url_postal_code_bip_sandbox = $config->value;
            }
            if ($config->code == 'url_postal_code_bip') {
                $url_postal_code_bip = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $url_postal_code_bip = $url_postal_code_bip_sandbox;
        } else {
            $url_postal_code_bip = $url_postal_code_bip;
        }

        $body = [
            "postal_code" => $postcode
        ];

        $brand = auth()->user()->brand_id;

        $token = $this->getTokenBip(Brand::find($brand));

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ];

        $response = Http::withHeaders($headers)->get($url_postal_code_bip, $body)->json();

        return $response;
    }
}
