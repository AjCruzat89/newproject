@include('components.formheader')
@include('components.background')
<form action="{{ route('resetPasswordRequest', ['token' => $token]) }}" method="POST">
    @csrf
    <div class="d-flex justify-content-center align-items-center vh-100 vw-100 overflow-hidden">
        <div class="box d-flex flex-column p-3">
            <h1 class="text-center p-3">Reset Password</h1>
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger d-flex align-items-center">{{ $error }}</div>
            @endforeach
            <label for="" class="mt-3">New Password</label>
            <input type="password" name="password" id="" placeholder="Enter Password...">
            <label for="" class="mt-3">Re-Enter New Password</label>
            <input type="password" name="password_confirmation" id="" placeholder="Enter Password...">
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            <a href="{{ route('loginPage') }}" class="text-center mt-3">Return to Login...</a>
        </div>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ("{{ session('success') }}") {
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
</script>
<script>
    document.title = 'Reset Password';
</script>
@include('components.formfooter')
