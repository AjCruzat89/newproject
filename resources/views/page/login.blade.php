@include('components.formheader')
@include('components.background')
<form action="{{ route('loginRequest') }}" method="POST">
    @csrf
    <div class="d-flex justify-content-center align-items-center vh-100 vw-100 overflow-hidden">
        <div class="box d-flex flex-column p-3">
            <h1 class="text-center p-3">Login</h1>
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger d-flex align-items-center">{{ $error }}</div>
            @endforeach
            <label for="">Email</label>
            <input type="text" name="email" id="" placeholder="Email...">
            <label for="" class="mt-3">Password</label>
            <input type="password" name="password" id="" placeholder="Password...">
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            <a href="{{ route('registerPage') }}" class="text-center mt-3">Dont have an account? Register here...</a>
            <a href="{{ route('forgotPassword') }}" class="text-center mt-1 mb-3">Forgot Password?</a>
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
    document.title = 'Login';
</script>
@include('components.formfooter')
