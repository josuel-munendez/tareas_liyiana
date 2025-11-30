<?php
// Función para determinar si es consola o web
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// Función para convertir Celsius a Fahrenheit
function celsiusAFahrenheit($celsius) {
    return ($celsius * 9/5) + 32;
}

// Función para convertir Fahrenheit a Celsius (extra)
function fahrenheitACelsius($fahrenheit) {
    return ($fahrenheit - 32) * 5/9;
}

// Función para limpiar entrada
function limpiarEntrada($dato) {
    return filter_var($dato, FILTER_VALIDATE_FLOAT);
}

// Función para clasificar temperatura
function clasificarTemperatura($celsius) {
    if ($celsius < 0) return '❄️ Muy frío';
    if ($celsius < 10) return '🥶 Frío';
    if ($celsius < 20) return '😊 Fresco';
    if ($celsius < 30) return '😎 Agradable';
    if ($celsius < 35) return '☀️ Calor';
    return '🔥 Muy caliente';
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "    CONVERSOR DE TEMPERATURA\n";
    echo "       Celsius a Fahrenheit\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Fórmula: °F = (°C × 9/5) + 32\n\n";

    // Leer temperatura del usuario
    echo "Ingrese temperatura en Celsius: ";
    $input = trim(fgets(STDIN));
    $celsius = limpiarEntrada($input);

    // Validar entrada
    if ($celsius === false) {
        echo "❌ Error: Debe ingresar un número válido.\n";
        return;
    }

    // Realizar conversión
    $fahrenheit = celsiusAFahrenheit($celsius);
    $clasificacion = clasificarTemperatura($celsius);

    // Mostrar resultados
    echo "\n🔍 RESULTADOS:\n";
    echo "================\n";
    printf("🌡️  Celsius:     %.2f °C\n", $celsius);
    printf("🌡️  Fahrenheit:  %.2f °F\n", $fahrenheit);
    echo "📊 Clasificación: $clasificacion\n";

    // Mostrar tabla de referencia
    echo "\n📋 TABLA DE REFERENCIA:\n";
    echo "----------------------\n";
    $referencias = array(-10, 0, 10, 20, 30, 37, 100);
    foreach ($referencias as $temp) {
        $fahr = celsiusAFahrenheit($temp);
        $clasif = clasificarTemperatura($temp);
        printf("%6.1f °C = %6.1f °F - %s\n", $temp, $fahr, $clasif);
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $celsius = null;
    $fahrenheit = null;
    $resultado = '';
    $clasificacion = '';
    $clase_css = '';

    // Procesar formulario si se envió
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['celsius'])) {
        $celsius = limpiarEntrada($_POST['celsius']);

        if ($celsius === false) {
            $resultado = "❌ Error: Debe ingresar un número válido.";
            $clase_css = 'error';
        } else {
            $fahrenheit = celsiusAFahrenheit($celsius);
            $clasificacion = clasificarTemperatura($celsius);

            $resultado = "✅ Conversión exitosa";
            $clase_css = 'exito';
        }
    }

    // Generar HTML
    echo generarHTML($resultado, $clasificacion, $clase_css, $celsius, $fahrenheit);
}

function generarHTML($resultado, $clasificacion, $clase_css, $celsius_valor, $fahrenheit_valor) {
    $valor_actual = ($celsius_valor !== null) ? $celsius_valor : '';

    $html_resultado = '';
    if (!empty($resultado)) {
        $html_detalles = '';
        if ($clase_css == 'exito') {
            $html_detalles = "
                <div class='detalles-conversion'>
                    <div class='temperatura'>
                        <span class='valor'>" . number_format($celsius_valor, 1) . " °C</span>
                        <span class='flecha'>→</span>
                        <span class='valor'>" . number_format($fahrenheit_valor, 1) . " °F</span>
                    </div>
                    <div class='clasificacion'>
                        $clasificacion
                    </div>
                    <div class='formula'>
                        Fórmula: (" . number_format($celsius_valor, 1) . " × 9/5) + 32 = " . number_format($fahrenheit_valor, 1) . "
                    </div>
                </div>
            ";
        }

        $html_resultado = "
            <div class='resultado $clase_css'>
                $resultado
                $html_detalles
            </div>
        ";
    }

    // Generar tabla de referencia
    $html_tabla = generarTablaReferencia();

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Temperatura - Web</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
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
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
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

        .detalles-conversion {
            margin-top: 15px;
        }

        .temperatura {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            font-size: 24px;
            margin: 15px 0;
        }

        .valor {
            background: rgba(255,255,255,0.8);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .flecha {
            font-size: 30px;
            color: #4a5568;
        }

        .clasificacion {
            font-size: 20px;
            margin: 10px 0;
            padding: 10px;
            background: rgba(255,255,255,0.7);
            border-radius: 5px;
        }

        .formula {
            font-family: monospace;
            background: #2d3748;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 14px;
        }

        .info {
            background: #bee3f8;
            color: #2a4365;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .tabla-referencia {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabla-referencia th,
        .tabla-referencia td {
            padding: 12px;
            text-align: center;
            border: 1px solid #cbd5e0;
        }

        .tabla-referencia th {
            background: #4a5568;
            color: white;
        }

        .tabla-referencia tr:nth-child(even) {
            background: #f7fafc;
        }

        .tabla-referencia tr:hover {
            background: #edf2f7;
        }

        .definicion {
            background: #f0fff4;
            border-left: 4px solid #48bb78;
            padding: 15px;
            margin: 15px 0;
        }

        .frio { background: #e3f2fd; }
        .fresco { background: #e8f5e8; }
        .agradable { background: #fff9c4; }
        .calor { background: #ffe0b2; }
        .caliente { background: #ffcdd2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🌡️ Conversor de Temperatura</h1>
        <div class="subtitle">Conversión de Celsius a Fahrenheit</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="definicion">
            <strong>📚 Fórmula:</strong> °F = (°C × 9/5) + 32<br>
            <strong>💡 Ejemplo:</strong> 25°C = (25 × 9/5) + 32 = 77°F
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="celsius">Ingrese temperatura en Celsius (°C):</label>
                <input type="number" id="celsius" name="celsius" value="$valor_actual"
                       placeholder="Ej: 25, -5, 37.5..." required step="0.1">
            </div>

            <button type="submit">🔄 Convertir a Fahrenheit</button>
        </form>

        $html_resultado
        $html_tabla

        <div class="info">
            <strong>💡 Información:</strong>
            <ul>
                <li><strong>Punto de congelación:</strong> 0°C = 32°F</li>
                <li><strong>Temperatura corporal:</strong> 37°C = 98.6°F</li>
                <li><strong>Punto de ebullición:</strong> 100°C = 212°F</li>
                <li>Las escalas Celsius y Fahrenheit se intersectan en -40°</li>
            </ul>
        </div>
    </div>
</body>
</html>
HTML;
}

function generarTablaReferencia() {
    $temperaturas = array(
        array('temp' => -40,   'clase' => 'frio',      'nota' => 'Mismo valor en ambas escalas'),
        array('temp' => -20,   'clase' => 'frio',      'nota' => 'Muy frío'),
        array('temp' => 0,     'clase' => 'frio',      'nota' => 'Punto de congelación del agua'),
        array('temp' => 10,    'clase' => 'fresco',    'nota' => 'Fresco'),
        array('temp' => 20,    'clase' => 'agradable', 'nota' => 'Temperatura ambiente ideal'),
        array('temp' => 25,    'clase' => 'agradable', 'nota' => 'Agradable'),
        array('temp' => 30,    'clase' => 'calor',     'nota' => 'Calor'),
        array('temp' => 37,    'clase' => 'calor',     'nota' => 'Temperatura corporal humana'),
        array('temp' => 40,    'clase' => 'caliente',  'nota' => 'Muy caliente'),
        array('temp' => 100,   'clase' => 'caliente',  'nota' => 'Punto de ebullición del agua')
    );

    $html = '<h3>📋 Tabla de Conversión de Referencia</h3>';
    $html .= '<table class="tabla-referencia">';
    $html .= '<tr><th>°C</th><th>°F</th><th>Descripción</th></tr>';

    foreach ($temperaturas as $temp) {
        $celsius = $temp['temp'];
        $fahrenheit = celsiusAFahrenheit($celsius);
        $clase = $temp['clase'];
        $nota = $temp['nota'];

        $html .= "<tr class='$clase'>
                    <td><strong>$celsius °C</strong></td>
                    <td><strong>" . number_format($fahrenheit, 1) . " °F</strong></td>
                    <td>$nota</td>
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