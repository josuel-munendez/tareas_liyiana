#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Algoritmos Secuenciales, Funciones Matemáticas y Estructuras de Control
Menú Principal - Versión Python
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

import os
import sys

def limpiar_pantalla():
    """Limpia la pantalla de la consola"""
    os.system('cls' if os.name == 'nt' else 'clear')

def mostrar_titulo():
    """Muestra el título principal del taller"""
    print("="*70)
    print("    TALLER DE ALGORITMOS SECUENCIALES Y ESTRUCTURAS DE CONTROL")
    print("                         VERSIÓN PYTHON")
    print("="*70)
    print("Autor: Lilliana")
    print("Fecha: 3 de octubre de 2025")
    print("="*70)

def mostrar_menu_principal():
    """Muestra el menú principal"""
    print("\n📚 SELECCIONE UNA SECCIÓN:")
    print("-" * 26)
    print("1. 🔢 Algoritmos Secuenciales")
    print("2. 🧮 Funciones Matemáticas")
    print("3. 🔄 Estructuras de Control - Para")
    print("4. ⏳ Estructuras de Control - Mientras")
    print("5. 🔁 Estructuras de Control - Repetir")
    print("6. 📊 Ejecutar todos los ejercicios")
    print("7. ℹ️  Información del taller")
    print("8. 🚪 Salir")
    print("-" * 26)

def mostrar_menu_secuencial():
    """Muestra el menú de algoritmos secuenciales"""
    print("\n🔢 ALGORITMOS SECUENCIALES:")
    print("-" * 27)
    print("1. Calcular áreas de figuras geométricas")
    print("2. Promedio de números")
    print("3. Determinar par o impar")
    print("4. Calcular factorial")
    print("5. Convertir temperatura")
    print("6. Volver al menú principal")

def mostrar_menu_funciones():
    """Muestra el menú de funciones matemáticas"""
    print("\n🧮 FUNCIONES MATEMÁTICAS:")
    print("-" * 25)
    print("1. Función sqrt() - Raíz cuadrada")
    print("2. Función pow() - Potencias")
    print("3. Función sin() - Seno")
    print("4. Función cos() - Coseno")
    print("5. Función tan() - Tangente")
    print("6. Volver al menú principal")

def mostrar_menu_para():
    """Muestra el menú de ciclos para"""
    print("\n🔄 CICLOS PARA:")
    print("-" * 15)
    print("1. Números del 1 al 100")
    print("2. Suma de pares del 1 al 20")
    print("3. Tabla de multiplicar del 5")
    print("4. Números impares del 1 al 50")
    print("5. Promedio de calificaciones")
    print("6. Volver al menú principal")

def mostrar_menu_mientras():
    """Muestra el menú de ciclos mientras"""
    print("\n⏳ CICLOS MIENTRAS:")
    print("-" * 18)
    print("1. Lectura de números hasta negativo")
    print("2. Suma de positivos hasta 0")
    print("3. Factorial con mientras")
    print("4. Números pares 1-100")
    print("5. Juego de adivinanzas")
    print("6. Volver al menú principal")

def mostrar_menu_repetir():
    """Muestra el menú de ciclos repetir"""
    print("\n🔁 CICLOS REPETIR:")
    print("-" * 17)
    print("1. Números del 1 al 10")
    print("2. Suma de pares del 1 al 20")
    print("3. Tabla de multiplicar del 5")
    print("4. Números impares del 1 al 50")
    print("5. Promedio de calificaciones")
    print("6. Volver al menú principal")

def ejecutar_ejercicio(ruta_archivo):
    """Ejecuta un ejercicio específico"""
    try:
        if os.path.exists(ruta_archivo):
            print(f"\n🚀 Ejecutando: {os.path.basename(ruta_archivo)}")
            print("="*60)

            # Cambiar al directorio del archivo para ejecución
            directorio_original = os.getcwd()
            directorio_ejercicio = os.path.dirname(ruta_archivo)
            nombre_archivo = os.path.basename(ruta_archivo)

            os.chdir(directorio_ejercicio)

            # Ejecutar el archivo
            os.system(f'python "{nombre_archivo}"')

            # Volver al directorio original
            os.chdir(directorio_original)

        else:
            print(f"❌ Error: No se encontró el archivo {ruta_archivo}")
    except Exception as e:
        print(f"❌ Error al ejecutar {ruta_archivo}: {e}")

    input("\n⏸️  Presione Enter para continuar...")

def mostrar_informacion():
    """Muestra información sobre el taller"""
    print("\n" + "="*60)
    print("ℹ️  INFORMACIÓN DEL TALLER")
    print("="*60)
    print("""
📋 OBJETIVO:
   Fortalecer las habilidades en la elaboración de algoritmos
   secuenciales utilizando funciones matemáticas y estructuras
   de control como el ciclo para, mientras y repita.

📚 CONTENIDO:
   • Algoritmos Secuenciales (5 ejercicios)
   • Funciones Matemáticas (5 ejercicios)
   • Ciclo Para (5 ejercicios)
   • Ciclo Mientras (5 ejercicios)
   • Ciclo Repetir (5 ejercicios)

🎯 TOTAL: 25 ejercicios prácticos

💻 TECNOLOGÍA:
   • Lenguaje: Python 3.x
   • Paradigma: Programación estructurada
   • Enfoque: Educativo y didáctico

🏗️  ESTRUCTURA DEL PROYECTO:
   taller1_lilliana/
   └── python/
       ├── estructura_secuencial/
       ├── funciones/
       ├── para/
       ├── mientras/
       └── repetir/

📖 METODOLOGÍA:
   • Cada ejercicio incluye documentación detallada
   • Análisis paso a paso de algoritmos
   • Comparación entre diferentes enfoques
   • Validación y manejo de errores
   • Estadísticas y verificaciones matemáticas

🎓 NIVEL: Intermedio
🕐 DURACIÓN ESTIMADA: 2-3 horas
""")

def ejecutar_todos():
    """Ejecuta todos los ejercicios del taller"""
    print("\n🚀 EJECUTANDO TODOS LOS EJERCICIOS DEL TALLER")
    print("="*50)

    # Estructura de ejercicios
    ejercicios = {
        "Algoritmos Secuenciales": [
            "estructura_secuencial/ejercicio1/figura_basico.py",
            "estructura_secuencial/ejercicio2/promedio_basico.py",
            "estructura_secuencial/ejercicio3/par_impar.py",
            "estructura_secuencial/ejercicio4/factorial.py",
            "estructura_secuencial/ejercicio5/temperatura.py"
        ],
        "Funciones Matemáticas": [
            "funciones/ejercicio1/raiz.py",
            "funciones/ejercicio2/potencia.py",
            "funciones/ejercicio3/seno.py",
            "funciones/ejercicio4/coseno.py",
            "funciones/ejercicio5/tangente.py"
        ],
        "Ciclos Para": [
            "para/ejercicio1/numeros1.py",
            "para/ejercicio2/sumar_pares.py",
            "para/ejercicio3/multiplicar.py",
            "para/ejercicio4/impares.py",
            "para/ejercicio5/promedio_calificaciones.py"
        ],
        "Ciclos Mientras": [
            "mientras/ejercicio1/lectura_numeros.py",
            "mientras/ejercicio2/suma_positivos.py",
            "mientras/ejercicio3/factorial_mientras.py",
            "mientras/ejercicio4/pares_mientras.py",
            "mientras/ejercicio5/adivinanzas.py"
        ],
        "Ciclos Repetir": [
            "repetir/ejercicio1/repetir_numeros.py",
            "repetir/ejercicio2/suma_pares_repetir.py",
            "repetir/ejercicio3/tabla_cinco_repetir.py",
            "repetir/ejercicio4/impares_repetir.py",
            "repetir/ejercicio5/calificaciones_repetir.py"
        ]
    }

    base_path = os.path.dirname(os.path.abspath(__file__))

    for seccion, archivos in ejercicios.items():
        print(f"\n📁 {seccion.upper()}")
        print("-" * (len(seccion) + 4))

        for i, archivo in enumerate(archivos, 1):
            ruta_completa = os.path.join(base_path, archivo)
            print(f"\n{i}. Ejecutando {os.path.basename(archivo)}...")

            if os.path.exists(ruta_completa):
                try:
                    # Ejecutar cada ejercicio
                    directorio_original = os.getcwd()
                    directorio_ejercicio = os.path.dirname(ruta_completa)
                    nombre_archivo = os.path.basename(ruta_completa)

                    os.chdir(directorio_ejercicio)
                    os.system(f'python "{nombre_archivo}"')
                    os.chdir(directorio_original)

                    print(f"✅ {archivo} completado")
                except Exception as e:
                    print(f"❌ Error en {archivo}: {e}")
            else:
                print(f"❌ No encontrado: {archivo}")

            if i < len(archivos):
                input("Presione Enter para el siguiente ejercicio...")

    print(f"\n🎉 ¡TODOS LOS EJERCICIOS COMPLETADOS!")
    print("="*40)

def main():
    """Función principal del menú"""
    while True:
        limpiar_pantalla()
        mostrar_titulo()
        mostrar_menu_principal()

        try:
            opcion = input("\nIngrese su opción (1-8): ")

            # Obtener la ruta base del script actual
            base_path = os.path.dirname(os.path.abspath(__file__))

            if opcion == "1":
                # Algoritmos Secuenciales
                while True:
                    limpiar_pantalla()
                    mostrar_titulo()
                    mostrar_menu_secuencial()

                    sub_opcion = input("\nIngrese su opción (1-6): ")

                    if sub_opcion == "1":
                        archivo = os.path.join(base_path, "estructura_secuencial/ejercicio1/figura_basico.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "2":
                        archivo = os.path.join(base_path, "estructura_secuencial/ejercicio2/promedio_basico.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "3":
                        archivo = os.path.join(base_path, "estructura_secuencial/ejercicio3/par_impar.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "4":
                        archivo = os.path.join(base_path, "estructura_secuencial/ejercicio4/factorial.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "5":
                        archivo = os.path.join(base_path, "estructura_secuencial/ejercicio5/temperatura.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "6":
                        break
                    else:
                        print("❌ Opción inválida")
                        input("Presione Enter para continuar...")

            elif opcion == "2":
                # Funciones Matemáticas
                while True:
                    limpiar_pantalla()
                    mostrar_titulo()
                    mostrar_menu_funciones()

                    sub_opcion = input("\nIngrese su opción (1-6): ")

                    if sub_opcion == "1":
                        archivo = os.path.join(base_path, "funciones/ejercicio1/raiz.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "2":
                        archivo = os.path.join(base_path, "funciones/ejercicio2/potencia.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "3":
                        archivo = os.path.join(base_path, "funciones/ejercicio3/seno.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "4":
                        archivo = os.path.join(base_path, "funciones/ejercicio4/coseno.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "5":
                        archivo = os.path.join(base_path, "funciones/ejercicio5/tangente.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "6":
                        break
                    else:
                        print("❌ Opción inválida")
                        input("Presione Enter para continuar...")

            elif opcion == "3":
                # Ciclos Para
                while True:
                    limpiar_pantalla()
                    mostrar_titulo()
                    mostrar_menu_para()

                    sub_opcion = input("\nIngrese su opción (1-6): ")

                    if sub_opcion == "1":
                        archivo = os.path.join(base_path, "para/ejercicio1/numeros1.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "2":
                        archivo = os.path.join(base_path, "para/ejercicio2/sumar_pares.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "3":
                        archivo = os.path.join(base_path, "para/ejercicio3/multiplicar.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "4":
                        archivo = os.path.join(base_path, "para/ejercicio4/impares.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "5":
                        archivo = os.path.join(base_path, "para/ejercicio5/promedio_calificaciones.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "6":
                        break
                    else:
                        print("❌ Opción inválida")
                        input("Presione Enter para continuar...")

            elif opcion == "4":
                # Ciclos Mientras
                while True:
                    limpiar_pantalla()
                    mostrar_titulo()
                    mostrar_menu_mientras()

                    sub_opcion = input("\nIngrese su opción (1-6): ")

                    if sub_opcion == "1":
                        archivo = os.path.join(base_path, "mientras/ejercicio1/lectura_numeros.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "2":
                        archivo = os.path.join(base_path, "mientras/ejercicio2/suma_positivos.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "3":
                        archivo = os.path.join(base_path, "mientras/ejercicio3/factorial_mientras.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "4":
                        archivo = os.path.join(base_path, "mientras/ejercicio4/pares_mientras.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "5":
                        archivo = os.path.join(base_path, "mientras/ejercicio5/adivinanzas.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "6":
                        break
                    else:
                        print("❌ Opción inválida")
                        input("Presione Enter para continuar...")

            elif opcion == "5":
                # Ciclos Repetir
                while True:
                    limpiar_pantalla()
                    mostrar_titulo()
                    mostrar_menu_repetir()

                    sub_opcion = input("\nIngrese su opción (1-6): ")

                    if sub_opcion == "1":
                        archivo = os.path.join(base_path, "repetir/ejercicio1/repetir_numeros.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "2":
                        archivo = os.path.join(base_path, "repetir/ejercicio2/suma_pares_repetir.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "3":
                        archivo = os.path.join(base_path, "repetir/ejercicio3/tabla_cinco_repetir.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "4":
                        archivo = os.path.join(base_path, "repetir/ejercicio4/impares_repetir.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "5":
                        archivo = os.path.join(base_path, "repetir/ejercicio5/calificaciones_repetir.py")
                        ejecutar_ejercicio(archivo)
                    elif sub_opcion == "6":
                        break
                    else:
                        print("❌ Opción inválida")
                        input("Presione Enter para continuar...")

            elif opcion == "6":
                # Ejecutar todos
                limpiar_pantalla()
                mostrar_titulo()
                ejecutar_todos()
                input("\nPresione Enter para volver al menú principal...")

            elif opcion == "7":
                # Información
                limpiar_pantalla()
                mostrar_titulo()
                mostrar_informacion()
                input("\nPresione Enter para volver al menú principal...")

            elif opcion == "8":
                # Salir
                print("\n👋 ¡Gracias por usar el taller!")
                print("🎓 Esperamos que hayas aprendido mucho")
                print("="*40)
                sys.exit(0)

            else:
                print("❌ Opción inválida. Por favor seleccione una opción válida (1-8).")
                input("Presione Enter para continuar...")

        except KeyboardInterrupt:
            print("\n\n👋 ¡Hasta luego!")
            sys.exit(0)
        except Exception as e:
            print(f"❌ Error inesperado: {e}")
            input("Presione Enter para continuar...")

if __name__ == "__main__":
    main()