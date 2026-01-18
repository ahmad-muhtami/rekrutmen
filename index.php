<?php include('./layouts/header.php') ?>
<?php
session_start();
?>

<title>Hatara Coffee - Aplikasi Rekrutmen & Seleksi Karyawan</title>

<nav class="w-full sticky top-0 bg-white/80 backdrop-blur-lg z-50 border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex-shrink-0 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-900 shadow-sm">
                    <img src="./assets/img/hatara.jpg" class="w-full h-full object-cover" alt="Hatara Logo">
                </div>
                <a href="./" class="text-xl font-bold text-gray-900 tracking-tight">Hatara Coffee</a>
            </div>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-3">
                    <a href="login.php" class="text-sm font-medium text-gray-700 hover:text-gray-900 px-4 py-2 transition-colors">Masuk</a>
                    <a href="register.php" class="text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 px-5 py-2.5 rounded-full transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 flex flex-col justify-center h-full pt-10 px-4 sm:px-6 lg:px-8">
            <main class="mt-10 mx-auto max-w-7xl sm:mt-12 md:mt-16 lg:mt-20 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Selamat Datang di</span>
                        <span class="block text-gray-600">Website Rekrutmen Hatara</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Seleksi Penerimaan Karyawan Kedai Kopi Hatara. Bergabunglah bersama kami untuk menciptakan pengalaman kopi terbaik.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <span class="block text-sm text-gray-500 mb-2 font-medium">Ingin bergabung dan melamar pekerjaan?</span>
                            <a href="register.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-black md:py-4 md:text-lg transition-all shadow-xl hover:shadow-2xl">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="./assets/img/kedaikopihatara.jpg" alt="Hatara Coffee Shop">
        <div class="absolute inset-0 bg-gradient-to-r from-white to-transparent lg:via-white/20 lg:to-transparent mix-blend-multiply"></div>
    </div>
</div>

<div class="py-16 bg-gray-50 overflow-hidden lg:py-24">
    <div class="relative max-w-xl mx-auto px-4 sm:px-6 lg:px-8 lg:max-w-7xl">
        <div class="relative">
            <h2 class="text-center text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Alur Pendaftaran
            </h2>
            <p class="mt-4 max-w-3xl mx-auto text-center text-xl text-gray-500">
                Tiga langkah mudah untuk memulai karirmu di Hatara Coffee.
            </p>
        </div>

        <div class="relative mt-12 lg:grid lg:grid-cols-3 lg:gap-8 items-stretch">
            <div class="mt-10 lg:mt-0">
                <div class="h-full flex flex-col bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow p-8 border border-gray-100">
                    <div class="flex-1">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white text-xl font-bold mb-5">
                            1
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Masuk / Daftar</h3>
                        <p class="mt-4 text-base text-gray-500">
                            Buat akun atau registrasi terlebih dahulu. Jika telah memiliki akun, silakan masuk ke dashboard pelamar.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-10 lg:mt-0">
                <div class="h-full flex flex-col bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow p-8 border border-gray-100">
                    <div class="flex-1">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white text-xl font-bold mb-5">
                            2
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Pilih Lowongan</h3>
                        <p class="mt-4 text-base text-gray-500">
                            Pilih lowongan kerja yang tersedia sesuai bidang pekerjaan yang ingin dilamar, isi data diri dan lakukan tes seleksi.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-10 lg:mt-0">
                <div class="h-full flex flex-col bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow p-8 border border-gray-100">
                    <div class="flex-1">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white text-xl font-bold mb-5">
                            3
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Selesai</h3>
                        <p class="mt-4 text-base text-gray-500">
                            Terima informasi status hasil rekrutmen dan seleksi penerimaan karyawan melalui notifikasi sistem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-16 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Daftar Lowongan Pekerjaan</h2>
            <p class="mt-4 max-w-2xl text-sm text-gray-500 sm:mt-0">Lowongan yang sedang dibuka</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            include './config/koneksi.php';

            // Definisi Bulan Indo
            $bulan_indo = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember'
            ];

            $today = date('Y-m-d');
            $queryDibuka = "SELECT lk.*, bp.jenis_pekerjaan, bp.bidang_pekerjaan, bp.gaji_pokok as salary
                             FROM lowongan_kerja lk 
                             JOIN bidang_pekerjaan bp ON lk.bidang_pekerjaan_id = bp.id 
                             WHERE lk.tanggal_berakhir > '$today' 
                             ORDER BY lk.tanggal_buka DESC";

            $resultDibuka = mysqli_query($koneksi, $queryDibuka);

            if (mysqli_num_rows($resultDibuka) > 0) {
                while ($row = mysqli_fetch_assoc($resultDibuka)) {
                    $gaji = "Rp " . number_format($row['salary'], 0, ',', '.');

                    // Format Tanggal
                    $ts = strtotime($row['tanggal_berakhir']);
                    $tgl_tutup = date('d', $ts) . ' ' . $bulan_indo[date('m', $ts)] . ' ' . date('Y', $ts);
            ?>
                    <div class="group bg-gray-50 rounded-xl p-6 border border-gray-200 opacity-75 hover:opacity-100 hover:bg-white hover:shadow-lg transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-800">
                                <?= $row['jenis_pekerjaan'] ?>
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                Dibuka
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-black transition-colors"><?= $row['judul'] ?></h3>
                        <p class="text-sm text-gray-500 mb-4"><?= $row['bidang_pekerjaan'] ?></p>

                        <div class="flex items-center text-sm text-gray-500 mb-6">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?= $gaji ?>
                        </div>

                        <a href="register.php" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-blue-700">
                            Lamar Pekerjaan
                        </a>


                    </div>
            <?php
                }
            } else {
                echo '<div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-gray-400 bg-gray-50 rounded-lg border border-dashed border-gray-300">Belum ada lowongan kerja yang tersedia.</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="bg-white py-16 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Riwayat Lowongan</h2>
            <p class="mt-4 max-w-2xl text-sm text-gray-500 sm:mt-0">Lowongan yang sudah ditutup</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            include './config/koneksi.php';

            // Definisi Bulan Indo
            $bulan_indo = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember'
            ];

            $today = date('Y-m-d');
            $query_closed = "SELECT lk.*, bp.jenis_pekerjaan, bp.bidang_pekerjaan, bp.gaji_pokok as salary
                             FROM lowongan_kerja lk 
                             JOIN bidang_pekerjaan bp ON lk.bidang_pekerjaan_id = bp.id 
                             WHERE lk.tanggal_berakhir < '$today' 
                             ORDER BY lk.tanggal_berakhir DESC LIMIT 6";

            $result_closed = mysqli_query($koneksi, $query_closed);

            if (mysqli_num_rows($result_closed) > 0) {
                while ($row = mysqli_fetch_assoc($result_closed)) {
                    $gaji = "Rp " . number_format($row['salary'], 0, ',', '.');

                    // Format Tanggal
                    $ts = strtotime($row['tanggal_berakhir']);
                    $tgl_tutup = date('d', $ts) . ' ' . $bulan_indo[date('m', $ts)] . ' ' . date('Y', $ts);
            ?>
                    <div class="group bg-gray-50 rounded-xl p-6 border border-gray-200 opacity-75 hover:opacity-100 hover:bg-white hover:shadow-lg transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-800">
                                <?= $row['jenis_pekerjaan'] ?>
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                Ditutup: <?= $tgl_tutup ?>
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-black transition-colors"><?= $row['judul'] ?></h3>
                        <p class="text-sm text-gray-500 mb-4"><?= $row['bidang_pekerjaan'] ?></p>

                        <div class="flex items-center text-sm text-gray-500 mb-6">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?= $gaji ?>
                        </div>

                        <button disabled class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-400 bg-gray-100 cursor-not-allowed">
                            Pendaftaran Ditutup
                        </button>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-gray-400 bg-gray-50 rounded-lg border border-dashed border-gray-300">Belum ada riwayat lowongan ditutup.</div>';
            }
            ?>
        </div>
    </div>
</div>

<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 md:flex md:items-center md:justify-center lg:px-8">
        <p class="text-center text-base text-gray-400">
            <span>Copyright &copy; Ahmad Muhtami 2026</span>
        </p>
    </div>
</footer>

<?php include('./layouts/footer.php') ?>