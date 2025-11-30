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
    echo " EJERCICIO 3: Tabla del 5\n";
    echo "     (Ciclo Repita)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "🧮 Generando tabla de multiplicar del 5 usando do-while...\n";
    echo "=======================================================\n";

    $i = 1;
    $tabla = array();
    $suma = 0;

    do {
        $resultado = 5 * $i;
        $tabla[] = $resultado;
        $suma += $resultado;
        echo "5 × $i = $resultado\n";
        $i++;
    } while ($i <= 10);

    // Mostrar resultados
    echo "\n📊 ESTADÍSTICAS DE LA TABLA:\n";
    echo "===========================\n";
    echo "🔢 Resultados: " . implode(', ', $tabla) . "\n";
    echo "🧮 Suma total: $suma\n";
    echo "📈 Promedio: " . number_format($suma / 10, 1) . "\n";
    echo "📈 Valor máximo: " . max($tabla) . "\n";
    echo "📉 Valor mínimo: " . min($tabla) . "\n";

    echo "\n💡 PATRONES INTERESANTES:\n";
    echo "=======================\n";
    echo "🔍 Todos los resultados terminan en 0 o 5\n";
    echo "📐 La diferencia entre resultados consecutivos es 5\n";
    echo "🎯 La tabla del 5 es la mitad de la tabla del 10\n";

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $tabla = array();
    $i = 1;

    // Generar tabla con ciclo repita (do-while)
    do {
        $tabla[] = array(
            'multiplicador' => $i,
            'resultado' => 5 * $i
        );
        $i++;
    } while ($i <= 10);

    echo generarHTML($tabla);
}

function generarHTML($tabla) {
    $suma = 0;
    foreach ($tabla as $item) {
        $suma += $item['resultado'];
    }
    $promedio = $suma / count($tabla);

    $html_tabla = '';
    foreach ($tabla as $item) {
        $html_tabla .= "
        <div class='fila-tabla'>
            <div class='operacion'>5 × {$item['multiplicador']}</div>
            <div class='igual'>=</div>
            <div class='resultado'>{$item['resultado']}</div>
        </div>";
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Ciclo Repita</title>
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
            background: #fffaf0;
            padding: 30px;
            border-radius: 15px;
            margin: 20px 0;
            border: 3px solid #ed8936;
        }

        .titulo-tabla {
            text-align: center;
            font-size: 28px;
            color: #744210;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .fila-tabla {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 15px;
            align-items: center;
            margin: 12px 0;
            padding: 12px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #ed8936;
            transition: all 0.3s;
        }

        .fila-tabla:hover {
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .operacion, .igual, .resultado {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .operacion {
            color: #4a5568;
        }

        .igual {
            color: #718096;
        }

        .resultado {
            color: #744210;
            background: #fed7d7;
            padding: 8px 15px;
            border-radius: 20px;
        }

        .estadisticas {
            background: #bee3f8;
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
            border-left: 4px solid #4299e1;
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

        .patrones {
            background: #c6f6d5;
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
        <h1>🧮 Ejercicio 3: Tabla del 5</h1>
        <div class="subtitle">Ciclo "Repita" (do-while) - Tabla de multiplicar</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="tabla-container">
            <div class="titulo-tabla">✨ Tabla de Multiplicar del 5 ✨</div>
            $html_tabla
        </div>

        <div class="estadisticas">
            <h3>📊 Estadísticas de la Tabla</h3>
            <div class="estadisticas-grid">
                <div class="estadistica-item">
                    <div class="estadistica-valor">10</div>
                    <div class="estadistica-label">Operaciones</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">$suma</div>
                    <div class="estadistica-label">Suma Total</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">" . number_format($promedio, 1) . "</div>
                    <div class="estadistica-label">Promedio</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">50</div>
                    <div class="estadistica-label">Valor Máximo</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">5</div>
                    <div class="estadistica-label">Valor Mínimo</div>
                </div>
            </div>
        </div>

        <div class="patrones">
            <strong>🔍 Patrones Interesantes en la Tabla del 5:</strong>
            <ul>
                <li>Todos los resultados terminan en <strong>0</strong> o <strong>5</strong></li>
                <li>La diferencia entre resultados consecutivos es siempre <strong>5</strong></li>
                <li>Los resultados alternan entre terminaciones 0 y 5</li>
                <li>La tabla del 5 es exactamente la mitad de la tabla del 10</li>
            </ul>
        </div>

        <div class="codigo">
            <strong>📝 Código utilizado:</strong><br>
            \$i = 1;<br>
            do {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;\$resultado = 5 * \$i;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;echo "5 × \$i = \$resultado";<br>
            &nbsp;&nbsp;&nbsp;&nbsp;\$i++;<br>
            } while (\$i <= 10);
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