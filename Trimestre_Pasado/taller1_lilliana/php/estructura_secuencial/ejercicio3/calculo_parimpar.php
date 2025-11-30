<?php
// Función para determinar si es consola o web
function esConsola() {
    return PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']);
}

// Función común para determinar par/impar
function esPar($numero) {
    return $numero % 2 == 0;
}

// Función para limpiar entrada
function limpiarEntrada($dato) {
    return filter_var($dato, FILTER_VALIDATE_INT);
}

// ===============================
// VERSIÓN CONSOLA
// ===============================
function ejecutarEnConsola() {
    echo "=================================\n";
    echo "   DETECTOR DE NÚMEROS PAR/IMPAR\n";
    echo "        (Modo Consola)\n";
    echo "=================================\n\n";

    // Leer número del usuario
    echo "Ingrese un número entero: ";
    $input = trim(fgets(STDIN));
    $numero = limpiarEntrada($input);

    // Validar entrada
    if ($numero === false) {
        echo "❌ Error: Debe ingresar un número entero válido.\n";
        return;
    }

    // Determinar y mostrar resultado
    if (esPar($numero)) {
        echo "✅ El número $numero es PAR\n";
    } else {
        echo "🔶 El número $numero es IMPAR\n";
    }

    echo "\nPresione Enter para continuar...";
    fgets(STDIN);
}

// ===============================
// VERSIÓN WEB
// ===============================
function ejecutarEnWeb() {
    $numero = null;
    $resultado = '';
    $clase_css = '';

    // Procesar formulario si se envió
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {
        $numero = limpiarEntrada($_POST['numero']);

        if ($numero === false) {
            $resultado = "❌ Error: Debe ingresar un número entero válido.";
            $clase_css = 'error';
        } else {
            if (esPar($numero)) {
                $resultado = "✅ El número $numero es PAR";
                $clase_css = 'par';
            } else {
                $resultado = "🔶 El número $numero es IMPAR";
                $clase_css = 'impar';
            }
        }
    }

    // Generar HTML
    echo generarHTML($resultado, $clase_css, $numero);
}

function generarHTML($resultado, $clase_css, $numero_valor) {
    $valor_actual = ($numero_valor !== null) ? $numero_valor : '';

    $html_resultado = '';
    if (!empty($resultado)) {
        $html_resultado = "<div class='resultado $clase_css'>$resultado</div>";
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detector Par/Impar - Web</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            margin-bottom: 30px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
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
        }

        button:hover {
            transform: translateY(-2px);
        }

        .resultado {
            margin-top: 25px;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .par {
            background: #c6f6d5;
            color: #22543d;
            border: 2px solid #48bb78;
        }

        .impar {
            background: #fed7d7;
            color: #742a2a;
            border: 2px solid #f56565;
        }

        .error {
            background: #fed7d7;
            color: #742a2a;
            border: 2px solid #f56565;
        }

        .info {
            background: #bee3f8;
            color: #2a4365;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 Detector de Números Par/Impar</h1>

        <div class="entorno">
            🌐 Ejecutándose en Modo Web
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="numero">Ingrese un número entero:</label>
                <input type="number" id="numero" name="numero" value="$valor_actual"
                       placeholder="Ej: 42, -7, 0..." required step="1">
            </div>

            <button type="submit">🔍 Verificar Par/Impar</button>
        </form>

        $html_resultado
        <!-- //{resultado ? "<div class='resultado $clase_css'>$resultado</div>" : ""} -->

        <div class="info">
            <strong>💡 Información:</strong>
            Un número es par si es divisible entre 2, es decir, si el residuo de dividirlo entre 2 es 0.
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