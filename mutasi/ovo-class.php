<?php
class OVO
{

    public function sendRequest2FA($nomerOvo)
    {
        
        $deviceId   =   '' . rand(111, 999) . 'ff' . rand(111, 999) . '-b7fc-3b' . rand(11, 99) . '-b' . rand(11, 99) . 'd-' . rand(1111, 9999) . 'd2fea8e5';
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://api.ovo.id/v1.0/api/auth/customer/login2FA");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"deviceId":"' . $deviceId . '","mobile":"' . $nomerOvo . '"}');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "App-Version: 3.37.0";
        $headers[] = "Os: Android";
        $headers[] = "Content-Type: application/json; charset=UTF-8";
        $headers[] = "Host: api.ovo.id";
        $headers[] = "User-Agent: okhttp/3.11.0";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        
        return ['result' => true, 'data' => $deviceId, 'pesan' => json_decode($result,true)['message']]; 
        curl_close ($ch);
    }

    public function konfirmasiCode($deviceId, $nomerOvo, $verificationCode)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.ovo.id/v1.0/api/auth/customer/login2FA/verify");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"deviceId":"' . $deviceId . '","mobile":"' . $nomerOvo . '","verificationCode":"' . $verificationCode . '"}');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "App-Version: 3.37.0";
        $headers[] = "Os: Android";
        $headers[] = "Content-Type: application/json; charset=UTF-8";
        $headers[] = "Host: api.ovo.id";
        $headers[] = "User-Agent: okhttp/3.11.0";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        
        return json_decode($result, true);
        curl_close ($ch);
    }

    public function konfirmasiSecurityCode($deviceId, $nomerOvo, $securityCode)
    {

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://api.ovo.id/v1.0/api/auth/customer/loginSecurityCode/verify");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"mobile":"' . $nomerOvo . '","securityCode":"' . $securityCode . '","deviceUnixtime":1539175105,"appVersion":"3.37.0","deviceId":"' . $deviceId . '","macAddress":"08:62:66:67:81:39","osName":"android","osVersion":"5.0","pushNotificationId":"FCM|e1-j8yB55QI:APA91bFan4mLCWogE4ols2OFSmz1YjgB71tKwZA0Y-IkwJSiKzG1ALJ6oxGuSQLYXLQWG8dujmdeWOdPn-gWWc_0fDcaO8BaPeZQbiF9wd3pfFU1NcYv54CUU80yPAZMS0nbNqfgHosJ"}');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "App-Version: 3.37.0";
        $headers[] = "Os: Android";
        $headers[] = "Content-Type: application/json; charset=UTF-8";
        $headers[] = "Host: api.ovo.id";
        $headers[] = "User-Agent: okhttp/3.11.0";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        
        return ['result' => true, 'data' => json_decode($result,true)['token'], 'pesan' => json_decode($result,true)['message']]; 
        curl_close ($ch);
    }

    public function seeMutation($token, $limit = 100)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.ovo.id/wallet/v2/transaction?page=1&limit=" . $limit . "&productType=001");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "Authorization: ".$token;
        $headers[] = "App-Version: 3.37.0";
        $headers[] = "Os: Android";
        $headers[] = "Host: api.ovo.id";
        $headers[] = "User-Agent: okhttp/3.11.0";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_encode($result, true);
    }
    
}