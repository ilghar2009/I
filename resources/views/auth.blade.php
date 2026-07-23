<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login/register</title>
  <style>
    * {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
      font-family: 'Vazirmatn', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(135deg, #0f0f0f, #1c1c1c, #101010);
      color: #fff;
    }

    .container {
      width: 360px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 20px;
      backdrop-filter: blur(12px);
      box-shadow: 0 0 25px rgba(0,0,0,0.6);
      padding: 30px;
      overflow: hidden;
      position: relative;
      transition: 0.5s;
    }

    .container h2 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: 500;
      letter-spacing: 1px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 7px 0;
      border: none;
      border-radius: 10px;
      background: rgba(255,255,255,0.08);
      color: #fff;
      outline: none;
      font-size: 15px;
      transition: 0.3s;
    }

    input:focus {
      background: rgba(255,255,255,0.15);
      box-shadow: 0 0 5px #4c8bf5;
    }

    button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      background: #4c8bf5;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
      transition: 0.3s;
    }

    button:hover {
      background: #6da3ff;
      transform: scale(1.02);
    }

    .switch {
      text-align: center;
      font-size: 14px;
      margin-top: 14px;
      color: #8ebaff;
      cursor: pointer;
    }

    .error {
      color: #ff6666;
      text-align: center;
      font-size: 14px;
      margin-top: 6px;
      min-height: 18px;
    }

    /* انیمیشن جابه‌جایی فرم‌ها */
    .forms {
      position: relative;
      height: 300px;
      width: 100%;
      overflow: hidden;
    }

    .form-box {
      position: absolute;
      width: 100%;
      transition: 0.7s;
      top: 0;
    }

    .signup {
      transform: translateX(100%);
      opacity: 0;
    }

    .container.active .signup {
      transform: translateX(0);
      opacity: 1;
    }

    .container.active .login {
      transform: translateX(-100%);
      opacity: 0;
    }

    /* واکنش‌گرا */
    @media (max-width: 480px) {
      .container {
        width: 90%;
        padding: 25px;
      }
      h2 {
        font-size: 18px;
      }
      button {
        font-size: 15px;
      }
    }

  </style>
</head>
<body>

  <div class="container" id="authBox">
    <div class="forms">
      <!-- 🟩 فرم ورود -->
      <div class="form-box login">
        <form action="{{route('auth')}}" method="post">
          @csrf
          <h2>ورود</h2>
          <input type="text" name="name" id="li_username" placeholder="نام کاربری">
          <input type="password" name="password" id="li_password" placeholder="رمز عبور">
          <input type="hidden" name="role" value="login">
          <button onclick="login()">ورود</button>
          <div class="switch" onclick="toggleForm()">ثبت‌نام ندارید؟ کلیک کنید</div>
          <div id="li_error" class="error">
            @if(isset($alertL) or isset(request()['alertL']))
              {{$alertL??request()['alertL']}}
            @endif
          </div>
        </form>
      </div>

      <!-- 🟦 فرم ثبت‌نام -->
      <div class="form-box signup">
        <form action="{{route('auth')}}" method="post">
          @csrf
          <h2>ثبت‌نام</h2>
{{--          <input type="text" id="su_name" name="name" placeholder="نام کامل">--}}
          <input type="text" id="su_username" name="name" placeholder="نام کاربری">
          <input type="password" id="su_password" name="password" placeholder="رمز عبور (حداقل ۸ کاراکتر)">
          <input type="hidden" name="role" value="sign">
          <button onclick="signup()">ثبت‌نام کنید</button>
          <div class="switch" onclick="toggleForm()">قبلاً ثبت‌نام کرده‌اید؟ ورود</div>
          <div id="su_error" class="error">
            @isset($alertS)
              {{$alertS}}
            @endisset
          </div>
        <form>
      </div>
    </div>
  </div>

  <script>
    const box = document.getElementById("authBox");

    function toggleForm() {
      box.classList.toggle('active');
      document.getElementById("li_error").innerText = '';
      document.getElementById("su_error").innerText = '';
    }

    function isStrongPassword(p) {
      return p.length >= 8 && /[A-Z]/.test(p) && /\d/.test(p);
    }

    function signup() {
      const name = su_name.value.trim();
      const user = su_username.value.trim();
      const pass = su_password.value;

      if (!name || !user || !pass) {
        su_error.innerText = "تمام فیلدها باید پر باشند.";
        return;
      }
      if (!isStrongPassword(pass)) {
        su_error.innerText = "رمز باید حداقل ۸ کاراکتر، دارای عدد و حرف بزرگ باشد.";
        return;
      }
      su_error.innerText = "";
      alert("ثبت‌نام با موفقیت انجام شد!");
      toggleForm();
    }

    function login() {
      const user = li_username.value.trim();
      const pass = li_password.value;

      if (!user || !pass) {
        li_error.innerText = "نام کاربری و رمز عبور اجباری است.";
        return;
      }
      li_error.innerText = "";
      // alert("ورود موفقیت‌آمیز!");
    }
  </script>

</body>
</html>
