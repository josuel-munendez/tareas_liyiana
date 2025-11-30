#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Para
Ejercicio 4: Imprimir los números impares del 1 al 50
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print(" EJERCICIO 4: Números Impares 1-50")
    print("=================================\n")

    numeros_impares = []
    contador = 0

    print("Números impares del 1 al 50:")
    print("-" * 28)

    # Ciclo para encontrar e imprimir números impares
    for i in range(1, 51):
        if i % 2 != 0:  # Verificar si es impar
            numeros_impares.append(i)
            contador += 1
            print(f"{i:2d}", end="  ")

            # Salto de línea cada 10 números
            if contador % 10 == 0:
                print()

    # Salto de línea si no terminó en múltiplo de 10
    if contador % 10 != 0:
        print()

    print()
    print("📊 ESTADÍSTICAS:")
    print("-" * 15)
    print(f"✅ Total de números impares: {contador}")
    print(f"🔢 Lista completa: {numeros_impares}")
    print(f"📐 Números por línea: 10")
    print(f"📏 Total de líneas: {(contador + 9) // 10}")  # Redondeo hacia arriba

    # Cálculos matemáticos
    suma_impares = sum(numeros_impares)
    promedio = suma_impares / contador

    print(f"\n🧮 CÁLCULOS MATEMÁTICOS:")
    print("-" * 24)
    print(f"• Suma de todos los impares: {suma_impares}")
    print(f"• Promedio: {promedio:.1f}")
    print(f"• Menor número impar: {min(numeros_impares)}")
    print(f"• Mayor número impar: {max(numeros_impares)}")
    print(f"• Diferencia entre mayor y menor: {max(numeros_impares) - min(numeros_impares)}")

    # Verificación matemática
    # Suma de primeros n números impares = n²
    # En este caso: suma de impares del 1 al 49 = 25² = 625
    n = contador  # Cantidad de números impares
    suma_teorica = n * n

    print(f"\n🔍 VERIFICACIÓN MATEMÁTICA:")
    print("-" * 27)
    print(f"• Cantidad de impares (n): {n}")
    print(f"• Suma teórica (n²): {n}² = {suma_teorica}")
    print(f"• Suma calculada: {suma_impares}")

    if suma_impares == suma_teorica:
        print("✅ ¡Verificación correcta!")
    else:
        print("❌ Error en la verificación")

    # Análisis de patrones
    print(f"\n📈 ANÁLISIS DE PATRONES:")
    print("-" * 25)
    print(f"• Secuencia: 1, 3, 5, 7, 9, ...")
    print(f"• Diferencia entre consecutivos: 2")
    print(f"• Fórmula general: 2n - 1, donde n = 1, 2, 3, ...")
    print(f"• Todos terminan en 1, 3, 5, 7, 9")

    # Verificar fórmula
    print(f"\n🧮 VERIFICACIÓN DE FÓRMULA (2n-1):")
    print("-" * 36)
    for n in range(1, 6):  # Primeros 5 números
        formula_resultado = 2 * n - 1
        numero_real = numeros_impares[n-1]
        print(f"n={n}: 2×{n}-1 = {formula_resultado}, Real: {numero_real} ✅")

    # Distribución por décadas
    print(f"\n📊 DISTRIBUCIÓN POR DÉCADAS:")
    print("-" * 29)
    for decada in range(5):  # 5 décadas: 1-10, 11-20, 21-30, 31-40, 41-50
        inicio = decada * 10 + 1
        fin = (decada + 1) * 10
        impares_en_decada = [x for x in numeros_impares if inicio <= x <= fin]
        print(f"Década {inicio:2d}-{fin:2d}: {len(impares_en_decada)} impares → {impares_en_decada}")

    # Comparación con pares
    numeros_pares = [i for i in range(1, 51) if i % 2 == 0]
    suma_pares = sum(numeros_pares)

    print(f"\n⚖️  COMPARACIÓN CON PARES:")
    print("-" * 26)
    print(f"• Cantidad de impares: {len(numeros_impares)}")
    print(f"• Cantidad de pares: {len(numeros_pares)}")
    print(f"• Suma de impares: {suma_impares}")
    print(f"• Suma de pares: {suma_pares}")
    print(f"• Diferencia de sumas: {abs(suma_impares - suma_pares)}")
    print(f"• Total (impares + pares): {suma_impares + suma_pares}")
    print(f"• Verificación total 1-50: {sum(range(1, 51))}")

    # Propiedades interesantes
    print(f"\n🎯 PROPIEDADES INTERESANTES:")
    print("-" * 28)
    print(f"• Último impar en el rango: {numeros_impares[-1]}")
    print(f"• Número impar central: {numeros_impares[len(numeros_impares)//2]}")
    print(f"• Suma = cuadrado perfecto: {suma_impares} = {int(suma_impares**0.5)}²")

    print(f"\n✅ Proceso completado exitosamente")
    print("=" * 38)

if __name__ == "__main__":
    main()