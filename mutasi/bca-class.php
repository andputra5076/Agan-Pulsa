<?php
date_default_timezone_set('Asia/Jakarta');
if (!function_exists('fix_angka'))
{
    function fix_angka($string)
    {
        $string = str_replace(',', '', $string);
        $string = strtok($string, '.');
        return $string;
    }
}
function grab_bca($user, $pass)
{
    $user_ip = '114.125.55.02';
    $ua = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36";
    $cookie = 'bca-cookie.txt';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
   // curl_setopt($ch, CURLOPT_PROXY, '341yfg:hYUzA9@138.128.98.140:8000');
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com');
    $info = curl_exec($ch);

    $a = strstr($info, 'var s = document.createElement(\'script\'), attrs = { src: (window.location.protocol ==',
        1);
    $a = strstr($a, 'function getCurNum(){');

    $b = array(
        'return "',
        'function getCurNum(){',
        '";',
        '}',
        '{',
        '(function()',
        );

    $b = str_replace($b, '', $a);
    $curnum = trim($b);
    $params = 'value(actions)=login&value(user_id)=' . $user .
        '&value(CurNum)=' . $curnum . '&value(user_ip)=' . $user_ip .
        '&value(browser_info)=' . $ua . '&value(mobile)=true&value(pswd)=' .
        $pass . '&value(Submit)=LOGIN';
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, 'https://ibank.klikbca.com/authentication.do');
    curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_POST, 1);
    echo $info = curl_exec($ch);

    // Buka menu
    curl_setopt($ch, CURLOPT_URL,
        'https://ibank.klikbca.com/nav_bar_indo/menu_bar.htm');
    curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/authentication.do');
    $info = curl_exec($ch);

    // Buka Informasi Rekening
    curl_setopt($ch, CURLOPT_URL,
        'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm');
    curl_setopt($ch, CURLOPT_REFERER, 'https://ibank.klikbca.com/authentication.do');
    $info = curl_exec($ch);

    // Buka Mutasi Rekening
    curl_setopt($ch, CURLOPT_URL,
        'https://ibank.klikbca.com/accountstmt.do?value(actions)=acct_stmt');
    curl_setopt($ch, CURLOPT_REFERER,
        'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm');
    curl_setopt($ch, CURLOPT_POST, 1);
    $info = curl_exec($ch);

    // Parameter untuk Lihat Mutasi Rekening
    $params = array();
    $jkt_time = time();
    $t1 = explode('-', date('Y-m-d', $jkt_time));
    $t0 = explode('-', date('Y-m-d', $jkt_time - (3600 * 6)));

    $params[] = 'value(startDt)=' . $t0[2];
    $params[] = 'value(startMt)=' . $t0[1];
    $params[] = 'value(startYr)=' . $t0[0];
    $params[] = 'value(endDt)=' . $t1[2];
    $params[] = 'value(endMt)=' . $t1[1];
    $params[] = 'value(endYr)=' . $t1[0];
    $params[] = 'value(D1)=0';
    $params[] = 'value(r1)=1';
    $params[] = 'value(fDt)=';
    $params[] = 'value(tDt)=';
    $params[] = 'value(submit1)=Lihat+Mutasi+Rekening';
     //$params[] = 'value(status)=success';
    

    $params = implode('&', $params);

    // Buka Lihat Mutasi Rekening & simpan hasilnya di $source
   // curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    // curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL,
        'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview');
    curl_setopt($ch, CURLOPT_REFERER,
        'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_POST, 1);

    $source = curl_exec($ch);
    
    /*
    
    // Buka Lihat Mutasi Rekening & simpan hasilnya di $source
     $params = "value(D1)=0&value(r1)=1&value(startDt)=".$t0[2]."&value(startMt)=".$t0[1]."&value(startYr)=".$t0[0]."&value(endDt)=".$t1[2]."&value(endMt)=".$t1[1]."&value(endYr)=".$t1[0]."&value(fDt)=&value(tDt)=&value(requestDate)=".$t0[2].$t0[1].$t0[0]."&value(isMonthly)=0&value(acct_no)=8525240149&value(from_date)=".$t0[2].$t0[1].$t0[0]."&value(to_date)=".$t0[2].$t0[1].$t0[0]."&value(inputEndDt)=".$t0[2].$t0[1].$t0[0]."&value(status)=SUCCESS&value(directDownload)=0";
     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
     curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL,
        'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmt_req');
    curl_setopt($ch, CURLOPT_REFERER,
        'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    

    $source = curl_exec($ch);
    
     // Buka Lihat Mutasi Rekening & simpan hasilnya di $source
     $params = "value(D1)=0&value(r1)=1&value(startDt)=".$t0[2]."&value(startMt)=".$t0[1]."&value(startYr)=".$t0[0]."&value(endDt)=".$t1[2]."&value(endMt)=".$t1[1]."&value(endYr)=".$t1[0]."&value(fDt)=&value(tDt)=&value(refNo)=201911191046053520&value(requestDate)=".$t0[2].$t0[1].$t0[0]."&value(isMonthly)=0&value(acct_no)=8525240149&value(from_date)=".$t0[2].$t0[1].$t0[0]."&value(to_date)=".$t0[2].$t0[1].$t0[0]."&value(inputEndDt)=".$t0[2].$t0[1].$t0[0]."&value(status)=SUCCESS&value(directDownload)=0";
     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
     curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL,
        'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmt_async');
    curl_setopt($ch, CURLOPT_REFERER,
        'https://ibank.klikbca.com/accountstmt.do?value(actions)=acctstmtview');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    

   // $source = curl_exec($ch);
    
    */
    
    

    // Logout, cURL close, hapus cookies
    curl_setopt($ch, CURLOPT_URL,
        'https://ibank.klikbca.com/authentication.do?value(actions)=logout');
    curl_setopt($ch, CURLOPT_REFERER,
        'https://ibank.klikbca.com/nav_bar_indo/account_information_menu.htm');
    $info = curl_exec($ch);
    curl_close($ch);
    @unlink($cookie);
    return $source;
}

    function check_bca($jumlah, $source){
    global $pdo;
    $user = ""; // USERID 
    $pass = ""; // PASS  
    //echo $source = grab_bca($user, $pass);
    $exp = explode('<b>Saldo</b></font></div></td>', $source);
    $invoices = array();
    $lunas = array();
    $jkt_time = time() + (3600 * 7);
    $tahun = date('Y', $jkt_time);
    if (isset($exp[1]))
    {
        $table = explode("</table>", $exp[1]);
        $tr = explode("<tr>", $table[0]);
        for ($i = 1; $i < count($tr); $i++)
        {
            $str = str_ireplace('</font>', '#~#~#</font>', $tr[$i]);
            $str = str_ireplace('<br>', '<br> ', $str);
            $str = preg_replace('!\s+!', ' ', trim(strip_tags($str)));
            $arr = array_map('trim', explode("#~#~#", $str));
            $tgl = $arr[0] . '/' . $tahun;
            $keterangan = $arr[1];
            $kredit = fix_angka($arr[3]);
            $status = $arr[4];
            if($kredit == $jumlah){
            $result = 'sukses';
            }
        }
        return $result;
    }
    }

?>