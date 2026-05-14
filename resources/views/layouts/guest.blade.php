<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TicketWave') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes slideDown {
                0%   { transform: translateY(0); }
                100% { transform: translateY(-50%); }
            }
            @keyframes slideUp {
                0%   { transform: translateY(-50%); }
                100% { transform: translateY(0); }
            }

            .col-down {
                animation: slideDown 30s linear infinite;
            }
            .col-up {
                animation: slideUp 30s linear infinite;
            }

            .poster-grid {
                position: fixed;
                inset: -20%;
                z-index: 0;
                display: grid;
                grid-template-columns: repeat(6, 1fr);
                gap: 6px;
                transform: rotate(-8deg) scale(1.2);
            }

            .poster-col {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .poster-item {
                flex-shrink: 0;
                height: 200px;
                border-radius: 6px;
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>

    <body class="font-sans antialiased" style="background-color: #060d0b; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1rem; position: relative; overflow: hidden;">

        {{-- FONDO TIPO NETFLIX CON ANIMACIÓN --}}
        @php
        $base = [
            asset('images/poster/btscon.jpg'),
            asset('images/poster/coldcon.jpg'),
            asset('images/poster/conc.jpg'),
            asset('images/poster/cone.jpg'),
            asset('images/poster/enhyepncon.jpg'),
            asset('images/poster/imaginecon.jpg'),
            asset('images/poster/jckcon.jpg'),
            asset('images/poster/manaconci.jpg'),
            asset('images/poster/mckcon.jpg'),
            asset('images/poster/ramsteincon.jpg'),
            asset('images/poster/siwftcon.jpg'),
            asset('images/poster/straycon.jpg'),
            asset('images/poster/tomocon.jpg'),
            asset('images/poster/tomorrow.jpg'),
        ];

        $cols = [];
        for ($i = 0; $i < 6; $i++) {
            $offset = $i * 2;
            $col = [];
            for ($j = 0; $j < count($base); $j++) {
                $col[] = $base[($j + $offset) % count($base)];
            }
            // Duplicar para loop infinito sin salto
            $cols[] = array_merge($col, $col);
        }
        @endphp

        <div class="poster-grid">
            @foreach($cols as $index => $col)
                @php
                    $duration = 25 + ($index * 4);
                    $dir = $index % 2 === 0 ? 'col-down' : 'col-up';
                @endphp
                <div class="poster-col <?php echo $dir; ?>" style="animation-duration: <?php echo $duration; ?>s;">
                    @foreach($col as $img)
                        <div class="poster-item" style="background-image: url('<?php echo $img; ?>');"></div>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- OVERLAY --}}
        <div style="position: fixed; inset: 0; z-index: 1; background: rgba(0,0,0,0.55);"></div>

        {{-- CONTENIDO PRINCIPAL --}}
<div style="position: relative; z-index: 2; width: 100%; max-width: 420px; background-color: rgba(15,45,38,0.85); backdrop-filter: blur(8px); border-radius: 1.5rem; padding: 2.5rem 2.5rem; box-shadow: 0 25px 50px rgba(0,0,0,0.5);">            {{ $slot }}
        </div>

        {{-- BOTÓN DE AYUDA --}}
        <div style="position: fixed; bottom: 1rem; left: 1rem; z-index: 3; background-color: rgba(15,45,38,0.9); color: #9ca3af; font-size: 0.75rem; padding: 0.75rem 1rem; border-radius: 0.5rem; display: flex; align-items: center; gap: 0.5rem; backdrop-filter: blur(4px);">
            <span style="border: 1px solid #9ca3af; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">?</span>
            <div>
                <p style="margin: 0; color: #d1fae5;">¿Necesitas ayuda?</p>
                <p style="margin: 0;">Centro de ayuda</p>
            </div>
        </div>

    </body>
</html>