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
    echo "  EJERCICIO 3: Tabla del 5\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    $numero = 5;
    $suma_total = 0;

    echo "Tabla de multiplicar del $numero:\n";
    echo "-------------------------------\n";

    for ($i = 1; $i <= 12; $i++) {
        $resultado = $numero * $i;
        $suma_total += $resultado;
        printf("%2d × %2d = %3d\n", $numero, $i, $resultado);
    }

    echo "\n📊 ESTADÍSTICAS:\n";
    echo "---------------\n";
    echo "🔢 Tabla completa del 1 al 12\n";
    echo "🧮 Suma de todos los resultados: $suma_total\n";
    echo "📐 Promedio: " . number_format($suma_total / 12, 2) . "\n";
    echo "📈 Resultado más alto: " . ($numero * 12) . "\n";
    echo "📉 Resultado más bajo: $numero\n";

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    echo generarHTML();
}

function generarHTML() {
    $numero = 5;
    $suma_total = 0;

    $html = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Tabla del 5</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
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

        .tabla-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .tabla-multiplicar {
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .tabla-multiplicar th {
            background: #4a5568;
            color: white;
            padding: 15px 25px;
            font-size: 18px;
        }

        .tabla-multiplicar td {
            padding: 12px 20px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
        }

        .tabla-multiplicar tr:nth-child(even) {
            background: #f7fafc;
        }

        .tabla-multiplicar tr:hover {
            background: #edf2f7;
            transform: scale(1.02);
            transition: transform 0.2s;
        }

        .resultado {
            color: #2d3748;
            font-weight: bold;
        }

        .estadisticas {
            background: #fffaf0;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .estadisticas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .estadistica-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #ed8936;
        }

        .estadistica-valor {
            font-size: 24px;
            font-weight: bold;
            color: #4a5568;
        }

        .estadistica-label {
            font-size: 14px;
            color: #718096;
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
        <h1>✖️ Ejercicio 3: Tabla de Multiplicar del 5</h1>
        <div class="subtitle">Ciclo "Para" - Tablas de multiplicar</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="tabla-container">
            <table class="tabla-multiplicar">
                <tr>
                    <th>Operación</th>
                    <th>Resultado</th>
                </tr>';

    // Generar tabla
    for ($i = 1; $i <= 12; $i++) {
        $resultado = $numero * $i;
        $suma_total += $resultado;
        $html .= "<tr>
                    <td>$numero × $i</td>
                    <td class='resultado'>$resultado</td>
                  </tr>";
    }

    $html .= '</table>
        </div>

        <div class="estadisticas">
            <h3>📊 Estadísticas de la Tabla</h3>
            <div class="estadisticas-grid">
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . $suma_total . '</div>
                    <div class="estadistica-label">Suma Total</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . number_format($suma_total / 12, 2) . '</div>
                    <div class="estadistica-label">Promedio</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . ($numero * 12) . '</div>
                    <div class="estadistica-label">Valor Más Alto</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . $numero . '</div>
                    <div class="estadistica-label">Valor Más Bajo</div>
                </div>
            </div>
        </div>

        <div class="volver">
            <a href="javascript:history.back()" class="btn-volver">← Volver</a>
        </div>
    </div>
</body>
</html>';

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