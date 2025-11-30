<?php

echo "Calculadora de áreas\n";
echo "===================\n";
echo "1. Triángulo\n";
echo "2. Rectángulo\n";
echo "3. Círculo\n";

// Leer la opción del usuario
$opcion = (int) readline("Selecciona una figura (1-3): ");

// Inicializar la variable del área
$area = 0;

// Calcular el área según la opción usando un switch
switch ($opcion) {
    case 1:
        $base = (float) readline("Ingresa la base del triángulo: ");
        $altura = (float) readline("Ingresa la altura del triángulo: ");
        $area = ($base * $altura) / 2;
        break;

    case 2:
        $base = (float) readline("Ingresa la base del rectángulo: ");
        $altura = (float) readline("Ingresa la altura del rectángulo: ");
        $area = $base * $altura;
        break;

    case 3:
        $radio = (float) readline("Ingresa el radio del círculo: ");
        $area = pi() * pow($radio, 2); // Se utiliza la función pi() de PHP
        break;

    default:
        echo "Opción no válida.\n";
        exit(1); // Termina el programa con un código de error
}

// Mostrar el resultado con dos decimales
echo "El área de la figura seleccionada es: " . number_format($area, 2) . "\n";

?>