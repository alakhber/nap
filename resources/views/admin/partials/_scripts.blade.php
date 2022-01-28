  <!-- jQuery -->
  <script src="{{ asset('project/backend/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('project/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('project/backend/js/adminlte.min.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('_scripts')

  <script>
    $(document).ready(function() {
        $('.logOut').on('click', function() {
            Swal.fire({
                title: 'Xəbərdarlıq !',
                text: "Çıxmaq İstədiyinizə Əminsiniz ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Xeyr !',
                confirmButtonText: 'Bəli !'
            }).then((result) => {
                if (result.value) {
                    $(this).find('form').submit();
                }
            });
        })
    });
</script>