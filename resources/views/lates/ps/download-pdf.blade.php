<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        div {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .signature {
            width: 150px;
            border-top: 2px solid #333;
            margin-top: 30px;
            text-align: center;
        }

        .signature p {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div>
        <h1>SURAT PERNYATAAN TIDAK AKAN DATANG TERLAMBAT KESEKOLAH</h1>
        <p>Yang bertanda tangan dibawah ini:</p>

        <p>NIS: {{ $lates->student->nis}}</p>
        <p>Nama: {{ $lates->student->name }}</p>
        <p>Rombel: {{ $lates->student->rombel->rombel }}</p>
        <p>Rayon: {{ $lates->student->rayon->rayon }}</p>
        <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak {{ $jumlahKeterlambatan }} kali yang mana hal tersebut termasuk kedalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.</p>

        <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>

        <p>{{ $lates->created_at->format('d F Y') }} Orang Tua/Wali Peserta Didik,</p>

        <div class="signature">
            <p>Peserta Didik, ({{ $lates->student->name }})</p>
            <p>Pembimbing Siswa, Kesiswaan, ({{ $lates->student->rayon->rayon }})</p>
        </div>
    </div>
</body>

</html>
