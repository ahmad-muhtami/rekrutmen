</div>

<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Ahmad Muhtami 2026</span>
    </div>
  </div>
</footer>

</div>

</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="../assets/library/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../assets/library/sbadmin/js/sb-admin-2.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>


<script>
  $(document).ready(function() {
    $('#mytable').DataTable({
      "autoWidth": false,
      "language": {
        "lengthMenu": "Menampilkan _MENU_ data",
        "zeroRecords": "Tidak ada data yang ditemukan",
        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
        "infoEmpty": "Tidak ada data yang tersedia",
        "infoFiltered": "(difilter dari _MAX_ total data)",
        "search": "Cari:",
        "paginate": {
          "first": "Pertama",
          "last": "Terakhir",
          "next": "Berikutnya",
          "previous": "Sebelumnya"
        },
        "emptyTable": "Tidak ada data di dalam tabel",
        "loadingRecords": "Sedang memuat...",
        "processing": "Sedang memproses...",
        "thousands": ".",
        "decimal": ","
      }
    });
});


  $(document).ready(function() {
    $('#tableLaba').DataTable({
      "autoWidth": false,
      "searching" : false,
      "buttons": [{
          extend: 'pdfHtml5',
          exportOptions: {
            columns: ':not(:last-child)',
          },
          alignment: "center",
          customize: function(doc) {
            doc.content[1].table.widths =
              Array(doc.content[1].table.body[0].length + 1).join('*').split('');
          }
        },
        "colvis"
      ],
    }).buttons().container().appendTo('#tableLaba_wrapper .col-md-6:eq(0)');
  });


  


</script>

</body>

</html>
<?php
ob_end_flush();
?>