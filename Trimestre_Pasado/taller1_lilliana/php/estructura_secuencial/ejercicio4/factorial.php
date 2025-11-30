<?php
// Función para determinar si es consola o web
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// Función para calcular factorial (iterativa)
function calcularFactorial($numero) {
    if ($numero < 0) {
        return false; // Número negativo
    }

    $factorial = 1;
    for ($i = 1; $i <= $numero; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}

// Función para calcular factorial recursivo (para mostrar diferentes métodos)
function factorialRecursivo($numero) {
    if ($numero < 0) return false;
    if ($numero == 0 || $numero == 1) return 1;
    return $numero * factorialRecursivo($numero - 1);
}

// Función para limpiar entrada
function limpiarEntrada($dato) {
    return filter_var($dato, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0)));
}

// Función para formatear número grande
function formatearNumero($numero) {
    if ($numero > 1000000) {
        return number_format($numero, 0, '.', ',');
    }
    return $numero;
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "     CALCULADORA DE FACTORIAL\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Definición: n! = n × (n-1) × (n-2) × ... × 1\n";
    echo "Ejemplo: 5! = 5 × 4 × 3 × 2 × 1 = 120\n\n";

    // Leer número del usuario
    echo "Ingrese un número natural (0-20): ";
    $input = trim(fgets(STDIN));
    $numero = limpiarEntrada($input);

    // Validar entrada
    if ($numero === false) {
        echo "❌ Error: Debe ingresar un número natural (entero no negativo).\n";
        return;
    }

    if ($numero > 20) {
        echo "⚠️  Advertencia: Números mayores a 20 pueden generar resultados muy grandes.\n";
        echo "¿Desea continuar? (s/n): ";
        $confirmacion = trim(fgets(STDIN));
        if (strtolower($confirmacion) !== 's') {
            echo "Operación cancelada.\n";
            return;
        }
    }

    // Calcular factorial
    $factorial = calcularFactorial($numero);

    if ($factorial === false) {
        echo "❌ Error: No se puede calcular factorial de números negativos.\n";
    } else {
        // Mostrar proceso de cálculo
        echo "\n🔍 Cálculo de $numero!:\n";
        echo "-------------------\n";

        if ($numero == 0) {
            echo "0! = 1 (por definición)\n";
        } else {
            $proceso = "";
            for ($i = $numero; $i >= 1; $i--) {
                $proceso .= $i;
                if ($i > 1) $proceso .= " × ";
            }
            echo "$proceso = " . formatearNumero($factorial) . "\n";
        }

        echo "\n✅ Resultado: $numero! = " . formatearNumero($factorial) . "\n";

        // Mostrar también el método recursivo para comparar
        $factorialRec = factorialRecursivo($numero);
        echo "   (Método recursivo: " . formatearNumero($factorialRec) . ")\n";
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $numero = null;
    $resultado = '';
    $proceso = '';
    $clase_css = '';
    $factorial = null;

    // Procesar formulario si se envió
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {
        $numero = limpiarEntrada($_POST['numero']);

        if ($numero === false) {
            $resultado = "❌ Error: Debe ingresar un número natural (entero no negativo).";
            $clase_css = 'error';
        } else {
            $factorial = calcularFactorial($numero);

            if ($factorial === false) {
                $resultado = "❌ Error: No se puede calcular factorial de números negativos.";
                $clase_css = 'error';
            } else {
                // Construir proceso de cálculo
                if ($numero == 0) {
                    $proceso = "0! = 1 (por definición)";
                } else {
                    $proceso = "$numero! = ";
                    $pasos = array();
                    for ($i = $numero; $i >= 1; $i--) {
                        $pasos[] = $i;
                    }
                    $proceso .= implode(" × ", $pasos) . " = " . formatearNumero($factorial);
                }

                $resultado = "✅ $numero! = " . formatearNumero($factorial);
                $clase_css = 'exito';
            }
        }
    }

    // Generar HTML
    echo generarHTML($resultado, $proceso, $clase_css, $numero, $factorial);
}

function generarHTML($resultado, $proceso, $clase_css, $numero_valor, $factorial_valor) {
    $valor_actual = ($numero_valor !== null) ? $numero_valor : '';

    $html_resultado = '';
    if (!empty($resultado)) {
        $html_proceso = $proceso ? "<div class='proceso'>$proceso</div>" : '';
        $html_resultado = "
            <div class='resultado $clase_css'>
                $resultado
                $html_proceso
            </div>
        ";
    }

    // Generar tabla de ejemplos si no hay resultado o el resultado es exitoso
    $html_tabla = '';
    if (empty($resultado) || $clase_css == 'exito') {
        $html_tabla = generarTablaEjemplos();
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Factorial - Web</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
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
        }

        button:hover {
            transform: translateY(-2px);
        }

        .resultado {
            margin-top: 25px;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .proceso {
            font-size: 14px;
            margin-top: 10px;
            padding: 10px;
            background: rgba(255,255,255,0.7);
            border-radius: 5px;
            font-family: monospace;
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
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .tabla-ejemplos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabla-ejemplos th,
        .tabla-ejemplos td {
            padding: 10px;
            text-align: center;
            border: 1px solid #cbd5e0;
        }

        .tabla-ejemplos th {
            background: #4a5568;
            color: white;
        }

        .tabla-ejemplos tr:nth-child(even) {
            background: #f7fafc;
        }

        .definicion {
            background: #f0fff4;
            border-left: 4px solid #48bb78;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 Calculadora de Factorial</h1>
        <div class="subtitle">n! = n × (n-1) × (n-2) × ... × 1</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="definicion">
            <strong>📚 Definición:</strong> El factorial de un número natural n (denotado n!) es el producto
            de todos los números enteros positivos desde 1 hasta n. Por definición, 0! = 1.
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="numero">Ingrese un número natural:</label>
                <input type="number" id="numero" name="numero" value="$valor_actual"
                       placeholder="Ej: 5, 7, 10..." required min="0" max="100" step="1">
            </div>

            <button type="submit">🧮 Calcular Factorial</button>
        </form>

        $html_resultado
        $html_tabla

        <div class="info">
            <strong>💡 Información:</strong>
            <ul>
                <li>El factorial crece muy rápido (5! = 120, 10! = 3,628,800)</li>
                <li>Solo se pueden calcular factoriales de números enteros no negativos</li>
                <li>Para números grandes, el resultado se muestra con separadores de miles</li>
            </ul>
        </div>
    </div>
</body>
</html>
HTML;
}

function generarTablaEjemplos() {
    $ejemplos = array(0, 1, 2, 3, 4, 5, 6, 7, 8);
    $html = '<h3>📋 Ejemplos de Factoriales</h3>';
    $html .= '<table class="tabla-ejemplos">';
    $html .= '<tr><th>n</th><th>n!</th><th>Cálculo</th></tr>';

    foreach ($ejemplos as $n) {
        $factorial = calcularFactorial($n);
        $calculo = '';

        if ($n == 0) {
            $calculo = '1 (por definición)';
        } else {
            $pasos = array();
            for ($i = $n; $i >= 1; $i--) {
                $pasos[] = $i;
            }
            $calculo = implode(' × ', $pasos);
        }

        $html .= "<tr>
                    <td><strong>$n</strong></td>
                    <td><strong>" . formatearNumero($factorial) . "</strong></td>
                    <td><code>$calculo</code></td>
                  </tr>";
    }

    $html .= '</table>';
    return $html;
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