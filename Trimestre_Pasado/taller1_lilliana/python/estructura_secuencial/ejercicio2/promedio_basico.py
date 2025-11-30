#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Algoritmos Secuenciales - Ejercicio 2
Calcular el promedio de un conjunto de números
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

def main():
    print("=========================================")
    print("    CALCULADORA DE PROMEDIO")
    print("=========================================")

    # Solicitar cantidad de números
    try:
        cantidad = int(input("¿Cuántos números desea promediar? "))
        if cantidad <= 0:
            print("Error: Debe ingresar una cantidad mayor a 0")
            return
    except ValueError:
        print("Error: Debe ingresar un número entero válido")
        return

    # Lista para almacenar los números
    numeros = []
    suma = 0

    # Leer los números
    print(f"\nIngrese {cantidad} números:")
    for i in range(cantidad):
        try:
            numero = float(input(f"Número {i+1}: "))
            numeros.append(numero)
            suma += numero
        except ValueError:
            print("Error: Debe ingresar un número válido")
            return

    # Calcular promedio
    promedio = suma / cantidad

    # Mostrar resultados
    print("\n" + "="*40)
    print("           RESULTADOS")
    print("="*40)
    print(f"Números ingresados: {numeros}")
    print(f"Suma total: {suma:.2f}")
    print(f"Cantidad de números: {cantidad}")
    print(f"Promedio: {promedio:.2f}")

    # Estadísticas adicionales
    maximo = max(numeros)
    minimo = min(numeros)

    print(f"\n📊 ESTADÍSTICAS ADICIONALES:")
    print(f"Número mayor: {maximo}")
    print(f"Número menor: {minimo}")
    print(f"Rango: {maximo - minimo:.2f}")

if __name__ == "__main__":
    main()