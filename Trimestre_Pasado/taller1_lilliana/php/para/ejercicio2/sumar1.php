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
    echo "  EJERCICIO 2: Suma Pares 1-20\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    $suma = 0;
    $numeros_pares = array();

    echo "Buscando números pares del 1 al 20:\n";
    echo "-----------------------------------\n";

    for ($i = 1; $i <= 20; $i++) {
        if ($i % 2 == 0) {
            $numeros_pares[] = $i;
            $suma += $i;
            echo "$i ";
        }
    }

    echo "\n\n📊 RESULTADOS:\n";
    echo "-------------\n";
    echo "🔢 Números pares encontrados: " . implode(', ', $numeros_pares) . "\n";
    echo "🧮 Operación: " . implode(' + ', $numeros_pares) . " = $suma\n";
    echo "📈 Cantidad de números pares: " . count($numeros_pares) . "\n";
    echo "📐 Promedio: " . number_format($suma / count($numeros_pares), 2) . "\n";

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
    $numeros_pares = array();
    $suma = 0;

    // Calcular números pares y suma
    for ($i = 1; $i <= 20; $i++) {
        if ($i % 2 == 0) {
            $numeros_pares[] = $i;
            $suma += $i;
        }
    }

    $html = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Suma Pares 1-20</title>
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

        .operacion {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            background: #f7fafc;
            border-radius: 10px;
        }

        .numero-par {
            display: inline-block;
            background: #bee3f8;
            color: #2a4365;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 18px;
        }

        .operador {
            font-size: 20px;
            font-weight: bold;
            margin: 0 5px;
        }

        .resultado {
            background: #c6f6d5;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
            font-size: 20px;
            border: 2px solid #48bb78;
        }

        .estadisticas {
            background: #fffaf0;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .estadistica {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            padding: 8px;
            background: white;
            border-radius: 5px;
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
        <h1>➕ Ejercicio 2: Suma de Números Pares (1-20)</h1>
        <div class="subtitle">Ciclo "Para" - Filtrado y suma</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="operacion">';

    // Mostrar operación
    foreach ($numeros_pares as $index => $numero) {
        $html .= "<span class='numero-par'>$numero</span>";
        if ($index < count($numeros_pares) - 1) {
            $html .= "<span class='operador'>+</span>";
        }
    }

    $html .= '</div>

        <div class="resultado">
            🧮 Resultado: ' . implode(' + ', $numeros_pares) . ' = <strong>' . $suma . '</strong>
        </div>

        <div class="estadisticas">
            <h3>📊 Estadísticas</h3>
            <div class="estadistica">
                <span>🔢 Números pares encontrados:</span>
                <strong>' . count($numeros_pares) . '</strong>
            </div>
            <div class="estadistica">
                <span>📋 Lista completa:</span>
                <strong>' . implode(', ', $numeros_pares) . '</strong>
            </div>
            <div class="estadistica">
                <span>📈 Suma total:</span>
                <strong>' . $suma . '</strong>
            </div>
            <div class="estadistica">
                <span>📐 Promedio:</span>
                <strong>' . number_format($suma / count($numeros_pares), 2) . '</strong>
            </div>
            <div class="estadistica">
                <span>🔍 Rango analizado:</span>
                <strong>1 - 20</strong>
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