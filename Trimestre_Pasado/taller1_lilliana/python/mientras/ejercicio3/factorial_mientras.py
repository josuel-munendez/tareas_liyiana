#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Mientras
Ejercicio 3: Calcular factorial usando ciclo mientras
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def factorial_mientras(n):
    """Calcula el factorial usando ciclo mientras"""
    if n < 0:
        return None
    if n == 0 or n == 1:
        return 1

    resultado = 1
    i = 2

    while i <= n:
        resultado *= i
        i += 1

    return resultado

def factorial_para_comparacion(n):
    """Calcula factorial con ciclo for para comparación"""
    if n < 0:
        return None
    if n == 0 or n == 1:
        return 1

    resultado = 1
    for i in range(2, n + 1):
        resultado *= i

    return resultado

def mostrar_proceso_paso_a_paso(n):
    """Muestra el proceso de cálculo paso a paso"""
    if n < 0:
        return None
    if n == 0 or n == 1:
        return [(n, 1)]

    pasos = []
    resultado = 1
    i = 2

    pasos.append((1, 1))  # Paso inicial

    while i <= n:
        resultado *= i
        pasos.append((i, resultado))
        i += 1

    return pasos

def main():
    print("=================================")
    print("  EJERCICIO 3: Factorial (Mientras)")
    print("=================================\n")

    try:
        # Leer número del usuario
        numero = int(input("Ingrese un número natural para calcular su factorial: "))

        # Validar entrada
        if numero < 0:
            print("❌ Error: El factorial no está definido para números negativos.")
            return

        # Calcular factorial usando mientras
        resultado_mientras = factorial_mientras(numero)

        # Calcular con for para comparación
        resultado_for = factorial_para_comparacion(numero)

        # Mostrar resultado principal
        print(f"\n" + "="*60)
        print("RESULTADO DEL CÁLCULO")
        print("="*60)
        print(f"Número: {numero}")
        print(f"Factorial (ciclo mientras): {numero}! = {resultado_mientras}")
        print(f"Factorial (ciclo for):      {numero}! = {resultado_for}")

        # Verificar que ambos métodos den el mismo resultado
        if resultado_mientras == resultado_for:
            print("✅ Ambos métodos coinciden")
        else:
            print("❌ Error: Los métodos no coinciden")

        # Mostrar proceso paso a paso (solo para números pequeños)
        if numero <= 12:
            pasos = mostrar_proceso_paso_a_paso(numero)
            if pasos:
                print(f"\n⚙️  PROCESO PASO A PASO (CICLO MIENTRAS):")
                print("-" * 42)

                if numero == 0:
                    print("0! = 1 (por definición)")
                elif numero == 1:
                    print("1! = 1 (por definición)")
                else:
                    print("Inicialización: resultado = 1, i = 2")
                    print(f"Condición: mientras i <= {numero}")
                    print()

                    resultado_temp = 1
                    i = 2
                    iteracion = 1

                    while i <= numero:
                        resultado_anterior = resultado_temp
                        resultado_temp *= i
                        print(f"Iteración {iteracion}: resultado = {resultado_anterior} × {i} = {resultado_temp}")
                        print(f"             i = {i} + 1 = {i + 1}")
                        print(f"             ¿{i + 1} <= {numero}? {'Sí' if i + 1 <= numero else 'No'}")
                        if i + 1 <= numero:
                            print("             Continuar ciclo")
                        else:
                            print("             Terminar ciclo")
                        print()
                        i += 1
                        iteracion += 1

        # Información sobre factoriales
        print(f"\n📚 INFORMACIÓN SOBRE FACTORIALES:")
        print("-" * 35)
        print(f"• Definición: n! = n × (n-1) × (n-2) × ... × 2 × 1")
        print(f"• Casos especiales: 0! = 1, 1! = 1")
        print(f"• Crecimiento: Los factoriales crecen muy rápidamente")

        # Mostrar algunos factoriales conocidos
        print(f"\n📊 FACTORIALES CONOCIDOS:")
        print("-" * 26)
        factoriales_conocidos = []
        for i in range(min(13, numero + 3)):
            fact = factorial_mientras(i)
            factoriales_conocidos.append((i, fact))
            if i <= 12:  # Solo mostrar hasta 12! para evitar números enormes
                print(f"{i:2d}! = {fact:>12,}")

        # Análisis del crecimiento
        if numero > 1:
            print(f"\n📈 ANÁLISIS DE CRECIMIENTO:")
            print("-" * 28)

            if numero <= 12:
                # Calcular razón de crecimiento
                factorial_anterior = factorial_mientras(numero - 1)
                razon = resultado_mientras / factorial_anterior
                print(f"• {numero}! / {numero-1}! = {resultado_mientras:,} / {factorial_anterior:,} = {razon}")
                print(f"• Incremento: {resultado_mientras - factorial_anterior:,}")

                if numero >= 3:
                    factorial_dos_anterior = factorial_mientras(numero - 2)
                    incremento_anterior = factorial_anterior - factorial_dos_anterior
                    incremento_actual = resultado_mientras - factorial_anterior
                    factor_incremento = incremento_actual / incremento_anterior if incremento_anterior != 0 else 0
                    print(f"• El incremento creció {factor_incremento:.1f} veces respecto al anterior")

        # Comparación de algoritmos
        print(f"\n🔍 COMPARACIÓN DE ALGORITMOS:")
        print("-" * 31)
        print(f"• Ciclo MIENTRAS:")
        print(f"  - Inicialización manual: resultado=1, i=2")
        print(f"  - Condición: mientras i <= n")
        print(f"  - Actualización manual: i = i + 1")
        print(f"• Ciclo PARA:")
        print(f"  - Inicialización automática: i desde 2")
        print(f"  - Condición automática: hasta n")
        print(f"  - Actualización automática: i++")
        print(f"• Ambos tienen la misma complejidad: O(n)")

        # Características del ciclo mientras
        print(f"\n⚙️  CARACTERÍSTICAS DEL CICLO MIENTRAS:")
        print("-" * 40)
        print(f"• Control manual de la variable de iteración")
        print(f"• Más flexible para condiciones complejas")
        print(f"• Requiere cuidado para evitar bucles infinitos")
        print(f"• Útil cuando no se conoce el número exacto de iteraciones")

        # Verificación matemática adicional
        if numero <= 20:  # Para evitar números demasiado grandes
            import math
            factorial_math = math.factorial(numero)
            print(f"\n✅ VERIFICACIÓN CON BIBLIOTECA MATH:")
            print("-" * 37)
            print(f"• Nuestro resultado: {resultado_mientras:,}")
            print(f"• math.factorial():  {factorial_math:,}")
            if resultado_mientras == factorial_math:
                print("• ✅ Verificación exitosa")
            else:
                print("• ❌ Error detectado")

        # Aplicaciones prácticas
        print(f"\n💡 APLICACIONES PRÁCTICAS:")
        print("-" * 26)
        print(f"• Combinatoria: Cálculo de permutaciones")
        print(f"• Probabilidad: Distribuciones discretas")
        print(f"• Series matemáticas: Expansiones de Taylor")
        print(f"• Algoritmos: Análisis de complejidad")

        if numero <= 7:
            print(f"• Ejemplo: {numero}! = número de formas de ordenar {numero} objetos")

        print(f"\n✅ Cálculo de factorial completado")
        print("=" * 40)

    except ValueError:
        print("❌ Error: Por favor ingrese un número entero válido.")
    except Exception as e:
        print(f"❌ Error inesperado: {e}")

if __name__ == "__main__":
    main()