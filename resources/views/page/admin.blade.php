@include('components.admin-header')
@include('components.background')
@include('components.admin-sidebar')
<div class="main">
    @include('components.admin-navbar')
</div>
<script>
    document.title = 'Admin';
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(auth()->check())
            if ("{{ session('success') }}") {
                Swal.fire({
                    icon: 'success',
                    title: 'Hi {{auth()->user()->name}}',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        @endif
    });
</script>
@include('components.admin-footer')
