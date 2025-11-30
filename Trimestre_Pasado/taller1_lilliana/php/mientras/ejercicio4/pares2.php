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
    echo " EJERCICIO 4: Pares 1-100\n";
    echo "   (Ciclo Mientras)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Generando números pares del 1 al 100...\n";
    echo "---------------------------------------\n";

    $i = 1;
    $contador = 0;
    $pares = array();
    $suma = 0;

    while ($i <= 100) {
        if ($i % 2 == 0) {
            $pares[] = $i;
            $suma += $i;
            $contador++;

            printf("%3d ", $i);

            // Salto de línea cada 10 números
            if ($contador % 10 == 0) {
                echo "\n";
            }
        }
        $i++;
    }

    // Mostrar resultados
    echo "\n\n📊 ESTADÍSTICAS:\n";
    echo "===============\n";
    echo "🔢 Total de números pares: $contador\n";
    echo "🧮 Suma total: $suma\n";
    echo "📈 Promedio: " . number_format($suma / $contador, 2) . "\n";
    echo "📈 Número par más alto: " . max($pares) . "\n";
    echo "📉 Número par más bajo: " . min($pares) . "\n";

    echo "\n💡 INFORMACIÓN ADICIONAL:\n";
    echo "======================\n";
    echo "🔍 Rango analizado: 1-100\n";
    echo "📐 Proporción pares/total: $contador/100 (" . ($contador) . "%)\n";

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $pares = array();
    $suma = 0;
    $i = 1;

    // Generar números pares con ciclo mientras
    while ($i <= 100) {
        if ($i % 2 == 0) {
            $pares[] = $i;
            $suma += $i;
        }
        $i++;
    }

    echo generarHTML($pares, $suma);
}

function generarHTML($pares, $suma) {
    $total_pares = count($pares);
    $promedio = $suma / $total_pares;

    $html_numeros = '';
    foreach ($pares as $index => $numero) {
        $html_numeros .= "<span class='numero-par'>$numero</span>";

        // Salto de línea cada 10 números
        if (($index + 1) % 10 == 0) {
            $html_numeros .= "<br>";
        }
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Ciclo Mientras</title>
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

        .numeros-container {
            text-align: center;
            line-height: 2;
            margin: 20px 0;
            padding: 20px;
            background: #f7fafc;
            border-radius: 10px;
        }

        .numero-par {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin: 2px;
            border-radius: 5px;
            font-weight: bold;
            background: #bee3f8;
            color: #2a4365;
            border: 2px solid #4299e1;
            transition: all 0.3s;
        }

        .numero-par:hover {
            transform: scale(1.1);
            background: #90cdf4;
            box-shadow: 0 3px 10px rgba(66, 153, 225, 0.3);
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

        .info {
            background: #bee3f8;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
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
            .numero-par {
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
        <h1>🔵 Ejercicio 4: Números Pares (1-100)</h1>
        <div class="subtitle">Ciclo "Mientras" - Generación de pares</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="numeros-container">
            $html_numeros
        </div>

        <div class="suma-container">
            <strong>🧮 Suma Total de Pares:</strong> <strong>$suma</strong>
        </div>

        <div class="estadisticas">
            <h3>📊 Estadísticas de Números Pares</h3>
            <div class="estadisticas-grid">
                <div class="estadistica-item">
                    <div class="estadistica-valor">$total_pares</div>
                    <div class="estadistica-label">Total Pares</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">$suma</div>
                    <div class="estadistica-label">Suma Total</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">" . number_format($promedio, 2) . "</div>
                    <div class="estadistica-label">Promedio</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">100</div>
                    <div class="estadistica-label">Más Alto</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">2</div>
                    <div class="estadistica-label">Más Bajo</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">1-100</div>
                    <div class="estadistica-label">Rango</div>
                </div>
            </div>
        </div>

        <div class="info">
            <strong>💡 Información:</strong>
            <ul>
                <li>Se utilizó un ciclo <strong>while</strong> para generar los números</li>
                <li>Condición: <code>while (\$i <= 100)</code></li>
                <li>Filtro: <code>if (\$i % 2 == 0)</code></li>
                <li>Los números pares son divisibles exactamente entre 2</li>
                <li>En el rango 1-100 hay exactamente 50 números pares</li>
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