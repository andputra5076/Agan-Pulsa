<!DOCTYPE html> 
<html>
  <head>
    <style>
        /* Spoiler Box Pure CSS by Twentytwo-aio */
.NomorPulsaPaket {
    display:block; margin:10px 0px; border:1px solid #3498db; padding:7px 10px; border-radius:3px; -moz-border-radius:3px;
}
.NomorPulsaPaket .tombol {
    background:#3498db; /* Warna tombol */
    color:#fff; /* Warna tulisan di tombol */
    display:inline-block; cursor:pointer; font:normal 600 14px Tahoma,sans-serif; padding:0px; border:none; outline:none; line-height:20px; border-radius:3px; -moz-border-radius:3px;
}
.NomorPulsaPaket .tombol:focus {
    pointer-events:none;
}
.NomorPulsaPaket .tombol:before {
    content:'Klik untuk melihat no, pulsa, paket'; /* Tulisan untuk membuka tombol */
    display:inline-block; padding:7px 10px; border-radius:3px; -moz-border-radius:3px;
}
.NomorPulsaPaket .tombol:focus::before {
    content:'Klik dimana saja untuk menutup'; /* Tulisan untuk menutup tombol */
    background:#cc0000; /* Warna tombol ketika spoiler terbuka */
}
.NomorPulsaPaket .isi {
    background:#e4e4e4; /* Warna background isi spoiler */
    pointer-events:auto; visibility:hidden; opacity:0; height:0px; transition:all .5s ease;
}
.NomorPulsaPaket .tombol:focus + .isi {
    visibility:visible; opacity:1; height:auto; margin:10px 0px 5px; padding:10px 15px; transition:all .5s ease;
}
    </style>
  </head>
  <body> 
  <div class="NomorPulsaPaket">
    <div class="tombol" tabindex="0"></div>
    <div class="isi">
        <!-- Isi Spoiler -->
        <h3><bold>TELKOMSEL</bold><br></h3>
        - *808# <i>Cek No</i><br>
        - *888# <i>Cek Pulsa</i><br>
        - *363# <i>Cek Paket Data</i><br>
        <br>
        <h3><bold>INDOSAT</bold><br></h3>
        - *123*30# <i>Cek No</i><br>
        - *123# <i>Cek Pulsa</i><br>
        - *363*7*1*1# <i>Cek Paket Data</i><br>
        <br>
        <h3><bold>XL</bold><br></h3>
        - *123*7*1*1*1*1# <i>Cek No</i><br>
        - *123# <i>Cek Pulsa</i><br>
        - *123*7*1*1# <i>Cek Paket Data (kartu lama)</i><br>
        - *123*5*1# <i>Cek Paket Data (kartu baru)</i><br>
        <br>
        <h3><bold>AXIS</bold><br></h3>
        - *123*7*5# <i>Cek No</i><br>
        - *123# <i>Cek Pulsa</i><br>
        - *889# <i>Cek Paket Data</i><br>
        <br>
        <h3><bold>3 (THREE)</bold><br></h3>
        - *111*1# <i>Cek No</i><br>
        - *111# <i>Cek Pulsa</i><br>
        - *123*10*3# <i>Cek Paket Data</i><br>
        <br>
        <h3><bold>SMARTFREN</bold><br></h3>
        - *999# <i>Cek No</i><br>
        - *999# <i>Cek Pulsa</i><br>
        - *995# <i>Cek Paket Data</i><br>
        <br>
        
    </div>
</div> 
  </body>
</html>