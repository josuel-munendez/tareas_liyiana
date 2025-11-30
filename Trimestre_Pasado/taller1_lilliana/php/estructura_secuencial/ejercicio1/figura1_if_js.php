<!-- // Taller de Algoritmos Secuenciales, Funciones Matemáticas y Estructuras de Control:
// Objetivo: Fortalecer las habilidades en la elaboración de algoritmos secuenciales utilizando funciones matemáticas y estructuras de control como el ciclo para, mientras y repita.

// Instrucciones:

// Lea cuidadosamente cada problema y analice los datos de entrada y salida.
// Diseñe el algoritmo utilizando las estructuras de control y funciones matemáticas indicadas.
// Implemente el algoritmo en el lenguaje de programación de su preferencia.
// Pruebe y depure el algoritmo para garantizar su correcto funcionamiento.
// Problemas:

// Algoritmos Secuenciales:

// Calcular el área de un triángulo, rectángulo o círculo, según la figura seleccionada por el usuario. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">
        <label for="figura">Seleccione una figura:</label>
        <select name="figura" id="figura">
            <option value="triangulo">Triángulo</option>
            <option value="rectangulo">Rectángulo</option>
            <option value="circulo">Círculo</option>
        </select><br><br>

        <div id="triangulo" style="display:none;">
            <label for="base">Base del triángulo:</label>
            <input type="number" name="base" id="base" step="0.01"><br><br>
            <label for="altura">Altura del triángulo:</label>
            <input type="number" name="altura" id="altura" step="0.01"><br><br>
        </div>

        <div id="rectangulo" style="display:none;">
            <label for="largo">Largo del rectángulo:</label>
            <input type="number" name="largo" id="largo" step="0.01"><br><br>
            <label for="ancho">Ancho del rectángulo:</label>
            <input type="number" name="ancho" id="ancho" step="0.01"><br><br>
        </div>

        <div id="circulo" style="display:none;">
            <label for="radio">Radio del círculo:</label>
            <input type="number" name="radio" id="radio" step="0.01"><br><br>
        </div>

        <input type="submit" name="calcular" value="Calcular Área">
    </form>
    <script>
        document.getElementById('figura').addEventListener('change', function () {
            var figura = this.value;
            document.getElementById('triangulo').style.display = 'none';
            document.getElementById('rectangulo').style.display = 'none';
            document.getElementById('circulo').style.display = 'none';

            if (figura === 'triangulo') {
                document.getElementById('triangulo').style.display = 'block';
            } else if (figura === 'rectangulo') {
                document.getElementById('rectangulo').style.display = 'block';
            } else if (figura === 'circulo') {
                document.getElementById('circulo').style.display = 'block';
            }
        });
    </script>
    <br>
    <h2>Resultado:</h2>
    <?php
    if (isset($_POST['calcular'])) {
        $figura = $_POST['figura'];

        if ($figura === 'triangulo') {
            $base = $_POST['base'];
            $altura = $_POST['altura'];
            $area = ($base * $altura) / 2;
            echo "El área del triángulo es: $area";
        } elseif ($figura === 'rectangulo') {
            $largo = $_POST['largo'];
            $ancho = $_POST['ancho'];
            $area = $largo * $ancho;
            echo "El área del rectángulo es: $area";
        } elseif ($figura === 'circulo') {
            $radio = $_POST['radio'];
            $area = pi() * pow($radio, 2);
            echo "El área del círculo es: $area";
        }
    }
    ?>
</body>

</html>