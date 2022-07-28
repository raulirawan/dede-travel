<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
</head>
<style>
    html {
        position: relative;
        min-width: 1024px;
        min-height: 768px;
        height: 100%;
    }
    .content {
    }
    .kode-tiket {
        font-size: 24px;
        padding-top: 20px;

    }
    .nama-peserta {
        padding-bottom: 20px;
        font-size: 24px;
    }
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<body>
    <div class="content" style="text-align: center">
        <h1>TIKET</h1>
        <div class="nama-peserta">
            RAUL IRAWAN
        </div>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('dwadwwaaw')) !!}"><br>
        <div class="kode-tiket">
            DWKAKWEKRK
        </div>
    </div>
    <div class="content" style="text-align: center">
        <h1>TIKET</h1>
        <div class="nama-peserta">
            RAUL IRAWAN
        </div>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('dwadwwaaw')) !!}"><br>
        <div class="kode-tiket">
            DWKAKWEKRK
        </div>
    </div>
    <div class="content" style="text-align: center">
        <h1>TIKET</h1>
        <div class="nama-peserta">
            RAUL IRAWAN
        </div>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('dwadwwaaw')) !!}"><br>
        <div class="kode-tiket">
            DWKAKWEKRK
        </div>
    </div>
    <div class="content" style="text-align: center">
        <h1>TIKET</h1>
        <div class="nama-peserta">
            RAUL IRAWAN
        </div>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('dwadwwaaw')) !!}"><br>
        <div class="kode-tiket">
            DWKAKWEKRK
        </div>
    </div>

</body>

</html>
