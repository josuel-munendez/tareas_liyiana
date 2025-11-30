#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Taller de Estructuras de Control - Ciclo Mientras
Ejercicio 5: Juego de adivinanzas con número secreto
Autor: Lilliana
Fecha: 3 de octubre de 2025
"""

import random

def generar_numero_secreto(min_val=1, max_val=100):
    """Genera un número secreto aleatorio en el rango dado"""
    return random.randint(min_val, max_val)

def obtener_pista(numero_secreto, intento):
    """Genera una pista basada en la diferencia entre el intento y el número secreto"""
    diferencia = abs(numero_secreto - intento)

    if diferencia == 0:
        return "¡CORRECTO! 🎉"
    elif diferencia <= 5:
        return "¡Muy caliente! 🔥"
    elif diferencia <= 10:
        return "Caliente 🌡️"
    elif diferencia <= 20:
        return "Tibio 😐"
    elif diferencia <= 30:
        return "Frío ❄️"
    else:
        return "¡Muy frío! 🧊"

def clasificar_dificultad(intentos, max_intentos):
    """Clasifica el desempeño del jugador"""
    porcentaje = (intentos / max_intentos) * 100

    if intentos == 1:
        return "¡INCREÍBLE! 🏆", "Adivinaste en el primer intento"
    elif porcentaje <= 30:
        return "EXCELENTE 🥇", "Muy pocas adivinanzas"
    elif porcentaje <= 50:
        return "MUY BUENO 🥈", "Buen desempeño"
    elif porcentaje <= 70:
        return "BUENO 🥉", "Desempeño promedio"
    elif porcentaje <= 90:
        return "REGULAR 😐", "Podrías mejorar"
    else:
        return "NECESITAS PRÁCTICA 😅", "Muchos intentos"

def main():
    print("=================================")
    print(" EJERCICIO 5: Juego de Adivinanzas")
    print("=================================\n")

    # Configuración del juego
    print("🎮 ¡Bienvenido al Juego de Adivinanzas!")
    print("Voy a pensar en un número y tú tendrás que adivinarlo.")
    print()

    try:
        # Configurar dificultad
        print("Selecciona la dificultad:")
        print("1. Fácil (1-50, 10 intentos)")
        print("2. Medio (1-100, 8 intentos)")
        print("3. Difícil (1-200, 6 intentos)")
        print("4. Experto (1-500, 5 intentos)")

        dificultad = int(input("\nIngresa tu opción (1-4): "))

        # Configurar parámetros según dificultad
        if dificultad == 1:
            min_val, max_val, max_intentos = 1, 50, 10
            nivel = "FÁCIL"
        elif dificultad == 2:
            min_val, max_val, max_intentos = 1, 100, 8
            nivel = "MEDIO"
        elif dificultad == 3:
            min_val, max_val, max_intentos = 1, 200, 6
            nivel = "DIFÍCIL"
        elif dificultad == 4:
            min_val, max_val, max_intentos = 1, 500, 5
            nivel = "EXPERTO"
        else:
            print("Opción inválida. Usando dificultad MEDIO.")
            min_val, max_val, max_intentos = 1, 100, 8
            nivel = "MEDIO"

        # Generar número secreto
        numero_secreto = generar_numero_secreto(min_val, max_val)

        print(f"\n🎯 CONFIGURACIÓN DEL JUEGO:")
        print("-" * 26)
        print(f"• Nivel: {nivel}")
        print(f"• Rango: {min_val} - {max_val}")
        print(f"• Intentos máximos: {max_intentos}")
        print(f"• Número secreto generado ✅")

        print(f"\n🎲 ¡Comencemos! Adivina el número entre {min_val} y {max_val}")
        print("=" * 50)

        # Variables del juego
        intentos = 0
        adivinado = False
        historial_intentos = []

        # Ciclo principal del juego (mientras)
        while intentos < max_intentos and not adivinado:
            intentos += 1

            try:
                print(f"\nIntento {intentos}/{max_intentos}")
                intento = int(input(f"Tu número ({min_val}-{max_val}): "))

                # Validar rango
                if intento < min_val or intento > max_val:
                    print(f"⚠️  El número debe estar entre {min_val} y {max_val}")
                    intentos -= 1  # No contar como intento válido
                    continue

                # Verificar si ya se intentó este número
                if intento in historial_intentos:
                    print(f"⚠️  Ya intentaste el {intento} antes")
                    intentos -= 1  # No contar como intento válido
                    continue

                historial_intentos.append(intento)

                # Verificar si es correcto
                if intento == numero_secreto:
                    adivinado = True
                    print(f"\n🎉 ¡FELICITACIONES! 🎉")
                    print(f"¡Adivinaste el número {numero_secreto} en {intentos} intentos!")
                    break

                # Dar pistas
                pista_temperatura = obtener_pista(numero_secreto, intento)

                if intento < numero_secreto:
                    direccion = "El número secreto es MAYOR 📈"
                else:
                    direccion = "El número secreto es MENOR 📉"

                print(f"❌ Incorrecto. {direccion}")
                print(f"🌡️  Pista: {pista_temperatura}")
                print(f"📝 Intentos usados: {historial_intentos}")

            except ValueError:
                print("❌ Por favor ingresa un número válido")
                intentos -= 1  # No contar como intento válido
                continue

        # Resultado final
        print(f"\n" + "="*60)
        print("RESULTADO FINAL DEL JUEGO")
        print("="*60)

        if adivinado:
            # Jugador ganó
            clasificacion, descripcion = clasificar_dificultad(intentos, max_intentos)

            print(f"🏆 ¡GANASTE!")
            print(f"• Número secreto: {numero_secreto}")
            print(f"• Intentos utilizados: {intentos}/{max_intentos}")
            print(f"• Calificación: {clasificacion}")
            print(f"• Comentario: {descripcion}")

            # Estadísticas del juego
            eficiencia = ((max_intentos - intentos + 1) / max_intentos) * 100
            print(f"• Eficiencia: {eficiencia:.1f}%")

            if intentos == 1:
                print("🎯 ¡Imposible! ¿Tuviste suerte o eres psíquico?")
            elif intentos <= max_intentos // 3:
                print("🧠 Excelente estrategia y un poco de suerte")
            elif intentos <= max_intentos // 2:
                print("👍 Buen razonamiento lógico")
            else:
                print("🤔 La persistencia es clave")

        else:
            # Jugador perdió
            print(f"😞 ¡Se acabaron los intentos!")
            print(f"• Número secreto era: {numero_secreto}")
            print(f"• Intentos utilizados: {intentos}/{max_intentos}")
            print(f"• ¡Mejor suerte la próxima vez!")

        # Análisis del historial
        if historial_intentos:
            print(f"\n📊 ANÁLISIS DEL HISTORIAL:")
            print("-" * 27)
            print(f"• Números intentados: {historial_intentos}")
            print(f"• Rango explorado: {min(historial_intentos)} - {max(historial_intentos)}")

            # Calcular distancias
            distancias = [abs(numero_secreto - intento) for intento in historial_intentos]
            print(f"• Mejor aproximación: {min(distancias)} (número {historial_intentos[distancias.index(min(distancias))]})")
            print(f"• Peor intento: {max(distancias)} (número {historial_intentos[distancias.index(max(distancias))]})")

            # Progreso
            if len(distancias) > 1:
                mejorando = sum(1 for i in range(1, len(distancias)) if distancias[i] < distancias[i-1])
                empeorando = sum(1 for i in range(1, len(distancias)) if distancias[i] > distancias[i-1])
                print(f"• Intentos que mejoraron: {mejorando}")
                print(f"• Intentos que empeoraron: {empeorando}")

        # Información sobre estrategias
        print(f"\n💡 ESTRATEGIAS RECOMENDADAS:")
        print("-" * 29)
        print(f"• Búsqueda binaria: Empezar por el medio del rango")
        print(f"• Dividir y conquistar: Reducir el rango a la mitad cada vez")
        print(f"• Usar las pistas de temperatura para ajustar")
        print(f"• No repetir números ya intentados")

        # Ejemplo de estrategia óptima
        print(f"\n🎯 ESTRATEGIA ÓPTIMA PARA TU NIVEL:")
        print("-" * 35)
        rango_actual = max_val - min_val + 1
        intentos_teoricos = 1
        temp_rango = rango_actual

        print(f"Con búsqueda binaria en rango {min_val}-{max_val}:")
        paso = 1
        while temp_rango > 1:
            temp_rango = temp_rango // 2
            intentos_teoricos += 1
            if paso <= 3:  # Mostrar solo primeros pasos
                mitad = (min_val + max_val) // 2
                print(f"Paso {paso}: Probar {mitad} (reduce rango a la mitad)")
                paso += 1

        print(f"Intentos teóricos mínimos: {intentos_teoricos}")
        print(f"Intentos disponibles: {max_intentos}")

        if max_intentos >= intentos_teoricos:
            print("✅ Suficientes intentos para ganar siempre con buena estrategia")
        else:
            print("⚠️  Nivel desafiante, requiere suerte además de estrategia")

        # Información sobre el algoritmo
        print(f"\n🔍 INFORMACIÓN DEL ALGORITMO:")
        print("-" * 31)
        print(f"• Estructura: Ciclo MIENTRAS con condiciones múltiples")
        print(f"• Condiciones: intentos < max_intentos AND not adivinado")
        print(f"• Tipo de ciclo: Indefinido (puede terminar antes)")
        print(f"• Validaciones: Rango, duplicados, formato")
        print(f"• Generación aleatoria: random.randint()")

        # Pregunta si quiere jugar de nuevo
        print(f"\n🔄 ¿Quieres jugar otra vez? (s/n): ", end="")
        jugar_otra_vez = input().lower()

        if jugar_otra_vez == 's' or jugar_otra_vez == 'si':
            print("\n" + "="*50)
            print("¡NUEVA PARTIDA!")
            print("="*50)
            main()  # Recursión para nueva partida
        else:
            print("\n🎮 ¡Gracias por jugar! ¡Hasta la próxima!")

        print("\n✅ Juego completado")
        print("=" * 25)

    except KeyboardInterrupt:
        print(f"\n\n⏹️  Juego interrumpido por el usuario.")
        print("¡Gracias por jugar!")
    except Exception as e:
        print(f"❌ Error inesperado: {e}")

if __name__ == "__main__":
    main()