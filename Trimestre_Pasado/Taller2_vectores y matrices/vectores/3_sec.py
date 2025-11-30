# 3) Realizar Un vector capaz de almacenar por sí solo los siguientes números,
#  1,2,6,9,12,15,18,21,24,27,30


# Lo que vi en comun es que el arreglo o el vector tiene un incremento de 3 o multiplo de 3, 
# pero con un inicio de 1 y 2

tamaño = 11  # Defino el tamaño del vector, en este caso 11 elementos
vector = []  # Inicializo un vector vacío
for i in range(tamaño):  # Recorro segun el tamaño del vector, y comenzar por defecto en 0
    if i == 0:  # Si es el primer elemento, lo agrego como 1
        vector.append(1)
    elif i == 1:  
        vector.append(2)
    else:  
        vector.append(i * 3) #ya despues de agregar los dos primeros numeros, ahora si continuamos con los multiplos de 3 
print("\033[34m Vector:", vector)  # Luego imprimo el vector