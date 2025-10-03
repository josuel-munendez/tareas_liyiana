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

// Implementación de sin() usando series de Taylor (necesaria para algunos métodos)
function mi_sin_taylor($x, $terminos = 10) {
    $x = fmod($x, 2 * M_PI);
    $resultado = 0;
    for ($n = 0; $n < $terminos; $n++) {
        $termino = pow(-1, $n) * pow($x, 2 * $n + 1) / factorial(2 * $n + 1);
        $resultado += $termino;
    }
    return $resultado;
}

// Implementación de cos() usando series de Taylor (necesaria para algunos métodos)
function mi_cos_taylor($x, $terminos = 10) {
    $x = fmod($x, 2 * M_PI);
    $resultado = 0;
    for ($n = 0; $n < $terminos; $n++) {
        $termino = pow(-1, $n) * pow($x, 2 * $n) / factorial(2 * $n);
        $resultado += $termino;
    }
    return $resultado;
}

// Implementación de tan() usando la definición tan(x) = sin(x)/cos(x)
function mi_tan_definicion($x, $terminos = 10) {
    // Reducir el ángulo al rango [-π/2, π/2] para evitar divisiones por cero
    $x = fmod($x, M_PI);
    if (abs($x) > M_PI/2) {
        $x = $x - M_PI * round($x / M_PI);
    }

    $sin_x = mi_sin_taylor($x, $terminos);
    $cos_x = mi_cos_taylor($x, $terminos);

    // Evitar división por cero
    if (abs($cos_x) < 1e-10) {
        return false; // Asíntota vertical
    }

    return $sin_x / $cos_x;
}

// Implementación de tan() usando series de Taylor directa
function mi_tan_taylor($x, $terminos = 10) {
    // Reducir el ángulo al rango [-π/2, π/2]
    $x = fmod($x, M_PI);
    if (abs($x) > M_PI/2) {
        $x = $x - M_PI * round($x / M_PI);
    }

    // Serie de Taylor para tangente usando números de Bernoulli
    // tan(x) = x + x³/3 + 2x⁵/15 + 17x⁷/315 + 62x⁹/2835 + ...
    $coeficientes = array(
        1,          // x¹
        1.0/3,      // x³
        2.0/15,     // x⁵
        17.0/315,   // x⁷
        62.0/2835,  // x⁹
        1382.0/155925, // x¹¹
        21844.0/6081075, // x¹³
        929569.0/638512875 // x¹⁵
    );

    $resultado = 0;
    for ($n = 0; $n < min($terminos, count($coeficientes)); $n++) {
        $exponente = 2 * $n + 1;
        $termino = $coeficientes[$n] * pow($x, $exponente);
        $resultado += $termino;
    }

    return $resultado;
}

// Implementación de tan() usando aproximación polinómica
function mi_tan_polinomico($x) {
    // Reducir el ángulo al rango [-π/2, π/2]
    $x = fmod($x, M_PI);
    if (abs($x) > M_PI/2) {
        $x = $x - M_PI * round($x / M_PI);
    }

    // Aproximación polinómica para tan(x) en [-π/4, π/4]
    if (abs($x) <= M_PI/4) {
        $x2 = $x * $x;
        return $x * (1 + $x2 * (1/3 + $x2 * (2/15 + $x2 * (17/315))));
    } else {
        // Para |x| > π/4, usar tan(x) = 1/tan(π/2 - x)
        $complemento = M_PI/2 - abs($x);
        $tan_complemento = mi_tan_polinomico($complemento);
        return ($x > 0) ? 1/$tan_complemento : -1/$tan_complemento;
    }
}

// Implementación de tan() usando lookup table con interpolación
function mi_tan_lookup($x, $precision = 1000) {
    // Reducir el ángulo al rango [0, π]
    $x = fmod($x, M_PI);
    if ($x < 0) $x += M_PI;

    // Evitar puntos cercanos a las asíntotas
    if (abs($x - M_PI/2) < 0.001) {
        return false; // Asíntota
    }

    // Crear tabla de lookup si no existe
    static $tan_table = null;
    if ($tan_table === null) {
        $tan_table = array();
        for ($i = 0; $i <= $precision; $i++) {
            $angle = ($i / $precision) * M_PI;
            // Saltar puntos demasiado cercanos a π/2
            if (abs($angle - M_PI/2) > 0.001) {
                $tan_table[$i] = tan($angle); // Usamos nativo para la tabla
            } else {
                $tan_table[$i] = null; // Marcamos asíntotas
            }
        }
    }

    // Encontrar los índices más cercanos
    $index = ($x / M_PI) * $precision;
    $index_floor = floor($index);
    $index_ceil = ceil($index);

    // Manejar asíntotas
    if ($tan_table[$index_floor] === null || $tan_table[$index_ceil] === null) {
        return false;
    }

    // Interpolación lineal
    if ($index_floor == $index_ceil) {
        return $tan_table[$index_floor];
    }

    $weight = $index - $index_floor;
    return $tan_table[$index_floor] * (1 - $weight) + $tan_table[$index_ceil] * $weight;
}

// Función principal que elige el método
function mi_tan($x, $metodo = 'auto', $terminos_taylor = 10) {
    switch ($metodo) {
        case 'definicion':
            return mi_tan_definicion($x, $terminos_taylor);
        case 'taylor':
            return mi_tan_taylor($x, $terminos_taylor);
        case 'polinomico':
            return mi_tan_polinomico($x);
        case 'lookup':
            return mi_tan_lookup($x);
        case 'auto':
        default:
            // Para alta precisión usar definición con Taylor
            return mi_tan_definicion($x, $terminos_taylor);
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

// Función para comparar con tan() nativo de PHP
function compararConNativo($x, $mi_calculo) {
    $nativo = tan($x);

    // Manejar casos especiales (asíntotas, infinitos)
    if ($mi_calculo === false || abs($nativo) > 1e10) {
        return "Asíntota";
    }

    // Evitar división por cero
    if ($nativo == 0) {
        return abs($mi_calculo) < 1e-10 ? "0.0000000000%" : "∞";
    }

    $diferencia = abs($mi_calculo - $nativo);
    $porcentaje_error = ($diferencia / abs($nativo)) * 100;

    return number_format($porcentaje_error, 10) . "%";
}

// Función para verificar si está cerca de una asíntota
function estaCercaAsintota($x) {
    // Las asíntotas de tan(x) están en x = π/2 + kπ
    $residuo = fmod(abs($x), M_PI);
    return abs($residuo - M_PI/2) < 0.01;
}

// Función para mostrar proceso de serie de Taylor
function mostrarProcesoTaylor($x, $terminos = 5) {
    $proceso = "Serie de Taylor para tan(x):\n";
    $proceso .= "tan(x) = ";

    $coeficientes = array("1", "1/3", "2/15", "17/315", "62/2835");
    $exponentes = array(1, 3, 5, 7, 9);

    for ($n = 0; $n < $terminos; $n++) {
        if ($n == 0) {
            $proceso .= "x";
        } else {
            $proceso .= " + " . $coeficientes[$n] . "·x^" . $exponentes[$n];
        }
    }
    $proceso .= " + ...\n\n";

    $proceso .= "Cálculo paso a paso (primeros $terminos términos):\n";
    $resultado_parcial = 0;
    for ($n = 0; $n < $terminos; $n++) {
        $coef = 0;
        switch ($n) {
            case 0: $coef = 1; break;
            case 1: $coef = 1/3; break;
            case 2: $coef = 2/15; break;
            case 3: $coef = 17/315; break;
            case 4: $coef = 62/2835; break;
        }

        $exponente = 2 * $n + 1;
        $termino_valor = $coef * pow($x, $exponente);
        $resultado_parcial += $termino_valor;
        $proceso .= sprintf("Término %d: %s·x^%d = %.10f → Suma parcial: %.10f\n",
            $n + 1, $coeficientes[$n], $exponente, $termino_valor, $resultado_parcial);
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
    echo "    IMPLEMENTACIÓN DE TAN()\n";
    echo "   Cálculo de la Tangente\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Métodos disponibles:\n";
    echo "- Definición: tan(x) = sin(x)/cos(x)\n";
    echo "- Serie de Taylor directa\n";
    echo "- Aproximación polinómica\n";
    echo "- Tabla de búsqueda con interpolación\n\n";

    echo "⚠️  La tangente tiene asíntotas en x = π/2 + kπ\n\n";

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

    // Verificar si está cerca de una asíntota
    $cerca_asintota = estaCercaAsintota($angulo_rad);
    if ($cerca_asintota) {
        echo "⚠️  Advertencia: El ángulo está cerca de una asíntota vertical.\n";
    }

    // Calcular con diferentes métodos
    $resultado_definicion = mi_tan($angulo_rad, 'definicion', 10);
    $resultado_taylor = mi_tan($angulo_rad, 'taylor', 10);
    $resultado_polinomico = mi_tan($angulo_rad, 'polinomico');
    $resultado_lookup = mi_tan($angulo_rad, 'lookup');
    $resultado_auto = mi_tan($angulo_rad, 'auto');
    $nativo = tan($angulo_rad);

    // Mostrar resultados
    echo "\n🔍 RESULTADOS:\n";
    echo "================\n";
    printf("📊 Ángulo: %.6f rad (%.2f°)\n", $angulo_rad, radianes_a_grados($angulo_rad));
    echo "\n";

    if ($resultado_definicion === false) {
        echo "📈 Definición (sin/cos):     Asíntota (indefinido)\n";
    } else {
        printf("📈 Definición (sin/cos):     %.10f\n", $resultado_definicion);
    }

    if ($resultado_taylor === false) {
        echo "🔢 Serie de Taylor directa:  Asíntota (indefinido)\n";
    } else {
        printf("🔢 Serie de Taylor directa:  %.10f\n", $resultado_taylor);
    }

    if ($resultado_polinomico === false) {
        echo "🔄 Aproximación polinómica:   Asíntota (indefinido)\n";
    } else {
        printf("🔄 Aproximación polinómica:   %.10f\n", $resultado_polinomico);
    }

    if ($resultado_lookup === false) {
        echo "📋 Tabla de búsqueda:         Asíntota (indefinido)\n";
    } else {
        printf("📋 Tabla de búsqueda:         %.10f\n", $resultado_lookup);
    }

    if ($resultado_auto === false) {
        echo "🤖 Método automático:         Asíntota (indefinido)\n";
    } else {
        printf("🤖 Método automático:         %.10f\n", $resultado_auto);
    }

    if (abs($nativo) > 1e10) {
        echo "🏁 PHP tan() nativo:          Asíntota (→∞)\n";
    } else {
        printf("🏁 PHP tan() nativo:          %.10f\n", $nativo);
    }

    // Mostrar errores (solo si no hay asíntotas)
    if (!$cerca_asintota && $resultado_auto !== false && abs($nativo) < 1e10) {
        echo "\n📊 COMPARACIÓN DE PRECISIÓN:\n";
        echo "---------------------------\n";
        printf("Definición vs Nativo:      %s\n", compararConNativo($angulo_rad, $resultado_definicion));
        printf("Taylor vs Nativo:          %s\n", compararConNativo($angulo_rad, $resultado_taylor));
        printf("Polinómico vs Nativo:      %s\n", compararConNativo($angulo_rad, $resultado_polinomico));
        printf("Lookup vs Nativo:          %s\n", compararConNativo($angulo_rad, $resultado_lookup));
    }

    // Mostrar proceso de Taylor si no hay asíntota
    if (!$cerca_asintota) {
        echo "\n" . mostrarProcesoTaylor($angulo_rad, 5);
    }

    // Mostrar tabla de ángulos importantes
    echo "\n📋 VALORES IMPORTANTES DE LA TANGENTE:\n";
    echo "------------------------------------\n";
    $angulos_importantes = array(0, M_PI/6, M_PI/4, M_PI/3);
    $nombres = array("0", "π/6", "π/4", "π/3");

    foreach ($angulos_importantes as $i => $angulo_val) {
        $mi_calc = mi_tan($angulo_val, 'definicion', 10);
        $nativo_val = tan($angulo_val);

        if ($mi_calc === false || abs($nativo_val) > 1e10) {
            printf("%-6s (%5.1f°): Asíntota\n", $nombres[$i], radianes_a_grados($angulo_val));
        } else {
            $error = compararConNativo($angulo_val, $mi_calc);
            printf("%-6s (%5.1f°): Mi: %8.6f, PHP: %8.6f, Error: %s\n",
                   $nombres[$i], radianes_a_grados($angulo_val), $mi_calc, $nativo_val, $error);
        }
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
    $cerca_asintota = false;
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

                // Verificar si está cerca de una asíntota
                $cerca_asintota = estaCercaAsintota($angulo_rad);

                // Calcular con diferentes métodos
                $resultados['definicion'] = mi_tan($angulo_rad, 'definicion', 10);
                $resultados['taylor'] = mi_tan($angulo_rad, 'taylor', 10);
                $resultados['polinomico'] = mi_tan($angulo_rad, 'polinomico');
                $resultados['lookup'] = mi_tan($angulo_rad, 'lookup');
                $resultados['auto'] = mi_tan($angulo_rad, 'auto');
                $resultados['nativo'] = tan($angulo_rad);

                // Calcular errores (solo si no hay asíntotas)
                if (!$cerca_asintota && $resultados['auto'] !== false && abs($resultados['nativo']) < 1e10) {
                    $resultados['error_definicion'] = compararConNativo($angulo_rad, $resultados['definicion']);
                    $resultados['error_taylor'] = compararConNativo($angulo_rad, $resultados['taylor']);
                    $resultados['error_polinomico'] = compararConNativo($angulo_rad, $resultados['polinomico']);
                    $resultados['error_lookup'] = compararConNativo($angulo_rad, $resultados['lookup']);
                } else {
                    $resultados['error_definicion'] = $resultados['error_taylor'] =
                    $resultados['error_polinomico'] = $resultados['error_lookup'] = "Asíntota";
                }

                $resultado = $cerca_asintota ? "⚠️  Cerca de asíntota - resultados pueden ser imprecisos" : "✅ Cálculos completados";
                $clase_css = $cerca_asintota ? 'advertencia' : 'exito';

                // Generar proceso Taylor si no hay asíntota
                if (!$cerca_asintota) {
                    $proceso_taylor = generarProcesoTaylorHTML($angulo_rad, 5);
                }

                // Guardar valores para mostrar
                $resultados['angulo_rad'] = $angulo_rad;
                $resultados['angulo_grados'] = radianes_a_grados($angulo_rad);
                $resultados['es_grados'] = $es_grados;
                $resultados['angulo_original'] = $angulo;
                $resultados['cerca_asintota'] = $cerca_asintota;
            }
        }
    }

    // Generar HTML
    echo generarHTML($resultado, $clase_css, $angulo, $es_grados, $resultados, $proceso_taylor, $cerca_asintota);
}

function generarProcesoTaylorHTML($x, $terminos) {
    $html = "<div class='proceso-taylor'>";
    $html .= "<h4>🔍 Serie de Taylor (primeros $terminos términos):</h4>";
    $html .= "<div class='formula'>tan(x) = ";

    $coeficientes = array("1", "1/3", "2/15", "17/315", "62/2835");
    $exponentes = array(1, 3, 5, 7, 9);

    for ($n = 0; $n < $terminos; $n++) {
        if ($n == 0) {
            $html .= "x";
        } else {
            $html .= " + " . $coeficientes[$n] . "·x<sup>" . $exponentes[$n] . "</sup>";
        }
    }
    $html .= " + ...</div>";

    $html .= "<div class='calculos-paso-a-paso'>";
    $resultado_parcial = 0;
    for ($n = 0; $n < $terminos; $n++) {
        $coef = 0;
        switch ($n) {
            case 0: $coef = 1; break;
            case 1: $coef = 1/3; break;
            case 2: $coef = 2/15; break;
            case 3: $coef = 17/315; break;
            case 4: $coef = 62/2835; break;
        }

        $exponente = 2 * $n + 1;
        $termino_valor = $coef * pow($x, $exponente);
        $resultado_parcial += $termino_valor;
        $html .= "<div class='paso'>";
        $html .= "<strong>Término " . ($n + 1) . ":</strong> ";
        $html .= $coeficientes[$n] . "·x<sup>{$exponente}</sup> = ";
        $html .= "<span class='valor-termino'>" . number_format($termino_valor, 10) . "</span>";
        $html .= " → Suma parcial: <span class='suma-parcial'>" . number_format($resultado_parcial, 10) . "</span>";
        $html .= "</div>";
    }
    $html .= "</div></div>";

    return $html;
}

function generarHTML($resultado, $clase_css, $angulo_valor, $es_grados_valor, $resultados, $proceso_taylor, $cerca_asintota) {
    $angulo_actual = ($angulo_valor !== null) ? $angulo_valor : '';
    $grados_checked = $es_grados_valor ? 'checked' : '';
    $radianes_checked = !$es_grados_valor ? 'checked' : '';

    $html_resultado = '';
    if (!empty($resultado)) {
        $html_detalles = '';
        if ($clase_css == 'exito' || $clase_css == 'advertencia') {
            $unidad_entrada = $resultados['es_grados'] ? 'grados' : 'radianes';
            $angulo_mostrar = $resultados['es_grados'] ?
                "{$resultados['angulo_original']}° = " . number_format($resultados['angulo_rad'], 6) . " rad" :
                number_format($resultados['angulo_rad'], 6) . " rad = " . number_format($resultados['angulo_grados'], 2) . "°";

            $advertencia_html = $cerca_asintota ?
                '<div class="advertencia-asintota">⚠️  El ángulo está cerca de una asíntota vertical. La tangente tiende a infinito.</div>' : '';

            // Función auxiliar para formatear resultado
            function formatearResultado($valor, $nativo = false) {
                if ($valor === false) {
                    return '<span class="asintota">Asíntota</span>';
                } elseif ($nativo && abs($valor) > 1e10) {
                    return '<span class="asintota">→∞</span>';
                } else {
                    return number_format($valor, 10);
                }
            }

            $html_detalles = "
                <div class='detalles-calculo'>
                    <div class='angulo-convertido'>
                        📊 Ángulo: <strong>$angulo_mostrar</strong>
                    </div>
                    $advertencia_html
                    <div class='resultados-comparacion'>
                        <div class='resultado-item'>
                            <span class='etiqueta'>📈 Definición (sin/cos):</span>
                            <span class='valor'>" . formatearResultado($resultados['definicion']) . "</span>
                            <span class='error'>" . ($cerca_asintota ? 'Asíntota' : 'Error: ' . $resultados['error_definicion']) . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>🔢 Serie de Taylor directa:</span>
                            <span class='valor'>" . formatearResultado($resultados['taylor']) . "</span>
                            <span class='error'>" . ($cerca_asintota ? 'Asíntota' : 'Error: ' . $resultados['error_taylor']) . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>🔄 Aproximación polinómica:</span>
                            <span class='valor'>" . formatearResultado($resultados['polinomico']) . "</span>
                            <span class='error'>" . ($cerca_asintota ? 'Asíntota' : 'Error: ' . $resultados['error_polinomico']) . "</span>
                        </div>
                        <div class='resultado-item'>
                            <span class='etiqueta'>📋 Tabla de búsqueda:</span>
                            <span class='valor'>" . formatearResultado($resultados['lookup']) . "</span>
                            <span class='error'>" . ($cerca_asintota ? 'Asíntota' : 'Error: ' . $resultados['error_lookup']) . "</span>
                        </div>
                        <div class='resultado-item destacado'>
                            <span class='etiqueta'>🤖 Método automático:</span>
                            <span class='valor'>" . formatearResultado($resultados['auto']) . "</span>
                        </div>
                        <div class='resultado-item nativo'>
                            <span class='etiqueta'>🏁 PHP tan() nativo:</span>
                            <span class='valor'>" . formatearResultado($resultados['nativo'], true) . "</span>
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
    <title>Implementación de tan() - Web</title>
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

        .advertencia {
            background: #fffaf0;
            color: #744210;
            border: 2px solid #ed8936;
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

        .advertencia-asintota {
            text-align: center;
            background: #fffaf0;
            color: #744210;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 2px solid #ed8936;
            font-weight: bold;
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

        .asintota {
            color: #e53e3e;
            font-weight: bold;
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

        .asintotas {
            background: #fed7d7;
            border-left: 4px solid #f56565;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧮 Implementación de tan()</h1>
        <div class="subtitle">Cálculo de la tangente con diferentes métodos numéricos</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="metodos">
            <div class="metodo">
                <h4>📈 Definición</h4>
                <p>tan(x) = sin(x)/cos(x)</p>
                <p><strong>Precisión:</strong> Alta</p>
                <p><strong>Eficiencia:</strong> Media</p>
            </div>
            <div class="metodo">
                <h4>🔢 Serie de Taylor</h4>
                <p>tan(x) = x + x³/3 + 2x⁵/15 + ...</p>
                <p><strong>Precisión:</strong> Alta</p>
                <p><strong>Eficiencia:</strong> Media</p>
            </div>
            <div class="metodo">
                <h4>🔄 Aproximación Polinómica</h4>
                <p>Aproximación racional optimizada</p>
                <p><strong>Precisión:</strong> Media</p>
                <p><strong>Eficiencia:</strong> Alta</p>
            </div>
        </div>

        <div class="asintotas">
            <h4>⚠️  Asíntotas de la Tangente</h4>
            <p>La función tangente tiene asíntotas verticales en:</p>
            <p><strong>x = π/2 + kπ</strong> (donde k es un número entero)</p>
            <p>En estos puntos, la tangente no está definida (tiende a ±∞)</p>
        </div>

        <div class="propiedades">
            <h4>📚 Propiedades de la Tangente:</h4>
            <ul>
                <li><strong>Periodicidad:</strong> tan(x + π) = tan(x)</li>
                <li><strong>Imparidad:</strong> tan(-x) = -tan(x) (función impar)</li>
                <li><strong>Relación con seno/coseno:</strong> tan(x) = sin(x)/cos(x)</li>
                <li><strong>Identidad pitagórica:</strong> 1 + tan²(x) = sec²(x)</li>
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
                <button type="button" class="ejemplo-rapido" onclick="document.getElementById('angulo').value='80g'">80°</button>
                <button type="button" class="ejemplo-rapido" onclick="document.getElementById('angulo').value='1.0472'">π/3 rad</button>
            </div>

            <button type="submit">🧮 Calcular Tangente</button>
        </form>

        $html_resultado
        $html_tabla

        <div class="info">
            <strong>💡 Información:</strong>
            <ul>
                <li><strong>Definición:</strong> Usa la relación fundamental tan(x) = sin(x)/cos(x)</li>
                <li><strong>Serie de Taylor:</strong> Expansión directa usando números de Bernoulli</li>
                <li><strong>Aproximación polinómica:</strong> Más eficiente para cálculo numérico</li>
                <li><strong>Tabla de búsqueda:</strong> Método histórico usado en hardware antiguo</li>
                <li>La tangente es una función impar: tan(-x) = -tan(x)</li>
                <li>La tangente tiene período π (180°)</li>
                <li>Evite ángulos cercanos a 90°, 270°, etc. (asíntotas verticales)</li>
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
        array("valor" => 0, "nombre" => "0", "grados" => 0, "tan_exacto" => 0),
        array("valor" => M_PI/6, "nombre" => "π/6", "grados" => 30, "tan_exacto" => 1/sqrt(3)),
        array("valor" => M_PI/4, "nombre" => "π/4", "grados" => 45, "tan_exacto" => 1),
        array("valor" => M_PI/3, "nombre" => "π/3", "grados" => 60, "tan_exacto" => sqrt(3)),
        array("valor" => M_PI/2, "nombre" => "π/2", "grados" => 90, "tan_exacto" => null),
        array("valor" => 2*M_PI/3, "nombre" => "2π/3", "grados" => 120, "tan_exacto" => -sqrt(3)),
        array("valor" => 3*M_PI/4, "nombre" => "3π/4", "grados" => 135, "tan_exacto" => -1),
        array("valor" => 5*M_PI/6, "nombre" => "5π/6", "grados" => 150, "tan_exacto" => -1/sqrt(3))
    );

    $html = '<h3>📋 Valores Importantes de la Tangente</h3>';
    $html .= '<table class="tabla-valores">';
    $html .= '<tr><th>Ángulo</th><th>Radianes</th><th>Grados</th><th>tan(x) Exacto</th><th>tan(x) Calculado</th><th>Error</th></tr>';

    foreach ($angulos as $angulo) {
        $valor_exacto = $angulo['tan_exacto'];
        $valor_calculado = mi_tan($angulo['valor'], 'definicion', 10);

        if ($valor_exacto === null) {
            $html .= "<tr>
                        <td><strong>{$angulo['nombre']}</strong></td>
                        <td>" . number_format($angulo['valor'], 4) . "</td>
                        <td>{$angulo['grados']}°</td>
                        <td class='asintota'>Asíntota</td>
                        <td class='asintota'>Asíntota</td>
                        <td class='asintota'>-</td>
                      </tr>";
        } else {
            $error = compararConNativo($angulo['valor'], $valor_calculado);
            $html .= "<tr>
                        <td><strong>{$angulo['nombre']}</strong></td>
                        <td>" . number_format($angulo['valor'], 4) . "</td>
                        <td>{$angulo['grados']}°</td>
                        <td>" . number_format($valor_exacto, 6) . "</td>
                        <td>" . number_format($valor_calculado, 6) . "</td>
                        <td>$error</td>
                      </tr>";
        }
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