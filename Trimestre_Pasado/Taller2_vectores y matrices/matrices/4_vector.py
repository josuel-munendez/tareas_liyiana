# 4). Hacer un vector 1 x 10, cuyo contenido sea las tablas de multiplicar del 9, solo
# puedes ingresar el número 9 y el 1 para calcular la tabla, el algoritmo debe calcular los demás
# números por si solo, ¿Cómo lo harías?

tabla9= [] #inicio el vector vacio
suma= 9 #como el algoritmo dice que solo se use el uno y el 9, entonces no lo inicio con cero
tabla9.append(suma)  #lo agrego de una vez al vector
for i in range(1,9+1): #lo comienzo desde uno pero termina has 10, pero se sabe que es hasta 9, pero ya tenemos uno guardado
    suma += 9 #sumamos cada nueve
    tabla9.append(suma) # lo agregamos
    
print("Tabla del 9:")    
print(tabla9)