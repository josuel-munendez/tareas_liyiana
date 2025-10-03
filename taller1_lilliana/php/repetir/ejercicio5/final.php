<?php
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "   EJERCICIOS CICLO 'REPITA'\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Seleccione un ejercicio:\n";
    echo "1. Números del 1 al 10\n";
    echo "2. Suma de pares del 1 al 20\n";
    echo "3. Tabla de multiplicar del 5\n";
    echo "4. Números impares del 1 al 50\n";
    echo "5. Promedio de calificaciones\n";
    echo "6. Salir\n\n";

    echo "Ingrese su opción (1-6): ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case '1':
            include 'ejercicio1_repita_1_al_10.php';
            break;
        case '2':
            include 'ejercicio2_repita_suma_pares_1_20.php';
            break;
        case '3':
            include 'ejercicio3_repita_tabla_5.php';
            break;
        case '4':
            include 'ejercicio4_repita_impares_1_50.php';
            break;
        case '5':
            include 'ejercicio5_repita_promedio_calificaciones.php';
            break;
        case '6':
            echo "¡Hasta luego!\n";
            exit;
        default:
            echo "❌ Opción no válida\n";
    }

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
    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciclo Repita - Ejercicios Completos</title>
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

        .ejercicios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .ejercicio-card {
            background: #f7fafc;
            padding: 25px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
            text-align: center;
        }

        .ejercicio-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .ejercicio-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .ejercicio-titulo {
            font-size: 18px;
            font-weight: bold;
            color: #4a5568;
            margin-bottom: 10px;
        }

        .ejercicio-descripcion {
            color: #718096;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .btn-ejercicio {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: transform 0.2s;
        }

        .btn-ejercicio:hover {
            transform: translateY(-2px);
        }

        .info {
            background: #bee3f8;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .caracteristicas {
            background: #fffaf0;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ed8936;
        }

        .comparacion {
            background: #c6f6d5;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 Ciclo "Repita" - Ejercicios Completos</h1>
        <div class="subtitle">5 ejercicios implementados con ciclo do-while</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="info">
            <strong>📚 Sobre el Ciclo "Repita" (do-while):</strong><br>
            El ciclo do-while ejecuta un bloque de código primero y luego verifica la condición.
            Esto garantiza que el bloque se ejecute al menos una vez, incluso si la condición es falsa inicialmente.
        </div>

        <div class="ejercicios-grid">
            <div class="ejercicio-card">
                <div class="ejercicio-icon">🔢</div>
                <div class="ejercicio-titulo">1. Números del 1 al 10</div>
                <div class="ejercicio-descripcion">
                    Genera y muestra la secuencia del 1 al 10 usando ciclo repita.
                    Incluye estadísticas y visualización interactiva.
                </div>
                <a href="ejercicio1_repita_1_al_10.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>

            <div class="ejercicio-card">
                <div class="ejercicio-icon">➕</div>
                <div class="ejercicio-titulo">2. Suma de Pares 1-20</div>
                <div class="ejercicio-descripcion">
                    Calcula la suma de todos los números pares entre 1 y 20.
                    Muestra el proceso y resultados detallados.
                </div>
                <a href="ejercicio2_repita_suma_pares_1_20.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>

            <div class="ejercicio-card">
                <div class="ejercicio-icon">🧮</div>
                <div class="ejercicio-titulo">3. Tabla del 5</div>
                <div class="ejercicio-descripcion">
                    Genera la tabla de multiplicar del 5 usando ciclo repita.
                    Diseño visual atractivo con patrones matemáticos.
                </div>
                <a href="ejercicio3_repita_tabla_5.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>

            <div class="ejercicio-card">
                <div class="ejercicio-icon">🔴</div>
                <div class="ejercicio-titulo">4. Números Impares 1-50</div>
                <div class="ejercicio-descripcion">
                    Identifica y muestra todos los números impares entre 1 y 50.
                    Estadísticas completas y diseño responsive.
                </div>
                <a href="ejercicio4_repita_impares_1_50.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>

            <div class="ejercicio-card">
                <div class="ejercicio-icon">📊</div>
                <div class="ejercicio-titulo">5. Promedio Calificaciones</div>
                <div class="ejercicio-descripcion">
                    Sistema interactivo para calcular promedios de calificaciones.
                    Evaluación cualitativa y manejo de sesiones.
                </div>
                <a href="ejercicio5_repita_promedio_calificaciones.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>
        </div>

        <div class="caracteristicas">
            <h3>🚀 Características Implementadas</h3>
            <ul>
                <li><strong>Detección automática</strong> de entorno (consola/web)</li>
                <li><strong>Interfaces adaptadas</strong> para cada medio</li>
                <li><strong>Validación robusta</strong> de entradas</li>
                <li><strong>Manejo de sesiones</strong> en versión web</li>
                <li><strong>Estadísticas detalladas</strong> en cada ejercicio</li>
                <li><strong>Diseño responsive</strong> y moderno</li>
                <li><strong>Experiencia interactiva</strong> y educativa</li>
            </ul>
        </div>

        <div class="comparacion">
            <h3>🔄 vs ⏩ Comparación: Repita vs Mientras</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th style="padding: 10px; border: 1px solid #48bb78; background: #c6f6d5;">Ciclo Repita (do-while)</th>
                    <th style="padding: 10px; border: 1px solid #4299e1; background: #bee3f8;">Ciclo Mientras (while)</th>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #48bb78;">Se ejecuta al menos una vez</td>
                    <td style="padding: 10px; border: 1px solid #4299e1;">Puede no ejecutarse nunca</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #48bb78;">Condición al final</td>
                    <td style="padding: 10px; border: 1px solid #4299e1;">Condición al inicio</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #48bb78;">Ideal para menús y validaciones</td>
                    <td style="padding: 10px; border: 1px solid #4299e1;">Ideal para procesos condicionales</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #48bb78;">Útil cuando se necesita una ejecución mínima</td>
                    <td style="padding: 10px; border: 1px solid #4299e1;">Útil cuando la condición puede ser falsa inicialmente</td>
                </tr>
            </table>
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