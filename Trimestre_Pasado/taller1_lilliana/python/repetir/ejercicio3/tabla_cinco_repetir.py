#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Repetir (Do-While)
Ejercicio 3: Tabla de multiplicar del 5 usando repetir
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=================================")
    print(" EJERCICIO 3: Tabla del 5 (Repetir)")
    print("=================================\n")

    numero = 5
    suma_total = 0
    resultados = []
    i = 1

    print(f"Tabla de multiplicar del {numero} usando estructura REPETIR:")
    print("-" * 54)

    # Simulación del ciclo REPETIR (do-while)
    while True:
        # Cuerpo del ciclo - calcular multiplicación
        resultado = numero * i
        resultados.append(resultado)
        suma_total += resultado

        print(f"{numero:2d} × {i:2d} = {resultado:3d}")

        # Condición de salida (evaluar al final)
        if i >= 12:  # Tabla completa hasta 12
            break

        i += 1

    # Mostrar estadísticas
    print(f"\n📊 ESTADÍSTICAS DE LA TABLA:")
    print("-" * 28)
    print(f"✅ Multiplicaciones calculadas: {len(resultados)}")
    print(f"🔢 Resultados: {resultados}")
    print(f"➕ Suma de todos los productos: {suma_total}")
    print(f"📐 Promedio de resultados: {suma_total / len(resultados):.2f}")
    print(f"📈 Resultado mayor: {max(resultados)}")
    print(f"📉 Resultado menor: {min(resultados)}")

    # Verificación matemática
    # Suma = 5×(1+2+3+...+12) = 5×(12×13/2) = 5×78 = 390
    suma_1_a_12 = 12 * 13 // 2
    suma_teorica = numero * suma_1_a_12

    print(f"\n🧮 VERIFICACIÓN MATEMÁTICA:")
    print("-" * 25)
    print(f"• Tabla del {numero} (multiplicadores 1-12)")
    print(f"• Suma teórica: {numero} × (1+2+...+12) = {numero} × {suma_1_a_12} = {suma_teorica}")
    print(f"• Suma calculada: {suma_total}")
    print(f"• ✅ Verificación: {'Correcta' if suma_total == suma_teorica else 'Error'}")

    # Proceso paso a paso del REPETIR
    print(f"\n⚙️  PROCESO PASO A PASO (REPETIR):")
    print("-" * 34)
    print("Iter | i  | Cálculo    | Result | Suma Acum | ¿i >= 12? | Continuar")
    print("-" * 67)

    # Simular proceso para documentar
    i_demo = 1
    suma_demo = 0
    iteracion = 1

    while True:
        calculo = f"{numero}×{i_demo}"
        resultado_demo = numero * i_demo
        suma_demo += resultado_demo
        condicion = "Sí" if i_demo >= 12 else "No"
        continuar = "No (break)" if i_demo >= 12 else "Sí"

        print(f" {iteracion:2d}  | {i_demo:2d} | {calculo:10s} | {resultado_demo:6d} | {suma_demo:8d} |    {condicion:2s}     | {continuar}")

        if i_demo >= 12:
            break
        i_demo += 1
        iteracion += 1

    # Análisis de patrones
    print(f"\n📈 ANÁLISIS DE PATRONES:")
    print("-" * 25)
    print(f"• Secuencia: 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60")
    print(f"• Diferencia común: +{numero}")
    print(f"• Fórmula general: {numero}×n donde n = 1,2,3,...,12")
    print(f"• Todos los resultados son múltiplos de {numero}")
    print(f"• Patrón de terminación: 5, 0, 5, 0, 5, 0, ...")

    # Clasificación de resultados
    terminan_en_0 = [r for r in resultados if r % 10 == 0]
    terminan_en_5 = [r for r in resultados if r % 10 == 5]
    pares = [r for r in resultados if r % 2 == 0]
    impares = [r for r in resultados if r % 2 != 0]

    print(f"\n🔍 CLASIFICACIÓN DE RESULTADOS:")
    print("-" * 31)
    print(f"• Terminan en 0: {len(terminan_en_0)} → {terminan_en_0}")
    print(f"• Terminan en 5: {len(terminan_en_5)} → {terminan_en_5}")
    print(f"• Resultados pares: {len(pares)} → {pares}")
    print(f"• Resultados impares: {len(impares)} → {impares}")
    print(f"• Patrón: Como 5 es impar, 5×par=par y 5×impar=impar")

    # Comparación con otros ciclos
    print(f"\n📊 COMPARACIÓN CON OTROS CICLOS:")
    print("-" * 33)

    # FOR tradicional
    resultados_for = [numero * j for j in range(1, 13)]
    suma_for = sum(resultados_for)

    # MIENTRAS
    resultados_mientras = []
    suma_mientras = 0
    k = 1
    while k <= 12:
        res = numero * k
        resultados_mientras.append(res)
        suma_mientras += res
        k += 1

    print(f"• REPETIR (actual): {len(resultados)} resultados, suma {suma_total}")
    print(f"• FOR:              {len(resultados_for)} resultados, suma {suma_for}")
    print(f"• MIENTRAS:         {len(resultados_mientras)} resultados, suma {suma_mientras}")

    coinciden = (resultados == resultados_for == resultados_mientras and
                 suma_total == suma_for == suma_mientras)
    print(f"• Todos coinciden: {'✅ Sí' if coinciden else '❌ No'}")

    # Propiedades matemáticas de la tabla del 5
    print(f"\n📊 PROPIEDADES DE LA TABLA DEL 5:")
    print("-" * 32)
    print(f"• Múltiplos de 5 en el rango 1-60")
    print(f"• Relación con decimales: fácil división mental")
    print(f"• Patrón visual: alternancia entre 0 y 5")
    print(f"• Útil para cálculos de tiempo (5 min, 10 min, etc.)")
    print(f"• Base para porcentajes (5% = 1/20)")

    # Aplicaciones prácticas
    print(f"\n💡 APLICACIONES PRÁCTICAS:")
    print("-" * 26)
    print(f"• Cálculos de tiempo: minutos (5×12 = 60 min = 1 hora)")
    print(f"• Dinero: monedas de 5 centavos")
    print(f"• Geometría: pentágonos (5 lados)")
    print(f"• Medidas: 5 cm, 5 m, etc.")

    # Relaciones con otras tablas
    print(f"\n🔗 RELACIONES CON OTRAS TABLAS:")
    print("-" * 32)
    print(f"• Tabla del 5 = (Tabla del 10) ÷ 2")
    print(f"• Tabla del 5 = (Tabla del 1) × 5")
    print(f"• Tabla del 10 = Tabla del 5 × 2")

    # Verificar relaciones
    tabla_10 = [10 * m for m in range(1, 13)]
    tabla_5_desde_10 = [t // 2 for t in tabla_10]

    print(f"Verificación tabla 10 ÷ 2:")
    for n in range(min(5, len(resultados))):
        print(f"  {numero}×{n+1} = {resultados[n]}, {tabla_10[n]}÷2 = {tabla_5_desde_10[n]} ✅")

    # Estructura del REPETIR para esta tabla
    print(f"\n📝 ESTRUCTURA DEL REPETIR:")
    print("-" * 27)
    print(f"Inicio:")
    print(f"    numero = 5")
    print(f"    i = 1")
    print(f"    REPETIR")
    print(f"        resultado = numero × i")
    print(f"        mostrar resultado")
    print(f"        i = i + 1")
    print(f"    HASTA i > 12")
    print(f"Fin")

    # Ventajas del REPETIR para esta aplicación
    print(f"\n⚖️  VENTAJAS DEL REPETIR AQUÍ:")
    print("-" * 28)
    print(f"✅ Garantiza al menos una multiplicación (5×1)")
    print(f"✅ Natural para tablas (siempre se calcula algo)")
    print(f"✅ Condición clara (hasta completar 12)")
    print(f"✅ Fácil de entender la lógica")

    # Optimizaciones posibles
    print(f"\n🚀 OPTIMIZACIONES POSIBLES:")
    print("-" * 27)
    print(f"• Calcular directamente: range(5, 61, 5)")
    print(f"• Usar list comprehension: [5*i for i in range(1,13)]")
    print(f"• Fórmula directa para suma: 5 × 78 = 390")
    print(f"• Para tablas grandes: usar numpy arrays")

    # Demostración de optimización
    tabla_optimizada = list(range(numero, numero * 13, numero))
    print(f"Optimización range: {tabla_optimizada}")
    print(f"Coincide con REPETIR: {'✅ Sí' if tabla_optimizada == resultados else '❌ No'}")

    # Información educativa
    print(f"\n🎓 INFORMACIÓN EDUCATIVA:")
    print("-" * 26)
    print(f"• El 5 es un número primo")
    print(f"• Base del sistema quinario (base 5)")
    print(f"• Aparece en muchas secuencias matemáticas")
    print(f"• Fundamental en el sistema decimal")
    print(f"• Relacionado con la proporción áurea (pentágono)")

    print(f"\n✅ Tabla del {numero} con REPETIR completada")
    print("=" * 42)

if __name__ == "__main__":
    main()