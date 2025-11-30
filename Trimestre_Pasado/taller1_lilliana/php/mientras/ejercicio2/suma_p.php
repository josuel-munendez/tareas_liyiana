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
    echo " EJERCICIO 2: Suma de Positivos\n";
    echo "      (Hasta ingresar 0)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    $suma = 0;
    $numeros = array();
    $contador = 0;

    echo "💡 Instrucciones: Ingrese números positivos (0 para terminar)\n";
    echo "------------------------------------------------------------\n";

    while (true) {
        echo "Ingrese un número positivo: ";
        $input = trim(fgets(STDIN));
        $numero = is_numeric($input) ? floatval($input) : null;

        if ($numero === null) {
            echo "❌ Error: Debe ingresar un número válido\n";
            continue;
        }

        // Verificar condición de salida
        if ($numero == 0) {
            echo "⚡ Se ingresó 0. Finalizando suma...\n";
            break;
        }

        if ($numero < 0) {
            echo "⚠️  Número negativo ignorado. Ingrese solo positivos o 0\n";
            continue;
        }

        $numeros[] = $numero;
        $suma += $numero;
        $contador++;
        echo "✅ +$numero | Suma parcial: $suma | Total números: $contador\n";
    }

    // Mostrar resultados
    echo "\n📊 RESULTADOS FINALES:\n";
    echo "=====================\n";
    echo "🔢 Total de números sumados: $contador\n";

    if ($contador > 0) {
        echo "📋 Números sumados: " . implode(' + ', $numeros) . "\n";
        echo "🧮 Suma total: $suma\n";
        echo "📈 Promedio: " . number_format($suma / $contador, 2) . "\n";
        echo "📈 Número más alto: " . max($numeros) . "\n";
    } else {
        echo "📭 No se ingresaron números positivos\n";
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    session_start();

    $mensaje = '';
    $numeros = isset($_SESSION['numeros']) ? $_SESSION['numeros'] : array();
    $suma_actual = isset($_SESSION['suma']) ? $_SESSION['suma'] : 0;
    $mostrar_resultados = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['reiniciar'])) {
            session_destroy();
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

        if (isset($_POST['numero'])) {
            $input = trim($_POST['numero']);
            $numero = is_numeric($input) ? floatval($input) : null;

            if ($numero === null) {
                $mensaje = "❌ Error: Debe ingresar un número válido";
            } else {
                if ($numero == 0) {
                    $mensaje = "⚡ Se ingresó 0. Proceso finalizado.";
                    $mostrar_resultados = true;
                } elseif ($numero < 0) {
                    $mensaje = "⚠️  Número negativo ignorado. Ingrese solo positivos o 0";
                } else {
                    $numeros[] = $numero;
                    $suma_actual += $numero;
                    $_SESSION['numeros'] = $numeros;
                    $_SESSION['suma'] = $suma_actual;
                    $mensaje = "✅ +$numero | Suma actual: $suma_actual | Total: " . count($numeros) . " números";
                }
            }
        }
    } else {
        // Inicializar sesión
        if (!isset($_SESSION['numeros'])) {
            $_SESSION['numeros'] = array();
            $_SESSION['suma'] = 0;
        }
    }

    echo generarHTML($mensaje, $numeros, $suma_actual, $mostrar_resultados);
}

function generarHTML($mensaje, $numeros, $suma_actual, $mostrar_resultados) {
    $total_numeros = count($numeros);
    $operacion = implode(' + ', $numeros);

    // Construir el mensaje HTML
    $html_mensaje = '';
    if ($mensaje) {
        $clase_mensaje = 'info';
        if (strpos($mensaje, 'Error') !== false) {
            $clase_mensaje = 'error';
        } elseif (strpos($mensaje, 'ignorado') !== false) {
            $clase_mensaje = 'advertencia';
        }
        $html_mensaje = "<div class='mensaje $clase_mensaje'>$mensaje</div>";
    }

    // Construir resultados finales
    $html_resultados = '';
    if ($mostrar_resultados && $total_numeros > 0) {
        $promedio = $suma_actual / $total_numeros;
        $maximo = max($numeros);

        $html_resultados = "
        <div class='resultados-finales'>
            <h3>📊 Resultados Finales</h3>
            <div class='estadisticas'>
                <div class='estadistica'><span>🔢 Total números:</span> <strong>$total_numeros</strong></div>
                <div class='estadistica'><span>📋 Operación:</span> <strong>$operacion</strong></div>
                <div class='estadistica'><span>🧮 Suma total:</span> <strong>$suma_actual</strong></div>
                <div class='estadistica'><span>📈 Promedio:</span> <strong>" . number_format($promedio, 2) . "</strong></div>
                <div class='estadistica'><span>📈 Número más alto:</span> <strong>$maximo</strong></div>
            </div>
        </div>";
    }

    // Botón de reiniciar
    $boton_reiniciar = '';
    if ($total_numeros > 0 || $mostrar_resultados) {
        $boton_reiniciar = "
        <form method='POST' style='margin-top: 15px;'>
            <button type='submit' name='reiniciar' class='btn-reiniciar'>🔄 Reiniciar Ejercicio</button>
        </form>";
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Ciclo Mientras</title>
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
            background: #c6f6d5;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 2px solid #48bb78;
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
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        }

        .mensaje {
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
        }

        .mensaje.error {
            background: #fed7d7;
            color: #742a2a;
            border: 2px solid #f56565;
        }

        .mensaje.info {
            background: #c6f6d5;
            color: #22543d;
            border: 2px solid #48bb78;
        }

        .mensaje.advertencia {
            background: #fffaf0;
            color: #744210;
            border: 2px solid #ed8936;
        }

        .resultados-finales {
            background: #bee3f8;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .estadisticas {
            display: grid;
            gap: 10px;
        }

        .estadistica {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            background: white;
            border-radius: 5px;
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
        <h1>➕ Ejercicio 2: Suma de Números Positivos</h1>
        <div class="subtitle">Ciclo "Mientras" - Hasta ingresar 0</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="instrucciones">
            <strong>💡 Instrucciones:</strong> Ingrese números positivos para sumar.
            El programa terminará cuando ingrese 0 (los negativos serán ignorados).
        </div>

        <div class="progreso">
            <strong>📊 Progreso Actual:</strong><br>
            🔢 Números ingresados: <strong>$total_numeros</strong><br>
            🧮 Suma acumulada: <strong>$suma_actual</strong>
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="numero">Ingrese un número positivo (0 para terminar):</label>
                <input type="number" id="numero" name="numero" step="any" required>
            </div>

            <button type="submit">📥 Ingresar Número</button>
        </form>

        $html_mensaje
        $html_resultados
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