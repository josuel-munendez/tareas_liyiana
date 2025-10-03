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
    echo " EJERCICIO 5: Promedio Calificaciones\n";
    echo "         (Ciclo Repita)\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "📊 Calculando promedio de calificaciones usando do-while...\n";
    echo "=========================================================\n";

    $calificaciones = array();
    $suma = 0;
    $continuar = true;
    $contador = 0;

    do {
        echo "Ingrese la calificación #" . ($contador + 1) . " (0-100, o -1 para terminar): ";
        $input = trim(fgets(STDIN));
        $calificacion = is_numeric($input) ? floatval($input) : null;

        if ($calificacion === null) {
            echo "❌ Error: Debe ingresar un número válido\n";
            continue;
        }

        if ($calificacion == -1) {
            $continuar = false;
            echo "⚡ Finalizando ingreso de calificaciones...\n";
        } elseif ($calificacion < 0 || $calificacion > 100) {
            echo "⚠️  Advertencia: La calificación debe estar entre 0 y 100\n";
        } else {
            $calificaciones[] = $calificacion;
            $suma += $calificacion;
            $contador++;
            echo "✅ Calificación $calificacion agregada. Promedio actual: " . number_format($suma / $contador, 2) . "\n";
        }
    } while ($continuar);

    // Mostrar resultados
    if ($contador > 0) {
        $promedio = $suma / $contador;

        echo "\n📊 RESULTADOS FINALES:\n";
        echo "=====================\n";
        echo "🔢 Total de calificaciones: $contador\n";
        echo "📋 Calificaciones: " . implode(', ', $calificaciones) . "\n";
        echo "🧮 Suma total: $suma\n";
        echo "📈 Promedio: " . number_format($promedio, 2) . "\n";
        echo "📈 Calificación más alta: " . max($calificaciones) . "\n";
        echo "📉 Calificación más baja: " . min($calificaciones) . "\n";

        // Evaluación cualitativa
        echo "\n🎓 EVALUACIÓN CUALITATIVA:\n";
        echo "=======================\n";
        if ($promedio >= 90) {
            echo "🏆 Excelente (A)\n";
        } elseif ($promedio >= 80) {
            echo "👍 Muy Bueno (B)\n";
        } elseif ($promedio >= 70) {
            echo "✅ Bueno (C)\n";
        } elseif ($promedio >= 60) {
            echo "⚠️  Regular (D)\n";
        } else {
            echo "❌ Insuficiente (F)\n";
        }
    } else {
        echo "\n📭 No se ingresaron calificaciones válidas\n";
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    session_start();

    $mensaje = '';
    $calificaciones = isset($_SESSION['calificaciones']) ? $_SESSION['calificaciones'] : array();
    $mostrar_resultados = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['reiniciar'])) {
            session_destroy();
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

        if (isset($_POST['finalizar'])) {
            if (count($calificaciones) > 0) {
                $mensaje = "⚡ Proceso finalizado. Mostrando resultados...";
                $mostrar_resultados = true;
            } else {
                $mensaje = "❌ Error: No hay calificaciones para promediar";
            }
        }

        if (isset($_POST['calificacion'])) {
            $input = trim($_POST['calificacion']);
            $calificacion = is_numeric($input) ? floatval($input) : null;

            if ($calificacion === null) {
                $mensaje = "❌ Error: Debe ingresar un número válido";
            } elseif ($calificacion < 0 || $calificacion > 100) {
                $mensaje = "⚠️  Advertencia: La calificación debe estar entre 0 y 100";
            } else {
                $calificaciones[] = $calificacion;
                $_SESSION['calificaciones'] = $calificaciones;
                $promedio_actual = array_sum($calificaciones) / count($calificaciones);
                $mensaje = "✅ Calificación $calificacion agregada. Total: " . count($calificaciones) . " calificaciones. Promedio actual: " . number_format($promedio_actual, 2);
            }
        }
    } else {
        // Inicializar sesión
        if (!isset($_SESSION['calificaciones'])) {
            $_SESSION['calificaciones'] = array();
        }
    }

    echo generarHTML($mensaje, $calificaciones, $mostrar_resultados);
}

function generarHTML($mensaje, $calificaciones, $mostrar_resultados) {
    $total_calificaciones = count($calificaciones);

    // Construir el mensaje HTML
    $html_mensaje = '';
    if ($mensaje) {
        $clase_mensaje = 'info';
        if (strpos($mensaje, 'Error') !== false) {
            $clase_mensaje = 'error';
        } elseif (strpos($mensaje, 'Advertencia') !== false) {
            $clase_mensaje = 'advertencia';
        } elseif (strpos($mensaje, 'agregada') !== false) {
            $clase_mensaje = 'exito';
        }
        $html_mensaje = "<div class='mensaje $clase_mensaje'>$mensaje</div>";
    }

    // Construir resultados finales
    $html_resultados = '';
    if ($mostrar_resultados && $total_calificaciones > 0) {
        $suma = array_sum($calificaciones);
        $promedio = $suma / $total_calificaciones;
        $maxima = max($calificaciones);
        $minima = min($calificaciones);

        // Evaluación cualitativa
        $evaluacion = '';
        $clase_evaluacion = '';
        if ($promedio >= 90) {
            $evaluacion = '🏆 Excelente (A)';
            $clase_evaluacion = 'excelente';
        } elseif ($promedio >= 80) {
            $evaluacion = '👍 Muy Bueno (B)';
            $clase_evaluacion = 'muy-bueno';
        } elseif ($promedio >= 70) {
            $evaluacion = '✅ Bueno (C)';
            $clase_evaluacion = 'bueno';
        } elseif ($promedio >= 60) {
            $evaluacion = '⚠️  Regular (D)';
            $clase_evaluacion = 'regular';
        } else {
            $evaluacion = '❌ Insuficiente (F)';
            $clase_evaluacion = 'insuficiente';
        }

        $html_resultados = "
        <div class='resultados-finales'>
            <h3>📊 Resultados Finales</h3>
            <div class='estadisticas'>
                <div class='estadistica'><span>🔢 Total calificaciones:</span> <strong>$total_calificaciones</strong></div>
                <div class='estadistica'><span>📋 Calificaciones:</span> <strong>" . implode(', ', $calificaciones) . "</strong></div>
                <div class='estadistica'><span>🧮 Suma total:</span> <strong>$suma</strong></div>
                <div class='estadistica'><span>📈 Promedio:</span> <strong>" . number_format($promedio, 2) . "</strong></div>
                <div class='estadistica'><span>📈 Calificación más alta:</span> <strong>$maxima</strong></div>
                <div class='estadistica'><span>📉 Calificación más baja:</span> <strong>$minima</strong></div>
            </div>
            <div class='evaluacion $clase_evaluacion'>
                <h4>🎓 Evaluación Cualitativa:</h4>
                <div class='resultado-evaluacion'>$evaluacion</div>
            </div>
        </div>";
    }

    $boton_reiniciar = $total_calificaciones > 0 ? "
        <form method='POST' style='margin-top: 15px;'>
            <button type='submit' name='reiniciar' class='btn-reiniciar'>🔄 Reiniciar Ejercicio</button>
        </form>" : '';

    $boton_finalizar = $total_calificaciones > 0 ? "
        <form method='POST' style='margin-top: 10px;'>
            <button type='submit' name='finalizar' class='btn-finalizar'>📊 Calcular Promedio Final</button>
        </form>" : '';

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Ciclo Repita</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            max-width: 600px;
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

        .instrucciones {
            background: #fffaf0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #ed8936;
        }

        .progreso {
            background: #bee3f8;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #4a5568;
        }

        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #cbd5e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
            width: 100%;
            font-weight: bold;
        }

        button:hover {
            transform: translateY(-2px);
        }

        .btn-finalizar {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }

        .btn-reiniciar {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        }

        .mensaje {
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
        }

        .exito {
            background: #c6f6d5;
            color: #22543d;
            border: 2px solid #48bb78;
        }

        .error {
            background: #fed7d7;
            color: #742a2a;
            border: 2px solid #f56565;
        }

        .info {
            background: #bee3f8;
            color: #2a4365;
            border: 2px solid #4299e1;
        }

        .advertencia {
            background: #fffaf0;
            color: #744210;
            border: 2px solid #ed8936;
        }

        .resultados-finales {
            background: #f7fafc;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 2px solid #4a5568;
        }

        .estadisticas {
            display: grid;
            gap: 10px;
            margin-bottom: 20px;
        }

        .estadistica {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            background: white;
            border-radius: 5px;
        }

        .evaluacion {
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .excelente {
            background: #c6f6d5;
            border: 2px solid #48bb78;
        }

        .muy-bueno {
            background: #bee3f8;
            border: 2px solid #4299e1;
        }

        .bueno {
            background: #fffaf0;
            border: 2px solid #ed8936;
        }

        .regular {
            background: #fed7d7;
            border: 2px solid #f56565;
        }

        .insuficiente {
            background: #fed7d7;
            border: 2px solid #e53e3e;
        }

        .resultado-evaluacion {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }

        .info-ciclo {
            background: #fed7d7;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Ejercicio 5: Promedio de Calificaciones</h1>
        <div class="subtitle">Ciclo "Repita" (do-while) - Cálculo de promedio</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="instrucciones">
            <strong>💡 Instrucciones:</strong>
            <ul>
                <li>Ingrese calificaciones entre 0 y 100</li>
                <li>El sistema calculará el promedio automáticamente</li>
                <li>Use el botón 'Calcular Promedio Final' para terminar</li>
                <li>Puede reiniciar en cualquier momento</li>
            </ul>
        </div>

        <div class="progreso">
            <strong>📈 Progreso Actual:</strong><br>
            📋 Calificaciones ingresadas: <strong>{$total_calificaciones}</strong><br>
            🧮 Promedio actual: <strong>" . ($total_calificaciones > 0 ? number_format(array_sum($calificaciones) / $total_calificaciones, 2) : '0.00') . "</strong>
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="calificacion">Ingrese una calificación (0-100):</label>
                <input type="number" id="calificacion" name="calificacion" min="0" max="100" step="0.1" required>
            </div>

            <button type="submit">📥 Agregar Calificación</button>
        </form>

        $boton_finalizar
        $html_mensaje
        $html_resultados
        $boton_reiniciar

        <div class="info-ciclo">
            <strong>🔄 Por qué usar Ciclo Repita aquí:</strong>
            <ul>
                <li>✅ <strong>Garantiza</strong> que se pida al menos una calificación</li>
                <li>✅ <strong>Ideal</strong> para entradas de usuario donde se necesita al menos un dato</li>
                <li>✅ <strong>Perfecto</strong> para menús y sistemas interactivos</li>
                <li>✅ <strong>Estructura</strong> más natural para procesos que deben ejecutarse una vez mínimo</li>
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