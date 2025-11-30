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
    echo " EJERCICIO 2: Suma de Pares 1-20\n";
    echo "       (Ciclo Repita)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "🔢 Sumando números pares del 1 al 20 usando do-while...\n";
    echo "======================================================\n";

    $i = 1;
    $suma = 0;
    $pares = array();
    $contador = 0;

    do {
        if ($i % 2 == 0) {
            $suma += $i;
            $pares[] = $i;
            $contador++;
            echo "✅ +$i | Suma parcial: $suma\n";
        }
        $i++;
    } while ($i <= 20);

    // Mostrar resultados
    echo "\n📊 RESULTADOS FINALES:\n";
    echo "=====================\n";
    echo "🔢 Números pares encontrados: " . implode(', ', $pares) . "\n";
    echo "📋 Total de pares: $contador\n";
    echo "🧮 Suma total: $suma\n";
    echo "📈 Promedio: " . number_format($suma / $contador, 2) . "\n";

    echo "\n💡 INFORMACIÓN ADICIONAL:\n";
    echo "======================\n";
    echo "🔄 Ciclo utilizado: do-while\n";
    echo "📝 Condición: while (\$i <= 20)\n";
    echo "🔍 Filtro: if (\$i % 2 == 0)\n";
    echo "🚀 Se garantiza al menos una iteración\n";

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

    // Sumar pares con ciclo repita (do-while)
    do {
        if ($i % 2 == 0) {
            $pares[] = $i;
            $suma += $i;
        }
        $i++;
    } while ($i <= 20);

    echo generarHTML($pares, $suma);
}

function generarHTML($pares, $suma) {
    $total_pares = count($pares);
    $promedio = $suma / $total_pares;
    $operacion = implode(' + ', $pares);

    $html_numeros = '';
    foreach ($pares as $numero) {
        $html_numeros .= "<div class='numero-par'>$numero</div>";
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Ciclo Repita</title>
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
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
            padding: 20px;
            background: #f7fafc;
            border-radius: 10px;
        }

        .numero-par {
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            border-radius: 50%;
            font-weight: bold;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            border: 3px solid #2f855a;
            transition: all 0.3s;
        }

        .numero-par:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.3);
        }

        .operacion {
            background: #bee3f8;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
            font-size: 16px;
        }

        .resultado-suma {
            background: #c6f6d5;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            border: 2px solid #48bb78;
        }

        .resultado-suma h3 {
            margin: 0;
            color: #22543d;
        }

        .suma-total {
            font-size: 32px;
            font-weight: bold;
            color: #22543d;
            margin: 10px 0;
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

        .info {
            background: #fed7d7;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .codigo {
            background: #2d3748;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            font-family: monospace;
            margin: 15px 0;
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
        <h1>➕ Ejercicio 2: Suma de Pares (1-20)</h1>
        <div class="subtitle">Ciclo "Repita" (do-while) - Suma de números pares</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="operacion">
            <strong>📋 Operación:</strong> $operacion
        </div>

        <div class="numeros-container">
            $html_numeros
        </div>

        <div class="resultado-suma">
            <h3>🧮 Resultado de la Suma</h3>
            <div class="suma-total">$suma</div>
            <p>Suma total de $total_pares números pares entre 1 y 20</p>
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
                    <div class="estadistica-valor">20</div>
                    <div class="estadistica-label">Más Alto</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">2</div>
                    <div class="estadistica-label">Más Bajo</div>
                </div>
            </div>
        </div>

        <div class="info">
            <strong>💡 Sobre los Números Pares:</strong>
            <ul>
                <li>Un número es par si es divisible exactamente entre 2</li>
                <li>Los números pares terminan en 0, 2, 4, 6 u 8</li>
                <li>Entre 1 y 20 hay 10 números pares</li>
                <li>La suma de pares consecutivos forma una progresión aritmética</li>
            </ul>
        </div>

        <div class="codigo">
            <strong>📝 Código utilizado:</strong><br>
            \$i = 1;<br>
            \$suma = 0;<br>
            do {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;if (\$i % 2 == 0) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\$suma += \$i;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;\$i++;<br>
            } while (\$i <= 20);
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