<!-- <?php 
// phpinfo();
// error_reporting(E_ALL);
// ini_set('display_errors', 1); ?> -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Áreas - Con Switch Case y JS</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #6e8efb, #a777e3);
        margin: 0;
        padding: 20px;
        color: #333;
    }

    .container {
        max-width: 550px;
        margin: 40px auto;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    h1 {
        text-align: center;
        color: #555;
        margin-bottom: 30px;
    }

    label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
        color: #444;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
    }

    input[type="submit"] {
        background: #007BFF;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 18px;
        margin-top: 25px;
        transition: background 0.3s;
    }

    input[type="submit"]:hover {
        background: #0056b3;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .hidden {
        display: none;
    }

    .result {
        margin-top: 30px;
        padding: 20px;
        border-radius: 8px;
        font-weight: bold;
        text-align: center;
        font-size: 18px;
    }

    .success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>🧮 Calculadora de Áreas</h1>

        <form action="" method="post" id="areaForm" novalidate>
            <div class="form-group">
                <label for="figura">🔷 Seleccione una figura:</label>
                <select name="figura" id="figura" required>
                    <option value="">-- Elija una figura --</option>
                    <option value="triangulo"
                        <?php if (isset($_POST['figura']) && $_POST['figura'] == 'triangulo') echo 'selected'; ?>>
                        Triángulo</option>
                    <option value="rectangulo"
                        <?php if (isset($_POST['figura']) && $_POST['figura'] == 'rectangulo') echo 'selected'; ?>>
                        Rectángulo</option>
                    <option value="circulo"
                        <?php if (isset($_POST['figura']) && $_POST['figura'] == 'circulo') echo 'selected'; ?>>
                        Círculo</option>
                </select>
            </div>

            <!-- Triángulo -->
            <div id="triangulo"
                class="form-group <?php echo (isset($_POST['figura']) && $_POST['figura'] == 'triangulo') ? '' : 'hidden'; ?>">
                <label>📐 Base del triángulo:</label>
                <input type="number" name="base" step="0.01"
                    value="<?php echo isset($_POST['base']) ? htmlspecialchars($_POST['base']) : ''; ?>" required>

                <label>📏 Altura del triángulo:</label>
                <input type="number" name="altura" step="0.01"
                    value="<?php echo isset($_POST['altura']) ? htmlspecialchars($_POST['altura']) : ''; ?>" required>
            </div>

            <!-- Rectángulo -->
            <div id="rectangulo"
                class="form-group <?php echo (isset($_POST['figura']) && $_POST['figura'] == 'rectangulo') ? '' : 'hidden'; ?>">
                <label>📏 Largo del rectángulo:</label>
                <input type="number" name="largo" step="0.01"
                    value="<?php echo isset($_POST['largo']) ? htmlspecialchars($_POST['largo']) : ''; ?>" required>

                <label>📐 Ancho del rectángulo:</label>
                <input type="number" name="ancho" step="0.01"
                    value="<?php echo isset($_POST['ancho']) ? htmlspecialchars($_POST['ancho']) : ''; ?>" required>
            </div>

            <!-- Círculo -->
            <div id="circulo"
                class="form-group <?php echo (isset($_POST['figura']) && $_POST['figura'] == 'circulo') ? '' : 'hidden'; ?>">
                <label>⭕ Radio del círculo:</label>
                <input type="number" name="radio" step="0.01"
                    value="<?php echo isset($_POST['radio']) ? htmlspecialchars($_POST['radio']) : ''; ?>" required>
            </div>

          <!--  <?php
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        ?> -->
            <input type="submit" name="calcular" value="🔷 Calcular Área">
        </form>

        <?php
if (isset($_POST['calcular'])) {
    $figura = $_POST['figura'] ?? '';
    $error = false;
    $mensaje = '';

    switch ($figura) {
        case 'triangulo':
            $base = floatval($_POST['base'] ?? 0);
            $altura = floatval($_POST['altura'] ?? 0);
            if ($base > 0 && $altura > 0) {
                $area = ($base * $altura) / 2;
                $mensaje = "✅ El área del triángulo es: <strong>" . number_format($area, 2) . " unidades²</strong>";
            } else {
                $error = true;
                $mensaje = "⚠️ Por favor, ingrese valores válidos para base y altura.";
            }
            break;

        case 'rectangulo':
            $largo = floatval($_POST['largo'] ?? 0);
            $ancho = floatval($_POST['ancho'] ?? 0);
            if ($largo > 0 && $ancho > 0) {
                $area = $largo * $ancho;
                $mensaje = "✅ El área del rectángulo es: <strong>" . number_format($area, 2) . " unidades²</strong>";
            } else {
                $error = true;
                $mensaje = "⚠️ Por favor, ingrese valores válidos para largo y ancho.";
            }
            break;

        case 'circulo':
            $radio = floatval($_POST['radio'] ?? 0);
            if ($radio > 0) {
                $area = M_PI * ($radio ** 2);
                $mensaje = "✅ El área del círculo es: <strong>" . number_format($area, 2) . " unidades²</strong>";
            } else {
                $error = true;
                $mensaje = "⚠️ Por favor, ingrese un valor válido para el radio.";
            }
            break;

        default:
            $error = true;
            $mensaje = "⚠️ Por favor, seleccione una figura válida.";
            break;
    }

    $clase = $error ? 'error' : 'success';
    echo "<div class='result $clase'>$mensaje</div>";
}   
    ?>

    </div>

    <script>
    const sections = ['triangulo', 'rectangulo', 'circulo'];

    function toggleSections() {
        const figura = document.getElementById('figura').value;
        sections.forEach(id => {
            const el = document.getElementById(id);
            const inputs = el.querySelectorAll('input');
            if (id === figura) {
                el.classList.remove('hidden');
                inputs.forEach(i => {
                    i.disabled = false;
                    i.required = true;
                });
            } else {
                el.classList.add('hidden');
                inputs.forEach(i => {
                    i.disabled = true;
                    i.required = false;
                });
            }
        });
    }

    document.getElementById('figura').addEventListener('change', toggleSections);

    window.addEventListener('DOMContentLoaded', function() {
        // Al cargar, deshabilitar inputs de secciones no seleccionadas
        toggleSections();
    });
    </script>

</body>

</html>