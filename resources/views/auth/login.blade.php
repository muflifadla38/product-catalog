<x-main-layout>
    <div class="d-flex justify-content-end vh-100">
        <div class="w-50 d-flex justify-content-center align-items-center">
            <div class="w-75 text-center">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/images/handbag.png') }}" class="invert me-2" alt="logo">
                    <span class="h5 mb-0 fw-bolder">{{ config('app.name', 'SIMS Web App') }}</span>
                </div>
                <div class="my-5 mx-5">
                    <span class="h3 fw-bold">Masuk atau buat akun untuk memulai</span>
                </div>
                <div class="mx-5">
                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf

                        @if (session('message'))
                            <div class="mb-4">
                                <x-alert message="{{ session('message') }}" />
                            </div>
                        @endif

                        <div class="input-group mb-4">
                            <span class="input-group-text bg-transparent border border-end-0 text-secondary">@</span>
                            <input type="email"
                                class="form-control shadow-none border rounded-1 border-start-0 ps-0 text-secondary  @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="masukkan email anda"
                                value="{{ old('email') }}" required>

                            @error('email')
                                <x-invalid-feedback :message="$message" />
                            @enderror
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-transparent border border-end-0 text-secondary">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <input type="password" id="password" name="password"
                                class="form-control shadow-none border rounded-1 border-start-0 border-end-0 ps-0 text-secondary @error('password') is-invalid @enderror"
                                placeholder="masukkan password anda" required>

                            <button
                                class="btn btn-outline-secondary d-flex align-items-center bg-transparent border border-start-0 text-secondary"
                                type="button" id="toggle-password" aria-label="Show password">
                                <ion-icon id="password-icon" name="eye-outline"></ion-icon>
                            </button>

                            @error('password')
                                <x-invalid-feedback :message="$message" />
                            @enderror
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-danger rounded-1 mb-3 w-100">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-50 d-flex">
            <img src="{{ asset('assets/images/frame-98699.png') }}" class="w-100 object-fit-cover" alt="logo">
        </div>
    </div>

    @push('scripts')
        <script>
            const togglePassword = $('#toggle-password');
            const password = $('#password');
            const passwordIcon = $('#password-icon');

            togglePassword.click(function() {
                const isPasswordVisible = password.attr('type') === 'password';

                let type = 'password';
                let icon = 'eye-outline';
                let ariaLabel = 'Show password';
                if (isPasswordVisible) {
                    type = 'text';
                    icon = 'eye-off-outline';
                    ariaLabel = 'Hide password';
                }

                password.attr('type', type);
                passwordIcon.attr('name', icon);
                $(this).attr('aria-label', ariaLabel);
            });
        </script>
    @endpush
</x-main-layout>
