<?php
class GoPay
{

    public $nomerGojek;
    public $kodeVerifikasi;
    public $loginToken;
    public $bearerToken;

    private function generate($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyz', ceil($length / strlen($x)))) , 1, $length);
    }

    public function sendRequest($nomerGojek)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://goid.gojekapi.com/goid/login/request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"client_id":"gojek:consumer:app","client_secret":"pGwQ7oi8bKqqwvid09UrjqpkMEHklb","country_code":"+62","phone_number":"' . $nomerGojek . '"}');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Platform: Android",
            "X-UniqueId: 159d884b3709ca69",
            "X-AppVersion: 4.5.2",
            "X-AppId: com.gojek.app",
            "Accept: application/json",
            "X-DeviceOS: Android,7.1.2",
            "X-User-Type: customer",
            "X-PhoneMake: samsung",
            "X-DeviceToken: ",
            "X-PushTokenType: FCM",
            "X-PhoneModel: samsung,SM-G935FD",
            "User-uuid: ",
            "Authorization: Bearer",
            "Accept-Language: en-null",
            "X-User-Locale: en_null",
            "Content-Type: application/json; charset=UTF-8",
            "Host: goid.gojekapi.com",
            "Connection: close",
            "User-Agent: okhttp/3.12.1"
        ));

        $result = curl_exec($ch);
        if (curl_errno($ch))
        {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $this->nomerGojek = $nomerGojek;
        $this->loginToken = json_decode($result, true) ['data']['otp_token'];
        return json_decode($result, true) ['data']['otp_token'];
        

    }

    public function konfirmasiCode($loginToken, $kodeVerifikasi, $nomerGojek)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://goid.gojekapi.com/goid/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"client_id":"gojek:consumer:app","client_secret":"pGwQ7oi8bKqqwvid09UrjqpkMEHklb","data":{"otp":"' . $kodeVerifikasi . '","otp_token":"' . $loginToken . '"},"grant_type":"otp","scopes":[]}');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Platform: Android",
            "X-UniqueId: 159d884b3709ca69",
            "X-AppVersion: 4.5.2",
            "X-AppId: com.gojek.app",
            "Accept: application/json",
            "X-DeviceOS: Android,7.1.2",
            "X-User-Type: customer",
            "X-PhoneMake: samsung",
            "X-DeviceToken: ",
            "X-PushTokenType: FCM",
            "X-PhoneModel: samsung,SM-G935FD",
            "User-uuid: ",
            "Authorization: Bearer",
            "Accept-Language: en-null",
            "X-User-Locale: en_null",
            "Content-Type: application/json; charset=UTF-8",
            "Host: goid.gojekapi.com",
            "Connection: close",
            "User-Agent: okhttp/3.12.1"
        ));

        $result = curl_exec($ch);
        //echo $result;
        if (curl_errno($ch))
        {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        
        if(json_decode($result, true) ['access_token']){
            return json_decode($result, true) ['access_token'];
        }else{
            return "Failed";
        }
        
    }

    public function seeMutation($nomerGojek, $page = '20')
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://customer.gopayapi.com/v1/users/transaction-history?page=1&limit=" . $page);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-AppVersion: 4.5.2",
            "X-AppId: com.gojek.app",
            "Accept: application/json",
            "Content-Type: application/json",
            "X-Platform: Android",
            "X-UniqueId: 159d884b3709ca69",
            "X-DeviceOS: Android,7.1.2",
            "X-User-Type: customer",
            "X-PhoneMake: samsung",
            "X-PushTokenType: FCM",
            "X-PhoneModel: samsung,SM-G935FD",
            (strlen($nomerGojek) > 16) ? "Authorization: Bearer $nomerGojek" : "Authorization: Bearer ".file_get_contents($nomerGojek . ".txt"),
            "Accept-Language: id-ID",
            "X-User-Locale: id_ID",
            "Gojek-Country-Code: ID",
            "Host: api.gojekapi.com",
            "Connection: close",
            "User-Agent: okhttp/3.12.1"
        ));

        $result = curl_exec($ch);
        if (curl_errno($ch))
        {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode(json_encode($result, JSON_PRETTY_PRINT), true);

    }

    public function cekSaldo($saldo, $mutasi)
    {

        if (strpos($mutasi, $saldo) !== false)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

}