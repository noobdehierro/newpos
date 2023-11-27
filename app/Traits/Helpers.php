<?php

namespace App\Traits;

use App\Models\Brand;
use App\Models\Configuration;
use App\Models\Order;
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

        $offers = Http::withHeaders($headers)->get($url_recharge, $body)->json();


        $email = $offers["data"]["email"] ?? null;
        // dd($offers);

        $offerings = [];
        if (!empty($offers["data"]["offerings"])) {
            foreach ($offers["data"]["offerings"] as $offer) {
                array_push($offerings, $this->fill_offering_data($offer, 'recarga'));
            }
        }
        // dd($offerings);


        return ["offerings" => $offerings, "email" => $email];
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

        $offers = Http::withHeaders($headers)->get($url_activation, $body)->json();
        $msisdn = $offers["data"]["msisdn"] ?? null;
        // dd($offers);

        $offerings = [];
        if (!empty($offers["data"]["offerings"])) {
            foreach ($offers["data"]["offerings"] as $offer) {
                array_push($offerings, $this->fill_offering_data($offer, 'active'));
            }
        }
        // dd($offerings);


        return ["offerings" => $offerings, "msisdn" => $msisdn];
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

    public function fill_offering_data($offering, $type)
    {


        $id = null;

        if ($type == 'recarga') {
            $id = $offering["supplementary_id"];
        } else if ($type == 'active') {
            $id = $offering["offering_id"];
        } else if ($type == 'contrata') {
            $id = $offering["bundle_id"];
        } else if ($type == 'esim') {
            $id = $offering["offering_id"];
        }

        $productId = $id;
        $specialPrice = $offering["price"] ?? $offering["total_price"];
        $price = $specialPrice . ' ' . 'MXN';
        $origDescription = $offering["description"];
        $descLines = preg_split("/\r\n|\r|\n/", $origDescription);
        $description = '<ul>';
        $internalName = $offering["name"] ?? '';

        foreach ($descLines as $descLine) {
            $description .= '<li>' . $descLine . '</li>';
        }

        $description .= '</ul>';

        return [
            'offering_id' => $productId,
            'display_name' => $offering["display_name"] ?? $offering["offering_name"],
            'price' => $price,
            'specialPrice' => $specialPrice,
            'description' => $description,
            'internalName' => $internalName
        ];
    }
    public function postOfferingsActive(Order $order)
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
            $url = $url_activation_bip_sandbox;
        } else {
            $url = $url_activation_bip;
        }

        $token = $this->getTokenBip(Brand::find($order->brand_id));

        $body = [
            "user" => [
                "name" => $order->name,
                "last_name" => $order->lastname,
                "middle_name" => "",
                "phone" => $order->telephone,
                "email" => $order->email
            ],
            "address" => [
                "street" => $order->street,
                "external_number" => $order->outdoor,
                "internal_number" => $order->indoor,
                "city" => $order->city,
                "neighborhood" => $order->suburb,
                "state" => $order->region,
                "postal_code" => $order->postcode,
                "shipping_reference" => ""
            ],
            "service" => [
                "msisdn" => $order->msisdn,
                "offering_id" => $order->msisdn
            ],
            "payment" => [
                "amount" => $order->total,
                "payment_method" => $order->payment_method,
                "payment_method_name" => "POS-Conekta-" . $order->payment_method . "-" . $order->reference_id,
                "concept" => "Pago Activación de Sim",
            ]
        ];

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ];

        $response = Http::withHeaders($headers)->post($url, $body)->json();

        return $response;
    }
}
