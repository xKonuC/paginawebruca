<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['loginUser'] ?? '';
    $password = $_POST['loginPass'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin'] = $user['usuario'];
        header("Location: admin.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!-- HTML de login igual que antes, pero muestra $error si existe -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - La Ruca de los Monos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(120deg, #000 60%, #f0a500 100%);
            font-family: 'Arial', sans-serif;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: rgba(20, 20, 20, 0.98);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            padding: 40px 32px 32px 32px;
            width: 100%;
            max-width: 370px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-icon {
            font-size: 3.2em;
            color: #f0a500;
            margin-bottom: 18px;
        }
        .login-title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 18px;
            color: #f0a500;
            letter-spacing: 1px;
        }
        .login-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .login-input {
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #444;
            background: #181818;
            color: #fff;
            font-size: 1em;
            outline: none;
            transition: border 0.2s;
        }
        .login-input:focus {
            border: 1.5px solid #f0a500;
        }
        .login-btn {
            background: linear-gradient(90deg, #f0a500 60%, #ff8c00 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 13px 0;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s, transform 0.2s;
        }
        .login-btn:hover {
            background: linear-gradient(90deg, #ff8c00 60%, #f0a500 100%);
            transform: translateY(-2px) scale(1.03);
        }
        .login-error {
            color: #ff4d4d;
            background: rgba(255,77,77,0.08);
            border-radius: 6px;
            padding: 7px 10px;
            font-size: 0.98em;
            margin-bottom: 5px;
            display: none;
        }
        .back-link {
            margin-top: 22px;
            color: #f0a500;
            text-decoration: none;
            font-size: 1em;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #ff8c00;
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .login-container {
                padding: 28px 8px 22px 8px;
                max-width: 98vw;
            }
            .login-title {
                font-size: 1.3em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="login-title">Iniciar sesión</div>
        <form class="login-form" method="POST">
            <?php if (isset(
                $error)): ?>
                <div class="login-error" style="display:block;"><?php echo $error; ?></div>
            <?php endif; ?>
            <input type="text" class="login-input" name="loginUser" placeholder="Usuario o Email" autocomplete="username" required>
            <input type="password" class="login-input" name="loginPass" placeholder="Contraseña" autocomplete="current-password" required>
            <button type="submit" class="login-btn">Ingresar</button>
        </form>
        <a href="index.html" class="back-link"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
    </div>
</body>
</html> 