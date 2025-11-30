<?php
// Función para determinar si es consola o web
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// Implementación de sqrt() usando el método de Newton-Raphson
function mi_sqrt($numero, $precision = 1e-10) {
    // Manejar casos especiales
    if ($numero < 0) {
        return false; // No existe raíz cuadrada real para números negativos
    }

    if ($numero == 0) {
        return 0;
    }

    // Valor inicial (puede ser cualquier aproximación, usamos n/2)
    $x = $numero / 2;
    $x_nuevo = 0;

    // Iterar hasta alcanzar la precisión deseada
    do {
        $x_nuevo = ($x + $numero / $x) / 2;
        $diferencia = abs($x_nuevo - $x);
        $x = $x_nuevo;
    } while ($diferencia > $precision);

    return $x;
}

// Función para comparar con sqrt() nativo de PHP
function compararConNativo($numero, $mi_calculo) {
    if ($mi_calculo === false) {
        return "N/A";
    }

    $nativo = sqrt($numero);
    $diferencia = abs($mi_calculo - $nativo);
    $porcentaje_error = ($diferencia / $nativo) * 100;

    return number_format($porcentaje_error, 10) . "%";
}

// Función para limpiar entrada
function limpiarEntrada($dato) {
    return filter_var($dato, FILTER_VALIDATE_FLOAT);
}

// Función para mostrar proceso iterativo
function mostrarProcesoIterativo($numero, $iteraciones = 5) {
    if ($numero <= 0) return "";

    $proceso = "Proceso iterativo (primeras $iteraciones iteraciones):\n";
    $x = $numero / 2;

    for ($i = 1; $i <= $iteraciones; $i++) {
        $x_nuevo = ($x + $numero / $x) / 2;
        $proceso .= "Iteración $i: x = " . number_format($x, 6) . " → " . number_format($x_nuevo, 6) . "\n";
        $x = $x_nuevo;
    }

    return $proceso;
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "    IMPLEMENTACIÓN DE SQRT()\n";
    echo "   Método de Newton-Raphson\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Algoritmo: xₙ₊₁ = (xₙ + número/xₙ) / 2\n\n";

    // Leer número del usuario
    echo "Ingrese un número para calcular su raíz cuadrada: ";
    $input = trim(fgets(STDIN));
    $numero = limpiarEntrada($input);

    // Validar entrada
    if ($numero === false) {
        echo "❌ Error: Debe ingresar un número válido.\n";
        return;
    }

    // Calcular raíz cuadrada
    $mi_resultado = mi_sqrt($numero);
    $nativo_resultado = ($numero >= 0) ? sqrt($numero) : false;

    // Mostrar resultados
    echo "\n🔍 RESULTADOS:\n";
    echo "================\n";
    printf("📊 Número ingresado: %.6f\n", $numero);

    if ($mi_resultado === false) {
        echo "❌ Error: No existe raíz cuadrada real para números negativos\n";
        echo "💡 Para números negativos, la raíz cuadrada es un número imaginario\n";
    } else {
        printf("🧮 Mi sqrt():       %.10f\n", $mi_resultado);
        printf("⚡ PHP sqrt():      %.10f\n", $nativo_resultado);
        printf("📈 Error relativo:  %s\n", compararConNativo($numero, $mi_resultado));

        echo "\n" . mostrarProcesoIterativo($numero, 5);

        // Mostrar verificación
        $cuadrado = $mi_resultado * $mi_resultado;
        printf("\n✅ Verificación: (%.6f)² = %.6f\n", $mi_resultado, $cuadrado);
    }

    // Mostrar tabla de ejemplos
    echo "\n📋 EJEMPLOS COMPARATIVOS:\n";
    echo "-------------------------\n";
    $ejemplos = array(1, 2, 4, 9, 16, 25, 100, 144, 1000);
    foreach ($ejemplos as $ejemplo) {
        $mi_calc = mi_sqrt($ejemplo);
        $nativo = sqrt($ejemplo);
        $error = compararConNativo($ejemplo, $mi_calc);
        printf("%4d → Mi: %8.6f, PHP: %8.6f, Error: %s\n",
               $ejemplo, $mi_calc, $nativo, $error);
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $numero = null;
    $mi_resultado = null;
    $nativo_resultado = null;
    $error_relativo = null;
    $proceso_iterativo = '';
    $verificacion = '';
    $clase_css = '';

    // Procesar formulario si se envió
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {
        $numero = limpiarEntrada($_POST['numero']);

        if ($numero === false) {
            $resultado = "❌ Error: Debe ingresar un número válido.";
            $clase_css = 'error';
        } else {
            $mi_resultado = mi_sqrt($numero);
            $nativo_resultado = ($numero >= 0) ? sqrt($numero) : false;
            $error_relativo = compararConNativo($numero, $mi_resultado);

            if ($mi_resultado === false) {
                $resultado = "❌ No existe raíz cuadrada real para números negativos";
                $clase_css = 'error';
            } else {
                $resultado = "✅ Cálculo completado";
                $clase_css = 'exito';

                // Generar proceso iterativo para mostrar
                $proceso_iterativo = generarProcesoIterativoHTML($numero, 5);
                $verificacion = number_format($mi_resultado * $mi_resultado, 6);
            }
        }
    }

    // Generar HTML
    echo generarHTML($resultado, $clase_css, $numero, $mi_resultado, $nativo_resultado, $error_relativo, $proceso_iterativo, $verificacion);
}

function generarProcesoIterativoHTML($numero, $iteraciones) {
    if ($numero <= 0) return "";

    $html = "<div class='proceso-iterativo'>";
    $html .= "<h4>🔁 Proceso Iterativo (primeras $iteraciones iteraciones):</h4>";
    $html .= "<div class='iteraciones'>";

    $x = $numero / 2;
    for ($i = 1; $i <= $iteraciones; $i++) {
        $x_nuevo = ($x + $numero / $x) / 2;
        $html .= "<div class='iteracion'>";
        $html .= "<span class='numero-iteracion'>Iteración $i:</span>";
        $html .= "<span class='formula'>x = " . number_format($x, 6) . " → " . number_format($x_nuevo, 6) . "</span>";
        $html .= "</div>";
        $x = $x_nuevo;
    }

    $html .= "</div></div>";
    return $html;
}

function generarHTML($resultado, $clase_css, $numero_valor, $mi_resultado, $nativo_resultado, $error_relativo, $proceso_iterativo, $verificacion) {
    $valor_actual = ($numero_valor !== null) ? $numero_valor : '';

    $html_resultado = '';
    if (!empty($resultado)) {
        $html_detalles = '';
        if ($clase_css == 'exito') {
            $html_detalles = "
                <div class='detalles-calculo'>
                    <div class='resultados-comparacion'>
                        <div class='resultado-item'>
                            <span class='etiqueta'>🧮 Mi implementación:</span>
                            <span class='valor'>" . number_format($mi_resultado, 10) . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>⚡ PHP sqrt() nativo:</span>
                            <span class='valor'>" . number_format($nativo_resultado, 10) . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>📈 Error relativo:</span>
                            <span class='valor'>$error_relativo</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>✅ Verificación:</span>
                            <span class='valor'>(" . number_format($mi_resultado, 6) . ")² = $verificacion</span>
                        </div>
                    </div>
                    $proceso_iterativo
                </div>
            ";
        }

        $html_resultado = "
            <div class='resultado $clase_css'>
                <div class='mensaje'>$resultado</div>
                $html_detalles
            </div>
        ";
    }

    // Generar tabla de ejemplos
    $html_tabla = generarTablaEjemplos();

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implementación de sqrt() - Web</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
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

        .mensaje {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
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

        .detalles-calculo {
            margin-top: 15px;
        }

        .resultados-comparacion {
            background: rgba(255,255,255,0.8);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .resultado-item {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            padding: 5px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .etiqueta {
            font-weight: bold;
            color: #4a5568;
        }

        .valor {
            font-family: monospace;
            background: #edf2f7;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .proceso-iterativo {
            background: #f7fafc;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .iteraciones {
            margin-top: 10px;
        }

        .iteracion {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            margin: 5px 0;
            background: white;
            border-radius: 4px;
            border-left: 4px solid #667eea;
        }

        .numero-iteracion {
            font-weight: bold;
            color: #4a5568;
        }

        .formula {
            font-family: monospace;
            color: #2d3748;
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
            padding: 12px;
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

        .tabla-ejemplos tr:hover {
            background: #edf2f7;
        }

        .definicion {
            background: #f0fff4;
            border-left: 4px solid #48bb78;
            padding: 15px;
            margin: 15px 0;
        }

        .algoritmo {
            background: #fffaf0;
            border-left: 4px solid #ed8936;
            padding: 15px;
            margin: 15px 0;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧮 Implementación de sqrt()</h1>
        <div class="subtitle">Método de Newton-Raphson para raíces cuadradas</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="definicion">
            <strong>📚 Método de Newton-Raphson:</strong><br>
            Para calcular √a, iteramos: xₙ₊₁ = (xₙ + a/xₙ) / 2
        </div>

        <div class="algoritmo">
            <strong>🔍 Algoritmo:</strong><br>
            function mi_sqrt(\$numero, \$precision = 1e-10) {<br>
            &nbsp;&nbsp;if (\$numero < 0) return false;<br>
            &nbsp;&nbsp;if (\$numero == 0) return 0;<br>
            &nbsp;&nbsp;\$x = \$numero / 2;<br>
            &nbsp;&nbsp;do {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;\$x_nuevo = (\$x + \$numero / \$x) / 2;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;\$diferencia = abs(\$x_nuevo - \$x);<br>
            &nbsp;&nbsp;&nbsp;&nbsp;\$x = \$x_nuevo;<br>
            &nbsp;&nbsp;} while (\$diferencia > \$precision);<br>
            &nbsp;&nbsp;return \$x;<br>
            }
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="numero">Ingrese un número para calcular su raíz cuadrada:</label>
                <input type="number" id="numero" name="numero" value="$valor_actual"
                       placeholder="Ej: 25, 2, 100, 144..." required step="any" min="0">
            </div>

            <button type="submit">🧮 Calcular Raíz Cuadrada</button>
        </form>

        $html_resultado
        $html_tabla

        <div class="info">
            <strong>💡 Información:</strong>
            <ul>
                <li>El método de Newton-Raphson converge muy rápido (duplica dígitos correctos en cada iteración)</li>
                <li>Precisión por defecto: 1×10⁻¹⁰</li>
                <li>No funciona con números negativos (raíces imaginarias)</li>
                <li>El error relativo muestra la diferencia porcentual con la función nativa de PHP</li>
            </ul>
        </div>
    </div>
</body>
</html>
HTML;
}

function generarTablaEjemplos() {
    $ejemplos = array(1, 2, 4, 9, 16, 25, 100, 144, 1000, 2.5, 0.25);

    $html = '<h3>📋 Ejemplos Comparativos</h3>';
    $html .= '<table class="tabla-ejemplos">';
    $html .= '<tr><th>Número</th><th>Mi sqrt()</th><th>PHP sqrt()</th><th>Error Relativo</th></tr>';

    foreach ($ejemplos as $ejemplo) {
        $mi_calc = mi_sqrt($ejemplo);
        $nativo = sqrt($ejemplo);
        $error = compararConNativo($ejemplo, $mi_calc);

        $html .= "<tr>
                    <td><strong>$ejemplo</strong></td>
                    <td>" . number_format($mi_calc, 6) . "</td>
                    <td>" . number_format($nativo, 6) . "</td>
                    <td>$error</td>
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