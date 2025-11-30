#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Para
Ejercicio 1: Imprimir los números del 1 al 100
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print("   EJERCICIO 1: Números 1-100")
    print("=================================\n")

    print("Imprimiendo números del 1 al 100:")
    print("-" * 33)

    contador = 0

    # Ciclo para imprimir números del 1 al 100
    for i in range(1, 101):
        print(f"{i:3d}", end=" ")
        contador += 1

        # Salto de línea cada 10 números
        if contador % 10 == 0:
            print()  # Nueva línea

    print("\n")
    print("📊 ESTADÍSTICAS:")
    print("-" * 15)
    print(f"✅ Total de números impresos: {contador}")
    print(f"🔢 Rango: 1 - 100")
    print(f"📐 Números por línea: 10")
    print(f"📏 Total de líneas: {contador // 10}")

    # Estadísticas adicionales
    suma_total = sum(range(1, 101))
    promedio = suma_total / contador

    print(f"\n🧮 CÁLCULOS ADICIONALES:")
    print("-" * 20)
    print(f"• Suma de todos los números: {suma_total}")
    print(f"• Promedio: {promedio:.1f}")
    print(f"• Número menor: 1")
    print(f"• Número mayor: 100")
    print(f"• Números pares: {len([x for x in range(1, 101) if x % 2 == 0])}")
    print(f"• Números impares: {len([x for x in range(1, 101) if x % 2 != 0])}")

    # Análisis por décadas
    print(f"\n📈 ANÁLISIS POR DÉCADAS:")
    print("-" * 22)
    for decada in range(1, 11):
        inicio = (decada - 1) * 10 + 1
        fin = decada * 10
        print(f"Década {decada:2d}: {inicio:3d} - {fin:3d}")

    print(f"\n✅ Proceso completado exitosamente")
    print("=" * 35)

if __name__ == "__main__":
    main()