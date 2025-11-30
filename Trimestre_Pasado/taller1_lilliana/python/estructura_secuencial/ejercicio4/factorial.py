#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Algoritmos Secuenciales
Ejercicio 4: Calcular el factorial de un número
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def calcular_factorial(n):
    """Función que calcula el factorial de un número de forma iterativa"""
    if n < 0:
        return None
    if n == 0 or n == 1:
        return 1

    factorial = 1
    for i in range(2, n + 1):
        factorial *= i
    return factorial

def main():
    print("=================================")
    print("   CALCULADORA DE FACTORIAL")
    print("=================================\n")

    try:
        # Leer número del usuario
        numero = int(input("Ingrese un número natural (entero positivo): "))

        # Validar que sea un número natural
        if numero < 0:
            print("Error: El factorial no está definido para números negativos.")
            return

        # Calcular factorial
        resultado = calcular_factorial(numero)

        # Mostrar resultado
        print("\n" + "="*50)
        print("RESULTADO DEL CÁLCULO")
        print("="*50)
        print(f"Número: {numero}")
        print(f"Factorial: {numero}! = {resultado}")

        # Mostrar el proceso paso a paso
        if numero <= 10:  # Solo mostrar proceso para números pequeños
            print(f"\nProceso paso a paso:")
            proceso = []
            for i in range(1, numero + 1):
                proceso.append(str(i))

            if numero == 0:
                print("0! = 1 (por definición)")
            elif numero == 1:
                print("1! = 1")
            else:
                print(f"{numero}! = {' × '.join(proceso)} = {resultado}")

        # Información adicional
        print(f"\nInformación adicional:")
        if numero > 0:
            print(f"• {numero-1}! = {calcular_factorial(numero-1)}")
        if numero < 20:  # Evitar números muy grandes
            print(f"• {numero+1}! = {calcular_factorial(numero+1)}")

        # Advertencia para números grandes
        if numero > 20:
            print(f"⚠️  Nota: {numero}! es un número muy grande!")

    except ValueError:
        print("Error: Por favor ingrese un número entero válido.")
    except Exception as e:
        print(f"Error inesperado: {e}")

if __name__ == "__main__":
    main()