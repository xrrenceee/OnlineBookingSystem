<x-app-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at center, #0c1c3b 0%, #050a1f 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: -50%;
            width: 200%;
            height: 100%;
            background: repeating-linear-gradient(
                45deg,
                rgba(0, 200, 255, 0.08),
                rgba(0, 200, 255, 0.08) 2px,
                transparent 2px,
                transparent 8px
            );
            animation: mysticStreaks 6s linear infinite;
            z-index: 0;
        }

        @keyframes mysticStreaks {
            from { transform: translateX(0);}
            to { transform: translateX(-25%);}
        }

        .dashboard-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding: 3rem 1rem;
            max-width: 1200px;
            margin: auto;
        }

        .dashboard-header h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #ffd700;
            text-shadow: 2px 2px #003366;
        }

        .dashboard-header p {
            color: #66ccff;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .card-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .card {
            background-color: rgba(10, 20, 50, 0.85);
            border-radius: 1.2rem;
            padding: 2rem;
            border: 3px solid #ffd700;
            box-shadow:
                0 0 20px #00bfff,
                inset 0 0 10px #003366;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow:
                0 0 30px #00bfff,
                inset 0 0 15px #ffd700;
        }

        .card h2 {
            font-size: 1.8rem;
            color: #ffd700;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px #003366;
        }

        .card p {
            font-size: 1rem;
            color: #cce6ff;
        }

        .drawer-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 100;
            background: linear-gradient(45deg, #ffd700, #003366);
            color: #000;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.5rem;
            box-shadow: 0 0 15px #ffd700;
            transition: transform 0.3s ease;
        }

        .drawer-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 0 25px #ffd700;
        }

        .drawer {
            position: fixed;
            top: 0;
            left: -260px;
            width: 240px;
            height: 100%;
            background-color: #0a1b3b;
            border-right: 3px solid #ffd700;
            box-shadow: 0 0 30px rgba(0, 191, 255, 0.4);
            padding: 2rem 1rem;
            transition: left 0.3s ease;
            z-index: 99;
            display: flex;
            flex-direction: column;
        }

        .drawer.open {
            left: 0;
        }

        .drawer-links {
            margin-top: 35%;
            display: flex;
            flex-direction: column;
        }

        .drawer a {
            display: block;
            margin-bottom: 1rem;
            color: #ffd700;
            background: linear-gradient(45deg, #003366, #001122);
            padding: 0.7rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 0 15px #00bfff;
            transition: all 0.3s ease;
        }

        .drawer a:hover {
            transform: scale(1.1);
            box-shadow: 0 0 30px #ffd700;
        }
    </style>

    <!-- ☰ Toggle Button -->
    <div class="drawer-toggle" onclick="document.querySelector('.drawer').classList.toggle('open')">
        ☰
    </div>

    <!-- 🧙 Sidebar Drawer -->
    <div class="drawer">
        <div class="drawer-links">
            <a href="{{ url('/bookings/create') }}">🛡️ Create Booking</a>
            <a href="{{ url('/bookings') }}">📜 View Bookings</a>
            <a href="{{ url('/profile') }}">🧑‍🎓 Hero Management</a>
        </div>
    </div>

    <!-- 🏰 Main Dashboard -->
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>🏰 Mobile Legends Dashboard</h1>
            <p>Manage your realm like a legend from the Land of Dawn!</p>
        </header>

        <section class="card-grid">
            <!-- Total Bookings -->
            <div class="card">
                <h2>📦 Total Bookings</h2>
                <p>You currently have <strong>{{ $totalBookings }}</strong> booking{{ $totalBookings !== 1 ? 's' : '' }} in your arsenal.</p>
            </div>

            <!-- Total Users -->
            <div class="card">
                <h2>👥 Total Warriors</h2>
                <p>There {{ $totalUsers === 1 ? 'is' : 'are' }} <strong>{{ $totalUsers }}</strong> registered warrior{{ $totalUsers !== 1 ? 's' : '' }} in your squad.</p>
            </div>
        </section>
    </div>

    <script>
        window.addEventListener('click', function (e) {
            const drawer = document.querySelector('.drawer');
            const toggle = document.querySelector('.drawer-toggle');
            if (!drawer.contains(e.target) && !toggle.contains(e.target)) {
                drawer.classList.remove('open');
            }
        });
    </script>
</x-app-layout>
