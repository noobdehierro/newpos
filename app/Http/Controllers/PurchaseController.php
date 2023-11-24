<?php

namespace App\Http\Controllers;

use App\Mail\ActivateSim;
use App\Mail\OrderPurchase;
use App\Mail\PortabilityRequest;
use App\Models\Balance;
use App\Models\Brand;
use App\Models\Configuration;
use App\Models\Events;
use App\Models\Movement;
use App\Models\Offering;
use App\Models\Order;
use App\Models\Portability;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{
    use Helpers;
    /**
     * Return a list of offerings to initiate the purchase process
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $account = auth()->user()->account;
        $iccid_prefix = Brand::where('id', auth()->user()->brand_id)->value('iccid_prefix');

        if ($account) {
            $order = Order::where([
                ['status', '=', 'Pending'],
                ['sales_type', '=', 'Contratación'],
                ['user_id', '=', auth()->user()->id]
            ])->first();

            return view('adminhtml.purchase.index', [
                'iccid_prefix' => $iccid_prefix,
                'order' => $order
            ]);
        } else {
            $order = [];

            return view('adminhtml.purchase.index', [
                'iccid_prefix' => $iccid_prefix,
                'order' => $order
            ])->with(
                'infoMsg',
                'Usted no tiene una cuenta activa para realizar movimientos.'
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Order $order)
    {

        $offering = $this->getOfferingsActive($order->brand_id, $order->iccid);
        $msisdn = $offering["msisdn"];
        $offeringsArray =  $offering["offerings"];

        return view('adminhtml.purchase.create', ['offerings' => $offeringsArray, 'order' => $order, 'msisdn' => $msisdn]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $attributes = $request->validate([
            'status' => 'required', // hidden
            'sales_type' => 'required', // hidden
            'user_id' => 'required', // hidden
            'user_name' => 'required', // hidden
            'brand_id' => 'required', // hidden
            'channel' => 'required', // hidden
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'birday' => 'nullable',
            'iccid' => 'nullable',
            'imei' => 'nullable',
            'street' => 'required',
            'outdoor' => 'required',
            'indoor' => 'nullable',
            'references' => 'required',
            'postcode' => 'required',
            'suburb' => 'required',
            'city' => 'required',
            'region' => 'required',
            'nip' => 'nullable',
            'msisdn' => 'nullable',
        ]);

        $iccidPrefix = Brand::where('id', $attributes['brand_id'])->value('iccid_prefix');

        if ($request->portabilidad === 'on') {
            $portability_attributes = $request->validate([
                'fullname' => 'nullable',
                'email' => 'nullable',
                'nip' => 'required|numeric',
                'msisdn' => 'required',
                'iccid' => 'nullable'
            ]);

            $portability_attributes['fullname'] =
                $request->name . ' ' . $request->lastname;
            $portability_attributes['email'] = $request->email;
            $portability_attributes['iccid'] = $iccidPrefix . $request->iccid;

            $portability_attributes['brand_id'] = auth()->user()->brand_id;
            $portability_attributes['user_id'] = auth()->user()->id;
        }

        try {
            if ($request->portabilidad === 'on') {
                $portability = Portability::create($portability_attributes);

                // self::portabilityNotification($portability);

                $attributes['portability_id'] = $portability->id;
            }
            $attributes['iccid'] = $iccidPrefix . $request->iccid;
            $attributes['brand_id'] = auth()->user()->brand_id;
            $attributes['user_id'] = auth()->user()->id;
            $order = Order::create($attributes);
            ddd($order);
            return redirect()->route('purchase.payment', $order->id);
        } catch (\Exception $exception) {
            ddd($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Cancel an order
     *
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Order $order)
    {
        try {
            $order->status = 'Canceled';
            $order->update();

            return redirect()
                ->route('purchase.index')
                ->with(
                    'success',
                    'Ha cancelado la orden exitosamente, ahora puede continuar con la creación de una nueva.'
                );
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the payment form for a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function payment(Order $order)
    {

        dd($order);

        $balance = Balance::where('brand_id', auth()->user()->primary_brand_id)
            ->latest()
            ->first();

        $conekta_public_key = self::getConektaPublicConfiguration();

        $token = $this->getToken();
        $conekta = [
            'token' => $token->checkout->id,
            'public_key' => $conekta_public_key
        ];

        return view('adminhtml.purchase.payment', [
            'order' => $order,
            'balance' => $balance,
            'conekta' => $conekta
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Confirm cash payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(Request $request, Order $order)
    {
        $request->validate([
            'payment_method' => 'required'
        ]);

        try {
            $lastBalance = Balance::where('brand_id', $order->brand_id)
                ->latest()
                ->first();
            $newBalance = new Balance();

            $order->payment_method = $request->payment_method;

            if ($order->payment_method == 'Efectivo') {
                $newBalance->brand_id = $order->brand_id;
                $newBalance->amount = -abs($order->total);
                $newBalance->balance =
                    $lastBalance->balance + $newBalance->amount;
                $newBalance->operation = 'Retiro';
                $newBalance->user_id = $request->user_id;
                $newBalance->user_name = $request->user_name;
                $newBalance->description = 'Contratación';
                $order->status = 'Complete';
            }

            $user = User::find($request->user_id);
            $currentUserAmount = $user->account->amount;
            $newUserAmount = $currentUserAmount + $order->total;
            $user->account->amount = $newUserAmount;

            $movement = new Movement();
            $movement->account_id = $user->account->id;
            $movement->amount = $order->total;
            $movement->description = 'Cobro de efectivo';
            $movement->operation = 'Contratación';

            $order->update();
            $newBalance->save();
            $movement->save();
            $user->account->update();
            self::activate_webhook($order);
            self::purchaseNotification($order);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('orders.index')
            ->with('success', 'Se realizo el pago con exito.');
    }

    /**
     * Conekta credit card payment intent, create a new Conekta order.
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function conektaOrder(Request $request, Order $order)
    {
        $conekta_private_key = self::getConektaConfiguration();

        $totalOriginal = $order->total;

        if ($request->card_payment_method == 'Tarjeta_vendedor') {
            $order->total = $order->seller_price;
            $payment_method = 'Tarjeta Vendedor';
        } else {
            $order->total = $totalOriginal;
            $payment_method = 'Tarjeta';
        }

        $conektaData = [
            'amount' => floatval($order->total) * 100,
            'currency' => 'MXN',
            'amount_refunded' => 0,
            'customer_info' => [
                'name' => $order->name,
                'email' => $order->email,
                'phone' => $order->telephone
            ],
            'shipping_contact' => [
                'receiver' => $order->name,
                'phone' => $order->telephone,
                'between_streets' => $order->references,
                'address' => [
                    'street1' =>
                    $order->street .
                        ' ' .
                        $order->outdor .
                        ' ' .
                        $order->indoor .
                        ' ' .
                        $order->suburb,
                    'city' => $order->city,
                    'state' => $order->region,
                    'country' => 'mx',
                    'object' => 'shipping_address',
                    'postal_code' => $order->postcode
                ]
            ],
            'metadata' => [
                'Integration' => 'API',
                'Integration_Type' => 'PHP 7.4'
            ],
            'line_items' => [
                [
                    'name' => 'Contratación Plan',
                    'unit_price' => floatval($order->total) * 100,
                    'quantity' => 1,
                    'description' => 'Plan ' . $order->brand_name,
                    'sku' => $order->qv_offering_id,
                    'brand' => $order->brand_name
                ]
            ],
            'charges' => [
                [
                    'payment_method' => [
                        'type' => 'card',
                        'token_id' => $request->token
                    ]
                ]
            ]
        ];

        try {
            $response = Http::withToken($conekta_private_key)
                ->withHeaders([
                    'Accept' => 'application/vnd.conekta-v2.0.0+json',
                    'Content-Type' => 'application/json'
                ])
                ->withBody(json_encode($conektaData), 'json')
                ->post('https://api.conekta.io/orders');

            $conektaOrder = json_decode($response);

            if (
                isset($conektaOrder->object) &&
                $conektaOrder->object === 'error'
            ) {
                return back()->with(
                    'error',
                    $conektaOrder->details[0]->message
                );
            } else {
                if (isset($conektaOrder->id)) {
                    $order->payment_method = $payment_method;
                    $order->payment_id = $conektaOrder->id;
                    $order->status = 'Complete';

                    $user = auth()->user();

                    $order->update();
                    $user->update();

                    self::purchaseNotification($order);
                    self::activate_webhook($order);


                    return redirect()
                        ->route('orders.index')
                        ->with('success', 'Se realizo el pago con exito.');
                }
            }
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Get Conekta token
     *
     * @return mixed|void
     */
    public function getToken()
    {
        $conekta_private_key = self::getConektaConfiguration();

        try {
            $data = [
                'checkout' => [
                    'returns_control_on' => 'Token'
                ]
            ];

            $response = Http::withToken($conekta_private_key)
                ->withHeaders([
                    'Accept' => 'application/vnd.conekta-v2.0.0+json',
                    'Content-Type' => 'application/json'
                ])
                ->withBody(json_encode($data), 'json')
                ->post('https://api.conekta.io/tokens');

            return json_decode($response->body());
        } catch (\Exception $exception) {
        }
    }

    /**
     * Notification for a new order
     *
     * @param Order $order
     * @return void
     */
    private function purchaseNotification(Order $order)
    {
        $configuration = Configuration::wherein('code', [
            'notifications_email'
        ])->get();

        $to = $configuration[0]->value;

        Mail::to($to)->send(new OrderPurchase($order));
    }

    /**
     * Notification for a new portability request
     *
     * @param Portability $portability
     * @return void
     */
    private function portabilityNotification(Portability $portability)
    {
        $configuration = Configuration::wherein('code', [
            'notifications_email'
        ])->get();

        $to = $configuration[0]->value;

        Mail::to($to)->send(new PortabilityRequest($portability));
    }

    /**
     * Returns the Conekta private key according to the sandbox configuration
     *
     * @return mixed
     */
    private function getConektaConfiguration()
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'conekta_private_api_key_sandbox',
            'conekta_private_api_key'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'conekta_private_api_key_sandbox') {
                $conekta_private_api_key_sandbox = $config->value;
            }
            if ($config->code == 'conekta_private_api_key') {
                $conekta_private_api_key = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $conekta_private_key = $conekta_private_api_key_sandbox;
        } else {
            $conekta_private_key = $conekta_private_api_key;
        }

        return $conekta_private_key;
    }

    /**
     * Returns the Conekta public key according to the sandbox configuration
     *
     * @return mixed
     */
    private function getConektaPublicConfiguration()
    {
        $configuration = Configuration::wherein('code', [
            'is_sandbox',
            'conekta_public_api_key_sandbox',
            'conekta_public_api_key'
        ])->get();

        foreach ($configuration as $config) {
            if ($config->code == 'is_sandbox') {
                $is_sandbox = $config->value;
            }
            if ($config->code == 'conekta_public_api_key_sandbox') {
                $conekta_public_api_key_sandbox = $config->value;
            }
            if ($config->code == 'conekta_public_api_key') {
                $conekta_public_api_key = $config->value;
            }
        }

        if ($is_sandbox === 'true') {
            $conekta_public_key = $conekta_public_api_key_sandbox;
        } else {
            $conekta_public_key = $conekta_public_api_key;
        }

        return $conekta_public_key;
    }

    public function activate_webhook(Order $order)
    {




        $configuration = Configuration::wherein('code', [
            'qvantel_webhook_sim_endpoint',
            'qvantel_webhook_sim_api_key',
        ])->get();

        foreach ($configuration as $config) {

            if ($config->code == 'qvantel_webhook_sim_endpoint') {
                $qvantel_webhook_sim_endpoint = $config->value;
            }
            if ($config->code == 'qvantel_webhook_sim_api_key') {
                $qvantel_webhook_sim_api_key = $config->value;
            }
        }

        $endpoint = $qvantel_webhook_sim_endpoint;

        $api_key = $qvantel_webhook_sim_api_key;


        $apiURL = $endpoint;




        // POST Data
        $postInput = [
            "basket" => [
                "salesPersonId" => $order->user_name,
                "paymentMethod" => [
                    "paymentMethodId" => "openpay",
                    "paymentMethodType" => "openpay-external-payment",
                    "params" => []
                ],
                "basketItems" => [[
                    "quantity" => 1,
                    "characteristics" => [[
                        "value" => "Activation",
                        "key" => "CH_ServiceActivationType"
                    ]],
                    "productId" => $order->qv_offering_id ?? '',
                    "CH_NumberResource" => $order->telephone,
                    "CH_ICC" => $order->iccid,
                    "useICC" => true
                ]]
            ],
            "customer" => [
                "individual" => [
                    "nationality" => "MX",
                    "gender" => "male",
                    "familyName" => $order->lastname,
                    "givenName" => $order->name,
                ],
                "contactMedia" => [[
                    "role" => "primary",
                    "validFor" => [
                        "startDatetime" => "2018-04-12T10:07:51.276Z",
                        "endDatetime" => "2032-04-12T10:07:51.276Z"
                    ],
                    "medium" => [
                        "telephoneNumber" => [
                            "number" => "string",
                            "numberType" => "fixed-line"
                        ],
                        "emailAddress" => [
                            "email" => $order->email,
                        ],
                        "postalAddress" => [
                            "city" => $order->city,
                            "coAddress" => $order->references,
                            "apartment" => $order->indoor,
                            "country" => "MX",
                            "building" => $order->outdoor,
                            "postalCode" => $order->postcode,
                            "street" => $order->street,
                            "stateOrProvince" => $order->region,
                            "county" => $order->suburb,
                        ]
                    ]
                ]],
                "identifications" => [[
                    "expirationDate" => "2024-11-25",
                    "identificationId" => "12345678901",
                    "issuingAuthority" => [
                        "city" => $order->city,
                        "name" => $order->name,
                        "country" => "MX",
                        "county" => $order->suburb,
                        "stateOrProvince" => $order->region,
                    ],
                    "issuingDate" => "2018-04-12T10:07:51.276Z",
                    "identificationType" => "personal-identity-code",
                    "validFor" => [
                        "startDatetime" => "2018-04-12T10:07:51.276Z",
                        "endDatetime" => "2032-04-12T10:07:51.276Z"
                    ]
                ]]
            ]
        ];


        // Headers
        $headers = [
            'Content-Type' => 'application/json',
            'x-channel' => 'dealers',
            'Authorization' => $api_key,


        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);

        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);


        Events::create([
            'operacion' => 'Activacion de SIM',
            'order_id' => $order->id,
            'client_name' => $order->name . ' ' . $order->lastname,
            'api_key' => $api_key,
            'api_endpoint' => $endpoint,
            'request' => json_encode($postInput),
            'code' => $statusCode,
            'response' => json_encode($responseBody),
        ]);


        if ($responseBody['status'] == 'error') {
            $configuration = Configuration::wherein('code', [
                'notifications_email'
            ])->get();

            $to = $configuration[0]->value;

            Mail::to($to)->send(new ActivateSim($order, $responseBody['status']));
        } else {
            $configuration = Configuration::wherein('code', [
                'notifications_email'
            ])->get();

            $to = $configuration[0]->value;

            Mail::to($to)->send(new ActivateSim($order, $responseBody['status']));
        }
    }
}
