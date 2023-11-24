<?php

namespace App\Traits;

use App\Models\Brand;
use App\Models\Configuration;
use Illuminate\Support\Facades\Http;

trait Helpers
{
    public function getTokenBip(Brand $brand)
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'url_token_bip_sandbox',
            'url_token_bip'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'url_token_bip_sandbox') {
                $url_token_bip_sandbox = $config->value;
            }
            if ($config->code == 'url_token_bip') {
                $url_token_bip = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $url_token_bip = $url_token_bip_sandbox;
        } else {
            $url_token_bip = $url_token_bip;
        }

        $body = [
            "client_token" => $brand->token
        ];

        $headers = [
            "Accept" => "application/json"
        ];

        $response = Http::withHeaders($headers)->get($url_token_bip, $body)->json();

        $access_token = $response['data']['access_token'];

        return $access_token;
    }

    public function getOfferingsPurchase(int $brand)
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'url_offering_bip_sandbox',
            'url_offering_bip'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'url_offering_bip_sandbox') {
                $url_offering_bip_sandbox = $config->value;
            }
            if ($config->code == 'url_offering_bip') {
                $url_offering_bip = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $url_offering = $url_offering_bip_sandbox;
        } else {
            $url_offering = $url_offering_bip;
        }

        $token = $this->getTokenBip(Brand::find($brand));

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ];

        $response = Http::withHeaders($headers)->get($url_offering)->json();

        return $response;
    }

    public function getOfferingsRecharge(int $brand, int $msisdn)
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'url_recharge_bip_sandbox',
            'url_recharge_bip'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'url_recharge_bip_sandbox') {
                $url_recharge_bip_sandbox = $config->value;
            }
            if ($config->code == 'url_recharge_bip') {
                $url_recharge_bip = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $url_recharge = $url_recharge_bip_sandbox;
        } else {
            $url_recharge = $url_recharge_bip;
        }

        $token = $this->getTokenBip(Brand::find($brand));

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ];

        $body = [
            "msisdn" => $msisdn
        ];

        $response = Http::withHeaders($headers)->get($url_recharge, $body)->json();


        return $response;
    }

    public function getOfferingsActive(int $brand, int $iccid)
    {

        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'url_activation_bip_sandbox',
            'url_activation_bip'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'url_activation_bip_sandbox') {
                $url_activation_bip_sandbox = $config->value;
            }
            if ($config->code == 'url_activation_bip') {
                $url_activation_bip = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $url_activation = $url_activation_bip_sandbox;
        } else {
            $url_activation = $url_activation_bip;
        }

        $token = $this->getTokenBip(Brand::find($brand));

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ];

        $body = [
            "iccid" => $iccid
        ];

        $response = Http::withHeaders($headers)->get($url_activation, $body)->json();

        return $response;
    }

    public function getCheckImei(int $brand, int $imei)
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'url_imei_bip_sandbox',
            'url_imei_bip'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'url_imei_bip_sandbox') {
                $url_imei_bip_sandbox = $config->value;
            }
            if ($config->code == 'url_imei_bip') {
                $url_imei_bip = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $url_imei = $url_imei_bip_sandbox;
        } else {
            $url_imei = $url_imei_bip;
        }

        $token = $this->getTokenBip(Brand::find($brand));

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ];

        $body = [
            "imei" => $imei
        ];

        $response = Http::withHeaders($headers)->get($url_imei, $body)->json();

        return $response;
    }

    public function getCheckPostalCode(int $brand, int $postal_code)
    {
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
            $url_postal_code = $url_postal_code_bip_sandbox;
        } else {
            $url_postal_code = $url_postal_code_bip;
        }

        $token = $this->getTokenBip(Brand::find($brand));

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ];

        $body = [
            "postal_code" => $postal_code
        ];

        $response = Http::withHeaders($headers)->get($url_postal_code, $body)->json();

        return $response;
    }
}
