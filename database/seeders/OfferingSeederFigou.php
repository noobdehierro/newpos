<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferingSeederFigou extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

        $offerings = [
            [
                'qv_offering_id' =>
                    'PO_SAY-RM-ST_125_125Mi_1500_500M_50_75SMS_2000T_3D_NR',
                'name' => '2GB/3 días',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>2GB de 5G-4G LTE</li><li>2GB extra en velocidad reducida</li><li>Vigencia: 3 días</li></ul>',
                'promotion' => '',
                'price' => 50,
                'seller_price' => 50,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_ST_250_250Mi_3750_1250M_125_125SMS_5000T_7D_NR',
                'name' => '5GB/7 días',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>5GB extra en velocidad reducida</li><li>Vigencia: 7 días</li></ul>',
                'promotion' => '',
                'price' => 70,
                'seller_price' => 70,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_ST_500_500Mi_7500_2500M_250_250SMS_10000T_15D_NR',
                'name' => '10GB/15 días',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>10GB de 5G-4G LTE</li><li>10GB extra en velocidad reducida</li><li>Vigencia: 15 días</li></ul>',
                'promotion' => '',
                'price' => 120,
                'seller_price' => 120,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_750_750Mi_5000M_250_250SMS_30D_NR',
                'name' => '5GB/ 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>Internet para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 140,
                'seller_price' => 140,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_750_750Mi_3000_5000M_250_250SMS_30D_NR',
                'name' => '8GB/ 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>Internet para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 180,
                'seller_price' => 180,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR',
                'name' => '20GB/ 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 240,
                'seller_price' => 240,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_30D_NR',
                'name' => '20GB/ 1 mes PLUS',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Internet para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 340,
                'seller_price' => 340,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_NR',
                'name' => '50GB/ 1 mes',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>50GB de 5G-4G LTE</li><li>50GB extra en velocidad reducida</li><li>Internet para compartir</li><li>Vigencia: 30 días</li></ul>',
                'promotion' => '',
                'price' => 450,
                'seller_price' => 450,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_3M_R',
                'name' => '20GB/3 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 90 días</li></ul>',
                'promotion' => '',
                'price' => 599,
                'seller_price' => 599,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_3M_R',
                'name' => '20GB/3 meses PLUS',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Internet para compartir</li><li>Vigencia: 90 días</li></ul>',
                'promotion' => '',
                'price' => 799,
                'seller_price' => 799,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_750_750Mi_5000_250_250SMS_6M_R',
                'name' => '5GB/6 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>Internet para compartir</li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 600,
                'seller_price' => 600,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R',
                'name' => '20GB/6 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 1000,
                'seller_price' => 1000,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_6M_R',
                'name' => '20GB/6 meses PLUS',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li>Internet para compartir<li></li><li>Vigencia: 180 días</li></ul>',
                'promotion' => '',
                'price' => 1400,
                'seller_price' => 1400,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_750_750Mi_5000_250_250SMS_12M_R',
                'name' => '5GB/12 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>5GB de 5G-4G LTE</li><li>5GB extra en velocidad reducida</li><li>Internet para compartir</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 1100,
                'seller_price' => 1100,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_ST_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R',
                'name' => '20GB/12 meses',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 2000,
                'seller_price' => 2000,
                'brand_id' => 1,
                'is_active' => true
            ],
            [
                'qv_offering_id' =>
                    'PO_SAY-RM_CT_750_750Mi_15000_5000M_500_500SMS_20000T_12M_R',
                'name' => '20GB/12 meses PLUS',
                'description' =>
                    '<ul><li>Minutos y SMS ilimitados</li><li>Territorio Nacional, EUA y Canada</li><li>20GB de 5G-4G LTE</li><li>20GB extra en velocidad reducida</li><li>Internet para compartir</li><li>Vigencia: 360 días</li></ul>',
                'promotion' => '',
                'price' => 2500,
                'seller_price' => 2500,
                'brand_id' => 1,
                'is_active' => true
            ],
        ];

        foreach ($offerings as $offering) {
            DB::table('offerings')->insert([
                'qv_offering_id' => $offering['qv_offering_id'],
                'name' => $offering['name'],
                'description' => $offering['description'],
                'promotion' => $offering['promotion'],
                'price' => $offering['price'],
                'seller_price' => $offering['seller_price'],
                'brand_id' => $offering['brand_id'],
                'is_active' => $offering['is_active'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
