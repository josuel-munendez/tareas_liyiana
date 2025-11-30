# 12) Leer una secuencia de números y sumar solo los pares mostrando el
# resultado del proceso.

from rich import print
import numpy as np

vector = np.random.randint(1, 100, 5) #uso numpy para que me genere una lista aleatoria

print(f"[magenta]El vector es: {vector}[/]")
suma = 0
for numero in vector: # uso in para traer cada elementro del vector
    if numero % 2 == 0: 
        suma += numero
        
print(f"[blue]La suma de sus números pares es: {suma}[/]")