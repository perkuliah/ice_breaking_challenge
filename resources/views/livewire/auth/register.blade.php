@section('title', 'Register')
<div>
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo mb-4">
                    <a href="#">
                        <img src="{{ asset('images/adu.png') }}" alt="Logo" class="img-fluid" style="width: 160px; height: auto;">
                    </a>
                </div>

                <h1 class="auth-title">Register</h1>
                <p class="auth-subtitle mb-5">Masukkan username, email, atau WhatsApp serta password.</p>

                <form wire:submit.prevent="register" novalidate>
                    {{-- ID User field --}}
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="name" class="form-label visually-hidden">Full Name</label>
                        <input
                            wire:model.defer="name"
                            type="text"
                            id="name"
                            class="form-control form-control-xl @error('name') is-invalid @enderror"
                            placeholder="Full Name"
                            autocomplete="username">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email field --}}
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="email" class="form-label visually-hidden">Email</label>
                        <input
                            wire:model.defer="email"
                            type="text"
                            id="email"
                            class="form-control form-control-xl @error('email') is-invalid @enderror"
                            placeholder="Email"
                            autocomplete="email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- WhatsApp field --}}
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="whatsapp" class="form-label visually-hidden">WhatsApp</label>
                        <input
                            wire:model.defer="whatsapp"
                            type="text"
                            id="whatsapp"
                            class="form-control form-control-xl @error('whatsapp') is-invalid @enderror"
                            placeholder="WhatsApp"
                            autocomplete="whatsapp">
                        <div class="form-control-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        @error('whatsapp')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password field --}}
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="password" class="form-label visually-hidden">Password</label>
                        <input
                            wire:model.defer="password"
                            type="password"
                            id="password"
                            class="form-control form-control-xl @error('password') is-invalid @enderror"
                            placeholder="Password"
                            autocomplete="current-password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password Confirmation field --}}
                    <div class="form-group position-relative has-icon-left mb-4">
                        <label for="password_confirmation" class="form-label visually-hidden">Password Confirmation</label>
                        <input
                            wire:model.defer="password_confirmation"
                            type="password_confirmation"
                            id="password_confirmation"
                            class="form-control form-control-xl @error('password_confirmation') is-invalid @enderror"
                            placeholder="Password Confirmation"
                            autocomplete="current-password_confirmation">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember --}}
                    <div class="form-check form-check-lg d-flex align-items-end mb-3">
                        <input wire:model="remember" class="form-check-input me-2" type="checkbox" id="remember">
                        <label class="form-check-label text-gray-600" for="remember">Keep me logged in</label>
                    </div>

                    {{-- Submit button --}}
                    <button
                        type="submit"
                        class="btn btn-primary btn-block btn-lg shadow-lg mt-3"
                        wire:loading.attr="disabled"
                        wire:target="login">
                        <span wire:loading.remove wire:target="register">Register</span>
                        <span wire:loading wire:target="register">Loading...</span>
                    </button>
                </form>

                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" wire:navigate class="font-bold">Login</a>.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                {{-- ilustrasi atau background --}}
            </div>
        </div>
    </div>
</div>
