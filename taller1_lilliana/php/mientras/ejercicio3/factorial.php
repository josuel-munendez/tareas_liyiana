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
    echo " EJERCICIO 3: Factorial\n";
    echo "   (Ciclo Mientras)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "💡 Cálculo del factorial: n! = n × (n-1) × (n-2) × ... × 1\n";
    echo "----------------------------------------------------------\n";

    echo "Ingrese un número natural (0-20): ";
    $input = trim(fgets(STDIN));
    $numero = is_numeric($input) ? intval($input) : null;

    if ($numero === null || $numero < 0) {
        echo "❌ Error: Debe ingresar un número natural (0-20)\n";
        return;
    }

    if ($numero > 20) {
        echo "⚠️  Advertencia: Números mayores a 20 pueden generar resultados muy grandes\n";
        echo "¿Desea continuar? (s/n): ";
        $confirmacion = trim(fgets(STDIN));
        if (strtolower($confirmacion) !== 's') {
            echo "Operación cancelada.\n";
            return;
        }
    }

    // Calcular factorial con ciclo mientras
    $factorial = 1;
    $i = 1;
    $proceso = "";

    echo "\n🔍 CÁLCULO DEL FACTORIAL:\n";
    echo "=======================\n";

    if ($numero == 0) {
        echo "0! = 1 (por definición)\n";
        $factorial = 1;
    } else {
        echo "Proceso de cálculo:\n";
        while ($i <= $numero) {
            $factorial *= $i;
            $proceso .= $i;
            if ($i < $numero) $proceso .= " × ";
            echo "Paso $i: $i! = $factorial\n";
            $i++;
        }
    }

    // Mostrar resultados
    echo "\n📊 RESULTADO FINAL:\n";
    echo "==================\n";
    if ($numero > 0) {
        echo "$numero! = $proceso = $factorial\n";
    }
    echo "✅ $numero! = " . number_format($factorial, 0, '.', ',') . "\n";

    // Información adicional
    echo "\n💡 INFORMACIÓN ADICIONAL:\n";
    echo "======================\n";
    echo "🔢 Número ingresado: $numero\n";
    echo "📐 Tipo: " . ($numero % 2 == 0 ? "Par" : "Impar") . "\n";
    echo "📊 Cantidad de dígitos en resultado: " . strlen((string)$factorial) . "\n";

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $resultado = '';
    $proceso = '';
    $numero_ingresado = '';
    $clase_css = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {
        $input = trim($_POST['numero']);
        $numero = is_numeric($input) ? intval($input) : null;
        $numero_ingresado = htmlspecialchars($input);

        if ($numero === null || $numero < 0) {
            $resultado = "❌ Error: Debe ingresar un número natural (0 o mayor)";
            $clase_css = 'error';
        } else {
            // Calcular factorial con ciclo mientras
            $factorial = 1;
            $i = 1;
            $pasos = array();

            if ($numero == 0) {
                $proceso = "0! = 1 (por definición)";
                $factorial = 1;
            } else {
                while ($i <= $numero) {
                    $factorial *= $i;
                    $pasos[] = "Paso $i: $i! = " . number_format($factorial, 0, '.', ',');
                    $i++;
                }
                $proceso = implode('<br>', $pasos);
            }

            $resultado = "✅ $numero! = " . number_format($factorial, 0, '.', ',');
            $clase_css = 'exito';
        }
    }

    echo generarHTML($resultado, $proceso, $numero_ingresado, $clase_css);
}

function generarHTML($resultado, $proceso, $numero_ingresado, $clase_css) {
    $html_proceso = '';
    if ($proceso) {
        $html_proceso = "
        <div class='proceso-calculo'>
            <h4>🔍 Proceso de Cálculo:</h4>
            <div class='pasos'>$proceso</div>
        </div>";
    }

    $html_resultado = '';
    if ($resultado) {
        $html_resultado = "
        <div class='resultado $clase_css'>
            <div class='mensaje'>$resultado</div>
            $html_proceso
        </div>";
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Ciclo Mientras</title>
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

        .definicion {
            background: #f0fff4;
            border-left: 4px solid #48bb78;
            padding: 15px;
            margin: 15px 0;
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

        .resultado {
            margin-top: 25px;
            padding: 20px;
            border-radius: 8px;
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

        .mensaje {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .proceso-calculo {
            margin-top: 15px;
        }

        .pasos {
            background: rgba(255,255,255,0.8);
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 14px;
        }

        .ejemplos {
            background: #fffaf0;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border: 2px solid #ed8936;
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
        <h1>🧮 Ejercicio 3: Factorial</h1>
        <div class="subtitle">Ciclo "Mientras" - Cálculo de factorial</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="definicion">
            <strong>📚 Definición:</strong> El factorial de un número natural n (n!) es el producto
            de todos los números enteros positivos desde 1 hasta n.
            <br><strong>Fórmula:</strong> n! = n × (n-1) × (n-2) × ... × 1
            <br><strong>Ejemplo:</strong> 5! = 5 × 4 × 3 × 2 × 1 = 120
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="numero">Ingrese un número natural:</label>
                <input type="number" id="numero" name="numero" value="$numero_ingresado"
                       placeholder="Ej: 5, 7, 10..." required min="0" max="100" step="1">
            </div>

            <button type="submit">🧮 Calcular Factorial</button>
        </form>

        $html_resultado

        <div class="ejemplos">
            <h4>📋 Ejemplos de Factoriales:</h4>
            <ul>
                <li><strong>0! = 1</strong> (por definición)</li>
                <li><strong>1! = 1</strong></li>
                <li><strong>5! = 120</strong></li>
                <li><strong>10! = 3,628,800</strong></li>
                <li><strong>15! = 1,307,674,368,000</strong></li>
            </ul>
        </div>

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