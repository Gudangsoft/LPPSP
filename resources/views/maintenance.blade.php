<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance – {{ isset($profile) && $profile->nama_lembaga ? $profile->nama_lembaga : 'LPPSP' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0d2b5e 0%, #1a4a9e 40%, #0f4c81 70%, #0d2b5e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background circles */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            animation: float 8s ease-in-out infinite;
        }
        .bg-circle:nth-child(1) { width: 400px; height: 400px; top: -100px; right: -100px; animation-delay: 0s; }
        .bg-circle:nth-child(2) { width: 300px; height: 300px; bottom: -80px; left: -80px; animation-delay: 3s; }
        .bg-circle:nth-child(3) { width: 200px; height: 200px; top: 50%; left: 10%; animation-delay: 5s; }
        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }

        .card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 24px;
            padding: 56px 48px;
            max-width: 560px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 32px 80px rgba(0,0,0,0.35);
            animation: cardIn 0.6s cubic-bezier(0.16,1,0.3,1);
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .icon-wrap {
            width: 88px; height: 88px;
            background: rgba(245,158,11,0.15);
            border: 2px solid rgba(245,158,11,0.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 28px;
            animation: pulse 2.5s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(245,158,11,0.3); }
            50%       { box-shadow: 0 0 0 16px rgba(245,158,11,0); }
        }
        .icon-wrap i { font-size: 2.4rem; color: #f59e0b; }

        .logo-text {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            margin-bottom: 16px;
        }
        h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 16px;
            line-height: 1.2;
        }
        .subtitle {
            font-size: 1rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .divider {
            width: 48px; height: 3px;
            background: linear-gradient(90deg, #f59e0b, #fcd34d);
            border-radius: 2px;
            margin: 0 auto 28px;
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.5);
        }
        .info-row i { color: #f59e0b; }

        .admin-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.35);
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s;
        }
        .admin-link:hover {
            color: rgba(255,255,255,0.7);
            border-color: rgba(255,255,255,0.25);
            background: rgba(255,255,255,0.06);
        }

        /* Animated dots */
        .dots { display: flex; align-items: center; justify-content: center; gap: 6px; margin-bottom: 28px; }
        .dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            animation: blink 1.4s ease-in-out infinite;
        }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink {
            0%, 80%, 100% { opacity: 0.3; transform: scale(1); }
            40% { opacity: 1; transform: scale(1.3); background: #f59e0b; }
        }

        @media (max-width: 480px) {
            .card { padding: 40px 24px; }
            h1 { font-size: 1.6rem; }
        }
    </style>
</head>
<body>
    <div class="bg-circle"></div>
    <div class="bg-circle"></div>
    <div class="bg-circle"></div>

    <div class="card">
        <p class="logo-text">{{ isset($profile) && $profile->singkatan ? $profile->singkatan : 'LPPSP' }}</p>

        <div class="icon-wrap">
            <i class="fas fa-tools"></i>
        </div>

        <h1>Sedang dalam Pemeliharaan</h1>

        <div class="divider"></div>

        <p class="subtitle">
            @if(isset($pesan) && $pesan)
                {{ $pesan }}
            @else
                Website sedang dalam proses pemeliharaan dan akan segera kembali.
                Terima kasih atas kesabaran Anda.
            @endif
        </p>

        <div class="dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

        <div class="info-row">
            <i class="fas fa-clock"></i>
            <span>Proses berlangsung sebentar lagi</span>
        </div>

        <br>

        <a href="{{ route('admin.login') }}" class="admin-link">
            <i class="fas fa-lock"></i> Login Admin
        </a>
    </div>
</body>
</html>
