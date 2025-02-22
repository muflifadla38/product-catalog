<div class="sidebar d-flex flex-column">
    <div class="d-flex align-items-center my-3 p-3">
        <a href="{{ route('product.lists.index') }}" class="d-flex justify-content-center align-items-center me-5">
            <img src="{{ asset('assets/images/handbag.png') }}" class="me-2" alt="logo">
            <span class="fw-semibold">{{ config('app.name', 'SIMS Web App') }}</span>
        </a>
        <button id="menu" class="bg-transparent border-0 text-white d-flex align-items-center">
            <ion-icon name="menu-outline" size="small"></ion-icon>
        </button>
    </div>
    <nav>
        <ul class="nav flex-column">
            <x-nav-item label="Produk" icon="package" route="product.lists" routeType="index" />
            <x-nav-item label="Profil" icon="user" route="profile" routeType="index" />
            <x-nav-item id="logout" label="Logout" icon="sign-out">
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </x-nav-item>
        </ul>
    </nav>
</div>

@push('scripts')
    <script>
        $('#logout').click(function(event) {
            event.preventDefault();

            if (confirm('Yakin ingin logout?')) {
                $('#logout-form').submit();
            }
        });
    </script>
@endpush
