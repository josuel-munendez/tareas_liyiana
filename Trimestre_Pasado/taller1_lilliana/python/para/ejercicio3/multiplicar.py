#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Para
Ejercicio 3: Calcular la tabla de multiplicar del 5
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print("  EJERCICIO 3: Tabla del 5")
    print("=================================\n")

    numero = 5
    suma_total = 0
    resultados = []

    print(f"Tabla de multiplicar del {numero}:")
    print("-" * 31)

    # Ciclo para generar la tabla de multiplicar
    for i in range(1, 13):  # Del 1 al 12
        resultado = numero * i
        resultados.append(resultado)
        suma_total += resultado
        print(f"{numero:2d} × {i:2d} = {resultado:3d}")

    print()
    print("📊 ESTADÍSTICAS:")
    print("-" * 15)
    print(f"🔢 Tabla completa del 1 al 12")
    print(f"🧮 Suma de todos los resultados: {suma_total}")
    print(f"📐 Promedio: {suma_total / 12:.2f}")
    print(f"📈 Resultado más alto: {max(resultados)}")
    print(f"📉 Resultado más bajo: {min(resultados)}")

    # Análisis de patrones
    print(f"\n🔍 ANÁLISIS DE PATRONES:")
    print("-" * 25)
    print(f"• Los resultados aumentan de {numero} en {numero}")
    print(f"• Diferencia entre consecutivos: {numero}")
    print(f"• Patrón: {numero}, {numero*2}, {numero*3}, ...")

    # Verificación matemática
    # Suma de la tabla = n × (1+2+3+...+12) = n × 12×13/2 = n × 78
    suma_teorica = numero * (12 * 13 // 2)
    print(f"🧮 Verificación: {numero} × 78 = {suma_teorica}")

    if suma_total == suma_teorica:
        print("✅ ¡Verificación correcta!")
    else:
        print("❌ Error en la verificación")

    # Clasificar resultados
    pares = [r for r in resultados if r % 2 == 0]
    impares = [r for r in resultados if r % 2 != 0]

    print(f"\n📈 CLASIFICACIÓN DE RESULTADOS:")
    print("-" * 31)
    print(f"• Resultados pares: {len(pares)} → {pares}")
    print(f"• Resultados impares: {len(impares)} → {impares}")

    # Como 5 es impar, alternará par/impar según el multiplicador
    print(f"• Patrón par/impar: 5×par=par, 5×impar=impar")

    # Información adicional
    print(f"\n🎯 DATOS CURIOSOS:")
    print("-" * 17)
    print(f"• 5 × 10 = 50 (base decimal)")
    print(f"• 5 × 12 = 60 (una docena de 5)")
    print(f"• Todos terminan en 0 o 5")
    print(f"• Múltiplos de 5: {', '.join(map(str, resultados))}")

    # Mostrar relación con otras tablas
    print(f"\n🔗 RELACIÓN CON OTRAS TABLAS:")
    print("-" * 30)
    print(f"• Tabla del 5 = (Tabla del 10) ÷ 2")
    print(f"• Tabla del 5 = (Tabla del 1) × 5")

    # Ejemplos de verificación
    for i in [2, 6, 10]:
        print(f"• 5×{i} = {5*i}, 10×{i}÷2 = {10*i//2}, 1×{i}×5 = {1*i*5}")

    # Proceso detallado para algunos valores
    print(f"\n⚙️  PROCESO DETALLADO (primeros 5):")
    print("-" * 35)
    suma_parcial = 0
    for i in range(1, 6):
        producto = numero * i
        suma_parcial += producto
        print(f"Paso {i}: {numero} × {i} = {producto}, Suma acumulada: {suma_parcial}")

    print(f"\n✅ Tabla del {numero} completada exitosamente")
    print("=" * 40)

if __name__ == "__main__":
    main()