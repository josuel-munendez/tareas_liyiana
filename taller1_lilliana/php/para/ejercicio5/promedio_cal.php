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
    echo "  EJERCICIO 5: Promedio Calificaciones\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    // Simular calificaciones de estudiantes
    $calificaciones = array(85, 92, 78, 96, 88, 76, 95, 89, 91, 87);
    $total_estudiantes = count($calificaciones);
    $suma = 0;

    echo "📚 CALIFICACIONES DE ESTUDIANTES:\n";
    echo "---------------------------------\n";

    for ($i = 0; $i < $total_estudiantes; $i++) {
        $numero_estudiante = $i + 1;
        $calificacion = $calificaciones[$i];
        $suma += $calificacion;

        $estado = ($calificacion >= 70) ? "✅ APROBADO" : "❌ REPROBADO";
        echo "Estudiante " . sprintf("%2d", $numero_estudiante) . ": $calificacion - $estado\n";
    }

    $promedio = $suma / $total_estudiantes;

    echo "\n📊 RESULTADOS ESTADÍSTICOS:\n";
    echo "--------------------------\n";
    echo "👥 Total de estudiantes: $total_estudiantes\n";
    echo "🧮 Suma total: $suma\n";
    echo "📈 Promedio del grupo: " . number_format($promedio, 2) . "\n";

    // Calificación más alta y más baja
    $maxima = max($calificaciones);
    $minima = min($calificaciones);

    echo "🏆 Calificación más alta: $maxima\n";
    echo "📉 Calificación más baja: $minima\n";
    echo "📐 Rango: $minima - $maxima\n";

    // Análisis de aprobados
    $aprobados = 0;
    foreach ($calificaciones as $calificacion) {
        if ($calificacion >= 70) {
            $aprobados++;
        }
    }
    $reprobados = $total_estudiantes - $aprobados;
    $porcentaje_aprobados = ($aprobados / $total_estudiantes) * 100;
    $porcentaje_reprobados = ($reprobados / $total_estudiantes) * 100;

    echo "\n🎓 ANÁLISIS DE APROBACIÓN:\n";
    echo "------------------------\n";
    echo "✅ Estudiantes aprobados (≥70): $aprobados/$total_estudiantes (" . number_format($porcentaje_aprobados, 1) . "%)\n";
    echo "❌ Estudiantes reprobados (<70): $reprobados/$total_estudiantes (" . number_format($porcentaje_reprobados, 1) . "%)\n";

    // Calificaciones por rango
    $excelente = $bueno = $suficiente = $reprobado = 0;
    foreach ($calificaciones as $calificacion) {
        if ($calificacion >= 90) $excelente++;
        elseif ($calificacion >= 80) $bueno++;
        elseif ($calificacion >= 70) $suficiente++;
        else $reprobado++;
    }

    echo "\n📋 DISTRIBUCIÓN POR RANGOS:\n";
    echo "--------------------------\n";
    echo "🥇 Excelente (90-100): $excelente estudiantes\n";
    echo "🥈 Bueno (80-89): $bueno estudiantes\n";
    echo "🥉 Suficiente (70-79): $suficiente estudiantes\n";
    echo "📝 Reprobado (<70): $reprobado estudiantes\n";

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

    // Contar aprobados y reprobados
    $aprobados = 0;
    foreach ($calificaciones as $calificacion) {
        if ($calificacion >= 70) {
            $aprobados++;
        }
    }
    $reprobados = $total_estudiantes - $aprobados;
    $porcentaje_aprobados = ($aprobados / $total_estudiantes) * 100;

    // Distribución por rangos
    $excelente = $bueno = $suficiente = $reprobado = 0;
    foreach ($calificaciones as $calificacion) {
        if ($calificacion >= 90) $excelente++;
        elseif ($calificacion >= 80) $bueno++;
        elseif ($calificacion >= 70) $suficiente++;
        else $reprobado++;
    }

    $html = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Promedio Calificaciones</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
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

        .tabla-calificaciones {
            margin: 20px 0;
            overflow-x: auto;
        }

        .tabla-calificaciones table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .tabla-calificaciones th {
            background: #4a5568;
            color: white;
            padding: 15px;
            text-align: left;
        }

        .tabla-calificaciones td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .tabla-calificaciones tr.excelente {
            background: #c6f6d5;
        }

        .tabla-calificaciones tr.bueno {
            background: #fffaf0;
        }

        .tabla-calificaciones tr.suficiente {
            background: #fed7d7;
        }

        .tabla-calificaciones tr.reprobado {
            background: #fed7d7;
            opacity: 0.7;
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

        .resumen-estadistico {
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

        .distribucion-rangos {
            background: #bee3f8;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .rango-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 5px;
        }

        .barra-container {
            flex-grow: 1;
            background: #e2e8f0;
            border-radius: 10px;
            margin: 0 15px;
            height: 20px;
            overflow: hidden;
        }

        .barra {
            height: 100%;
            border-radius: 10px;
        }

        .barra.excelente { background: #48bb78; }
        .barra.bueno { background: #ed8936; }
        .barra.suficiente { background: #f56565; }
        .barra.reprobado { background: #e53e3e; }

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
        <h1>📊 Ejercicio 5: Promedio de Calificaciones</h1>
        <div class="subtitle">Ciclo "Para" - Análisis estadístico de calificaciones</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="tabla-calificaciones">
            <table>
                <tr>
                    <th>#</th>
                    <th>Estudiante</th>
                    <th>Calificación</th>
                    <th>Estado</th>
                    <th>Rango</th>
                </tr>';

    // Generar tabla de calificaciones
    for ($i = 0; $i < $total_estudiantes; $i++) {
        $numero_estudiante = $i + 1;
        $calificacion = $calificaciones[$i];

        // Determinar estado y clase
        $estado = ($calificacion >= 70) ? '<span class="aprobado">✅ Aprobado</span>' : '<span class="reprobado">❌ Reprobado</span>';

        if ($calificacion >= 90) {
            $clase_fila = 'excelente';
            $rango = '🥇 Excelente';
        } elseif ($calificacion >= 80) {
            $clase_fila = 'bueno';
            $rango = '🥈 Bueno';
        } elseif ($calificacion >= 70) {
            $clase_fila = 'suficiente';
            $rango = '🥉 Suficiente';
        } else {
            $clase_fila = 'reprobado';
            $rango = '📝 Reprobado';
        }

        $html .= "<tr class='$clase_fila'>
                    <td>$numero_estudiante</td>
                    <td>Estudiante $numero_estudiante</td>
                    <td><strong>$calificacion</strong></td>
                    <td>$estado</td>
                    <td>$rango</td>
                  </tr>";
    }

    $html .= '</table>
        </div>

        <div class="resumen-estadistico">
            <h3>📈 Resumen Estadístico</h3>
            <div class="estadisticas-grid">
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . $total_estudiantes . '</div>
                    <div class="estadistica-label">Total Estudiantes</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . number_format($promedio, 2) . '</div>
                    <div class="estadistica-label">Promedio General</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . $maxima . '</div>
                    <div class="estadistica-label">Calificación Más Alta</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . $minima . '</div>
                    <div class="estadistica-label">Calificación Más Baja</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . $aprobados . '</div>
                    <div class="estadistica-label">Estudiantes Aprobados</div>
                </div>
                <div class="estadistica-item">
                    <div class="estadistica-valor">' . number_format($porcentaje_aprobados, 1) . '%</div>
                    <div class="estadistica-label">Porcentaje Aprobación</div>
                </div>
            </div>
        </div>

        <div class="distribucion-rangos">
            <h3>📋 Distribución por Rangos de Calificación</h3>';

    // Mostrar distribución por rangos
    $rangos = array(
        array('nombre' => '🥇 Excelente (90-100)', 'cantidad' => $excelente, 'clase' => 'excelente'),
        array('nombre' => '🥈 Bueno (80-89)', 'cantidad' => $bueno, 'clase' => 'bueno'),
        array('nombre' => '🥉 Suficiente (70-79)', 'cantidad' => $suficiente, 'clase' => 'suficiente'),
        array('nombre' => '📝 Reprobado (<70)', 'cantidad' => $reprobado, 'clase' => 'reprobado')
    );

    foreach ($rangos as $rango) {
        $porcentaje = ($rango['cantidad'] / $total_estudiantes) * 100;
        $ancho_barra = min(100, $porcentaje * 2); // Escalar para mejor visualización

        $html .= "<div class='rango-item'>
                    <span><strong>{$rango['nombre']}</strong></span>
                    <div class='barra-container'>
                        <div class='barra {$rango['clase']}' style='width: {$ancho_barra}%'></div>
                    </div>
                    <span><strong>{$rango['cantidad']} estudiantes (" . number_format($porcentaje, 1) . "%)</strong></span>
                  </div>";
    }

    $html .= '</div>

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