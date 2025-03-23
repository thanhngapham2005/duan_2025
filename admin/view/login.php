<?php
session_start();
ob_start();

require_once __DIR__ . '/../../commoms/function.php';
require_once __DIR__ . '/../../model/userModel.php';
$thongbao = ''; // Khởi tạo biến thông báo lỗi

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dangnhap'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $checkuser = checkUser($email, $password);

        if ($checkuser) {
            if ($checkuser['role'] == 2) { // Kiểm tra nếu là admin (role = 1)
                $_SESSION['user'] = $checkuser;
                $_SESSION['role'] = $checkuser['role'];
                header('Location: ../'); // Điều hướng ra ngoài thư mục cha
                exit;
            } else {
                $thongbao = "❌ Bạn không có quyền truy cập!";
            }
        } else {
            $thongbao = "❌ Tài khoản hoặc mật khẩu không đúng!";
        }
    } else {
        $thongbao = "⚠️ Vui lòng nhập đầy đủ thông tin!";
    }
}

?>


<!doctype html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Login</title>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Quicksand', sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #000;
    }

    section {
        position: absolute;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2px;
        flex-wrap: wrap;
        overflow: hidden;
    }

    section::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(#000, #0f0, #000);
        animation: animate 5s linear infinite;
    }

    @keyframes animate {
        0% {
            transform: translateY(-100%);
        }

        100% {
            transform: translateY(100%);
        }
    }

    section span {
        position: relative;
        display: block;
        width: calc(6.25vw - 2px);
        height: calc(6.25vw - 2px);
        background: #181818;
        z-index: 2;
        transition: 1.5s;
    }

    section span:hover {
        background: #0f0;
        transition: 0s;
    }

    section .signin {
        position: absolute;
        width: 400px;
        background: #222;
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
        border-radius: 4px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 9);
    }

    section .signin .content {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 40px;
    }

    section .signin .content h2 {
        font-size: 2em;
        color: #0f0;
        text-transform: uppercase;
    }

    section .signin .content .form {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    section .signin .content .form .inputBox {
        position: relative;
        width: 100%;
    }

    section .signin .content .form .inputBox input {
        position: relative;
        width: 100%;
        background: #333;
        border: none;
        outline: none;
        padding: 25px 10px 7.5px;
        border-radius: 4px;
        color: #fff;
        font-weight: 500;
        font-size: 1em;
    }

    section .signin .content .form .inputBox i {
        position: absolute;
        left: 0;
        padding: 15px 10px;
        font-style: normal;
        color: #aaa;
        transition: 0.5s;
        pointer-events: none;
    }

    .signin .content .form .inputBox input:focus~i,
    .signin .content .form .inputBox input:valid~i {
        transform: translateY(-7.5px);
        font-size: 0.8em;
        color: #fff;
    }

    .signin .content .form .links {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .signin .content .form .links a {
        color: #fff;
        text-decoration: none;
    }

    .signin .content .form .links a:nth-child(2) {
        color: #0f0;
        font-weight: 600;
    }

    .signin .content .form .inputBox input[type="submit"] {
        padding: 10px;
        background: #0f0;
        color: #000;
        font-weight: 600;
        font-size: 1.35em;
        letter-spacing: 0.05em;
        cursor: pointer;
        margin-top: -25px;
    }

    input[type="submit"]:active {
        opacity: 0.6;
    }

    @media (max-width: 900px) {
        section span {
            width: calc(10vw - 2px);
            height: calc(10vw - 2px);
        }
    }

    @media (max-width: 600px) {
        section span {
            width: calc(20vw - 2px);
            height: calc(20vw - 2px);
        }
    }
    </style>

</head>

<body>
    <!-- partial:index.partial.html -->

    <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
        <span></span> <span></span> <span></span> <span></span> <span></span>

        <div class="signin">

            <div class="content">

                <h2>Sign In</h2>

                <?php if (!empty($thongbao)) : ?>
                <p style="color: red; font-weight: bold; text-align: center;"><?php echo $thongbao; ?></p>
                <?php endif; ?>

                <form class="form" action="login.php" method="POST">
                    <div class="inputBox">

                        <input type="email" name="email"> <i>Username</i>

                    </div>

                    <div class="inputBox">

                        <input type="password" name="password"> <i>Password</i>

                    </div>

                    <div class="links">

                    </div>

                    <div class="inputBox">

                        <input type="submit" name="dangnhap" value="Login">

                    </div>
                </form>


            </div>

        </div>

    </section> <!-- partial -->

</body>

</html>