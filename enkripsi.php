<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sistem Keamanan Data</title>
    <style>
        /* Gaya untuk latar belakang halaman */
        body {
            background-color: #f0f8ff; /* Latar belakang body diubah menjadi AliceBlue */
            font-family: Arial, sans-serif; /* Mengatur jenis font untuk halaman */
        }

        /* Gaya untuk container */
        .container {
            max-width: 600px; /* Lebar maksimum container */
            margin: 50px auto; /* Margin atas dan bawah 50px, margin kiri dan kanan otomatis */
            padding: 20px; /* Padding di dalam container */
            background-color: #ffffff; /* Latar belakang container diubah menjadi putih */
            border-radius: 10px; /* Membuat sudut container membulat */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan pada container */
        }

        /* Gaya untuk header card */
        .card-header {
            background-color: #4b0082; /* Warna latar belakang header diubah menjadi indigo */
            color: white; /* Warna teks di header menjadi putih */
            padding: 10px; /* Padding di dalam header */
            text-align: center; /* Teks di header ditempatkan di tengah */
            border-radius: 10px 10px 0 0; /* Membulatkan sudut atas header */
        }

        /* Gaya untuk body card */
        .card-body {
            background-color: #fdf5e6; /* Latar belakang card-body diubah menjadi OldLace */
            color: #333; /* Warna teks di dalam card-body menjadi abu-abu gelap */
            padding: 20px; /* Padding di dalam card-body */
            border-radius: 0 0 10px 10px; /* Membulatkan sudut bawah card-body */
        }

        /* Gaya untuk tombol */
        .btn {
            width: 48%; /* Lebar tombol diatur agar sejajar dengan tombol lainnya */
            font-size: 16px; /* Ukuran font untuk tombol */
        }

        /* Gaya khusus untuk tombol Enkripsi */
        .btn-success {
            background-color: #228b22; /* Warna latar belakang tombol Enkripsi diubah menjadi ForestGreen */
            border: none; /* Menghilangkan border pada tombol */
        }

        /* Gaya khusus untuk tombol Dekripsi */
        .btn-danger {
            background-color: #b22222; /* Warna latar belakang tombol Dekripsi diubah menjadi FireBrick */
            border: none; /* Menghilangkan border pada tombol */
        }

        /* Gaya untuk header hasil */
        .hasil-header {
            background-color: #483d8b; /* Warna latar belakang header HASIL diubah menjadi DarkSlateBlue */
            color: white; /* Warna teks di header hasil menjadi putih */
            text-align: center; /* Teks di header hasil ditempatkan di tengah */
            padding: 10px; /* Padding di dalam header hasil */
            margin-top: 20px; /* Margin atas diatur agar terpisah dari konten sebelumnya */
            border-radius: 10px; /* Membulatkan sudut header hasil */
        }

        /* Gaya untuk input pada form */
        .input-group input {
            height: 50px; /* Tinggi input diatur */
            font-size: 18px; /* Ukuran font di input diatur */
        }

        /* Gaya untuk tabel */
        table {
            width: 100%; /* Lebar tabel diatur agar memenuhi lebar container */
            margin-top: 20px; /* Margin atas tabel diatur agar terpisah dari konten sebelumnya */
        }

        /* Gaya untuk sel tabel */
        table td {
            padding: 10px; /* Padding di dalam sel tabel */
            border-bottom: 1px solid #ccc; /* Border bawah pada sel tabel */
        }

        /* Gaya untuk teks tebal di tabel */
        table td b {
            color: #333; /* Warna teks tebal di tabel menjadi abu-abu gelap */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h4><b>Caesar Cipher Encryption</b></h4> <!-- Judul header card -->
            </div>
            <div class="card-body">
                <!-- Logika PHP -->
                <?php
                if (isset($_POST['enkripsi']) || isset($_POST['dekripsi'])) {
                    // Fungsi untuk mengenkripsi atau mendekripsi karakter
                    function cipher($char, $key)
                    {
                        if (ctype_alpha($char)) {
                            $nilai = ord(ctype_upper($char) ? 'A' : 'a');
                            $ch = ord($char);
                            $mod = fmod($ch + $key - $nilai, 26);
                            return chr($mod + $nilai);
                        }
                        return $char;
                    }

                    // Fungsi untuk enkripsi teks
                    function enkripsi($input, $key)
                    {
                        $output = "";
                        $chars = str_split($input);
                        foreach ($chars as $char) {
                            $output .= cipher($char, $key);
                        }
                        return $output;
                    }

                    // Fungsi untuk dekripsi teks
                    function dekripsi($input, $key)
                    {
                        return enkripsi($input, 26 - $key);
                    }
                }
                ?>

                <!-- Form Input -->
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="plain" class="form-control" placeholder="Masukkan Teks">
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="key" class="form-control" placeholder="Masukkan Key (Kunci)">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="enkripsi" class="btn btn-success">Enkripsi</button>
                        <button type="submit" name="dekripsi" class="btn btn-danger">Dekripsi</button>
                    </div>
                </form>
            </div>

            <!-- Hasil Enkripsi/Dekripsi -->
            <div class="card-header hasil-header">
                <h4><b>HASIL</b></h4> <!-- Judul header hasil -->
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td><b>Output:</b></td>
                        <td>
                            <b><?php
                                if (isset($_POST['enkripsi'])) {
                                    echo enkripsi($_POST['plain'], $_POST['key']);
                                } elseif (isset($_POST['dekripsi'])) {
                                    echo dekripsi($_POST['plain'], $_POST['key']);
                                }
                                ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Teks Asli:</b></td>
                        <td>
                            <b><?php
                                if (isset($_POST['enkripsi'])) {
                                    echo dekripsi(enkripsi($_POST['plain'], $_POST['key']), $_POST['key']);
                                } elseif (isset($_POST['dekripsi'])) {
                                    echo enkripsi(dekripsi($_POST['plain'], $_POST['key']), $_POST['key']);
                                }
                                ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Key:</b></td>
                        <td><b><?php echo $_POST['key'] ?? ''; ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
