<x-guest-layout>
    <style>
        body { background-color: #0a1f1a !important; }
        .guest-card {
            background-color: #0f2d26 !important;
            border-radius: 1.5rem !important;
        }
    </style>

   <div class="text-center mb-8">
    <h1 style="font-weight: 800; font-size: clamp(3rem, 8vw, 5rem); letter-spacing: -0.02em; line-height: 1; color: white;">
        <span style="color: #6ee7b7;">T</span>icketwave
    </h1>
    <p class="text-white font-semibold mt-3" style="font-size: 1.1rem;">
        Tu próximo gran momento empieza aquí
    </p>
</div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 style="text-align: center; color: white; font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">
    Inicio de sesión
</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-400 text-sm mb-1" for="email">Correo</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                style="background: transparent; border: 1px solid #4b5563; border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; width: 100%;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-2">
            <label class="block text-gray-400 text-sm mb-1" for="password">Contraseña</label>
            <input id="password" type="password" name="password" required
                style="background: transparent; border: 1px solid #4b5563; border-radius: 0.75rem; padding: 0.75rem 1rem; color: white; width: 100%;" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="text-right mb-6">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color: #9ca3af; font-size: 0.875rem;">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <button type="submit" style="width: 100%; background: #6ee7b7; color: #0a1f1a; font-weight: bold; padding: 0.75rem; border-radius: 9999px; border: none; cursor: pointer;">
            Iniciar sesión
        </button>
    </form>

    <div class="text-center mt-6">
        <p style="color: #9ca3af; font-size: 0.875rem;">¿No tienes una cuenta?</p>
        <a href="{{ route('register') }}" style="display: block; margin-top: 0.5rem; border: 1px solid #6ee7b7; color: #6ee7b7; font-weight: bold; padding: 0.75rem; border-radius: 9999px; text-align: center; text-decoration: none;">
            ¡Regístrate!
        </a>
    </div>
</x-guest-layout>