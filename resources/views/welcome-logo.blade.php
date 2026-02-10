<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <title>Marriage Certificate System</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .container {
            text-align: center;
        }
        .logo {
            max-width: 600px;
            width: 80%;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }
        .blend-remove-white {
            mix-blend-mode: multiply;
            filter: contrast(1.15) saturate(1.1);
        }
        .bg-blur {
            position: fixed;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(12px);
            transform: scale(1.05);
            z-index: -1;
            pointer-events: none;
        }
        .hint {
            font-size: 12pt;
            color: #555;
        }
    </style>
</head>
<body
    @php
        $bgCandidates = [
            'images/sogod-municipal.jpg',
            'images/sogod-municipal.jpeg',
            'images/sogod-municipal.png',
            'sogod-municipal.jpg',
            'sogod-municipal.jpeg',
            'sogod-municipal.png',
        ];
        $bgFound = null;
        foreach ($bgCandidates as $bp) {
            if (file_exists(public_path($bp))) { $bgFound = $bp; break; }
        }
    @endphp
>
    @if ($bgFound)
        <div class="bg-blur" style="background-image: url('{{ asset($bgFound) }}');"></div>
    @endif
    @php
        $candidates = [
            'images/sogod-logo.png',
            'images/sogod-logo.jpg',
            'images/sogod-logo.gif',
            'sogod-logo.png',
            'sogod-logo.jpg',
            'sogod-logo.gif',
        ];
        $found = null;
        foreach ($candidates as $p) {
            if (file_exists(public_path($p))) {
                $found = $p;
                break;
            }
        }
    @endphp
    <div class="container">
        @if ($found)
            @php
                $ext = strtolower(pathinfo($found, PATHINFO_EXTENSION));
                $needsBlend = in_array($ext, ['gif','jpg','jpeg']);
            @endphp
            <img class="logo {{ $needsBlend ? 'blend-remove-white' : '' }}" src="{{ asset($found) }}" alt="Municipality of Sogod, Southern Leyte Logo">
        @else
            <div class="hint" style="margin-bottom: 20px;">
                Logo file not found. Place it at public/images/sogod-logo.gif (or .png / .jpg)
            </div>
        @endif
        <div class="hint">Press any key or click to continue</div>
    </div>
    <script>
        function go() {
            window.location.href = "{{ url('/marriage-certificate') }}";
        }
        document.addEventListener('keydown', go);
        document.addEventListener('click', go);
        document.addEventListener('touchstart', go, { once: true });

        // Register Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    })
                    .catch(err => {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });
        }
    </script>
</body>
</html>
