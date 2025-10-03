<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Áreas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9f7ef;
            border-left: 5px solid #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Calculadora de Áreas</h2>

    <form method="post">
        <label for="figura">Seleccione una figura:</label>
        <select name="figura" required>
            <option value="">-- Elija una figura --</option>
            <option value="triangulo" <?php if (isset($_POST['figura']) && $_POST['figura'] == 'triangulo') echo 'selected'; ?>>Triángulo</option>
            <option value="rectangulo" <?php if (isset($_POST['figura']) && $_POST['figura'] == 'rectangulo') echo 'selected'; ?>>Rectángulo</option>
            <option value="circulo" <?php if (isset($_POST['figura']) && $_POST['figura'] == 'circulo') echo 'selected'; ?>>Círculo</option>
        </select>

        <h3>Datos (complete solo los necesarios según la figura):</h3>

        <label for="base">Base (Triángulo) o Largo (Rectángulo):</label>
        <input type="number" name="base_largo" step="0.01" value="<?php echo isset($_POST['base_largo']) ? htmlspecialchars($_POST['base_largo']) : ''; ?>">

        <label for="altura">Altura (Triángulo) o Ancho (Rectángulo):</label>
        <input type="number" name="altura_ancho" step="0.01" value="<?php echo isset($_POST['altura_ancho']) ? htmlspecialchars($_POST['altura_ancho']) : ''; ?>">

        <label for="radio">Radio (Círculo):</label>
        <input type="number" name="radio" step="0.01" value="<?php echo isset($_POST['radio']) ? htmlspecialchars($_POST['radio']) : ''; ?>">

        <input type="submit" name="calcular" value="Calcular Área">
    </form><br>

    <?php if (isset($_POST['figura'])): ?>
    <p><strong>Figura seleccionada:</strong> 
    <?php
        $nombres = [
            'triangulo' => 'Triángulo → use "Base" y "Altura"',
            'rectangulo' => 'Rectángulo → use "Base/Largo" y "Altura/Ancho"',
            'circulo' => 'Círculo → use solo "Radio"'
        ];
        echo $nombres[$_POST['figura']] ?? 'Seleccione una figura';
    ?>
    </p>
    <?php endif; ?>

    <?php
    if (isset($_POST['calcular'])) {
        $figura = $_POST['figura'] ?? '';
        $error = false;
        $mensaje = '';

        switch ($figura) {
            case 'triangulo':
                $base = $_POST['base_largo'] ?? 0;
                $altura = $_POST['altura_ancho'] ?? 0;
                if ($base > 0 && $altura > 0) {
                    $area = ($base * $altura) / 2;
                    $mensaje = "El área del triángulo es: " . number_format($area, 2) . " unidades²";
                } else {
                    $error = true;
                    $mensaje = "Por favor, ingrese valores válidos para base y altura.";
                }
                break;

            case 'rectangulo':
                $largo = $_POST['base_largo'] ?? 0;
                $ancho = $_POST['altura_ancho'] ?? 0;
                if ($largo > 0 && $ancho > 0) {
                    $area = $largo * $ancho;
                    $mensaje = "El área del rectángulo es: " . number_format($area, 2) . " unidades²";
                } else {
                    $error = true;
                    $mensaje = "Por favor, ingrese valores válidos para largo y ancho.";
                }
                break;

            case 'circulo':
                $radio = $_POST['radio'] ?? 0;
                if ($radio > 0) {
                    $area = pi() * pow($radio, 2);
                    $mensaje = "El área del círculo es: " . number_format($area, 2) . " unidades²";
                } else {
                    $error = true;
                    $mensaje = "Por favor, ingrese un valor válido para el radio.";
                }
                break;

            default:
                $error = true;
                $mensaje = "Por favor, seleccione una figura válida.";
                break;
        }

        // Mostrar resultado o error
        $clase = $error ? 'error' : 'result';
        echo "<div class='$clase'>$mensaje</div>";
    }
    ?>

</div>

</body>
</html>