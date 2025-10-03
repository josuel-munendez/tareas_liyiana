<?php
// Función para determinar si es consola o web
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// ===============================
// EJERCICIO 1: Imprimir números del 1 al 100
// ===============================
function ejercicio1_consola() {
    echo "=================================\n";
    echo "   EJERCICIO 1: Números 1-100\n";
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

    echo "\n\n✅ Total de números impresos: $contador\n";
}

function ejercicio1_web() {
    $html = "<div class='ejercicio'>";
    $html .= "<h3>1️⃣ Números del 1 al 100</h3>";
    $html .= "<div class='numeros-container'>";

    for ($i = 1; $i <= 100; $i++) {
        $clase = ($i % 2 == 0) ? 'par' : 'impar';
        $html .= "<span class='numero $clase'>$i</span>";

        // Salto de línea cada 10 números
        if ($i % 10 == 0) {
            $html .= "<br>";
        }
    }

    $html .= "</div>";
    $html .= "<div class='resumen'>✅ Total de números: <strong>100</strong></div>";
    $html .= "</div>";

    return $html;
}

// ===============================
// EJERCICIO 2: Sumar números pares del 1 al 20
// ===============================
function ejercicio2_consola() {
    echo "\n=================================\n";
    echo "  EJERCICIO 2: Suma Pares 1-20\n";
    echo "=================================\n\n";

    $suma = 0;
    $numeros_pares = array();

    echo "Números pares del 1 al 20:\n";
    echo "--------------------------\n";

    for ($i = 1; $i <= 20; $i++) {
        if ($i % 2 == 0) {
            $numeros_pares[] = $i;
            $suma += $i;
            echo "$i ";
        }
    }

    echo "\n\n🔢 Números pares encontrados: " . implode(', ', $numeros_pares);
    echo "\n🧮 Suma total: " . implode(' + ', $numeros_pares) . " = $suma\n";
    echo "📊 Cantidad de números pares: " . count($numeros_pares) . "\n";
}

function ejercicio2_web() {
    $numeros_pares = array();
    $suma = 0;

    for ($i = 1; $i <= 20; $i++) {
        if ($i % 2 == 0) {
            $numeros_pares[] = $i;
            $suma += $i;
        }
    }

    $html = "<div class='ejercicio'>";
    $html .= "<h3>2️⃣ Suma de Números Pares (1-20)</h3>";
    $html .= "<div class='numeros-pares'>";

    foreach ($numeros_pares as $numero) {
        $html .= "<span class='numero-par'>$numero</span>";
        if ($numero < 20) {
            $html .= "<span class='operador'> + </span>";
        }
    }

    $html .= "</div>";
    $html .= "<div class='resultado-suma'>";
    $html .= "<strong>🧮 Suma total:</strong> " . implode(' + ', $numeros_pares) . " = <strong>$suma</strong>";
    $html .= "</div>";
    $html .= "<div class='resumen'>";
    $html .= "📊 Cantidad de números pares: <strong>" . count($numeros_pares) . "</strong>";
    $html .= "</div>";
    $html .= "</div>";

    return $html;
}

// ===============================
// EJERCICIO 3: Tabla de multiplicar del 5
// ===============================
function ejercicio3_consola() {
    echo "\n=================================\n";
    echo "  EJERCICIO 3: Tabla del 5\n";
    echo "=================================\n\n";

    $numero = 5;
    echo "Tabla de multiplicar del $numero:\n";
    echo "-------------------------------\n";

    for ($i = 1; $i <= 12; $i++) {
        $resultado = $numero * $i;
        printf("%2d × %2d = %3d\n", $numero, $i, $resultado);
    }

    echo "\n🔢 Tabla completa del 1 al 12\n";
}

function ejercicio3_web() {
    $numero = 5;
    $html = "<div class='ejercicio'>";
    $html .= "<h3>3️⃣ Tabla de Multiplicar del 5</h3>";
    $html .= "<div class='tabla-multiplicar'>";
    $html .= "<table>";
    $html .= "<tr><th>Operación</th><th>Resultado</th></tr>";

    for ($i = 1; $i <= 12; $i++) {
        $resultado = $numero * $i;
        $html .= "<tr>";
        $html .= "<td>$numero × $i</td>";
        $html .= "<td>= $resultado</td>";
        $html .= "</tr>";
    }

    $html .= "</table>";
    $html .= "</div>";
    $html .= "<div class='resumen'>";
    $html .= "🔢 Tabla completa del <strong>1 al 12</strong>";
    $html .= "</div>";
    $html .= "</div>";

    return $html;
}

// ===============================
// EJERCICIO 4: Números impares del 1 al 50
// ===============================
function ejercicio4_consola() {
    echo "\n=================================\n";
    echo "  EJERCICIO 4: Impares 1-50\n";
    echo "=================================\n\n";

    echo "Números impares del 1 al 50:\n";
    echo "---------------------------\n";

    $contador = 0;
    $impares = array();

    for ($i = 1; $i <= 50; $i++) {
        if ($i % 2 != 0) {
            $impares[] = $i;
            printf("%3d ", $i);
            $contador++;

            // Salto de línea cada 5 números
            if ($contador % 5 == 0) {
                echo "\n";
            }
        }
    }

    echo "\n\n🔢 Total de números impares: $contador\n";
    echo "📋 Lista completa: " . implode(', ', $impares) . "\n";
}

function ejercicio4_web() {
    $impares = array();

    for ($i = 1; $i <= 50; $i++) {
        if ($i % 2 != 0) {
            $impares[] = $i;
        }
    }

    $html = "<div class='ejercicio'>";
    $html .= "<h3>4️⃣ Números Impares (1-50)</h3>";
    $html .= "<div class='numeros-container'>";

    foreach ($impares as $index => $numero) {
        $html .= "<span class='numero impar'>$numero</span>";

        // Salto de línea cada 5 números
        if (($index + 1) % 5 == 0) {
            $html .= "<br>";
        }
    }

    $html .= "</div>";
    $html .= "<div class='resumen'>";
    $html .= "🔢 Total de números impares: <strong>" . count($impares) . "</strong><br>";
    $html .= "📋 Lista: " . implode(', ', $impares);
    $html .= "</div>";
    $html .= "</div>";

    return $html;
}

// ===============================
// EJERCICIO 5: Promedio de calificaciones
// ===============================
function ejercicio5_consola() {
    echo "\n=================================\n";
    echo "  EJERCICIO 5: Promedio Calificaciones\n";
    echo "=================================\n\n";

    // Simular calificaciones de estudiantes
    $calificaciones = array(85, 92, 78, 96, 88, 76, 95, 89, 91, 87);
    $total_estudiantes = count($calificaciones);
    $suma = 0;

    echo "Calificaciones de los estudiantes:\n";
    echo "---------------------------------\n";

    for ($i = 0; $i < $total_estudiantes; $i++) {
        $numero_estudiante = $i + 1;
        $calificacion = $calificaciones[$i];
        $suma += $calificacion;

        echo "Estudiante " . sprintf("%2d", $numero_estudiante) . ": $calificacion\n";
    }

    $promedio = $suma / $total_estudiantes;

    echo "\n📊 RESULTADOS:\n";
    echo "-------------\n";
    echo "👥 Total de estudiantes: $total_estudiantes\n";
    echo "🧮 Suma total: $suma\n";
    echo "📈 Promedio: " . number_format($promedio, 2) . "\n";

    // Calificación más alta y más baja
    $maxima = max($calificaciones);
    $minima = min($calificaciones);

    echo "🏆 Calificación más alta: $maxima\n";
    echo "📉 Calificación más baja: $minima\n";

    // Análisis adicional
    $aprobados = 0;
    foreach ($calificaciones as $calificacion) {
        if ($calificacion >= 70) {
            $aprobados++;
        }
    }
    $porcentaje_aprobados = ($aprobados / $total_estudiantes) * 100;

    echo "✅ Estudiantes aprobados (≥70): $aprobados/" . $total_estudiantes .
         " (" . number_format($porcentaje_aprobados, 1) . "%)\n";
}

function ejercicio5_web() {
    // Simular calificaciones de estudiantes
    $calificaciones = array(85, 92, 78, 96, 88, 76, 95, 89, 91, 87);
    $total_estudiantes = count($calificaciones);
    $suma = 0;

    foreach ($calificaciones as $calificacion) {
        $suma += $calificacion;
    }

    $promedio = $suma / $total_estudiantes;
    $maxima = max($calificaciones);
    $minima = min($calificaciones);

    // Contar aprobados
    $aprobados = 0;
    foreach ($calificaciones as $calificacion) {
        if ($calificacion >= 70) {
            $aprobados++;
        }
    }
    $porcentaje_aprobados = ($aprobados / $total_estudiantes) * 100;

    $html = "<div class='ejercicio'>";
    $html .= "<h3>5️⃣ Promedio de Calificaciones</h3>";

    // Tabla de calificaciones
    $html .= "<div class='tabla-calificaciones'>";
    $html .= "<table>";
    $html .= "<tr><th>#</th><th>Estudiante</th><th>Calificación</th><th>Estado</th></tr>";

    for ($i = 0; $i < $total_estudiantes; $i++) {
        $numero_estudiante = $i + 1;
        $calificacion = $calificaciones[$i];
        $estado = ($calificacion >= 70) ? '<span class="aprobado">✅ Aprobado</span>' : '<span class="reprobado">❌ Reprobado</span>';
        $clase_fila = ($calificacion >= 90) ? 'excelente' : (($calificacion >= 70) ? 'aprobado' : 'reprobado');

        $html .= "<tr class='$clase_fila'>";
        $html .= "<td>$numero_estudiante</td>";
        $html .= "<td>Estudiante $numero_estudiante</td>";
        $html .= "<td>$calificacion</td>";
        $html .= "<td>$estado</td>";
        $html .= "</tr>";
    }

    $html .= "</table>";
    $html .= "</div>";

    // Resumen estadístico
    $html .= "<div class='resumen-estadistico'>";
    $html .= "<h4>📊 Resumen Estadístico</h4>";
    $html .= "<div class='estadisticas'>";
    $html .= "<div class='estadistica'><span class='etiqueta'>👥 Total estudiantes:</span> <strong>$total_estudiantes</strong></div>";
    $html .= "<div class='estadistica'><span class='etiqueta'>🧮 Suma total:</span> <strong>$suma</strong></div>";
    $html .= "<div class='estadistica'><span class='etiqueta'>📈 Promedio:</span> <strong>" . number_format($promedio, 2) . "</strong></div>";
    $html .= "<div class='estadistica'><span class='etiqueta'>🏆 Calificación más alta:</span> <strong>$maxima</strong></div>";
    $html .= "<div class='estadistica'><span class='etiqueta'>📉 Calificación más baja:</span> <strong>$minima</strong></div>";
    $html .= "<div class='estadistica'><span class='etiqueta'>✅ Aprobados (≥70):</span> <strong>$aprobados/$total_estudiantes (" . number_format($porcentaje_aprobados, 1) . "%)</strong></div>";
    $html .= "</div>";
    $html .= "</div>";

    $html .= "</div>";

    return $html;
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "    EJERCICIOS DE CICLO 'PARA'\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    // Ejecutar todos los ejercicios
    ejercicio1_consola();
    ejercicio2_consola();
    ejercicio3_consola();
    ejercicio4_consola();
    ejercicio5_consola();

    echo "\n=================================\n";
    echo "      🎉 TODOS LOS EJERCICIOS\n";
    echo "         COMPLETADOS\n";
    echo "=================================\n\n";

    echo "Presione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    // Generar HTML
    echo generarHTML();
}

function generarHTML() {
    $ejercicio1 = ejercicio1_web();
    $ejercicio2 = ejercicio2_web();
    $ejercicio3 = ejercicio3_web();
    $ejercicio4 = ejercicio4_web();
    $ejercicio5 = ejercicio5_web();

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de Ciclo "Para" - Web</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
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

        .ejercicios-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .ejercicio {
            background: #f7fafc;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            transition: transform 0.2s;
        }

        .ejercicio:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .ejercicio h3 {
            color: #4a5568;
            margin-top: 0;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .numeros-container {
            text-align: center;
            line-height: 2;
            margin: 15px 0;
        }

        .numero {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin: 2px;
            border-radius: 5px;
            font-weight: bold;
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

        .numeros-pares {
            text-align: center;
            margin: 15px 0;
            font-size: 18px;
        }

        .numero-par {
            background: #bee3f8;
            color: #2a4365;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
        }

        .operador {
            margin: 0 5px;
            font-weight: bold;
        }

        .resultado-suma {
            text-align: center;
            background: #e6fffa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-size: 18px;
            border: 2px solid #38b2ac;
        }

        .tabla-multiplicar {
            display: flex;
            justify-content: center;
            margin: 15px 0;
        }

        .tabla-multiplicar table {
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .tabla-multiplicar th {
            background: #4a5568;
            color: white;
            padding: 12px 20px;
        }

        .tabla-multiplicar td {
            padding: 10px 20px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
        }

        .tabla-multiplicar tr:nth-child(even) {
            background: #f7fafc;
        }

        .tabla-multiplicar tr:hover {
            background: #edf2f7;
        }

        .tabla-calificaciones {
            margin: 15px 0;
            overflow-x: auto;
        }

        .tabla-calificaciones table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .tabla-calificaciones th {
            background: #4a5568;
            color: white;
            padding: 12px;
            text-align: left;
        }

        .tabla-calificaciones td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .tabla-calificaciones tr.excelente {
            background: #c6f6d5;
        }

        .tabla-calificaciones tr.aprobado {
            background: #fffaf0;
        }

        .tabla-calificaciones tr.reprobado {
            background: #fed7d7;
        }

        .tabla-calificaciones tr:hover {
            background: #e2e8f0;
        }

        .aprobado {
            color: #22543d;
            font-weight: bold;
        }

        .reprobado {
            color: #742a2a;
            font-weight: bold;
        }

        .resumen {
            background: #e2e8f0;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 14px;
        }

        .resumen-estadistico {
            background: #fffaf0;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            border: 2px solid #ed8936;
        }

        .resumen-estadistico h4 {
            margin-top: 0;
            color: #744210;
        }

        .estadisticas {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 10px;
        }

        .estadistica {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            background: white;
            border-radius: 5px;
        }

        .etiqueta {
            font-weight: bold;
            color: #4a5568;
        }

        .info {
            background: #bee3f8;
            color: #2a4365;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .estadisticas {
                grid-template-columns: 1fr;
            }

            .numero {
                width: 35px;
                height: 35px;
                line-height: 35px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 Ejercicios de Ciclo "Para"</h1>
        <div class="subtitle">Implementación de 5 ejercicios usando ciclos for</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="info">
            <strong>📚 Ejercicios implementados:</strong>
            <ol>
                <li>Imprimir números del 1 al 100</li>
                <li>Sumar números pares del 1 al 20</li>
                <li>Tabla de multiplicar del 5</li>
                <li>Imprimir números impares del 1 al 50</li>
                <li>Promediar calificaciones de estudiantes</li>
            </ol>
        </div>

        <div class="ejercicios-container">
            $ejercicio1
            $ejercicio2
            $ejercicio3
            $ejercicio4
            $ejercicio5
        </div>

        <div class="info">
            <strong>💡 Características implementadas:</strong>
            <ul>
                <li><strong>Formateo visual:</strong> Números pares e impares con colores diferentes</li>
                <li><strong>Presentación organizada:</strong> Tablas y contenedores para mejor legibilidad</li>
                <li><strong>Análisis estadístico:</strong> En el ejercicio de calificaciones</li>
                <li><strong>Responsive:</strong> Adaptable a diferentes tamaños de pantalla</li>
                <li><strong>Interactividad:</strong> Efectos hover y transiciones suaves</li>
            </ul>
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