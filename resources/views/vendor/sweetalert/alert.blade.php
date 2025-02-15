@if (Session::has('alert.config'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({!! Session::pull('alert.config') !!});
        });
    </script>
@endif
