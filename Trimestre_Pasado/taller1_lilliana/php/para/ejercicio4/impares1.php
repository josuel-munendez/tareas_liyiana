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
    echo "  EJERCICIO 4: Impares 1-50\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Buscando números impares del 1 al 50:\n";
    echo "-------------------------------------\n";

    $contador = 0;
    $impares = array();
    $suma_impares = 0;

    for ($i = 1; $i <= 50; $i++) {
        if ($i % 2 != 0) {
            $impares[] = $i;
            $suma_impares += $i;
            printf("%3d ", $i);
            $contador++;

            // Salto de línea cada 5 números
            if ($contador % 5 == 0) {
                echo "\n";
            }
        }
    }

    echo "\n\n📊 ESTADÍSTICAS:\n";
    echo "---------------\n";
    echo "🔢 Total de números impares: $contador\n";
    echo "📋 Lista completa: " . implode(', ', $impares) . "\n";
    echo "🧮 Suma de impares: " . implode(' + ', $impares) . " = $suma_impares\n";
    echo "📐 Promedio: " . number_format($suma_impares / $contador, 2) . "\n";
    echo "📈 Número impar más alto: " . max($impares) . "\n";
    echo "📉 Número impar más bajo: " . min($impares) . "\n";

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
    $impares = array();
    $suma_impares = 0;

    // Calcular números impares
    for ($i = 1; $i <= 50; $i++) {
        if ($i % 2 != 0) {
            $impares[] = $i;
            $suma_impares += $i;
        }
    }

    $html = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Números Impares 1-50</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
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

        .numeros-container {
            text-align: center;
            line-height: 2;
            margin: 20px 0;
            padding: 20px;
            background: #f7fafc;
            border-radius: 10px;
        }

        .numero-impar {
            display: inline-block;
            width: 45px;
            height: 45px;
            line-height: 45px;
            margin: 3px;
            border-radius: 5px;
            font-weight: bold;
            background: #fed7d7;
            color: #742a2a;
            border: 2px solid #f56565;
            transition: all 0.3s;
        }

        .numero-impar:hover {
            transform: scale(1.1);
            background: #feb2b2;
            box-shadow: 0 3px 10px rgba(245, 101, 101, 0.3);
        }

        .estadisticas {
            background: #fffaf0;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 2px solid #ed8936;
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

        .suma-container {
            background: #c6f6d5;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
            border: 2px solid #48bb78;
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

        @media (max-width: 768px) {
            .numero-impar {
                width: 35px;
                height: 35px;
                line-height: 35px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔶 Ejercicio 4: Números Impares (1-50)</h1>
        <div class="subtitle">Ciclo "Para" - Filtrado de números impares</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="numeros-container">';

    // Generar números impares
    foreach ($impares as $index => $numero) {
        $html .= "<span class='numero-impar'>$numero</span>";

        // Salto de línea cada 5 números
        if (($index + 1) % 5 == 0) {
            $html .= "<br>";
        }
    }

    $html .= '</div>

        <div class="suma-container">
            <strong>🧮 Suma Total:</strong> ' . implode(' + ', $impares) . ' = <strong>' . $suma_impares . '</strong>
        </div>

        <div class="estadisticas">
            <h3>📊 Estadísticas de Números Impares</h3>
            <div class="estadisticas-grid">
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . count($impares) . '</div>
                    <div class="estadistica-label">Total Impares</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . $suma_impares . '</div>
                    <div class="estadistica-label">Suma Total</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . number_format($suma_impares / count($impares), 2) . '</div>
                    <div class="estadistica-label">Promedio</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . max($impares) . '</div>
                    <div class="estadistica-label">Más Alto</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . min($impares) . '</div>
                    <div class="estadistica-label">Más Bajo</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">1-50</div>
                    <div class="estadistica-label">Rango</div>
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