# 4) Realizar un vector que tenga almacenada las vocales, otro vector donde
#tenga almacenado el abecedario, cuando esté listo, el usuario pueda ver la
#posición de dichas letras, el objetivo es que pueda digitar los números de la
#posiciones y armar palabras de 3, 5 o 6 letras.
import string as st #impoto esta libreria para almacenar el abecedario en un array
 # Vector con el abecedario no entendi lo de vocales, porque el abecedario ya tiene las vocales
abecedario = list(st.ascii_lowercase)  # Vector con el abecedario en minúsculas


print("abecedario con sus posiciones:") #imprimo el abecedario
for i,lt in enumerate(abecedario): #enumerate me ayuda a obtener el indice y el valor del array
    
    print(f"{i}: {lt}") #imprimo el indice y la letra correspondiente del abecedario


veces = int(input("cuantas letras va a ingresar? "))  # Solicito al usuario cuántas letras quiere ingresar

letras = []  
for i in range(veces):  
    while True:  
        posicion = int(input(f"ingrese la posición de la letra {i + 1}: "))  # Solicito la posición de la letra
        if 0 <= posicion < len(abecedario):  
            letras.append(abecedario[posicion])  # Agrego la letra correspondiente a la lista
            break  
        else:
         print("Posición inválida. Debe estar entre 0 y 25.")  # Mensaje de error si la posición es inválida

print("\033[34m palabra formada:", ''.join(letras))  # Imprimo la palabra formada por las letras ingresadas