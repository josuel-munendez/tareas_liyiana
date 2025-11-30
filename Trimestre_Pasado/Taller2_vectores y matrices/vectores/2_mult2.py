# 2) Realizar Un vector capaz de almacenar por sí solo los siguientes números,
# 2,4,6,8,10,12,14,16,18,20,22,24,26,28,30.

# Lo que vi en comun es que el arreglo o el vector tiene un incremento de 2 o multiplo de 2


tamaño = 15 # Defino el tamaño del vector, en este caso 15 elementos

vector =[] # Inicializo un vector vacío

for i in range(1, tamaño): #Hago que comience en 1 para que el primer elemento sea 2, hasta 15 que es la dimension del vector 
    vector.append(i * 2)  # Comienza en 2 y aumenta de 2 en 2
print("\033[34m Vector:", vector) 
