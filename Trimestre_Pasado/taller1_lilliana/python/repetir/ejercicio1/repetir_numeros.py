#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Repetir (Do-While)
Ejercicio 1: Imprimir números del 1 al 10 usando repetir
Autor: Lilliana
Fecha: 3 de octubre de 2025

Nota: Python no tiene do-while nativo, se simula con while True y break
"""

def main():
    print("=================================")
    print(" EJERCICIO 1: Números 1-10 (Repetir)")
    print("=================================\n")

    print("Números del 1 al 10 usando estructura REPETIR:")
    print("-" * 47)

    numeros = []
    suma = 0
    i = 1

    # Simulación del ciclo REPETIR (do-while)
    # En Python: while True con break al final
    while True:
        # Cuerpo del ciclo (se ejecuta al menos una vez)
        print(f"{i:2d}", end="  ")
        numeros.append(i)
        suma += i

        # Condición de salida (al final, como en do-while)
        if i >= 10:
            break

        i += 1  # Incremento

    print()  # Nueva línea después de los números

    # Mostrar resultados
    print(f"\n📊 ESTADÍSTICAS:")
    print("-" * 15)
    print(f"✅ Números impresos: {len(numeros)}")
    print(f"🔢 Lista completa: {numeros}")
    print(f"➕ Suma total: {suma}")
    print(f"📐 Promedio: {suma / len(numeros):.1f}")
    print(f"📈 Número mayor: {max(numeros)}")
    print(f"📉 Número menor: {min(numeros)}")

    # Verificación matemática
    suma_teorica = 10 * 11 // 2  # Suma de 1 a 10 = n(n+1)/2
    print(f"\n🧮 VERIFICACIÓN MATEMÁTICA:")
    print("-" * 25)
    print(f"• Suma calculada: {suma}")
    print(f"• Suma teórica (n(n+1)/2): {suma_teorica}")
    print(f"• ✅ Verificación: {'Correcta' if suma == suma_teorica else 'Error'}")

    # Análisis del ciclo REPETIR
    print(f"\n⚙️  ANÁLISIS DEL CICLO REPETIR:")
    print("-" * 32)
    print(f"• Estructura: REPETIR...HASTA (do-while)")
    print(f"• Característica: Se ejecuta AL MENOS una vez")
    print(f"• Condición: Se evalúa AL FINAL de cada iteración")
    print(f"• En Python: while True + break (simulación)")
    print(f"• Garantía: Siempre ejecuta el cuerpo mínimo 1 vez")

    # Demostración paso a paso
    print(f"\n🔍 PROCESO PASO A PASO:")
    print("-" * 24)
    print("Iteración | i | Acción | ¿i >= 10? | Continuar")
    print("-" * 45)

    # Simular el proceso para mostrar cómo funciona
    i_demo = 1
    iteracion = 1
    while True:
        accion = f"Imprimir {i_demo}"
        condicion = "Sí" if i_demo >= 10 else "No"
        continuar = "No (break)" if i_demo >= 10 else "Sí"

        print(f"    {iteracion:2d}    | {i_demo:1d} | {accion:10s} |    {condicion:2s}     | {continuar}")

        if i_demo >= 10:
            break
        i_demo += 1
        iteracion += 1

    # Comparación con otros ciclos
    print(f"\n📊 COMPARACIÓN CON OTROS CICLOS:")
    print("-" * 33)

    # Método 1: Ciclo FOR
    numeros_for = list(range(1, 11))

    # Método 2: Ciclo MIENTRAS (while)
    numeros_mientras = []
    j = 1
    while j <= 10:
        numeros_mientras.append(j)
        j += 1

    # Método 3: REPETIR simulado
    numeros_repetir = []
    k = 1
    while True:
        numeros_repetir.append(k)
        if k >= 10:
            break
        k += 1

    print(f"• FOR (range):          {numeros_for}")
    print(f"• MIENTRAS (while):     {numeros_mientras}")
    print(f"• REPETIR (simulado):   {numeros_repetir}")
    print(f"• Todos coinciden: {'✅ Sí' if numeros_for == numeros_mientras == numeros_repetir else '❌ No'}")

    # Diferencias clave
    print(f"\n🔍 DIFERENCIAS CLAVE:")
    print("-" * 20)
    print(f"📌 FOR:")
    print(f"   • Mejor para rangos conocidos")
    print(f"   • Inicialización automática")
    print(f"   • Menos propenso a errores")

    print(f"📌 MIENTRAS (while):")
    print(f"   • Evalúa condición ANTES de ejecutar")
    print(f"   • Puede no ejecutarse nunca")
    print(f"   • Más flexible para condiciones complejas")

    print(f"📌 REPETIR (do-while):")
    print(f"   • Evalúa condición DESPUÉS de ejecutar")
    print(f"   • Se ejecuta AL MENOS una vez")
    print(f"   • Útil para menús y validaciones")

    # Casos de uso típicos
    print(f"\n💡 CASOS DE USO DEL REPETIR:")
    print("-" * 28)
    print(f"✅ Menús interactivos")
    print(f"✅ Validación de entrada de datos")
    print(f"✅ Juegos (al menos una partida)")
    print(f"✅ Lectura de archivos línea por línea")
    print(f"✅ Procesamiento que requiere al menos una ejecución")

    # Ejemplo práctico de cuándo usar REPETIR
    print(f"\n🎯 EJEMPLO PRÁCTICO:")
    print("-" * 19)
    print(f"Validación de entrada:")
    print(f"REPETIR")
    print(f"    pedir_numero()")
    print(f"    validar_numero()")
    print(f"HASTA numero_valido")
    print(f"")
    print(f"Garantiza al menos una solicitud de entrada")

    # Simulación de la lógica interna
    print(f"\n🛠️  LÓGICA INTERNA (Python):")
    print("-" * 27)
    print(f"# Estructura REPETIR simulada:")
    print(f"while True:")
    print(f"    # Cuerpo del ciclo")
    print(f"    ejecutar_acciones()")
    print(f"    # Condición de salida")
    print(f"    if condicion_de_parada:")
    print(f"        break")

    # Ventajas y desventajas
    print(f"\n⚖️  VENTAJAS Y DESVENTAJAS:")
    print("-" * 27)
    print(f"✅ VENTAJAS:")
    print(f"   • Garantiza ejecución mínima")
    print(f"   • Lógica natural para algunos problemas")
    print(f"   • Bueno para validaciones")

    print(f"❌ DESVENTAJAS:")
    print(f"   • No existe nativamente en Python")
    print(f"   • Puede ser menos legible")
    print(f"   • Propenso a bucles infinitos si se programa mal")

    # Patrón de números generado
    print(f"\n📈 PATRÓN GENERADO:")
    print("-" * 18)
    print(f"• Secuencia: 1, 2, 3, 4, 5, 6, 7, 8, 9, 10")
    print(f"• Tipo: Progresión aritmética")
    print(f"• Diferencia común: +1")
    print(f"• Término general: an = n")
    print(f"• Suma (S10): {suma}")

    print(f"\n✅ Ejercicio REPETIR completado")
    print("=" * 35)

if __name__ == "__main__":
    main()