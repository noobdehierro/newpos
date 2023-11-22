<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
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

        $configurations = [
            [
                'label' => 'Sandbox',
                'code' => 'is_sandbox',
                'value' => 'true',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'Notifications Email Sandbox',
                'code' => 'notifications_email_sandbox',
                'value' => 'jreyes@saycocorporativo.com',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Access Token BIP Sandbox',
                'code' => 'url_token_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/token',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Map Sandbox',
                'code' => 'url_map_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/tools/location_info',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Postal Code Sandbox',
                'code' => 'url_postal_code_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/tools/cp_info',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Info IMEI Sandbox',
                'code' => 'url_imei_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/tools/imei_check',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Offering Sandbox',
                'code' => 'url_offering_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/purchase',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Recharge Sandbox',
                'code' => 'url_recharge_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/recharge',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Activation Sandbox',
                'code' => 'url_activation_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/activation',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Offering ESIM Sandbox',
                'code' => 'url_offering_esim_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/purchase_esim',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Portability Sandbox',
                'code' => 'url_portability_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/portability',
                'group' => 'General',
                'is_protected' => true
            ],
            [
                'label' => 'URL Recharge ESIM Sandbox',
                'code' => 'url_recharge_esim_bip_sandbox',
                'value' => 'https://api-sandbox.igou.mx/v1/recharge_esim',
                'group' => 'General',
                'is_protected' => true
            ]

        ];

        foreach ($configurations as $configuration) {
            DB::table('configurations')->insert([
                'label' => $configuration['label'],
                'code' => $configuration['code'],
                'value' => $configuration['value'],
                'group' => $configuration['group'],
                'is_protected' => $configuration['is_protected'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ]);
        }
    }
}
