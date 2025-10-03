<?php
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "   EJERCICIOS CICLO 'MIENTRAS'\n";
    echo "          (Modo Consola)\n";
    echo "=================================\n\n";

    echo "Seleccione un ejercicio:\n";
    echo "1. Leer números hasta valor negativo\n";
    echo "2. Sumar números positivos hasta 0\n";
    echo "3. Factorial con ciclo mientras\n";
    echo "4. Números pares 1-100 con mientras\n";
    echo "5. Juego de adivinanzas\n";
    echo "6. Salir\n\n";

    echo "Ingrese su opción (1-6): ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case '1':
            include 'ejercicio1_lectura_numeros.php';
            break;
        case '2':
            include 'ejercicio2_suma_positivos.php';
            break;
        case '3':
            include 'ejercicio3_factorial_mientras.php';
            break;
        case '4':
            include 'ejercicio4_pares_1_100_mientras.php';
            break;
        case '5':
            include 'ejercicio5_adivinanza.php';
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
    <title>Ciclo Mientras - Ejercicios Completos</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 Ciclo "Mientras" - Ejercicios Completos</h1>
        <div class="subtitle">5 ejercicios implementados con ciclo while</div>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <div class="info">
            <strong>📚 Sobre el Ciclo "Mientras" (while):</strong><br>
            El ciclo while ejecuta un bloque de código mientras una condición sea verdadera.
            Es ideal cuando no sabemos exactamente cuántas iteraciones necesitaremos.
        </div>

        <div class="ejercicios-grid">
            <div class="ejercicio-card">
                <div class="ejercicio-icon">🔢</div>
                <div class="ejercicio-titulo">1. Lectura de Números</div>
                <div class="ejercicio-descripcion">
                    Lee números continuamente hasta que se ingrese un valor negativo.
                    Muestra estadísticas de los números ingresados.
                </div>
                <a href="ejercicio1_lectura_numeros.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>

            <div class="ejercicio-card">
                <div class="ejercicio-icon">➕</div>
                <div class="ejercicio-titulo">2. Suma de Positivos</div>
                <div class="ejercicio-descripcion">
                    Suma números positivos ingresados por el usuario hasta que se ingrese 0.
                    Los números negativos son ignorados.
                </div>
                <a href="ejercicio2_suma_positivos.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>

            <div class="ejercicio-card">
                <div class="ejercicio-icon">🧮</div>
                <div class="ejercicio-titulo">3. Cálculo de Factorial</div>
                <div class="ejercicio-descripcion">
                    Calcula el factorial de un número usando ciclo while.
                    Muestra el proceso paso a paso del cálculo.
                </div>
                <a href="ejercicio3_factorial_mientras.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>

            <div class="ejercicio-card">
                <div class="ejercicio-icon">🔵</div>
                <div class="ejercicio-titulo">4. Números Pares 1-100</div>
                <div class="ejercicio-descripcion">
                    Genera y muestra todos los números pares entre 1 y 100 usando while.
                    Incluye estadísticas y suma total.
                </div>
                <a href="ejercicio4_pares_1_100_mientras.php" class="btn-ejercicio">Abrir Ejercicio</a>
            </div>

            <div class="ejercicio-card">
                <div class="ejercicio-icon">🎯</div>
                <div class="ejercicio-titulo">5. Juego de Adivinanzas</div>
                <div class="ejercicio-descripcion">
                    Adivina un número secreto entre 1-100 con pistas interactivas.
                    Sistema de puntuación y límite de intentos.
                </div>
                <a href="ejercicio5_adivinanza.php" class="btn-ejercicio">Abrir Ejercicio</a>
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