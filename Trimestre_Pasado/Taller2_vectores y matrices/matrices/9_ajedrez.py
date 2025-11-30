# 9) Realizar un algoritmo que resalte la siguiente área.
from rich import print
matriz = [
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0]    
]

for f, filas in enumerate(matriz):
    for c, elemento in enumerate(filas):
        if (f+c) % 2 == 0: #lo que va hacer es como es par o impar cada posicion del  elemento, entonces se van aa sumar tanto fila como columna y si es par lo pinta, 
            matriz[f][c] = 1 #agrego uno para que se entienda mejor
            print(f"[red]{matriz[f][c]:5}[/]", end="")
        else:
            print(f"{elemento:5}", end="")
            
    print()