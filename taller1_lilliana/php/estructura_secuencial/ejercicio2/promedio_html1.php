<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Promedio - Algoritmo Secuencial</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
            backdrop-filter: blur(10px);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 2.2em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .header p {
            color: #666;
            font-size: 1.1em;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
            font-size: 1.1em;
        }

        .form-group input[type="number"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1.1em;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-group input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 15px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        .input-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 25px 0;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1.2em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .result {
            margin-top: 30px;
            padding: 25px;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border-radius: 15px;
            color: white;
            text-align: center;
            box-shadow: 0 10px 25px rgba(17, 153, 142, 0.3);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .result-details {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            margin-top: 15px;
        }

        .result-details p {
            margin: 8px 0;
            font-size: 1.1em;
        }

        .numbers-display {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            word-wrap: break-word;
        }

        .error {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .algorithm-info {
            background: rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 10px 10px 0;
        }

        .algorithm-info h3 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .algorithm-info p {
            color: #555;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .container {
                padding: 25px;
                margin: 10px;
            }

            .input-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .header h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Calculadora de Promedio</h1>
            <p>Algoritmo Secuencial - HTML + CSS + PHP</p>
        </div>

        <div class="algorithm-info">
            <h3>🔄 Algoritmo Secuencial</h3>
            <p>Este programa utiliza un algoritmo completamente secuencial: lee los datos del formulario, procesa cada número paso a paso, calcula la suma y divide entre la cantidad. Sin ciclos ni estructuras de control complejas.</p>
        </div>

        <?php
        // ALGORITMO SECUENCIAL EN PHP
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // PASO 1: Leer datos del formulario (secuencial)
            $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : null;
            $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : null;
            $num3 = isset($_POST['num3']) ? floatval($_POST['num3']) : null;
            $num4 = isset($_POST['num4']) ? floatval($_POST['num4']) : null;
            $num5 = isset($_POST['num5']) ? floatval($_POST['num5']) : null;

            // PASO 2: Validar datos (secuencial)
            $numeros_validos = array();
            $cantidad_numeros = 0;

            // Validación secuencial número por número
            if ($num1 !== null && $num1 !== 0) {
                $numeros_validos[] = $num1;
                $cantidad_numeros = $cantidad_numeros + 1;
            }

            if ($num2 !== null && $num2 !== 0) {
                $numeros_validos[] = $num2;
                $cantidad_numeros = $cantidad_numeros + 1;
            }

            if ($num3 !== null && $num3 !== 0) {
                $numeros_validos[] = $num3;
                $cantidad_numeros = $cantidad_numeros + 1;
            }

            if ($num4 !== null && $num4 !== 0) {
                $numeros_validos[] = $num4;
                $cantidad_numeros = $cantidad_numeros + 1;
            }

            if ($num5 !== null && $num5 !== 0) {
                $numeros_validos[] = $num5;
                $cantidad_numeros = $cantidad_numeros + 1;
            }

            // PASO 3: Verificar si hay números válidos
            if ($cantidad_numeros == 0) {
                echo '<div class="error">';
                echo '<h3>❌ Error</h3>';
                echo '<p>Debe ingresar al menos un número válido (diferente de 0)</p>';
                echo '</div>';
            } else {
                // PASO 4: Calcular suma (secuencial)
                $suma = 0;

                // Suma secuencial número por número
                if (isset($numeros_validos[0])) {
                    $suma = $suma + $numeros_validos[0];
                }
                if (isset($numeros_validos[1])) {
                    $suma = $suma + $numeros_validos[1];
                }
                if (isset($numeros_validos[2])) {
                    $suma = $suma + $numeros_validos[2];
                }
                if (isset($numeros_validos[3])) {
                    $suma = $suma + $numeros_validos[3];
                }
                if (isset($numeros_validos[4])) {
                    $suma = $suma + $numeros_validos[4];
                }

                // PASO 5: Calcular promedio (secuencial)
                $promedio = $suma / $cantidad_numeros;

                // PASO 6: Mostrar resultados
                echo '<div class="result">';
                echo '<h2>✨ Resultado del Cálculo</h2>';
                echo '<div class="result-details">';
                echo '<div class="numbers-display">';
                echo '<strong>📝 Números ingresados:</strong><br>';
                echo implode(' + ', $numeros_validos);
                echo '</div>';
                echo '<p><strong>➕ Suma total:</strong> ' . number_format($suma, 2) . '</p>';
                echo '<p><strong>🔢 Cantidad de números:</strong> ' . $cantidad_numeros . '</p>';
                echo '<p><strong>📊 Promedio:</strong> ' . number_format($promedio, 2) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="num1">🔵 Número 1:</label>
                <input type="number" id="num1" name="num1" step="any" placeholder="Ingrese el primer número"
                       value="<?php echo isset($_POST['num1']) ? $_POST['num1'] : ''; ?>">
            </div>

            <div class="input-grid">
                <div class="form-group">
                    <label for="num2">🟢 Número 2:</label>
                    <input type="number" id="num2" name="num2" step="any" placeholder="Segundo número (opcional)"
                           value="<?php echo isset($_POST['num2']) ? $_POST['num2'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="num3">🟡 Número 3:</label>
                    <input type="number" id="num3" name="num3" step="any" placeholder="Tercer número (opcional)"
                           value="<?php echo isset($_POST['num3']) ? $_POST['num3'] : ''; ?>">
                </div>
            </div>

            <div class="input-grid">
                <div class="form-group">
                    <label for="num4">🟠 Número 4:</label>
                    <input type="number" id="num4" name="num4" step="any" placeholder="Cuarto número (opcional)"
                           value="<?php echo isset($_POST['num4']) ? $_POST['num4'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="num5">🔴 Número 5:</label>
                    <input type="number" id="num5" name="num5" step="any" placeholder="Quinto número (opcional)"
                           value="<?php echo isset($_POST['num5']) ? $_POST['num5'] : ''; ?>">
                </div>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <button type="submit" class="btn">🧮 Calcular Promedio</button>
            </div>
        </form>

        <div class="algorithm-info" style="margin-top: 30px;">
            <h3>💡 Características del Algoritmo</h3>
            <p><strong>✅ Completamente Secuencial:</strong> Lee cada campo uno por uno, valida secuencialmente, suma paso a paso y calcula el promedio.</p>
            <p><strong>🌐 Multi-tecnología:</strong> HTML para la interfaz, CSS para el diseño y PHP para el procesamiento secuencial.</p>
            <p><strong>📱 Responsive:</strong> Se adapta a diferentes tamaños de pantalla.</p>
        </div>
    </div>
</body>
</html>