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
    echo " EJERCICIO 4: Impares 1-50\n";
    echo "     (Ciclo Repita)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "🔴 Generando números impares del 1 al 50 usando do-while...\n";
    echo "=========================================================\n";

    $i = 1;
    $impares = array();
    $suma = 0;
    $contador = 0;

    do {
        if ($i % 2 != 0) {
            $impares[] = $i;
            $suma += $i;
            $contador++;

            printf("%3d ", $i);

            // Salto de línea cada 10 números
            if ($contador % 10 == 0) {
                echo "\n";
            }
        }
        $i++;
    } while ($i <= 50);

    // Mostrar resultados
    echo "\n\n📊 ESTADÍSTICAS:\n";
    echo "===============\n";
    echo "🔢 Total de números impares: $contador\n";
    echo "🧮 Suma total: $suma\n";
    echo "📈 Promedio: " . number_format($suma / $contador, 2) . "\n";
    echo "📈 Número impar más alto: " . max($impares) . "\n";
    echo "📉 Número impar más bajo: " . min($impares) . "\n";

    echo "\n💡 INFORMACIÓN ADICIONAL:\n";
    echo "======================\n";
    echo "🔍 Rango analizado: 1-50\n";
    echo "📐 Proporción impares/total: $contador/50 (" . ($contador * 2) . "%)\n";
    echo "🎯 Los números impares no son divisibles entre 2\n";

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $impares = array();
    $suma = 0;
    $i = 1;

    // Generar impares con ciclo repita (do-while)
    do {
        if ($i % 2 != 0) {
            $impares[] = $i;
            $suma += $i;
        }
        $i++;
    } while ($i <= 50);

    echo generarHTML($impares, $suma);
}

function generarHTML($impares, $suma) {
    $total_impares = count($impares);
    $promedio = $suma / $total_impares;

    $html_numeros = '';
    foreach ($impares as $index => $numero) {
        $html_numeros .= "<span class='numero-impar'>$numero</span>";

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
    <title>Ejercicio 4 - Ciclo Repita</title>
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

        .numero-impar {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin: 2px;
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

        .suma-container {
            background: #fed7d7;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
            border: 2px solid #f56565;
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

        .caracteristicas {
            background: #bee3f8;
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
        <h1>🔴 Ejercicio 4: Números Impares (1-50)</h1>
        <div class="subtitle">Ciclo "Repita" (do-while) - Generación de impares</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="numeros-container">
            $html_numeros
        </div>

        <div class="suma-container">
            <strong>🧮 Suma Total de Impares:</strong> <strong>$suma</strong>
        </div>

        <div class="estadisticas">
            <h3>📊 Estadísticas de Números Impares</h3>
            <div class="estadisticas-grid">
                <div class="estadistica-item">
                    <div class="estadistica-valor">$total_impares</div>
                    <div class="estadistica-label">Total Impares</div>
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
                    <div class="estadistica-valor">49</div>
                    <div class="estadistica-label">Más Alto</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">1</div>
                    <div class="estadistica-label">Más Bajo</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">1-50</div>
                    <div class="estadistica-label">Rango</div>
                </div>
            </div>
        </div>

        <div class="info">
            <strong>💡 Sobre los Números Impares:</strong>
            <ul>
                <li>Un número es impar si <strong>NO es divisible entre 2</strong></li>
                <li>Los números impares terminan en 1, 3, 5, 7 o 9</li>
                <li>Entre 1 y 50 hay 25 números impares</li>
                <li>La suma de los primeros n números impares es n²</li>
            </ul>
        </div>

        <div class="caracteristicas">
            <strong>🚀 Ventajas del Ciclo Repita (do-while):</strong>
            <ul>
                <li>✅ <strong>Garantiza ejecución</strong> - Se ejecuta al menos una vez</li>
                <li>✅ <strong>Útil para validaciones</strong> - Ideal para menús y entradas de usuario</li>
                <li>✅ <strong>Condición posterior</strong> - La verificación ocurre después del bloque</li>
                <li>✅ <strong>Menos código</strong> - En algunos casos reduce líneas de código</li>
            </ul>
        </div>

        <div class="codigo">
            <strong>📝 Código utilizado:</strong><br>
            \$i = 1;<br>
            do {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;if (\$i % 2 != 0) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo \$i;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
            &nbsp;&nbsp;&nbsp;&nbsp;\$i++;<br>
            } while (\$i <= 50);
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