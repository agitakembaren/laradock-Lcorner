
<?php
    $api_key = "428ff8d9782be1b3721ec552cbf56827";
   
    function get_city($key){
        $data = [
            'status' => false,
            'result' => []
        ]; 
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/city",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$key
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['rajaongkir']['results'];
            } else {
                $data['result'] = $result['rajaongkir']['status']['description'];
            }
        }
        return $data;
    }

    function get_subdistrict($city_id, $key){
        $data = [
            'status' => false,
            'result' => []
        ]; 
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$city_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$key
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['rajaongkir']['results'];
            } else {
                $data['result'] = $result['rajaongkir']['status']['description'];
            }
        }
        return $data;
    }

    function hitung_ongkir($kecamatan_asal, $kecamatan_tujuan, $kurir, $berat, $key){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=".$kecamatan_asal."&originType=subdistrict&destination=".$kecamatan_tujuan."&destinationType=subdistrict&weight=".$berat."&courier=".$kurir,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ".$key
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['rajaongkir']['results'][0];
            } else {
                $data['result'] = $result['rajaongkir']['status']['description'];
            }
        }
        return $data;
    }
 
    //ambil data kota
    $city = [];
    $check = get_city($api_key);
    if ($check['status']){
        $city = $check['result'];
?>          
    

<div class="content">
            <div class="box">🔥</div>  
                <div class="title m-b-md">
                    Logistic Corner 
                </div>

                <div class="links">
                <a href="/">Beranda</a>
                    <a href="rajaongkir">Cek Ongkir</a>
                    <a href="cekresi">Cek Resi</a>
                    <a href="ekspedisi">List Ekspedisi</a>
                    <a href="download">Download</a>
                    <a href="about">Tentang Kami</a>
                </div>
         </div>
         <hr>
<div class="container">  
    <div class="col-lg-5">
        <div class="panel panel-success">
            <div class="panel-heading">Cek Ongkos Kirim</div>
                <div class="panel-body">
                <form method="GET">
                Kota Asal Pengiriman<br/>
                <select name="kota_asal" id="kota_asal">
                    <?php
                        foreach ($city as $item):
                            echo "<option value='".$item['city_id']."'>".$item['type']." ".$item['city_name']."</option>";
                        endforeach;
                    ?>
                </select>
                <br/><br/>
                Kecamatan Asal Pengiriman<br/>
                <select name="kecamatan_asal" id="kecamatan_asal">
                <?php
                    $check = get_subdistrict($city[1]['city_id'],$api_key);
                    if ($check['status']){
                        $subdistrict = $check['result'];
                        foreach ($subdistrict as $item):
                            echo "<option value='".$item['subdistrict_id']."'>".$item['subdistrict_name']."</option>";
                        endforeach;
                    }
                ?>
                </select>
                <br/><br/>  
                Kota Tujuan Pengiriman<br/>
                <select name="kota_tujuan" id="kota_tujuan">
                    <?php
                        foreach ($city as $item):
                            echo "<option value='".$item['city_id']."'>".$item['type']." ".$item['city_name']."</option>";
                        endforeach;
                    ?>
                </select>
                <br/><br/>
                Kecamatan Tujuan Pengiriman<br/>
                <select name="kecamatan_tujuan" id="kecamatan_tujuan">
                <?php
                    $check = get_subdistrict($city[0]['city_id'],$api_key);
                    if ($check['status']){
                        $subdistrict = $check['result'];
                        foreach ($subdistrict as $item):
                            echo "<option value='".$item['subdistrict_id']."'>".$item['subdistrict_name']."</option>";
                        endforeach;
                    }
                ?>
                </select>
                <br/><br/>
                Kurir<br/>
                <select name="kurir">
                    <option value="jne">JNE</option>
                    <option value="pos">POS Indonesia</option>
                    <option value="tiki">TIKI</option>
                    <option value="lion">LION PARCEL</option>
                    <option value="jnt">JNT</option>
                    <option value="sicepat">SICEPAT</option>
                    
                </select>
                <br/><br/>
                Berat<br/>
                <input type=text name="berat"> gram
                <br><br>
                <div class="footer">
                        <button type="submit" name="cek" class="btn btn-primary">Cek Ongkir</button>
                    </div>
            </form>
    
        </div>
        </div>
        </div>

 
    <div class="col-lg-7">
        <div class="panel panel-success">
            <div class="panel-heading">Hasil</div>
                <div class="panel-body">
                    <?php  
                    if (isset($_GET['kota_asal'])){
                        $kecamatan_asal = $_GET['kecamatan_asal'];
                        $kecamatan_tujuan = $_GET['kecamatan_tujuan'];
                        $kurir = $_GET['kurir'];
                        $berat = $_GET['berat'];
                        $ongkir = hitung_ongkir($kecamatan_asal,$kecamatan_tujuan,$kurir,$berat,$api_key);
                       
                        echo json_encode($ongkir['result']);
                       
                    }
                } else {
                    echo $check['result'];
                }
                    
                    ?>
                </div>
            </div>
        </div>
    


<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
        .container {
            padding: 10px
        }

        .panel-success>.panel-heading {
            background: orange;
            color: black;
            text-transform: uppercase
        }

        .btn-primary {
            background: orange;
            color: black
        }
</style>

<style>
            html, body {
                background-color: #fff;
                color: black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 90vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: black;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            
            .box {
                color: black;
                padding: 0rem 0rem;
                margin: 0rem;
                font-size: 60px;
            }
        </style>


<script>
    $('#kota_asal').on('change', function(){
        var city_id = $(this).val();
        var key = "<?=$api_key;?>";
        $.ajax({
            type : 'POST',
            url : 'http://localhost/LCorner/cek_kecamatan.php',
            data :  {'city_id' : city_id, 'key' : key},
                success: function (data) {
                    $("#kecamatan_asal").html(data);
            }
        });        
    });
    $('#kota_tujuan').on('change', function(){
        var city_id = $(this).val();
        var key = "<?=$api_key;?>";
        $.ajax({
            type : 'POST',
            url : 'http://localhost/LCorner/cek_kecamatan.php',
            data :  {'city_id' : city_id, 'key' : key},
                success: function (data) {
                    $("#kecamatan_tujuan").html(data);
            }
        });        
    });
</script>


