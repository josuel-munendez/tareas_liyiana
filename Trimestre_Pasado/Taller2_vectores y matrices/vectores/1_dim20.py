# 1) Hacer un vector dimensión 20, que sea capaz por si solo de guardar la
# siguiente sucesiones de números, 1,3,5,7,9,11,13,15,17,19,21,23,25

# Lo que analice es que el arreglo es impar entonces puedo usar esa logica para seleccionar los numeros


tamaño = 20  # Defino el tamaño del vector, en este caso 20 elementos

vector = []  # Inicializo un vector vacío

for i in range(tamaño):  # Recorro segun el tamaño del vector, y comenzar por defecto en 0
    vector.append(i*2+1) #la funcion append agrega el elemento al final del vector
    #lo que va hacer es en cada iteracion va multiplicar por 2 y sumar 1 para que sea impar

print("\033[34m Vector:", vector)  
    
