<?php
// Función para determinar si es consola o web
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// Función para calcular factorial (necesaria para Taylor)
function factorial($n) {
    if ($n == 0 || $n == 1) return 1;
    $resultado = 1;
    for ($i = 2; $i <= $n; $i++) {
        $resultado *= $i;
    }
    return $resultado;
}

// Implementación de cos() usando series de Taylor
function mi_cos_taylor($x, $terminos = 10) {
    // Reducir el ángulo al rango [-2π, 2π] usando periodicidad
    $x = fmod($x, 2 * M_PI);

    $resultado = 0;
    for ($n = 0; $n < $terminos; $n++) {
        $termino = pow(-1, $n) * pow($x, 2 * $n) / factorial(2 * $n);
        $resultado += $termino;
    }
    return $resultado;
}

// Implementación de cos() usando aproximación polinómica
function mi_cos_polinomico($x) {
    // Reducir el ángulo al rango [0, 2π]
    $x = fmod($x, 2 * M_PI);
    if ($x < 0) $x += 2 * M_PI;

    // Aproximación polinómica para coseno
    // Usaremos una aproximación de Chebyshev o una racional
    if ($x >= 0 && $x <= M_PI) {
        // Para x en [0, π], podemos usar una aproximación
        $x2 = $x * $x;
        return 1 - $x2/2 * (1 - $x2/12 * (1 - $x2/30 * (1 - $x2/56)));
    } else {
        // Para x en [π, 2π], cos(x) = -cos(x - π)
        return -mi_cos_polinomico($x - M_PI);
    }
}

// Implementación de cos() usando la identidad cos(x) = sin(π/2 - x)
function mi_cos_identidad($x) {
    return mi_sin_taylor(M_PI/2 - $x);
}

// Necesitamos la función sin() de Taylor para la identidad
function mi_sin_taylor($x, $terminos = 10) {
    $x = fmod($x, 2 * M_PI);
    $resultado = 0;
    for ($n = 0; $n < $terminos; $n++) {
        $termino = pow(-1, $n) * pow($x, 2 * $n + 1) / factorial(2 * $n + 1);
        $resultado += $termino;
    }
    return $resultado;
}

// Implementación de cos() usando lookup table con interpolación
function mi_cos_lookup($x, $precision = 1000) {
    // Reducir el ángulo al rango [0, 2π]
    $x = fmod($x, 2 * M_PI);
    if ($x < 0) $x += 2 * M_PI;

    // Crear tabla de lookup si no existe
    static $cos_table = null;
    if ($cos_table === null) {
        $cos_table = array();
        for ($i = 0; $i <= $precision; $i++) {
            $angle = ($i / $precision) * 2 * M_PI;
            $cos_table[$i] = cos($angle); // Usamos nativo para la tabla
        }
    }

    // Encontrar los índices más cercanos
    $index = ($x / (2 * M_PI)) * $precision;
    $index_floor = floor($index);
    $index_ceil = ceil($index);

    // Interpolación lineal
    if ($index_floor == $index_ceil) {
        return $cos_table[$index_floor];
    }

    $weight = $index - $index_floor;
    return $cos_table[$index_floor] * (1 - $weight) + $cos_table[$index_ceil] * $weight;
}

// Función principal que elige el método
function mi_cos($x, $metodo = 'auto', $terminos_taylor = 10) {
    switch ($metodo) {
        case 'taylor':
            return mi_cos_taylor($x, $terminos_taylor);
        case 'polinomico':
            return mi_cos_polinomico($x);
        case 'identidad':
            return mi_cos_identidad($x);
        case 'lookup':
            return mi_cos_lookup($x);
        case 'auto':
        default:
            // Para alta precisión usar Taylor
            return mi_cos_taylor($x, $terminos_taylor);
    }
}

// Función para convertir grados a radianes
function grados_a_radianes($grados) {
    return $grados * M_PI / 180;
}

// Función para convertir radianes a grados
function radianes_a_grados($radianes) {
    return $radianes * 180 / M_PI;
}

// Función para comparar con cos() nativo de PHP
function compararConNativo($x, $mi_calculo) {
    $nativo = cos($x);

    // Evitar división por cero
    if ($nativo == 0) {
        return abs($mi_calculo) < 1e-10 ? "0.0000000000%" : "∞";
    }

    $diferencia = abs($mi_calculo - $nativo);
    $porcentaje_error = ($diferencia / abs($nativo)) * 100;

    return number_format($porcentaje_error, 10) . "%";
}

// Función para mostrar proceso de serie de Taylor
function mostrarProcesoTaylor($x, $terminos = 5) {
    $proceso = "Serie de Taylor para cos(x):\n";
    $proceso .= "cos(x) = ";

    $terminos_formula = array();
    for ($n = 0; $n < $terminos; $n++) {
        $signo = $n % 2 == 0 ? '' : '-';
        $exponente = 2 * $n;
        $factorial = factorial(2 * $n);

        if ($n == 0) {
            $terminos_formula[] = "1";
        } else {
            $terminos_formula[] = "$signo x^{$exponente}/{$exponente}!";
        }

        $proceso .= ($n > 0 ? " " . ($n % 2 == 0 ? "+" : "-") . " " : "") . "x^{$exponente}/{$exponente}!";
    }
    $proceso .= " + ...\n\n";

    $proceso .= "Cálculo paso a paso (primeros $terminos términos):\n";
    $resultado_parcial = 0;
    for ($n = 0; $n < $terminos; $n++) {
        $termino_valor = pow(-1, $n) * pow($x, 2 * $n) / factorial(2 * $n);
        $resultado_parcial += $termino_valor;
        $proceso .= sprintf("Término %d: %s = %.10f → Suma parcial: %.10f\n",
            $n + 1, $terminos_formula[$n], $termino_valor, $resultado_parcial);
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
    echo "    IMPLEMENTACIÓN DE COS()\n";
    echo "   Cálculo del Coseno\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Métodos disponibles:\n";
    echo "- Serie de Taylor: cos(x) = 1 - x²/2! + x⁴/4! - x⁶/6! + ...\n";
    echo "- Aproximación polinómica\n";
    echo "- Identidad trigonométrica: cos(x) = sin(π/2 - x)\n";
    echo "- Tabla de búsqueda con interpolación\n\n";

    // Leer ángulo del usuario
    echo "Ingrese el ángulo (en radianes, o añada 'g' para grados): ";
    $input = trim(fgets(STDIN));

    // Detectar si es grados o radianes
    $es_grados = (substr($input, -1) === 'g' || substr($input, -1) === 'G');
    if ($es_grados) {
        $input = substr($input, 0, -1);
    }

    $angulo = limpiarEntrada($input);

    // Validar entrada
    if ($angulo === false) {
        echo "❌ Error: Debe ingresar un número válido.\n";
        return;
    }

    // Convertir a radianes si es necesario
    if ($es_grados) {
        $angulo_rad = grados_a_radianes($angulo);
        echo "🔁 Convertido: {$angulo}° = " . number_format($angulo_rad, 6) . " rad\n";
    } else {
        $angulo_rad = $angulo;
        $angulo_grados = radianes_a_grados($angulo);
        echo "🔁 Convertido: " . number_format($angulo, 6) . " rad = {$angulo_grados}°\n";
    }

    // Calcular con diferentes métodos
    $resultado_taylor = mi_cos($angulo_rad, 'taylor', 10);
    $resultado_polinomico = mi_cos($angulo_rad, 'polinomico');
    $resultado_identidad = mi_cos($angulo_rad, 'identidad');
    $resultado_lookup = mi_cos($angulo_rad, 'lookup');
    $resultado_auto = mi_cos($angulo_rad, 'auto');
    $nativo = cos($angulo_rad);

    // Mostrar resultados
    echo "\n🔍 RESULTADOS:\n";
    echo "================\n";
    printf("📊 Ángulo: %.6f rad (%.2f°)\n", $angulo_rad, radianes_a_grados($angulo_rad));
    echo "\n";

    printf("📈 Serie de Taylor (10 términos): %.10f\n", $resultado_taylor);
    printf("🔢 Aproximación polinómica:       %.10f\n", $resultado_polinomico);
    printf("🔄 Identidad trigonométrica:      %.10f\n", $resultado_identidad);
    printf("📋 Tabla de búsqueda:             %.10f\n", $resultado_lookup);
    printf("🤖 Método automático:             %.10f\n", $resultado_auto);
    printf("🏁 PHP cos() nativo:              %.10f\n", $nativo);

    // Mostrar errores
    echo "\n📊 COMPARACIÓN DE PRECISIÓN:\n";
    echo "---------------------------\n";
    printf("Taylor vs Nativo:        %s\n", compararConNativo($angulo_rad, $resultado_taylor));
    printf("Polinómico vs Nativo:    %s\n", compararConNativo($angulo_rad, $resultado_polinomico));
    printf("Identidad vs Nativo:     %s\n", compararConNativo($angulo_rad, $resultado_identidad));
    printf("Lookup vs Nativo:        %s\n", compararConNativo($angulo_rad, $resultado_lookup));

    // Mostrar proceso de Taylor
    echo "\n" . mostrarProcesoTaylor($angulo_rad, 5);

    // Mostrar tabla de ángulos importantes
    echo "\n📋 VALORES IMPORTANTES DEL COSENO:\n";
    echo "---------------------------------\n";
    $angulos_importantes = array(0, M_PI/6, M_PI/4, M_PI/3, M_PI/2, M_PI, 3*M_PI/2, 2*M_PI);
    $nombres = array("0", "π/6", "π/4", "π/3", "π/2", "π", "3π/2", "2π");

    foreach ($angulos_importantes as $i => $angulo_val) {
        $mi_calc = mi_cos($angulo_val, 'taylor', 10);
        $nativo_val = cos($angulo_val);
        $error = compararConNativo($angulo_val, $mi_calc);
        printf("%-6s (%5.1f°): Mi: %8.6f, PHP: %8.6f, Error: %s\n",
               $nombres[$i], radianes_a_grados($angulo_val), $mi_calc, $nativo_val, $error);
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $angulo = null;
    $es_grados = false;
    $resultados = array();
    $proceso_taylor = '';
    $clase_css = '';

    // Procesar formulario si se envió
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['angulo'])) {
            $input = trim($_POST['angulo']);
            $es_grados = isset($_POST['unidad']) && $_POST['unidad'] === 'grados';

            // Detectar si el usuario añadió 'g' o 'grados'
            if (preg_match('/^([\d\.\-]+)\s*(g|grados?)?$/i', $input, $matches)) {
                $angulo = limpiarEntrada($matches[1]);
                if (!empty($matches[2])) {
                    $es_grados = true;
                }
            } else {
                $angulo = limpiarEntrada($input);
            }

            if ($angulo === false) {
                $resultado = "❌ Error: Debe ingresar un número válido.";
                $clase_css = 'error';
            } else {
                // Convertir a radianes si es necesario
                $angulo_rad = $es_grados ? grados_a_radianes($angulo) : $angulo;

                // Calcular con diferentes métodos
                $resultados['taylor'] = mi_cos($angulo_rad, 'taylor', 10);
                $resultados['polinomico'] = mi_cos($angulo_rad, 'polinomico');
                $resultados['identidad'] = mi_cos($angulo_rad, 'identidad');
                $resultados['lookup'] = mi_cos($angulo_rad, 'lookup');
                $resultados['auto'] = mi_cos($angulo_rad, 'auto');
                $resultados['nativo'] = cos($angulo_rad);

                // Calcular errores
                $resultados['error_taylor'] = compararConNativo($angulo_rad, $resultados['taylor']);
                $resultados['error_polinomico'] = compararConNativo($angulo_rad, $resultados['polinomico']);
                $resultados['error_identidad'] = compararConNativo($angulo_rad, $resultados['identidad']);
                $resultados['error_lookup'] = compararConNativo($angulo_rad, $resultados['lookup']);

                $resultado = "✅ Cálculos completados";
                $clase_css = 'exito';

                // Generar proceso Taylor
                $proceso_taylor = generarProcesoTaylorHTML($angulo_rad, 5);

                // Guardar valores para mostrar
                $resultados['angulo_rad'] = $angulo_rad;
                $resultados['angulo_grados'] = radianes_a_grados($angulo_rad);
                $resultados['es_grados'] = $es_grados;
                $resultados['angulo_original'] = $angulo;
            }
        }
    }

    // Generar HTML
    echo generarHTML($resultado, $clase_css, $angulo, $es_grados, $resultados, $proceso_taylor);
}

function generarProcesoTaylorHTML($x, $terminos) {
    $html = "<div class='proceso-taylor'>";
    $html .= "<h4>🔍 Serie de Taylor (primeros $terminos términos):</h4>";
    $html .= "<div class='formula'>cos(x) = ";

    for ($n = 0; $n < $terminos; $n++) {
        $signo = $n == 0 ? '' : ($n % 2 == 0 ? ' + ' : ' - ');
        $exponente = 2 * $n;
        $html .= "{$signo}x<sup>{$exponente}</sup>/{$exponente}!";
    }
    $html .= " + ...</div>";

    $html .= "<div class='calculos-paso-a-paso'>";
    $resultado_parcial = 0;
    for ($n = 0; $n < $terminos; $n++) {
        $termino_valor = pow(-1, $n) * pow($x, 2 * $n) / factorial(2 * $n);
        $resultado_parcial += $termino_valor;
        $exponente = 2 * $n;
        $html .= "<div class='paso'>";
        $html .= "<strong>Término " . ($n + 1) . ":</strong> ";
        $html .= "(" . ($n % 2 == 0 ? '+' : '-') . ") x<sup>{$exponente}</sup>/{$exponente}! = ";
        $html .= "<span class='valor-termino'>" . number_format($termino_valor, 10) . "</span>";
        $html .= " → Suma parcial: <span class='suma-parcial'>" . number_format($resultado_parcial, 10) . "</span>";
        $html .= "</div>";
    }
    $html .= "</div></div>";

    return $html;
}

function generarHTML($resultado, $clase_css, $angulo_valor, $es_grados_valor, $resultados, $proceso_taylor) {
    $angulo_actual = ($angulo_valor !== null) ? $angulo_valor : '';
    $grados_checked = $es_grados_valor ? 'checked' : '';
    $radianes_checked = !$es_grados_valor ? 'checked' : '';

    $html_resultado = '';
    if (!empty($resultado)) {
        $html_detalles = '';
        if ($clase_css == 'exito') {
            $unidad_entrada = $resultados['es_grados'] ? 'grados' : 'radianes';
            $angulo_mostrar = $resultados['es_grados'] ?
                "{$resultados['angulo_original']}° = " . number_format($resultados['angulo_rad'], 6) . " rad" :
                number_format($resultados['angulo_rad'], 6) . " rad = " . number_format($resultados['angulo_grados'], 2) . "°";

            $html_detalles = "
                <div class='detalles-calculo'>
                    <div class='angulo-convertido'>
                        📊 Ángulo: <strong>$angulo_mostrar</strong>
                    </div>
                    <div class='resultados-comparacion'>
                        <div class='resultado-item'>
                            <span class='etiqueta'>📈 Serie de Taylor:</span>
                            <span class='valor'>" . number_format($resultados['taylor'], 10) . "</span>
                            <span class='error'>Error: " . $resultados['error_taylor'] . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>🔢 Aproximación polinómica:</span>
                            <span class='valor'>" . number_format($resultados['polinomico'], 10) . "</span>
                            <span class='error'>Error: " . $resultados['error_polinomico'] . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>🔄 Identidad trigonométrica:</span>
                            <span class='valor'>" . number_format($resultados['identidad'], 10) . "</span>
                            <span class='error'>Error: " . $resultados['error_identidad'] . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>📋 Tabla de búsqueda:</span>
                            <span class='valor'>" . number_format($resultados['lookup'], 10) . "</span>
                            <span class='error'>Error: " . $resultados['error_lookup'] . "</span>
                        </div>
                        <div class='resultado-item destacado'>
                            <span class='etiqueta'>🤖 Método automático:</span>
                            <span class='valor'>" . number_format($resultados['auto'], 10) . "</span>
                        </div>
                        <div class='resultado-item nativo'>
                            <span class='etiqueta'>🏁 PHP cos() nativo:</span>
                            <span class='valor'>" . number_format($resultados['nativo'], 10) . "</span>
                        </div>
                    </div>
                    $proceso_taylor
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

    // Generar tabla de valores importantes
    $html_tabla = generarTablaValoresImportantes();

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implementación de cos() - Web</title>
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

        .unidad-opciones {
            display: flex;
            gap: 20px;
            margin: 10px 0;
        }

        .unidad-opcion {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #4a5568;
        }

        input[type="number"], input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #cbd5e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        input[type="number"]:focus, input[type="text"]:focus {
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

        .angulo-convertido {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            padding: 10px;
            background: rgba(255,255,255,0.7);
            border-radius: 8px;
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
            min-width: 250px;
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

        .proceso-taylor {
            background: #f7fafc;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .formula {
            font-family: monospace;
            background: #2d3748;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            text-align: center;
            font-size: 16px;
        }

        .calculos-paso-a-paso {
            margin-top: 15px;
        }

        .paso {
            padding: 8px;
            margin: 5px 0;
            background: white;
            border-radius: 4px;
            border-left: 4px solid #667eea;
            font-family: monospace;
            font-size: 14px;
        }

        .valor-termino, .suma-parcial {
            font-weight: bold;
            color: #2d3748;
        }

        .info {
            background: #bee3f8;
            color: #2a4365;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .tabla-valores {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabla-valores th,
        .tabla-valores td {
            padding: 12px;
            text-align: center;
            border: 1px solid #cbd5e0;
        }

        .tabla-valores th {
            background: #4a5568;
            color: white;
        }

        .tabla-valores tr:nth-child(even) {
            background: #f7fafc;
        }

        .tabla-valores tr:hover {
            background: #edf2f7;
        }

        .definicion {
            background: #f0fff4;
            border-left: 4px solid #48bb78;
            padding: 15px;
            margin: 15px 0;
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

        .ejemplos-rapidos {
            display: flex;
            gap: 10px;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .ejemplo-rapido {
            padding: 8px 15px;
            background: #e2e8f0;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .ejemplo-rapido:hover {
            background: #cbd5e0;
        }

        .propiedades {
            background: #fffaf0;
            border-left: 4px solid #ed8936;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧮 Implementación de cos()</h1>
        <div class="subtitle">Cálculo del coseno con diferentes métodos numéricos</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="metodos">
            <div class="metodo">
                <h4>📈 Serie de Taylor</h4>
                <p>cos(x) = 1 - x²/2! + x⁴/4! - x⁶/6! + ...</p>
                <p><strong>Precisión:</strong> Alta</p>
                <p><strong>Eficiencia:</strong> Media</p>
            </div>
            <div class="metodo">
                <h4>🔢 Aproximación Polinómica</h4>
                <p>Aproximación racional optimizada</p>
                <p><strong>Precisión:</strong> Media</p>
                <p><strong>Eficiencia:</strong> Alta</p>
            </div>
            <div class="metodo">
                <h4>🔄 Identidad Trigonométrica</h4>
                <p>cos(x) = sin(π/2 - x)</p>
                <p><strong>Precisión:</strong> Alta</p>
                <p><strong>Eficiencia:</strong> Media</p>
            </div>
        </div>

        <div class="propiedades">
            <h4>📚 Propiedades del Coseno:</h4>
            <ul>
                <li><strong>Periodicidad:</strong> cos(x + 2π) = cos(x)</li>
                <li><strong>Paridad:</strong> cos(-x) = cos(x) (función par)</li>
                <li><strong>Relación con seno:</strong> cos(x) = sin(π/2 - x)</li>
                <li><strong>Identidad fundamental:</strong> cos²(x) + sin²(x) = 1</li>
            </ul>
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="angulo">Ingrese el ángulo:</label>
                <input type="text" id="angulo" name="angulo" value="$angulo_actual"
                       placeholder='Ej: "0.7854", "45g", "π/4"' required>
                <div class="unidad-opciones">
                    <div class="unidad-opcion">
                        <input type="radio" id="radianes" name="unidad" value="radianes" $radianes_checked>
                        <label for="radianes">Radianes</label>
                    </div>
                    <div class="unidad-opcion">
                        <input type="radio" id="grados" name="unidad" value="grados" $grados_checked>
                        <label for="grados">Grados</label>
                    </div>
                </div>
            </div>

            <div class="ejemplos-rapidos">
                <button type="button" class="ejemplo-rapido" onclick="document.getElementById('angulo').value='0'">0°</button>
                <button type="button" class="ejemplo-rapido" onclick="document.getElementById('angulo').value='30g'">30°</button>
                <button type="button" class="ejemplo-rapido" onclick="document.getElementById('angulo').value='45g'">45°</button>
                <button type="button" class="ejemplo-rapido" onclick="document.getElementById('angulo').value='60g'">60°</button>
                <button type="button" class="ejemplo-rapido" onclick="document.getElementById('angulo').value='90g'">90°</button>
                <button type="button" class="ejemplo-rapido" onclick="document.getElementById('angulo').value='1.0472'">π/3 rad</button>
            </div>

            <button type="submit">🧮 Calcular Coseno</button>
        </form>

        $html_resultado
        $html_tabla

        <div class="info">
            <strong>💡 Información:</strong>
            <ul>
                <li><strong>Serie de Taylor:</strong> Expansión matemática exacta, converge para todo x real</li>
                <li><strong>Aproximación polinómica:</strong> Más eficiente pero menos precisa que Taylor</li>
                <li><strong>Identidad trigonométrica:</strong> Usa la relación fundamental entre seno y coseno</li>
                <li><strong>Tabla de búsqueda:</strong> Método histórico usado en calculadoras antiguas</li>
                <li>El coseno es una función par: cos(-x) = cos(x)</li>
                <li>El coseno tiene período 2π (360°)</li>
            </ul>
        </div>
    </div>

    <script>
        // Agregar funcionalidad a los botones de ejemplos rápidos
        document.querySelectorAll('.ejemplo-rapido').forEach(button => {
            button.addEventListener('click', function() {
                const valor = this.textContent;
                if (valor.includes('°')) {
                    document.getElementById('grados').checked = true;
                } else if (valor.includes('rad')) {
                    document.getElementById('radianes').checked = true;
                }
            });
        });
    </script>
</body>
</html>
HTML;
}

function generarTablaValoresImportantes() {
    $angulos = array(
        array("valor" => 0, "nombre" => "0", "grados" => 0, "cos_exacto" => 1),
        array("valor" => M_PI/6, "nombre" => "π/6", "grados" => 30, "cos_exacto" => sqrt(3)/2),
        array("valor" => M_PI/4, "nombre" => "π/4", "grados" => 45, "cos_exacto" => sqrt(2)/2),
        array("valor" => M_PI/3, "nombre" => "π/3", "grados" => 60, "cos_exacto" => 0.5),
        array("valor" => M_PI/2, "nombre" => "π/2", "grados" => 90, "cos_exacto" => 0),
        array("valor" => 2*M_PI/3, "nombre" => "2π/3", "grados" => 120, "cos_exacto" => -0.5),
        array("valor" => 3*M_PI/4, "nombre" => "3π/4", "grados" => 135, "cos_exacto" => -sqrt(2)/2),
        array("valor" => M_PI, "nombre" => "π", "grados" => 180, "cos_exacto" => -1)
    );

    $html = '<h3>📋 Valores Importantes del Coseno</h3>';
    $html .= '<table class="tabla-valores">';
    $html .= '<tr><th>Ángulo</th><th>Radianes</th><th>Grados</th><th>cos(x) Exacto</th><th>cos(x) Taylor</th><th>Error</th></tr>';

    foreach ($angulos as $angulo) {
        $valor_exacto = $angulo['cos_exacto'];
        $valor_taylor = mi_cos($angulo['valor'], 'taylor', 10);
        $error = compararConNativo($angulo['valor'], $valor_taylor);

        $html .= "<tr>
                    <td><strong>{$angulo['nombre']}</strong></td>
                    <td>" . number_format($angulo['valor'], 4) . "</td>
                    <td>{$angulo['grados']}°</td>
                    <td>" . number_format($valor_exacto, 6) . "</td>
                    <td>" . number_format($valor_taylor, 6) . "</td>
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