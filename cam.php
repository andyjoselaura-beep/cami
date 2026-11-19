<?php
session_start();

// Contraseña de acceso (puedes cambiarla aquí)
$CONTRASENA_CORRECTA = "Camila2026";
$error = "";

// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Validar contraseña enviada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $clave_ingresada = trim($_POST['password']);
    if ($clave_ingresada === $CONTRASENA_CORRECTA) {$_SESSION['acceso_concedido'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = "Contraseña incorrecta. Inténtalo de nuevo.";
    }
}

$autenticado = isset($_SESSION['acceso_concedido']) &&$_SESSION['acceso_concedido'] === true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Para Camila • Fe, Amistad y Cariño</title>
    <style>
        :root {
            --rojo-oscuro: #3b050c;
            --rojo-vino: #6e0d1a;
            --rojo-carmesi: #a81529;
            --rojo-rubi: #d62839;
            --rojo-rosa: #ff6b7b;
            --rojo-suave: #f8d7da;
            --crema-calido: #fff5f5;
            --dorado-suave: #ffd89b;
            --texto-claro: #fffafa;
            --texto-oscuro: #2b060b;
            --borde-dorado: rgba(255, 215, 160, 0.35);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at top, var(--rojo-carmesi) 0%, var(--rojo-vino) 45%, var(--rojo-oscuro) 100%);
            color: var(--texto-claro);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }

        /* Fondo animado de flores y pétalos flotando */
        .lluvia-flores {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .flor-flotante {
            position: absolute;
            top: -10%;
            font-size: 1.5rem;
            opacity: 0.75;
            animation: caerFlor linear infinite;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.35));
        }

        .flor-flotante:nth-child(1)  { left: 6%;  animation-duration: 11s; animation-delay: 0s;   font-size: 1.3rem; }
        .flor-flotante:nth-child(2)  { left: 16%; animation-duration: 14s; animation-delay: 2s;   font-size: 1.8rem; }
        .flor-flotante:nth-child(3)  { left: 28%; animation-duration: 10s; animation-delay: 4s;   font-size: 1.4rem; }
        .flor-flotante:nth-child(4)  { left: 39%; animation-duration: 15s; animation-delay: 1s;   font-size: 1.7rem; }
        .flor-flotante:nth-child(5)  { left: 52%; animation-duration: 12s; animation-delay: 3s;   font-size: 1.5rem; }
        .flor-flotante:nth-child(6)  { left: 64%; animation-duration: 16s; animation-delay: 0.5s; font-size: 1.9rem; }
        .flor-flotante:nth-child(7)  { left: 75%; animation-duration: 11s; animation-delay: 5s;   font-size: 1.3rem; }
        .flor-flotante:nth-child(8)  { left: 86%; animation-duration: 13s; animation-delay: 2.5s; font-size: 1.6rem; }
        .flor-flotante:nth-child(9)  { left: 93%; animation-duration: 14s; animation-delay: 6s;   font-size: 1.4rem; }
        .flor-flotante:nth-child(10) { left: 45%; animation-duration: 17s; animation-delay: 7s;   font-size: 1.6rem; }

        @keyframes caerFlor {
            0% {
                transform: translateY(-10vh) translateX(0) rotate(0deg) scale(0.9);
                opacity: 0;
            }
            15% {
                opacity: 0.85;
            }
            50% {
                transform: translateY(45vh) translateX(22px) rotate(180deg) scale(1.05);
            }
            85% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(112vh) translateX(-18px) rotate(360deg) scale(0.95);
                opacity: 0;
            }
        }

        /* Flor decorativa animada en CSS */
        .flor-css {
            display: inline-block;
            animation: latidoFlor 3.2s ease-in-out infinite;
        }

        @keyframes latidoFlor {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50%      { transform: scale(1.16) rotate(8deg); }
        }

        /* Tarjeta de acceso */
        .login-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            background: rgba(59, 5, 12, 0.88);
            border: 1px solid var(--borde-dorado);
            border-radius: 20px;
            padding: 36px 28px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(8px);
            text-align: center;
        }

        .simbolo-fe {
            font-size: 2.6rem;
            color: #ff9aa2;
            margin-bottom: 10px;
        }

        .login-card h1 {
            font-size: 1.6rem;
            margin-bottom: 8px;
            color: #ffe5e8;
        }

        .login-card p.sub {
            font-size: 0.95rem;
            color: var(--rojo-suave);
            margin-bottom: 24px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 6px;
            color: #ffd6db;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #c92a3d;
            background: #240307;
            color: #ffffff;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        input[type="password"]:focus {
            border-color: #ff6b7b;
            box-shadow: 0 0 0 3px rgba(214, 40, 57, 0.35);
        }

        .btn-rojo {
            width: 100%;
            padding: 12px 18px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--rojo-rubi), var(--rojo-carmesi));
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, filter 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 20px rgba(214, 40, 57, 0.4);
        }

        .btn-rojo:hover {
            filter: brightness(1.08);
            transform: translateY(-1px);
        }

        .error-msg {
            background: rgba(214, 40, 57, 0.22);
            border: 1px solid #ff6b7b;
            color: #ffd1d6;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 16px;
        }

        /* Espacio privado para Camila */
        .contenedor-principal {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 880px;
            background: var(--crema-calido);
            color: var(--texto-oscuro);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.55);
            border: 2px solid #e06c78;
        }

        .encabezado {
            background: linear-gradient(120deg, var(--rojo-carmesi), var(--rojo-vino));
            color: var(--texto-claro);
            padding: 28px 32px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .encabezado h1 {
            font-size: 1.8rem;
            letter-spacing: 0.3px;
        }

        .encabezado span {
            font-size: 0.94rem;
            color: var(--rojo-suave);
        }

        .btn-salir {
            display: inline-block;
            padding: 9px 16px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.35);
            transition: background 0.2s;
        }

        .btn-salir:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        /* Sección destacada con ilustración de Jesús */
        .seccion-jesus {
            background: linear-gradient(180deg, #fff0f2 0%, #ffe4e8 100%);
            border-bottom: 1px solid #f4b6be;
            padding: 28px 24px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 24px;
            text-align: left;
        }

        .marco-jesus {
            width: 145px;
            height: 145px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff8e7 0%, #ffd6db 70%, #e06c78 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 28px rgba(214, 40, 57, 0.35);
            border: 3px solid var(--rojo-carmesi);
            animation: auraSagrada 4s ease-in-out infinite;
            flex-shrink: 0;
        }

        @keyframes auraSagrada {
            0%, 100% { box-shadow: 0 0 22px rgba(214, 40, 57, 0.32); transform: translateY(0); }
            50%      { box-shadow: 0 0 36px rgba(255, 193, 102, 0.65); transform: translateY(-4px); }
        }

        .texto-jesus {
            max-width: 560px;
        }

        .texto-jesus h2 {
            color: var(--rojo-vino);
            font-size: 1.3rem;
            margin-bottom: 6px;
        }

        .texto-jesus p {
            color: #4a1219;
            font-size: 0.97rem;
        }

        .cuerpo {
            padding: 30px 32px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .tarjeta {
            background: #ffffff;
            border-left: 5px solid var(--rojo-carmesi);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 6px 18px rgba(110, 13, 26, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .tarjeta:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(168, 21, 41, 0.16);
        }

        .tarjeta h2 {
            font-size: 1.15rem;
            color: var(--rojo-vino);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tarjeta p {
            color: #4a1219;
            font-size: 0.96rem;
        }

        .cita-destacada {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, #fff0f2, #ffe3e7);
            border: 1px solid #f3a6ae;
            border-radius: 14px;
            padding: 22px 26px;
            text-align: center;
        }

        .cita-destacada blockquote {
            font-style: italic;
            font-size: 1.08rem;
            color: var(--rojo-vino);
            margin-bottom: 8px;
        }

        .cita-destacada cite {
            font-size: 0.9rem;
            color: var(--rojo-carmesi);
            font-weight: 600;
        }

        .pie {
            background: #fae1e4;
            color: var(--rojo-vino);
            text-align: center;
            padding: 14px 20px;
            font-size: 0.88rem;
        }
    </style>
</head>
<body>

<!-- Lluvia animada de flores y pétalos -->
<div class="lluvia-flores" aria-hidden="true">
    <span class="flor-flotante">&#127801;</span>
    <span class="flor-flotante">&#127802;</span>
    <span class="flor-flotante">&#127800;</span>
    <span class="flor-flotante">&#127801;</span>
    <span class="flor-flotante">&#10047;</span>
    <span class="flor-flotante">&#127802;</span>
    <span class="flor-flotante">&#127801;</span>
    <span class="flor-flotante">&#127800;</span>
    <span class="flor-flotante">&#10048;</span>
    <span class="flor-flotante">&#127801;</span>
</div>

<?php if (!$autenticado): ?>
    <div class="login-card">
        <div class="simbolo-fe"><span class="flor-css">&#127801;</span> &#10013; <span class="flor-css">&#127801;</span></div>
        <h1>Espacio para Camila</h1>
        <p class="sub">Ingresa la contraseña para abrir este rincón de amistad, cariño y fe.</p>

        <?php if ($error !== ""): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Escribe la clave..." required autofocus>
            </div>
            <button type="submit" class="btn-rojo">Entrar</button>
        </form>
    </div>
<?php else: ?>
    <div class="contenedor-principal">
        <header class="encabezado">
            <div>
                <h1><span class="flor-css">&#127801;</span> Para Camila • Fe y Amistad</h1>
                <span>Un detalle sincero de cariño, cercanía y gratitud por tu vida</span>
            </div>
            <a href="?logout=1" class="btn-salir">Cerrar sesión</a>
        </header>

        <!-- Ilustración estilizada de Jesús con resplandor -->
        <section class="seccion-jesus">
            <div class="marco-jesus" title="Jesús, luz y paz">
                <svg width="115" height="115" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                    <!-- Aureola luminosa -->
                    <circle cx="60" cy="46" r="32" fill="none" stroke="#f4b942" stroke-width="3.5" opacity="0.9"/>
                    <line x1="60" y1="10" x2="60" y2="20" stroke="#f4b942" stroke-width="2.5" stroke-linecap="round"/>
                    <line x1="25" y1="46" x2="35" y2="46" stroke="#f4b942" stroke-width="2.5" stroke-linecap="round"/>
                    <line x1="85" y1="46" x2="95" y2="46" stroke="#f4b942" stroke-width="2.5" stroke-linecap="round"/>
                    <!-- Cabello largo -->
                    <path d="M39 45 C37 25, 83 25, 81 45 L84 74 C78 76, 74 72, 74 66 L74 48 L46 48 L46 66 C46 72, 42 76, 36 74 Z" fill="#4a2511"/>
                    <!-- Rostro sereno -->
                    <ellipse cx="60" cy="48" rx="14" ry="17" fill="#f7d3ba"/>
                    <!-- Ojos suaves y sonrisa tranquila -->
                    <circle cx="55" cy="46" r="1.6" fill="#3b1d0e"/>
                    <circle cx="65" cy="46" r="1.6" fill="#3b1d0e"/>
                    <path d="M55 54 Q60 58 65 54" fill="none" stroke="#8c4a32" stroke-width="1.8" stroke-linecap="round"/>
                    <!-- Barba suave -->
                    <path d="M47 51 C48 63, 72 63, 73 51 C70 66, 50 66, 47 51 Z" fill="#4a2511" opacity="0.85"/>
                    <path d="M47 51 C48 63, 72 63, 73 51 C70 66, 50 66, 47 51 Z" fill="#4a2511" opacity="0.85"/>
                    <!-- Túnica blanca y manto rojo carmesí -->
                    <path d="M28 110 C30 82, 90 82, 92 110 Z" fill="#fffafa" stroke="#d9c2c5" stroke-width="1.5"/>
                    <path d="M34 110 C38 86, 62 84, 72 110 Z" fill="#a81529"/>
                    <!-- Corazón luminoso en el pecho -->
                    <path d="M60 92 C57 88, 51 90, 54 95 L60 101 L66 95 C69 90, 63 88, 60 92 Z" fill="#ff6b7b"/>
                </svg>
            </div>
            <div class="texto-jesus">
                <h2>Bajo la mirada y bendición de Jesús <span class="flor-css">&#127802;</span></h2>
                <p>Que la paz de Cristo acompañe siempre tu corazón, Camila, iluminando tu camino y cuidando cada paso de nuestra amistad con amor, nobleza y esperanza.</p>
            </div>
        </section>

        <main class="cuerpo">
            <section class="tarjeta">
                <h2><span class="flor-css">&#127801;</span> Amistad que Acompaña</h2>
                <p>Tenerte cerca como amiga y confidente es un regalo que valoro cada día, por la confianza, las risas y la sinceridad que compartimos.</p>
            </section>

            <section class="tarjeta">
                <h2><span class="flor-css">&#127800;</span> Luz y Fe</h2>
                <p>Que Jesús guíe siempre tus pasos, cuide tu corazón y llene tus proyectos de paz, sabiduría y alegría en cada etapa de tu vida.</p>
            </section>

            <section class="tarjeta">
                <h2><span class="flor-css">&#127802;</span> Cariño Sincero</h2>
                <p>El afecto verdadero florece en los pequeños detalles, en el apoyo constante y en el deseo genuino de verte sonreír siempre.</p>
            </section>

            <section class="cita-destacada">
                <blockquote>"Guárdame como un sello sobre tu corazón, porque el amor auténtico es firme y luminoso, capaz de resistir cualquier prueba o distancia."</blockquote>
                <cite>— Inspirado en Cantar de los Cantares 8:6 • Dedicado a Camila <span class="flor-css">&#127801;</span></cite>
            </section>
        </main>

        <footer class="pie">
            Hecho con aprecio, flores y fe para Camila &bull; Contraseña por defecto: <strong>Camila2026</strong>
        </footer>
    </div>
<?php endif; ?>

</body>
</html>