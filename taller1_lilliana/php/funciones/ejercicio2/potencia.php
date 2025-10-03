<?php
// Función para determinar si es consola o web
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// Implementación de pow() usando método iterativo
function mi_pow_iterativo($base, $exponente) {
    // Casos especiales
    if ($exponente == 0) return 1;
    if ($base == 0) return 0;
    if ($base == 1) return 1;

    $resultado = 1;
    $exponente_abs = abs($exponente);

    for ($i = 0; $i < $exponente_abs; $i++) {
        $resultado *= $base;
    }

    // Manejar exponentes negativos
    if ($exponente < 0) {
        return 1 / $resultado;
    }

    return $resultado;
}

// Implementación de pow() usando método de exponenciación binaria (más eficiente)
function mi_pow_binario($base, $exponente) {
    // Casos especiales
    if ($exponente == 0) return 1;
    if ($base == 0) return 0;
    if ($base == 1) return 1;

    $resultado = 1;
    $exponente_abs = abs($exponente);
    $base_actual = $base;

    while ($exponente_abs > 0) {
        // Si el exponente es impar, multiplicar por la base actual
        if ($exponente_abs % 2 == 1) {
            $resultado *= $base_actual;
        }

        // Elevar la base al cuadrado
        $base_actual *= $base_actual;
        // Dividir el exponente entre 2
        $exponente_abs = (int)($exponente_abs / 2);
    }

    // Manejar exponentes negativos
    if ($exponente < 0) {
        return 1 / $resultado;
    }

    return $resultado;
}

// Implementación de pow() usando logaritmos (para exponentes fraccionarios)
function mi_pow_logaritmico($base, $exponente) {
    if ($base <= 0) {
        return false; // No maneja bases negativas con exponentes fraccionarios
    }

    return exp($exponente * log($base));
}

// Función principal que elige el mejor método
function mi_pow($base, $exponente, $metodo = 'auto') {
    // Casos especiales
    if ($exponente == 0) return 1;
    if ($base == 0) return 0;
    if ($base == 1) return 1;

    // Determinar el método a usar
    if ($metodo === 'auto') {
        // Si el exponente es entero, usar método binario (más eficiente)
        if (floor($exponente) == $exponente) {
            return mi_pow_binario($base, $exponente);
        } else {
            // Para exponentes fraccionarios, usar logaritmos
            return mi_pow_logaritmico($base, $exponente);
        }
    } elseif ($metodo === 'iterativo') {
        return mi_pow_iterativo($base, $exponente);
    } elseif ($metodo === 'binario') {
        return mi_pow_binario($base, $exponente);
    } elseif ($metodo === 'logaritmico') {
        return mi_pow_logaritmico($base, $exponente);
    }

    return false;
}

// Función para comparar con pow() nativo de PHP
function compararConNativo($base, $exponente, $mi_calculo) {
    if ($mi_calculo === false) {
        return "N/A";
    }

    $nativo = pow($base, $exponente);

    // Evitar división por cero
    if ($nativo == 0) {
        return "∞";
    }

    $diferencia = abs($mi_calculo - $nativo);
    $porcentaje_error = ($diferencia / abs($nativo)) * 100;

    return number_format($porcentaje_error, 10) . "%";
}

// Función para mostrar proceso de exponenciación binaria
function mostrarProcesoBinario($base, $exponente) {
    if (floor($exponente) != $exponente || $exponente <= 0) {
        return "";
    }

    $proceso = "Proceso de exponenciación binaria:\n";
    $resultado = 1;
    $base_actual = $base;
    $exp_actual = abs($exponente);
    $paso = 1;

    $proceso .= "Inicio: resultado = 1, base = $base, exponente = $exp_actual\n";

    while ($exp_actual > 0) {
        $proceso .= "Paso $paso: ";

        if ($exp_actual % 2 == 1) {
            $proceso .= "Exponente impar ($exp_actual), multiplicar resultado × base_actual: ";
            $resultado_anterior = $resultado;
            $resultado *= $base_actual;
            $proceso .= "$resultado_anterior × $base_actual = $resultado\n";
        } else {
            $proceso .= "Exponente par ($exp_actual), solo elevar base al cuadrado\n";
        }

        $base_anterior = $base_actual;
        $base_actual *= $base_actual;
        $exp_actual = (int)($exp_actual / 2);
        $paso++;

        if ($exp_actual > 0) {
            $proceso .= "        Base = $base_anterior² = $base_actual, Exponente = $exp_actual\n";
        }
    }

    return $proceso;
}

// Función para limpiar entrada
function limpiarEntrada($dato) {
    return filter_var($dato, FILTER_VALIDATE_FLOAT);
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "    IMPLEMENTACIÓN DE POW()\n";
    echo "    Cálculo de Potencias\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    // Leer base y exponente del usuario
    echo "Ingrese la base: ";
    $input_base = trim(fgets(STDIN));
    $base = limpiarEntrada($input_base);

    echo "Ingrese el exponente: ";
    $input_exponente = trim(fgets(STDIN));
    $exponente = limpiarEntrada($input_exponente);

    // Validar entradas
    if ($base === false || $exponente === false) {
        echo "❌ Error: Debe ingresar números válidos.\n";
        return;
    }

    // Calcular con diferentes métodos
    $resultado_iterativo = mi_pow($base, $exponente, 'iterativo');
    $resultado_binario = mi_pow($base, $exponente, 'binario');
    $resultado_log = mi_pow($base, $exponente, 'logaritmico');
    $resultado_auto = mi_pow($base, $exponente, 'auto');
    $nativo = pow($base, $exponente);

    // Mostrar resultados
    echo "\n🔍 RESULTADOS:\n";
    echo "================\n";
    printf("📊 Base: %.6f, Exponente: %.6f\n", $base, $exponente);
    echo "\n";

    printf("🔄 Método iterativo:    %.10f\n", $resultado_iterativo);
    printf("⚡ Método binario:      %.10f\n", $resultado_binario);

    if ($resultado_log !== false) {
        printf("📈 Método logarítmico:  %.10f\n", $resultado_log);
    } else {
        echo "📈 Método logarítmico:  No disponible para base negativa\n";
    }

    printf("🤖 Método automático:   %.10f\n", $resultado_auto);
    printf("🏁 PHP pow() nativo:    %.10f\n", $nativo);

    // Mostrar errores
    echo "\n📊 COMPARACIÓN DE PRECISIÓN:\n";
    echo "---------------------------\n";
    printf("Iterativo vs Nativo:   %s\n", compararConNativo($base, $exponente, $resultado_iterativo));
    printf("Binario vs Nativo:     %s\n", compararConNativo($base, $exponente, $resultado_binario));

    if ($resultado_log !== false) {
        printf("Logarítmico vs Nativo: %s\n", compararConNativo($base, $exponente, $resultado_log));
    }

    // Mostrar proceso si es entero positivo
    if (floor($exponente) == $exponente && $exponente > 0) {
        echo "\n" . mostrarProcesoBinario($base, $exponente);
    }

    // Mostrar tabla de ejemplos
    echo "\n📋 EJEMPLOS DE POTENCIAS:\n";
    echo "------------------------\n";
    $ejemplos = array(
        array(2, 3),
        array(2, -2),
        array(5, 0),
        array(10, 3),
        array(2, 0.5),
        array(8, 1/3)
    );

    foreach ($ejemplos as $ejemplo) {
        $b = $ejemplo[0];
        $e = $ejemplo[1];
        $mi_calc = mi_pow($b, $e, 'auto');
        $nativo = pow($b, $e);
        $error = compararConNativo($b, $e, $mi_calc);
        printf("%5.1f^%-8s → Mi: %8.6f, PHP: %8.6f, Error: %s\n",
               $b, $e, $mi_calc, $nativo, $error);
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $base = null;
    $exponente = null;
    $resultados = array();
    $proceso_binario = '';
    $clase_css = '';

    // Procesar formulario si se envió
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['base']) && isset($_POST['exponente'])) {
        $base = limpiarEntrada($_POST['base']);
        $exponente = limpiarEntrada($_POST['exponente']);

        if ($base === false || $exponente === false) {
            $resultado = "❌ Error: Debe ingresar números válidos.";
            $clase_css = 'error';
        } else {
            // Calcular con diferentes métodos
            $resultados['iterativo'] = mi_pow($base, $exponente, 'iterativo');
            $resultados['binario'] = mi_pow($base, $exponente, 'binario');
            $resultados['logaritmico'] = mi_pow($base, $exponente, 'logaritmico');
            $resultados['auto'] = mi_pow($base, $exponente, 'auto');
            $resultados['nativo'] = pow($base, $exponente);

            // Calcular errores
            $resultados['error_iterativo'] = compararConNativo($base, $exponente, $resultados['iterativo']);
            $resultados['error_binario'] = compararConNativo($base, $exponente, $resultados['binario']);
            $resultados['error_logaritmico'] = ($resultados['logaritmico'] !== false) ?
                compararConNativo($base, $exponente, $resultados['logaritmico']) : 'N/A';

            $resultado = "✅ Cálculos completados";
            $clase_css = 'exito';

            // Generar proceso binario si es aplicable
            if (floor($exponente) == $exponente && $exponente > 0) {
                $proceso_binario = generarProcesoBinarioHTML($base, $exponente);
            }
        }
    }

    // Generar HTML
    echo generarHTML($resultado, $clase_css, $base, $exponente, $resultados, $proceso_binario);
}

function generarProcesoBinarioHTML($base, $exponente) {
    $html = "<div class='proceso-binario'>";
    $html .= "<h4>🔍 Proceso de Exponenciación Binaria:</h4>";
    $html .= "<div class='pasos'>";

    $resultado = 1;
    $base_actual = $base;
    $exp_actual = abs($exponente);
    $paso = 1;

    $html .= "<div class='paso'>Paso 0: resultado = 1, base = $base, exponente = $exp_actual</div>";

    while ($exp_actual > 0) {
        $html .= "<div class='paso'>";
        $html .= "<strong>Paso $paso:</strong> ";

        if ($exp_actual % 2 == 1) {
            $resultado_anterior = $resultado;
            $resultado *= $base_actual;
            $html .= "Exponente impar ($exp_actual), multiplicar: $resultado_anterior × $base_actual = <strong>$resultado</strong>";
        } else {
            $html .= "Exponente par ($exp_actual), solo elevar base al cuadrado";
        }

        $base_anterior = $base_actual;
        $base_actual *= $base_actual;
        $exp_actual = (int)($exp_actual / 2);
        $paso++;

        if ($exp_actual > 0) {
            $html .= "<br>→ Base = $base_anterior² = $base_actual, Exponente = $exp_actual";
        }

        $html .= "</div>";
    }

    $html .= "</div></div>";
    return $html;
}

function generarHTML($resultado, $clase_css, $base_valor, $exponente_valor, $resultados, $proceso_binario) {
    $base_actual = ($base_valor !== null) ? $base_valor : '';
    $exponente_actual = ($exponente_valor !== null) ? $exponente_valor : '';

    $html_resultado = '';
    if (!empty($resultado)) {
        $html_detalles = '';
        if ($clase_css == 'exito') {
            $html_detalles = "
                <div class='detalles-calculo'>
                    <div class='resultados-comparacion'>
                        <div class='resultado-item'>
                            <span class='etiqueta'>🔄 Método iterativo:</span>
                            <span class='valor'>" . number_format($resultados['iterativo'], 10) . "</span>
                            <span class='error'>Error: " . $resultados['error_iterativo'] . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>⚡ Método binario:</span>
                            <span class='valor'>" . number_format($resultados['binario'], 10) . "</span>
                            <span class='error'>Error: " . $resultados['error_binario'] . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>📈 Método logarítmico:</span>
                            <span class='valor'>" .
                                ($resultados['logaritmico'] !== false ?
                                number_format($resultados['logaritmico'], 10) : 'No disponible') . "</span>
                            <span class='error'>Error: " . $resultados['error_logaritmico'] . "</span>
                        </div>
                        <div class='resultado-item destacado'>
                            <span class='etiqueta'>🤖 Método automático:</span>
                            <span class='valor'>" . number_format($resultados['auto'], 10) . "</span>
                        </div>
                        <div class='resultado-item nativo'>
                            <span class='etiqueta'>🏁 PHP pow() nativo:</span>
                            <span class='valor'>" . number_format($resultados['nativo'], 10) . "</span>
                        </div>
                    </div>
                    $proceso_binario
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
    <title>Implementación de pow() - Web</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
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

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-col {
            flex: 1;
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
            align-items: center;
            margin: 12px 0;
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            background: white;
            border-radius: 6px;
        }

        .resultado-item.destacado {
            background: #e6fffa;
            border-left: 4px solid #38b2ac;
        }

        .resultado-item.nativo {
            background: #fffaf0;
            border-left: 4px solid #ed8936;
        }

        .etiqueta {
            font-weight: bold;
            color: #4a5568;
            min-width: 200px;
        }

        .valor {
            font-family: monospace;
            background: #edf2f7;
            padding: 5px 12px;
            border-radius: 4px;
            flex: 1;
            margin: 0 15px;
            text-align: center;
        }

        .error {
            font-family: monospace;
            background: #fed7d7;
            color: #742a2a;
            padding: 5px 12px;
            border-radius: 4px;
            min-width: 150px;
            text-align: center;
            font-size: 14px;
        }

        .proceso-binario {
            background: #f7fafc;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .pasos {
            margin-top: 10px;
        }

        .paso {
            padding: 10px;
            margin: 8px 0;
            background: white;
            border-radius: 6px;
            border-left: 4px solid #667eea;
            font-family: monospace;
            font-size: 14px;
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
            font-size: 14px;
        }

        .metodos {
            display: flex;
            gap: 15px;
            margin: 15px 0;
        }

        .metodo {
            flex: 1;
            padding: 15px;
            background: #f7fafc;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }

        .metodo h4 {
            margin-top: 0;
            color: #4a5568;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧮 Implementación de pow()</h1>
        <div class="subtitle">Cálculo de potencias con diferentes métodos</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="metodos">
            <div class="metodo">
                <h4>🔄 Método Iterativo</h4>
                <p>Multiplicación repetida: O(n)</p>
            </div>
            <div class="metodo">
                <h4>⚡ Método Binario</h4>
                <p>Exponenciación por cuadrados: O(log n)</p>
            </div>
            <div class="metodo">
                <h4>📈 Método Logarítmico</h4>
                <p>Usa logaritmos: aᵇ = exp(b × log(a))</p>
            </div>
        </div>

        <form method="POST" action="">
            <div class="form-row">
                <div class="form-col">
                    <label for="base">Base:</label>
                    <input type="number" id="base" name="base" value="$base_actual"
                           placeholder="Ej: 2, 5, 10..." required step="any">
                </div>
                <div class="form-col">
                    <label for="exponente">Exponente:</label>
                    <input type="number" id="exponente" name="exponente" value="$exponente_actual"
                           placeholder="Ej: 3, -2, 0.5..." required step="any">
                </div>
            </div>

            <button type="submit">🧮 Calcular Potencia</button>
        </form>

        $html_resultado
        $html_tabla

        <div class="info">
            <strong>💡 Información:</strong>
            <ul>
                <li><strong>Método iterativo:</strong> Simple pero ineficiente para exponentes grandes</li>
                <li><strong>Método binario:</strong> Muy eficiente, usa la representación binaria del exponente</li>
                <li><strong>Método logarítmico:</strong> Útil para exponentes fraccionarios, no funciona con bases negativas</li>
                <li><strong>Método automático:</strong> Elige el mejor método según el tipo de exponente</li>
            </ul>
        </div>
    </div>
</body>
</html>
HTML;
}

function generarTablaEjemplos() {
    $ejemplos = array(
        array(2, 3, "2³ = 8"),
        array(2, -2, "2⁻² = 0.25"),
        array(5, 0, "5⁰ = 1"),
        array(10, 3, "10³ = 1000"),
        array(2, 0.5, "2⁰·⁵ = √2"),
        array(8, 1/3, "8¹ᐟ³ = 2"),
        array(3, 4, "3⁴ = 81"),
        array(4, -1, "4⁻¹ = 0.25")
    );

    $html = '<h3>📋 Ejemplos de Potencias</h3>';
    $html .= '<table class="tabla-ejemplos">';
    $html .= '<tr><th>Base</th><th>Exponente</th><th>Fórmula</th><th>Mi pow()</th><th>PHP pow()</th><th>Error</th></tr>';

    foreach ($ejemplos as $ejemplo) {
        $base = $ejemplo[0];
        $exponente = $ejemplo[1];
        $formula = $ejemplo[2];

        $mi_calc = mi_pow($base, $exponente, 'auto');
        $nativo = pow($base, $exponente);
        $error = compararConNativo($base, $exponente, $mi_calc);

        $html .= "<tr>
                    <td><strong>$base</strong></td>
                    <td><strong>$exponente</strong></td>
                    <td>$formula</td>
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