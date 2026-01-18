<?php include('./layouts/header.php') ?>
<?php
session_start();
?>
<title>Login</title>
<div class="w-full h-[90vh] overflow-hidden grid grid-cols-1 p-0">
  <div class="flex items-center h-full justify-center z-30">
    <div>
      <div class="w-20 h-20 rounded-full overflow-hidden mx-auto border-2 border-black mb-2">
        <img src="./assets/img/hatara.jpg" class="w-full h-full object-cover" alt="">
      </div>
      <h1 class="text-center text-2xl font-semibold capitalize text-black">Aplikasi Rekrutmen & Seleksi <br> Karyawan Kedai Kopi Hatara
        <span class="block text-xs font-normal text-black lowercase">Harap masuk untuk melanjutkan</span>
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

      <form class="mt-8" action="config/login_proses.php" method="POST">
        <div class="mb-5">
          <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Nama Pengguna</label>
          <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg placeholder:text-xs focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>
        <div class="mb-2">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Kata Sandi</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg placeholder:text-xs focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>
        <div class="w-full gap-1 mt-5 mb-3">
          <button type="submit" class="w-full block text-white bg-black hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center">Masuk</button>
        </div>
        <p class="text-sm font-normal text-black mb-3 text-center">Belum memiliki akun? <a href="register.php" class="text-indigo-700">Buat Akun</a></p>
      </form>
    </div>
  </div>
  <div class="absolute inset-0 z-20 lg:hidden z-[21] bg-gradient-to-tr from-white/50 to-blue-500/50 backdrop-blur-sm">
  </div>

</div>

<div class="w-full text-center justify-center py-5 border-t fixed bottom-0 left-0 right-0 text-sm font-normal text-black/50">
  <span>Copyright &copy; Ahmad Muhtami 2026</span>

</div>








<?php include('./layouts/footer.php') ?>