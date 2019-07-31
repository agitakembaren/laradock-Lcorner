<?php
                        function cek_resi($waybill, $courier){
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "waybill=".$waybill."&courier=".$courier,
                        CURLOPT_HTTPHEADER => array(
                            "content-type: application/x-www-form-urlencoded",
                            "key: 428ff8d9782be1b3721ec552cbf56827"
                        ),
                        ));

                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        curl_close($curl);
                    

                        if ($err) {
                        echo "cURL Error #:" . $err;
                        } else {
                        echo $response;
                        }

                    }
                    ?>

<html>

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
            
            
            <div class="col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">Cek Resi Anda</div>
                    <div class="panel-body">
                        <form action="" method="GET">
                            <div class="form-group">   
                                <label for="" class="control-label">Nomor Resi</label>
                                <input type="text" class="form-control" name="waybill" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label" >Jasa Pengiriman</label>
                                <select name="courier" id="" class="form-control" required>
                                    <option value="">-- Pilih Jasa Pengiriman -- </option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS INDONESIA</option>
                                    <option value="lion">LION PARCEL</option>
                                    <option value="sicepat">SICEPAT</option>
                                    <option value="jnt">JNT</option>
                                </select>
                            </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" name="cek" class="btn btn-primary">Cek Resi</button>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</html>

<div class="col-lg-7">
        <div class="panel panel-success">
            <div class="panel-heading">Hasil</div>
                <div class="panel-body">

                    <?php  
                    if (isset($_GET['waybill'])){
                        $courier = $_GET['courier'];
                        $waybill = $_GET['waybill'];
                        $cek_resi = cek_resi($waybill,$courier);
                       
                        echo json_decode($cek_resi['result']);
                       
                    }
               
                    
                    ?>
            </div>
        </div>
    </div>

<style>
     .container {
            padding: 10px
        }

        .panel-success>.panel-heading {
            background: orange;
            color: black;
            text-transform: uppercase
        }

        .a {
            color: black
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