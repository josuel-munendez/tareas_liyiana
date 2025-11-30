#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Para
Ejercicio 2: Sumar los números pares del 1 al 20
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print("  EJERCICIO 2: Suma de Pares 1-20")
    print("=================================\n")

    suma_pares = 0
    numeros_pares = []

    print("Números pares del 1 al 20:")
    print("-" * 26)

    # Ciclo para encontrar y sumar números pares
    for i in range(1, 21):
        if i % 2 == 0:  # Verificar si es par
            numeros_pares.append(i)
            suma_pares += i
            print(f"{i:2d}", end="  ")

    print("\n")

    # Mostrar resultados
    print("📊 RESULTADOS:")
    print("-" * 14)
    print(f"✅ Números pares encontrados: {len(numeros_pares)}")
    print(f"🔢 Lista de pares: {numeros_pares}")
    print(f"➕ Suma total: {suma_pares}")

    # Verificación matemática
    # La suma de números pares 2+4+6+...+2n = n(n+1)
    n = 10  # Hay 10 números pares del 1 al 20
    suma_teorica = n * (n + 1)
    print(f"🧮 Verificación teórica: {n} × {n+1} = {suma_teorica}")

    if suma_pares == suma_teorica:
        print("✅ ¡Verificación correcta!")
    else:
        print("❌ Error en la verificación")

    # Estadísticas adicionales
    promedio_pares = suma_pares / len(numeros_pares)
    print(f"\n📈 ESTADÍSTICAS ADICIONALES:")
    print("-" * 27)
    print(f"• Promedio de números pares: {promedio_pares:.1f}")
    print(f"• Menor número par: {min(numeros_pares)}")
    print(f"• Mayor número par: {max(numeros_pares)}")
    print(f"• Diferencia entre mayor y menor: {max(numeros_pares) - min(numeros_pares)}")

    # Análisis de la secuencia
    print(f"\n🔍 ANÁLISIS DE LA SECUENCIA:")
    print("-" * 28)
    print(f"• Secuencia: números pares del 1 al 20")
    print(f"• Patrón: cada número es el anterior + 2")
    print(f"• Fórmula general: 2n donde n = 1, 2, 3, ..., 10")

    # Mostrar proceso paso a paso
    print(f"\n⚙️  PROCESO PASO A PASO:")
    print("-" * 22)
    suma_acumulada = 0
    for i, num_par in enumerate(numeros_pares, 1):
        suma_acumulada += num_par
        print(f"Paso {i:2d}: Suma hasta ahora = {suma_acumulada:2d} (agregado: {num_par})")

    # Comparación con impares
    suma_impares = sum(i for i in range(1, 21) if i % 2 != 0)
    numeros_impares = [i for i in range(1, 21) if i % 2 != 0]

    print(f"\n⚖️  COMPARACIÓN CON IMPARES:")
    print("-" * 28)
    print(f"• Suma de pares (1-20): {suma_pares}")
    print(f"• Suma de impares (1-20): {suma_impares}")
    print(f"• Diferencia: {abs(suma_pares - suma_impares)}")
    print(f"• Total (pares + impares): {suma_pares + suma_impares}")
    print(f"• Verificación total 1-20: {sum(range(1, 21))}")

    print(f"\n✅ Proceso completado exitosamente")
    print("=" * 35)

if __name__ == "__main__":
    main()