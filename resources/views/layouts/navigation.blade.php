<nav x-data="{ open: false }">
    <style>
        /* Sliding text strip above navbar */
        .ml-banner {
            width: 100%;
            background: linear-gradient(90deg, #142850, #0a1b3b);
            overflow: hidden;
            position: relative;
            height: 40px;
            border-bottom: 2px solid #ffd700;
        }

        .ml-banner-text {
            white-space: nowrap;
            display: inline-block;
            font-weight: bold;
            font-size: 1.2rem;
            color: #ffd700;
            text-shadow: 0 0 10px #00bfff;
            animation: scrollLeft 12s linear infinite;
            padding-left: 100%;
        }

        @keyframes scrollLeft {
            0% {
                transform: translateX(0%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        /* Navbar styles from previous ML design */
        nav {
            background: linear-gradient(90deg, #0a1b3b, #142850);
            position: relative;
            overflow: hidden;
        }

        nav::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100px;
            width: 80px;
            height: 80px;
            background: url('https://upload.wikimedia.org/wikipedia/en/8/8f/Mobile_Legends_Bang_Bang_logo.png') no-repeat center;
            background-size: contain;
            opacity: 0.1;
            animation: sword-move 12s linear infinite;
            z-index: 1;
        }

        @keyframes sword-move {
            0% { left: -100px; top: 10px; }
            50% { left: 100%; top: 30px; }
            100% { left: -100px; top: 10px; }
        }

        .nav-container {
            position: relative;
            z-index: 10;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #ffd700;
        }

        .nav-left, .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-logo svg {
            height: 40px;
            fill: #ffd700;
            filter: drop-shadow(0 0 5px #00bfff);
        }

        .nav-link {
            color: #ffd700;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-link::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #ffd700, #00bfff, #ffd700);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .nav-link:hover::before {
            transform: scaleX(1);
        }

        .nav-link:hover {
            color: #00bfff;
            text-shadow: 0 0 10px #00bfff;
        }

        .nav-user-name {
            font-weight: bold;
            color: #ffd700;
            text-shadow: 0 0 10px #00bfff;
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: #ffd700;
            font-size: 1.8rem;
        }

        @media (max-width: 768px) {
            .nav-left > .nav-link,
            .nav-right {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .mobile-menu {
                display: block;
                background: rgba(10, 27, 59, 0.95);
                padding: 1rem 2rem;
                animation: fadeIn 0.3s ease-in-out;
            }
        }

        .mobile-menu a {
            display: block;
            color: #ffd700;
            margin-bottom: 1rem;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }

        .mobile-menu a:hover {
            color: #00bfff;
            text-shadow: 0 0 8px #00bfff;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    @php
        $unreadCount = Auth::user()->unreadNotifications->count();
    @endphp

    <!-- Sliding Text Banner -->
    <div class="ml-banner">
        <div class="ml-banner-text">
            IT KA AG MO ANTA &nbsp; • &nbsp; IT KA AG MO ANTA &nbsp; • &nbsp; IT KA AG MO ANTA
        </div>
    </div>

    <!-- Top Navigation -->
    <div class="nav-container">
        <!-- Left Side -->
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="nav-logo">
                <x-application-logo />
            </a>

            <a href="{{ route('dashboard') }}" class="nav-link">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Right Side -->
        <div class="nav-right">
            <span class="nav-user-name">👤 {{ Auth::user()->name }}</span>

            <a href="{{ route('notifications') }}" class="nav-link relative">
                🔔 Notifications
                @if ($unreadCount > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   class="nav-link"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>

        <!-- Hamburger Icon -->
        <button @click="open = !open" class="hamburger">
            ☰
        </button>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="open" class="mobile-menu">
        <span class="nav-user-name">👤 {{ Auth::user()->name }}</span>

        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>

        <a href="{{ route('notifications') }}" class="nav-link relative">
            🔔 Notifications
            @if ($unreadCount > 0)
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                    {{ $unreadCount }}
                </span>
            @endif
        </a>

        <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               class="nav-link"
               onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
    </div>
</nav>
