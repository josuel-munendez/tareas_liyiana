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
    echo " EJERCICIO 1: Lectura de Números\n";
    echo "   (Hasta valor negativo)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    $numeros = array();
    $contador = 0;

    echo "💡 Instrucciones: Ingrese números (negativo para terminar)\n";
    echo "--------------------------------------------------------\n";

    while (true) {
        echo "Ingrese un número: ";
        $input = trim(fgets(STDIN));
        $numero = is_numeric($input) ? floatval($input) : null;

        if ($numero === null) {
            echo "❌ Error: Debe ingresar un número válido\n";
            continue;
        }

        // Verificar condición de salida
        if ($numero < 0) {
            echo "⚡ Se ingresó un número negativo. Finalizando...\n";
            break;
        }

        $numeros[] = $numero;
        $contador++;
        echo "✅ Número $numero agregado. Total: $contador números\n";
    }

    // Mostrar resultados
    echo "\n📊 RESULTADOS FINALES:\n";
    echo "=====================\n";
    echo "🔢 Total de números ingresados: $contador\n";

    if ($contador > 0) {
        echo "📋 Números ingresados: " . implode(', ', $numeros) . "\n";
        echo "🧮 Suma total: " . array_sum($numeros) . "\n";
        echo "📈 Promedio: " . number_format(array_sum($numeros) / $contador, 2) . "\n";
        echo "📈 Máximo: " . max($numeros) . "\n";
        echo "📉 Mínimo: " . min($numeros) . "\n";
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
                if ($numero < 0) {
                    $mensaje = "⚡ Se ingresó un número negativo. Proceso finalizado.";
                    $mostrar_resultados = true;
                } else {
                    $numeros[] = $numero;
                    $_SESSION['numeros'] = $numeros;
                    $mensaje = "✅ Número $numero agregado. Total: " . count($numeros) . " números";
                }
            }
        }
    } else {
        // Inicializar sesión
        if (!isset($_SESSION['numeros'])) {
            $_SESSION['numeros'] = array();
        }
    }

    echo generarHTML($mensaje, $numeros, $mostrar_resultados);
}

function generarHTML($mensaje, $numeros, $mostrar_resultados) {
    $total_numeros = count($numeros);
    $lista_numeros = implode(', ', $numeros);

    // Construir el mensaje HTML
    $html_mensaje = '';
    if ($mensaje) {
        $clase_mensaje = (strpos($mensaje, 'Error') !== false) ? 'error' : 'info';
        $html_mensaje = "<div class='mensaje $clase_mensaje'>$mensaje</div>";
    }

    // Construir resultados finales
    $html_resultados = '';
    if ($mostrar_resultados && $total_numeros > 0) {
        $suma = array_sum($numeros);
        $promedio = $suma / $total_numeros;
        $maximo = max($numeros);
        $minimo = min($numeros);

        $html_resultados = "
        <div class='resultados-finales'>
            <h3>📊 Resultados Finales</h3>
            <div class='estadisticas'>
                <div class='estadistica'><span>🔢 Total números:</span> <strong>$total_numeros</strong></div>
                <div class='estadistica'><span>📋 Números ingresados:</span> <strong>$lista_numeros</strong></div>
                <div class='estadistica'><span>🧮 Suma total:</span> <strong>$suma</strong></div>
                <div class='estadistica'><span>📈 Promedio:</span> <strong>" . number_format($promedio, 2) . "</strong></div>
                <div class='estadistica'><span>📈 Máximo:</span> <strong>$maximo</strong></div>
                <div class='estadistica'><span>📉 Mínimo:</span> <strong>$minimo</strong></div>
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
    <title>Ejercicio 1 - Ciclo Mientras</title>
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
        <h1>🔢 Ejercicio 1: Lectura de Números</h1>
        <div class="subtitle">Ciclo "Mientras" - Hasta valor negativo</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="instrucciones">
            <strong>💡 Instrucciones:</strong> Ingrese números positivos o cero.
            El programa terminará cuando ingrese un número negativo.
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="numero">Ingrese un número:</label>
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

    <script>
        function reiniciarFormulario() {
            document.getElementById('numero').value = '';
            document.getElementById('numero').focus();
        }
    </script>
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