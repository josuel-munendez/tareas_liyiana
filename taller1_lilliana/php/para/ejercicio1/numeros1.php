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
    echo "   EJERCICIO 1: Números 1-100\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Imprimiendo números del 1 al 100:\n";
    echo "---------------------------------\n";

    $contador = 0;
    for ($i = 1; $i <= 100; $i++) {
        printf("%3d ", $i);
        $contador++;

        // Salto de línea cada 10 números
        if ($contador % 10 == 0) {
            echo "\n";
        }
    }

    echo "\n\n📊 ESTADÍSTICAS:\n";
    echo "---------------\n";
    echo "✅ Total de números impresos: $contador\n";
    echo "🔢 Rango: 1 - 100\n";
    echo "📐 Números por línea: 10\n";

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
    $html = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Números 1-100</title>
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

        .numero {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin: 2px;
            border-radius: 5px;
            font-weight: bold;
            transition: transform 0.2s;
        }

        .numero:hover {
            transform: scale(1.1);
        }

        .numero.par {
            background: #c6f6d5;
            color: #22543d;
            border: 1px solid #48bb78;
        }

        .numero.impar {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #f56565;
        }

        .estadisticas {
            background: #bee3f8;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .estadistica {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            padding: 5px;
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
            .numero {
                width: 30px;
                height: 30px;
                line-height: 30px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 Ejercicio 1: Números del 1 al 100</h1>
        <div class="subtitle">Ciclo "Para" - Impresión de números</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="numeros-container">';

    // Generar números
    for ($i = 1; $i <= 100; $i++) {
        $clase = ($i % 2 == 0) ? 'par' : 'impar';
        $html .= "<span class='numero $clase'>$i</span>";

        // Salto de línea cada 10 números
        if ($i % 10 == 0) {
            $html .= "<br>";
        }
    }

    $html .= '</div>

        <div class="estadisticas">
            <h3>📊 Estadísticas</h3>
            <div class="estadistica">
                <span>✅ Total de números:</span>
                <strong>100</strong>
            </div>
            <div class="estadistica">
                <span>🔢 Rango:</span>
                <strong>1 - 100</strong>
            </div>
            <div class="estadistica">
                <span>📐 Números por línea:</span>
                <strong>10</strong>
            </div>
            <div class="estadistica">
                <span>🔵 Números pares:</span>
                <strong>50</strong>
            </div>
            <div class="estadistica">
                <span>🔴 Números impares:</span>
                <strong>50</strong>
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