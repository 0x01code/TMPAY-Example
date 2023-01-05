<?php

class TMPAY
{
    private string $merchant_id = '';
    private string $resp_url = '';
    private string $channel = '';

    /**
     * merchant_id  =>  รหัสร้านค้า (A-Z,0-9 ความยาว 10 หลัก) เช่น TMPAY
     * resp_url     =>  URL สำหรับการรับผลการตรวจสอบ เช่น https://0x01code.me/TMPAY.Webhook.php
     * channel      =>  ประเภทบัตรเงินสด
     *                  truemoney = บัตรเงินสดทรูมันนี่
     *                  razer_gold_pin = Razer Gold PIN
     * 
     * การทดสอบระบบสามารถใช้ merchant_id เป็น TEST และใช้รหัสบัตรด้านล่างทดสอบ
     * รหัสบัตรเงินสด 55555555555551 มูลค่า 50   บาท
     * รหัสบัตรเงินสด 55555555555552 มูลค่า 90   บาท
     * รหัสบัตรเงินสด 55555555555553 มูลค่า 150  บาท
     * รหัสบัตรเงินสด 55555555555554 มูลค่า 300  บาท
     * รหัสบัตรเงินสด 55555555555555 มูลค่า 500  บาท
     * รหัสบัตรเงินสด 55555555555556 มูลค่า 1000 บาท
     */
    public function __construct(string $merchant_id, string $resp_url, string $channel = 'truemoney')
    {
        $this->merchant_id = $merchant_id;
        $this->resp_url = $resp_url;
        $this->channel = $channel;
    }

    public function tmn_refill($truemoney_password)
    {
        if (function_exists('curl_init')) {
            $curl = curl_init('https://www.tmpay.net/TPG/backend.php?merchant_id=' . $this->merchant_id . '&password=' . $truemoney_password . '&channel=' . $this->channel . '&resp_url=' . $this->resp_url);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt($curl, CURLOPT_HEADER, FALSE);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            $curl_content = curl_exec($curl);
            curl_close($curl);
        } else {
            $curl_content = file_get_contents('http://www.tmpay.net/TPG/backend.php?merchant_id=' . $this->merchant_id . '&password=' . $truemoney_password . '&channel=' . $this->channel . '&resp_url=' . $this->resp_url);
        }
        if (strpos($curl_content, 'SUCCEED') !== FALSE) {
            return true;
        } else {
            return false;
        }
    }
}
