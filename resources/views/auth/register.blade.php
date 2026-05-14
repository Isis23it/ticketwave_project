<x-guest-layout>

    {{-- TÍTULO --}}
    <div class="text-center mb-8">
        <h1 style="font-weight: 800; font-size: clamp(2.5rem, 6vw, 4rem); letter-spacing: -0.02em; line-height: 1; color: white;">
            <span style="color: #6ee7b7;">T</span>icketwave
        </h1>
        <p style="color: white; font-weight: 600; margin-top: 0.75rem; font-size: 1rem;">
            Regístrate y accede a los mejores eventos en segundos.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- SECCIÓN: Información --}}
        <div style="margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
                <span style="color: #6ee7b7; font-weight: 700; font-size: 1rem;">Información básica</span>
                <div style="flex: 1; height: 1px; background-color: #6ee7b7; opacity: 0.4;"></div>
            </div>

            {{-- Name --}}
            <div style="margin-bottom: 1rem;">
                <label style="display: block; color: #9ca3af; font-size: 0.8rem; margin-bottom: 0.4rem;">Nombre</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    style="width: 100%; background: transparent; border: 1px solid #4b5563; border-radius: 0.75rem; padding: 0.65rem 1rem; color: white; font-size: 0.95rem; outline: none;" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            {{-- Email --}}
            <div style="margin-bottom: 1rem;">
                <label style="display: block; color: #9ca3af; font-size: 0.8rem; margin-bottom: 0.4rem;">Correo</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    style="width: 100%; background: transparent; border: 1px solid #4b5563; border-radius: 0.75rem; padding: 0.65rem 1rem; color: white; font-size: 0.95rem; outline: none;" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
        </div>

        {{-- SECCIÓN: Contraseña --}}
        <div style="margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
                <span style="color: #6ee7b7; font-weight: 700; font-size: 1rem;">Contraseña</span>
                <div style="flex: 1; height: 1px; background-color: #6ee7b7; opacity: 0.4;"></div>
            </div>

            {{-- Password --}}
            <div style="margin-bottom: 1rem;">
                <label style="display: block; color: #9ca3af; font-size: 0.8rem; margin-bottom: 0.4rem;">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    style="width: 100%; background: transparent; border: 1px solid #4b5563; border-radius: 0.75rem; padding: 0.65rem 1rem; color: white; font-size: 0.95rem; outline: none;" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            {{-- Confirm Password --}}
            <div>
                <label style="display: block; color: #9ca3af; font-size: 0.8rem; margin-bottom: 0.4rem;">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    style="width: 100%; background: transparent; border: 1px solid #4b5563; border-radius: 0.75rem; padding: 0.65rem 1rem; color: white; font-size: 0.95rem; outline: none;" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        {{-- BOTONES --}}
        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem;">
            <a href="{{ route('login') }}"
                style="padding: 0.65rem 1.5rem; border: 1px solid #6ee7b7; border-radius: 9999px; color: #6ee7b7; font-size: 0.9rem; text-decoration: none; font-weight: 600;">
                Cancelar
            </a>
            <button type="submit"
                style="padding: 0.65rem 1.5rem; background: #6ee7b7; color: #0a1f1a; font-weight: 700; border-radius: 9999px; border: none; cursor: pointer; font-size: 0.9rem;">
                ¡Regístrate!
            </button>
        </div>

    </form>
</x-guest-layout>