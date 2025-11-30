# 13) Hacer un vector de 30 números y mostrar la suma de los pares y el
# producto de los que son múltiplo de 5.

from rich import print
import numpy as np

vector = np.random.randint(1, 100, 30) #uso numpy para que me genere una lista aleatoria
suma = 0
multi = []
print(f"[magenta]El vector es: {vector}[/]")
for numero in vector: # uso in para traer cada elementro del vector
    if numero % 2 == 0: 
        suma += numero
    if numero % 5 == 0: #para hallar los que son multiplos de 5
        multi.append(numero)
producto = np.prod(multi)#los multiplos de 5 los almaceno en una lista ya que como son muchos numeros da error al usar  *= entonces investigando con prod de numpy permite manejar esos valores
        
print(f"[blue]La suma de sus números pares es: {suma}[/]")
print(f"[red]El producto de los multiplos de 5 es: {producto}[/]")