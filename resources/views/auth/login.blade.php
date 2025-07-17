<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - Mobile Legends</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: radial-gradient(circle at center, #0c1c3b 0%, #050a1f 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      overflow: hidden;
      position: relative;
    }

    /* Mystic glowing background lines */
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

    .login-container {
      position: relative;
      z-index: 1;
      background: rgba(0, 20, 40, 0.8);
      padding: 40px;
      width: 100%;
      max-width: 400px;
      border-radius: 16px;
      border: 3px solid #ffd700;
      box-shadow:
        0 0 25px #00bfff,
        inset 0 0 15px #003366;
      overflow: hidden;
    }

    .login-container::before {
      content: "";
      position: absolute;
      top: -10px;
      left: -10px;
      right: -10px;
      bottom: -10px;
      background: linear-gradient(135deg, #00bfff, #ffd700, #003366);
      filter: blur(20px);
      z-index: -1;
      opacity: 0.2;
    }

    h2 {
      text-align: center;
      font-size: 30px;
      margin-bottom: 10px;
      color: #ffd700;
      text-shadow: 2px 2px #003366;
    }

    p.description {
      text-align: center;
      font-size: 14px;
      color: #cce6ff;
      margin-bottom: 24px;
    }

    label {
      font-size: 13px;
      display: block;
      margin-bottom: 6px;
      color: #ffd700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      border-radius: 10px;
      background-color: #0a1b3b;
      border: 2px solid #335577;
      color: #fff;
      margin-bottom: 16px;
      transition: all 0.3s;
      font-size: 15px;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #00bfff;
      box-shadow: 0 0 10px #00bfff;
      outline: none;
    }

    .checkbox-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      margin-bottom: 20px;
      color: #ffd700;
    }

    .checkbox-container a {
      color: #66ccff;
      text-decoration: none;
    }

    .checkbox-container a:hover {
      text-decoration: underline;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      background: linear-gradient(45deg, #00bfff, #003366);
      color: #fff;
      cursor: pointer;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow:
        inset 0 0 10px #003366,
        0 0 10px #00bfff;
      position: relative;
      overflow: hidden;
      transition: 0.4s;
    }

    .submit-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -75%;
      width: 50%;
      height: 100%;
      background: linear-gradient(
        120deg,
        rgba(255,255,255,0.3) 0%,
        rgba(255,255,255,0) 100%
      );
      transform: skewX(-25deg);
      transition: 0.7s;
    }

    .submit-btn:hover::before {
      left: 125%;
    }

    .submit-btn:hover {
      background: linear-gradient(45deg, #66ccff, #003366);
      box-shadow:
        inset 0 0 20px #ffd700,
        0 0 20px #ffd700;
    }

    .footer-text {
      text-align: center;
      margin-top: 20px;
      font-size: 13px;
      color: #ffd700;
    }

    .footer-text a {
      color: #66ccff;
      text-decoration: none;
      font-weight: bold;
    }

    .footer-text a:hover {
      text-decoration: underline;
    }

    .session-status {
      color: #66ffcc;
      text-align: center;
      margin-bottom: 14px;
      font-size: 13px;
    }

    .error-message {
      color: #ff6b6b;
      text-align: center;
      margin-bottom: 14px;
      font-size: 13px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>MOBAI LIGINDS</h2>
    <p class="description">BISAYA KA? OPEN NA</p>

    <!-- Session Status -->
    @if (session('status'))
      <div class="session-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <label for="email">Emil</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
      @error('email')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <label for="password">Pasworld</label>
      <input type="password" id="password" name="password" required placeholder="••••••••">
      @error('password')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <div class="checkbox-container">
        <label><input type="checkbox" name="remember"> Alalahanin mo ako</label>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}">Forgot password?</a>
        @endif
      </div>

      <button type="submit" class="submit-btn">ANO JAY?</button>
    </form>

    <p class="footer-text">
      Don’t have an account?
      <a href="{{ route('register') }}">Create Your Squad</a>
    </p>
  </div>

</body>
</html>
