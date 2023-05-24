<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5
	.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Faris Rasyid</title>
</head>
<body>
<div class="container">
    <img class="image-center"src="logo.jpg">
    <h1 class="text-center"></h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div class="card">
	<div class="form-group">
            <div class="">Form Pemesanan Bento Cake</div>
            <div class="">

                <?php foreach ([
                    ["label" => "Nama Pelanggan:", "type" => "text", "id" => "nama", "name" => "nama"],
                    ["label" => "Nomor Hp:", "type" => "text", "id" => "nomor", "name" => "nomor"],
                    ["label" => "Golongan Pemakaian:", "type" => "select", "id" => "lokasi", "name" => "lokasi", "options" => [
                        ["value" => "Tanggerang", "text" => "Tanggerang"],
                        ["value" => "Bogor", "text" => "Bogor"],
                        ["value" => "Jakarta", "text" => "Jakarta"],
                        ["value" => "Depok", "text" => "Depok"],
                        ["value" => "Bekasi", "text" => "Bekasi"]
                    ]],
                    ["label" => "Jumlah:", "type" => "text", "id" => "jumlah", "name" => "jumlah"]
                ] as $input) : ?>

				<div class="card">
				<div class="form-group">
                        <label for="<?= $input['id'] ?>"><?= $input['label'] ?></label>

                        <?php if ($input['type'] == "select") : ?>
                            <select class="form-control" id="<?= $input['id'] ?>" name="<?= $input['name'] ?>">
                                <?php foreach ($input['options'] as $option) : ?>
                                    <option value="<?= $option['value'] ?>"><?= $option['text'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else : ?>
                            <input type="<?= $input['type'] ?>" class="form-control" id="<?= $input['id'] ?>" name="<?= $input['name'] ?>">
                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

                <button type="submit" class="btn btn-success">Pesan</button>
            </div>
        </div>
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama = $_POST["nama"];
        $nomor = $_POST["nomor"];
        $lokasi = $_POST["lokasi"];
        $tempat = $_POST["lokasi"];
        $jumlah = $_POST["jumlah"];


        $tarif_dasar = array(
            "Tanggerang" => 5000,
            "Bogor" => 10000,
            "Jakarta" => 0,
            "Depok" => 0,
            "Bekasi" => 0

        );


        $tarifongkir = $tarif_dasar[$tempat];
        $total_tagihan = $jumlah * 90000 + $tarifongkir;


        $data = array(
           

			"nama" => $nama,		"nomor" => $nomor,
            "lokasi" => $lokasi,
            "golongan" => $tempat,
            "jumlah" => $jumlah,
            "tarif_pemakaian" => $tarifongkir,
            "total_tagihan" => $total_tagihan
        );
    
    
        $json_file = "cake.json";
	$current_data = file_get_contents($json_file);
	$array_data = json_decode($current_data, true);
	$array_data[] = $data;
	$final_data = json_encode($array_data, JSON_PRETTY_PRINT);
	file_put_contents($json_file, $final_data);
     
        echo "<div class='container'>";
        echo "<h2>Tagihan Pelanggan</h2>";
        echo "<table class='table'>";
        echo "<tr><td>Nama Pelanggan:</td><td>$nama</td></tr>";
        echo "<tr><td>Nomor Hp:</td><td>$nomor</td></tr>";
        echo "<tr><td>Lokasi:</td><td>$lokasi</td></tr>";
        echo "<tr><td>Lokasi:</td><td>$tempat</td></tr>";
        echo "<tr><td>Jumlah Kue:</td><td>$jumlah</td></tr>";
        echo "<tr><td>Tarif Ongkir:</td><td>$tarifongkir</td></tr>";
        echo "<tr><td>Total Tagihan:</td><td>$total_tagihan</td></tr>";
        echo "</table>";
        echo "</div>";
    }
    ?>
    

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>    