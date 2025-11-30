#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Mientras
Ejercicio 4: Imprimir números pares del 1 al 100 usando mientras
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print(" EJERCICIO 4: Pares 1-100 (Mientras)")
    print("=================================\n")

    print("Números pares del 1 al 100 (usando ciclo mientras):")
    print("-" * 52)

    numeros_pares = []
    suma_pares = 0
    contador = 0
    i = 1

    # Ciclo mientras para encontrar números pares
    while i <= 100:
        if i % 2 == 0:  # Verificar si es par
            numeros_pares.append(i)
            suma_pares += i
            contador += 1
            print(f"{i:3d}", end="  ")

            # Salto de línea cada 10 números
            if contador % 10 == 0:
                print()  # Nueva línea

        i += 1  # Incrementar manualmente

    # Salto de línea si no terminó en múltiplo de 10
    if contador % 10 != 0:
        print()

    print(f"\n📊 ESTADÍSTICAS GENERALES:")
    print("-" * 25)
    print(f"✅ Total de números pares: {contador}")
    print(f"🔢 Rango analizado: 1 - 100")
    print(f"📐 Números por línea: 10")
    print(f"📏 Total de líneas: {(contador + 9) // 10}")
    print(f"➕ Suma de todos los pares: {suma_pares}")

    # Cálculos matemáticos
    promedio = suma_pares / contador
    print(f"\n🧮 CÁLCULOS MATEMÁTICOS:")
    print("-" * 24)
    print(f"• Promedio de los pares: {promedio:.1f}")
    print(f"• Menor número par: {min(numeros_pares)}")
    print(f"• Mayor número par: {max(numeros_pares)}")
    print(f"• Diferencia entre extremos: {max(numeros_pares) - min(numeros_pares)}")

    # Verificación matemática
    # Suma de números pares 2+4+6+...+100 = 2(1+2+3+...+50) = 2×(50×51/2) = 50×51 = 2550
    n_pares = contador  # 50 números pares
    suma_teorica = n_pares * (n_pares + 1)  # Fórmula para suma de pares

    print(f"\n🔍 VERIFICACIÓN MATEMÁTICA:")
    print("-" * 27)
    print(f"• Cantidad de pares (n): {n_pares}")
    print(f"• Suma teórica: n×(n+1) = {n_pares}×{n_pares+1} = {suma_teorica}")
    print(f"• Suma calculada: {suma_pares}")

    if suma_pares == suma_teorica:
        print("✅ ¡Verificación correcta!")
    else:
        print("❌ Error en la verificación")

    # Análisis del algoritmo mientras
    print(f"\n⚙️  ANÁLISIS DEL ALGORITMO MIENTRAS:")
    print("-" * 37)
    print(f"• Variable de control: i (inicializada en 1)")
    print(f"• Condición del ciclo: mientras i <= 100")
    print(f"• Incremento manual: i = i + 1")
    print(f"• Verificación interna: if i % 2 == 0")
    print(f"• Total de iteraciones ejecutadas: 100")
    print(f"• Iteraciones útiles (pares): {contador}")
    print(f"• Eficiencia: {contador/100*100:.1f}%")

    # Proceso detallado (primeras iteraciones)
    print(f"\n🔍 PROCESO DETALLADO (primeras 10 iteraciones):")
    print("-" * 47)
    print("Iteración | i | ¿Es par? | Acción")
    print("-" * 35)

    for iteracion in range(1, 11):
        es_par = "Sí" if iteracion % 2 == 0 else "No"
        accion = "Agregar" if iteracion % 2 == 0 else "Ignorar"
        print(f"    {iteracion:2d}    | {iteracion:1d} |    {es_par:2s}    | {accion}")

    # Comparación con otros métodos
    print(f"\n📊 COMPARACIÓN CON OTROS MÉTODOS:")
    print("-" * 34)

    # Método 1: Ciclo for con rango completo
    pares_for_completo = []
    for i in range(1, 101):
        if i % 2 == 0:
            pares_for_completo.append(i)

    # Método 2: Ciclo for con rango optimizado
    pares_for_optimizado = list(range(2, 101, 2))

    # Método 3: Mientras optimizado (solo pares)
    pares_mientras_opt = []
    j = 2
    while j <= 100:
        pares_mientras_opt.append(j)
        j += 2

    print(f"• Mientras actual (1 a 100):     {len(numeros_pares)} pares, 100 iteraciones")
    print(f"• For completo (1 a 100):        {len(pares_for_completo)} pares, 100 iteraciones")
    print(f"• For optimizado (2,4,6...):     {len(pares_for_optimizado)} pares, 50 iteraciones")
    print(f"• Mientras optimizado (2,4,6...): {len(pares_mientras_opt)} pares, 50 iteraciones")

    # Verificar que todos den el mismo resultado
    todos_iguales = (numeros_pares == pares_for_completo ==
                     pares_for_optimizado == pares_mientras_opt)
    print(f"• Todos los métodos coinciden: {'✅ Sí' if todos_iguales else '❌ No'}")

    # Análisis de patrones
    print(f"\n📈 ANÁLISIS DE PATRONES:")
    print("-" * 25)
    print(f"• Secuencia: 2, 4, 6, 8, 10, ...")
    print(f"• Diferencia constante: +2")
    print(f"• Fórmula general: 2n donde n = 1,2,3,...,50")
    print(f"• Todos terminan en: 0, 2, 4, 6, 8")

    # Distribución por décadas
    print(f"\n📊 DISTRIBUCIÓN POR DÉCADAS:")
    print("-" * 29)
    for decada in range(10):  # 10 décadas: 1-10, 11-20, ..., 91-100
        inicio = decada * 10 + 1
        fin = (decada + 1) * 10
        pares_en_decada = [x for x in numeros_pares if inicio <= x <= fin]
        print(f"Década {inicio:2d}-{fin:3d}: {len(pares_en_decada)} pares → {pares_en_decada}")

    # Propiedades matemáticas
    print(f"\n🎯 PROPIEDADES MATEMÁTICAS:")
    print("-" * 28)
    print(f"• Primer par: {numeros_pares[0]}")
    print(f"• Último par: {numeros_pares[-1]}")
    print(f"• Par central: {numeros_pares[len(numeros_pares)//2]}")
    print(f"• Suma de extremos: {numeros_pares[0]} + {numeros_pares[-1]} = {numeros_pares[0] + numeros_pares[-1]}")
    print(f"• Producto de extremos: {numeros_pares[0]} × {numeros_pares[-1]} = {numeros_pares[0] * numeros_pares[-1]}")

    # Ventajas y desventajas del ciclo mientras
    print(f"\n⚖️  CICLO MIENTRAS - PROS Y CONTRAS:")
    print("-" * 35)
    print(f"✅ VENTAJAS:")
    print(f"   • Máxima flexibilidad en condiciones")
    print(f"   • Control manual completo del flujo")
    print(f"   • Útil para condiciones complejas")
    print(f"❌ DESVENTAJAS:")
    print(f"   • Más propenso a errores (bucles infinitos)")
    print(f"   • Requiere manejo manual de variables")
    print(f"   • Menos eficiente para rangos conocidos")

    print(f"\n✅ Análisis de números pares completado")
    print("=" * 42)

if __name__ == "__main__":
    main()