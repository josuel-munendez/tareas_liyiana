<?php
// OPCIÓN 1: Promedio de 5 números (cantidad fija)
echo "=== PROMEDIO DE 5 NÚMEROS ===\n";

echo "Ingrese el primer número: ";
$num1 = (float)trim(fgets(STDIN));

echo "Ingrese el segundo número: ";
$num2 = (float)trim(fgets(STDIN));

echo "Ingrese el tercer número: ";
$num3 = (float)trim(fgets(STDIN));

echo "Ingrese el cuarto número: ";
$num4 = (float)trim(fgets(STDIN));

echo "Ingrese el quinto número: ";
$num5 = (float)trim(fgets(STDIN));

// Calcular suma y promedio
$suma = $num1 + $num2 + $num3 + $num4 + $num5;
$promedio = $suma / 5;

echo "\nLos números ingresados son: $num1, $num2, $num3, $num4, $num5\n";
echo "Suma total: $suma\n";
echo "Promedio: $promedio\n\n";

// OPCIÓN 2: El usuario indica cuántos números va a ingresar
echo "=== PROMEDIO CON CANTIDAD VARIABLE ===\n";

echo "¿Cuántos números desea promediar? ";
$cantidad = (int)trim(fgets(STDIN));

// Verificar que la cantidad sea válida
if ($cantidad <= 0) {
    echo "Error: Debe ingresar una cantidad mayor a 0\n";
    exit;
}

$suma_total = 0;

// Leer los números secuencialmente según la cantidad especificada
for ($i = 1; $i <= $cantidad; $i++) {
    echo "Ingrese el número $i: ";
    $numero = (float)trim(fgets(STDIN));
    $suma_total += $numero;
}

$promedio_final = $suma_total / $cantidad;

echo "\nSuma total: $suma_total\n";
echo "Cantidad de números: $cantidad\n";
echo "Promedio: $promedio_final\n\n";

// OPCIÓN 3: Usando arrays (más elegante)
echo "=== USANDO ARRAYS ===\n";

echo "¿Cuántos números desea ingresar? ";
$n = (int)trim(fgets(STDIN));

if ($n <= 0) {
    echo "Error: Debe ingresar una cantidad mayor a 0\n";
    exit;
}

$numeros = array();

// Leer números y almacenarlos en array
for ($i = 0; $i < $n; $i++) {
    echo "Ingrese el número " . ($i + 1) . ": ";
    $numeros[$i] = (float)trim(fgets(STDIN));
}

// Calcular suma usando función array_sum()
$suma_array = array_sum($numeros);
$promedio_array = $suma_array / count($numeros);

echo "\nNúmeros ingresados: " . implode(", ", $numeros) . "\n";
echo "Suma: $suma_array\n";
echo "Promedio: $promedio_array\n\n";

// OPCIÓN 4: Función para calcular promedio
function calcularPromedio($numeros) {
    $suma = array_sum($numeros);
    $cantidad = count($numeros);

    if ($cantidad == 0) {
        return 0;
    }

    return $suma / $cantidad;
}

echo "=== USANDO FUNCIÓN PERSONALIZADA ===\n";

// Ejemplo con números predefinidos
$conjunto_numeros = array(10, 20, 30, 40, 50);
$resultado = calcularPromedio($conjunto_numeros);

echo "Números: " . implode(", ", $conjunto_numeros) . "\n";
echo "Promedio usando función: $resultado\n";

// OPCIÓN 5: Versión más compacta sin ciclos explícitos
echo "\n=== VERSIÓN SIN CICLOS EXPLÍCITOS ===\n";

echo "Ingrese números separados por espacios: ";
$entrada = trim(fgets(STDIN));

// Convertir la entrada en array de números
$numeros_ingresados = array_map('floatval', explode(' ', $entrada));

// Filtrar valores vacíos
$numeros_validos = array_filter($numeros_ingresados, function($num) {
    return !is_nan($num);
});

if (empty($numeros_validos)) {
    echo "No se ingresaron números válidos\n";
} else {
    $suma_compacta = array_sum($numeros_validos);
    $promedio_compacto = $suma_compacta / count($numeros_validos);

    echo "Números: " . implode(", ", $numeros_validos) . "\n";
    echo "Suma: $suma_compacta\n";
    echo "Promedio: $promedio_compacto\n";
}
?>