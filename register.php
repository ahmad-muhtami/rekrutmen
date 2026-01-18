<?php include('./layouts/header.php') ?>
<?php 
      session_start();
?>
<title>Pendaftaran</title>
<div class="w-full overflow-y-auto h-full grid grid-cols-1 px-0 py-20" style="z-index: 40;">
  <div class="flex items-center h-full justify-center z-30">
    <div class="">
      <div class="w-20 h-20 rounded-full overflow-hidden mx-auto border-2 border-black mb-2">
        <img src="./assets/img/hatara.jpg" class="w-full h-full object-cover" alt="">
      </div>
      <h1 class="text-center text-2xl font-semibold capitalize text-black">Aplikasi Rekrutmen & Seleksi <br> Karyawan Kedai Kopi Hatara
        <span class="block text-xs font-normal text-black lowercase">Isi formulir berikut untuk mendaftar</span>
      </h1>
      <?php
      if (isset($_SESSION['result'])) {
        if ($_SESSION['result'] != 'success') {
      ?>
          <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-300 max-w-[300px] mx-auto mt-5" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div>
              <span class="font-medium">Maaf!</span> <?= $_SESSION['message'] ?>
            </div>
          </div>
      <?php
        }
        unset($_SESSION['result']);
        unset($_SESSION['message']);
      }
      ?>
      <form class="mt-8" action="config/register.php" method="POST">
        <div class="mb-5">
          <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg placeholder:text-xs focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>
        <div class="mb-5">
          <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
          <input type="tel" id="nomor_telepon" name="nomor_telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg placeholder:text-xs focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>
        <div class="mb-5">
          <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Nama Pengguna</label>
          <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg placeholder:text-xs focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Kata Sandi</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg placeholder:text-xs focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>
        <div class="w-full gap-1">
          <button type="submit" class="w-full block text-white bg-black hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center">Daftar</button>
        </div>
        <p class="text-center mb-1.5"><small>Sudah memiliki akun? <a href="login.php" class="text-blue-700 font-bold">Masuk</a></small></p>
      </form>
    </div>
  </div>
  
  
</div>

<div class="w-full text-center bg-white justify-center py-5 border-t sticky bottom-0 left-0 right-0 text-sm font-normal text-black/50" style="z-index: 50;">
<span>Copyright &copy; Ahmad Muhtami 2026</span>

</div>


<?php include('./layouts/footer.php') ?>