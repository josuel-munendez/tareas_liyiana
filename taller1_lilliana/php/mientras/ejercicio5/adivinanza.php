<?php
// Función para determinar si es consola o web
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "  EJERCICIO 5: Adivina el Número\n";
    echo "   (Ciclo Mientras)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    $numero_secreto = rand(1, 100);
    $intentos = 0;
    $max_intentos = 10;
    $adivinado = false;

    echo "🎮 BIENVENIDO AL JUEGO DE ADIVINANZAS!\n";
    echo "=====================================\n";
    echo "💡 He pensado en un número entre 1 y 100\n";
    echo "🎯 Tienes $max_intentos intentos para adivinarlo\n";
    echo "-------------------------------------------------\n";

    while ($intentos < $max_intentos && !$adivinado) {
        $intentos_restantes = $max_intentos - $intentos;
        echo "\n📊 Intentos restantes: $intentos_restantes\n";
        echo "Ingresa tu número: ";

        $input = trim(fgets(STDIN));
        $numero = is_numeric($input) ? intval($input) : null;

        if ($numero === null || $numero < 1 || $numero > 100) {
            echo "❌ Error: Debes ingresar un número entre 1 y 100\n";
            continue;
        }

        $intentos++;

        if ($numero == $numero_secreto) {
            $adivinado = true;
            echo "🎉 ¡FELICIDADES! ¡ADIVINASTE!\n";
            echo "✅ El número era: $numero_secreto\n";
            echo "📊 Lo lograste en $intentos intento(s)\n";

            // Mostrar puntuación
            $puntuacion = ($max_intentos - $intentos + 1) * 10;
            echo "🏆 Puntuación: $puntuacion/100 puntos\n";

            if ($intentos == 1) {
                echo "🌟 ¡INCREÍBLE! Adivinaste a la primera!\n";
            } elseif ($intentos <= 3) {
                echo "🔥 ¡Excelente! Eres muy bueno en esto\n";
            } elseif ($intentos <= 6) {
                echo "👍 ¡Buen trabajo! Lo hiciste bien\n";
            } else {
                echo "💪 ¡Bien hecho! Pero puedes mejorar\n";
            }
        } else {
            $diferencia = abs($numero - $numero_secreto);

            if ($numero < $numero_secreto) {
                echo "📈 El número es MAYOR";
            } else {
                echo "📉 El número es MENOR";
            }

            // Pistas adicionales
            if ($diferencia <= 5) {
                echo " - ¡MUY CALIENTE! 🔥\n";
            } elseif ($diferencia <= 15) {
                echo " - Caliente ☀️\n";
            } elseif ($diferencia <= 30) {
                echo " - Tibio 🌤️\n";
            } else {
                echo " - Frío ❄️\n";
            }
        }
    }

    if (!$adivinado) {
        echo "\n💀 ¡SE ACABARON LOS INTENTOS!\n";
        echo "😞 El número era: $numero_secreto\n";
        echo "📊 Intentos realizados: $intentos\n";
        echo "💡 Mejor suerte la próxima vez\n";
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    session_start();

    // Inicializar juego si es necesario
    if (!isset($_SESSION['numero_secreto']) || isset($_POST['reiniciar'])) {
        $_SESSION['numero_secreto'] = rand(1, 100);
        $_SESSION['intentos'] = 0;
        $_SESSION['max_intentos'] = 10;
        $_SESSION['historial'] = array();
        $_SESSION['juego_terminado'] = false;
    }

    $mensaje = '';
    $clase_mensaje = '';
    $mostrar_resultado = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {
        if ($_SESSION['juego_terminado']) {
            $mensaje = "El juego ha terminado. Reinicia para jugar nuevamente.";
            $clase_mensaje = 'advertencia';
        } else {
            $input = trim($_POST['numero']);
            $numero = is_numeric($input) ? intval($input) : null;

            if ($numero === null || $numero < 1 || $numero > 100) {
                $mensaje = "❌ Error: Debes ingresar un número entre 1 y 100";
                $clase_mensaje = 'error';
            } else {
                $_SESSION['intentos']++;
                $numero_secreto = $_SESSION['numero_secreto'];
                $intento_actual = $_SESSION['intentos'];
                $max_intentos = $_SESSION['max_intentos'];

                // Guardar en historial
                $_SESSION['historial'][] = array(
                    'numero' => $numero,
                    'intento' => $intento_actual
                );

                if ($numero == $numero_secreto) {
                    $_SESSION['juego_terminado'] = true;
                    $puntuacion = ($max_intentos - $intento_actual + 1) * 10;

                    $mensaje = "🎉 ¡FELICIDADES! Adivinaste el número $numero_secreto en $intento_actual intento(s). Puntuación: $puntuacion/100";
                    $clase_mensaje = 'exito';
                    $mostrar_resultado = true;
                } else {
                    $intentos_restantes = $max_intentos - $intento_actual;
                    $diferencia = abs($numero - $numero_secreto);

                    if ($numero < $numero_secreto) {
                        $mensaje = "📈 El número es MAYOR";
                    } else {
                        $mensaje = "📉 El número es MENOR";
                    }

                    // Pistas de temperatura
                    if ($diferencia <= 5) {
                        $mensaje .= " - ¡MUY CALIENTE! 🔥";
                    } elseif ($diferencia <= 15) {
                        $mensaje .= " - Caliente ☀️";
                    } elseif ($diferencia <= 30) {
                        $mensaje .= " - Tibio 🌤️";
                    } else {
                        $mensaje .= " - Frío ❄️";
                    }

                    $mensaje .= "<br>📊 Intentos restantes: $intentos_restantes";
                    $clase_mensaje = 'info';

                    if ($intentos_restantes == 0) {
                        $_SESSION['juego_terminado'] = true;
                        $mensaje = "💀 ¡SE ACABARON LOS INTENTOS! El número era: $numero_secreto";
                        $clase_mensaje = 'error';
                        $mostrar_resultado = true;
                    }
                }
            }
        }
    }

    echo generarHTML($mensaje, $clase_mensaje, $mostrar_resultado);
}

function generarHTML($mensaje, $clase_mensaje, $mostrar_resultado) {
    $intentos = isset($_SESSION['intentos']) ? $_SESSION['intentos'] : 0;
    $max_intentos = isset($_SESSION['max_intentos']) ? $_SESSION['max_intentos'] : 10;
    $historial = isset($_SESSION['historial']) ? $_SESSION['historial'] : array();
    $juego_terminado = isset($_SESSION['juego_terminado']) ? $_SESSION['juego_terminado'] : false;

    // Construir el mensaje HTML
    $html_mensaje = '';
    if ($mensaje) {
        $html_mensaje = "<div class='mensaje $clase_mensaje'>$mensaje</div>";
    }

    // Construir historial
    $html_historial = '';
    if (!empty($historial)) {
        $html_historial = "<div class='historial'><h4>📋 Historial de Intentos:</h4>";
        foreach ($historial as $intento) {
            $html_historial .= "<div class='intento'>Intento {$intento['intento']}: {$intento['numero']}</div>";
        }
        $html_historial .= "</div>";
    }

    // Botón de reiniciar
    $boton_reiniciar = '';
    if ($intentos > 0) {
        $boton_reiniciar = "
        <form method='POST' style='margin-top: 15px;'>
            <button type='submit' name='reiniciar' class='btn-reiniciar'>🔄 Jugar Otra Vez</button>
        </form>";
    }

    $input_juego = '';
    if (!$juego_terminado) {
        $input_juego = '
        <form method="POST">
            <div class="form-group">
                <label for="numero">Ingresa tu número (1-100):</label>
                <input type="number" id="numero" name="numero" min="1" max="100" required>
            </div>

            <button type="submit">🎯 Adivinar</button>
        </form>';
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Ciclo Mientras</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h1 {
            text-align: center;
            color: #4a5568;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #718096;
            margin-bottom: 30px;
            font-style: italic;
        }

        .entorno {
            background: #e2e8f0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #4a5568;
        }

        .instrucciones {
            background: #fffaf0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #ed8936;
        }

        .progreso {
            background: #bee3f8;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #4a5568;
        }

        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #cbd5e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
            width: 100%;
            font-weight: bold;
        }

        button:hover {
            transform: translateY(-2px);
        }

        .btn-reiniciar {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }

        .mensaje {
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
        }

        .exito {
            background: #c6f6d5;
            color: #22543d;
            border: 2px solid #48bb78;
        }

        .error {
            background: #fed7d7;
            color: #742a2a;
            border: 2px solid #f56565;
        }

        .info {
            background: #bee3f8;
            color: #2a4365;
            border: 2px solid #4299e1;
        }

        .advertencia {
            background: #fffaf0;
            color: #744210;
            border: 2px solid #ed8936;
        }

        .historial {
            background: #f7fafc;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .intento {
            padding: 5px;
            margin: 3px 0;
            background: white;
            border-radius: 3px;
        }

        .volver {
            text-align: center;
            margin-top: 20px;
        }

        .btn-volver {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎯 Ejercicio 5: Adivina el Número</h1>
        <div class="subtitle">Ciclo "Mientras" - Juego de adivinanzas</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="instrucciones">
            <strong>🎮 INSTRUCCIONES:</strong>
            <ul>
                <li>He pensado en un número entre <strong>1 y 100</strong></li>
                <li>Tienes <strong>{$max_intentos} intentos</strong> para adivinarlo</li>
                <li>Te daré pistas si tu número es mayor o menor</li>
                <li>¡Buena suerte!</li>
            </ul>
        </div>

        <div class="progreso">
            <strong>📊 Progreso del Juego:</strong><br>
            🎯 Intentos realizados: <strong>{$intentos}</strong><br>
            📈 Intentos restantes: <strong>" . ($max_intentos - $intentos) . "</strong>
        </div>

        $input_juego

        $html_mensaje

        $html_historial
        $boton_reiniciar

        <div class="volver">
            <a href="javascript:history.back()" class="btn-volver">← Volver</a>
        </div>
    </div>
</body>
</html>
HTML;
}

// ===============================
// EJECUCIÓN PRINCIPAL
// ===============================
if (esConsola()) {
    ejecutarEnConsola();
} else {
    ejecutarEnWeb();
}
?>