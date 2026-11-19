<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Admin SURGE | Login</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div id="login-screen">
        <div class="login-box">
            <h2 style="color:#142844; font-style:italic;">SURGE</h2>
            <div class="form-group">
                <input type="email" id="email" placeholder="E-mail" value="admin@surge.com">
            </div>
            <div class="form-group">
                <input type="password" id="password" placeholder="Senha" value="admin123">
            </div>
            <button class="btn" style="width:100%;" onclick="login()">Entrar</button>
        </div>
    </div>
    <script>
        async function login() {
            const res = await fetch('/SURGE/Backend/public/api/admin/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value
                })
            });
            if (res.ok) {
                window.location.href = 'dashboard.php';
            } else {
                alert('Login inválido');
            }
        }
    </script>
</body>
</html>