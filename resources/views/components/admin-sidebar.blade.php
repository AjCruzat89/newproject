<div class="d-none d-md-flex flex-column position-fixed vh-100 px-3 pt-5 pb-4 gap-3" id="sidebar">
    <span id="closeButton" class="d-flex d-md-none material-symbols-outlined">
        close
        </span>
    <a href="{{ route('adminPage') }}"><span class="material-symbols-outlined">
        home
        </span>Home</a>
    <a href="{{ route('inventoryPage') }}"><span class="material-symbols-outlined">
        inventory_2
        </span>Inventory</a>
    <a href="#">Items(NOT YET)</a>
    <a href="#">Sales(NOT YET)</a>
    @auth
        <form action="{{ route('logoutRequest') }}" method="post" style="margin-top: auto">
            @csrf
            <button class="btn btn-primary" type="submit">Logout</button>
        </form>
    @endauth
</div>