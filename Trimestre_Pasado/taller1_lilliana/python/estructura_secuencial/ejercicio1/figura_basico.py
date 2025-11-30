#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Algoritmos Secuenciales - Ejercicio 1
Calcular el área de un triángulo, rectángulo o círculo
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

import math

def main():
    print("Calculadora de áreas")
    print("===================")
    print("1. Triángulo")
    print("2. Rectángulo")
    print("3. Círculo")

    # Leer la opción del usuario
    try:
        opcion = int(input("Selecciona una figura (1-3): "))
    except ValueError:
        print("Error: Debe ingresar un número válido")
        return

    # Inicializar la variable del área
    area = 0

    # Calcular el área según la opción usando condicionales
    if opcion == 1:
        try:
            base = float(input("Ingresa la base del triángulo: "))
            altura = float(input("Ingresa la altura del triángulo: "))
            area = (base * altura) / 2
        except ValueError:
            print("Error: Debe ingresar números válidos")
            return

    elif opcion == 2:
        try:
            base = float(input("Ingresa la base del rectángulo: "))
            altura = float(input("Ingresa la altura del rectángulo: "))
            area = base * altura
        except ValueError:
            print("Error: Debe ingresar números válidos")
            return

    elif opcion == 3:
        try:
            radio = float(input("Ingresa el radio del círculo: "))
            area = math.pi * (radio ** 2)
        except ValueError:
            print("Error: Debe ingresar números válidos")
            return

    else:
        print("Opción no válida.")
        return

    # Mostrar el resultado con dos decimales
    print(f"El área de la figura seleccionada es: {area:.2f}")

if __name__ == "__main__":
    main()
