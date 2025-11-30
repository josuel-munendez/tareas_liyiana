# 6). De una matriz 5*5 llenar la diagonal principal con la letra A:

from rich import print
matriz = [
    [25, 12, 26, 7, 15],
    [12, 12, 2, 9, 25],
    [25, 6, 4, 25, 6],
    [1, 4, 6, 10, 9],
    [2, 25, 8, 5, 8]
        
]
for f, fila in enumerate(matriz):
    for c, elemento in enumerate(fila):
        if c == f:
            matriz[f][c] = "A"  # ingreo la letra a en la matriz
            print(f"[red]{matriz[f][c]:^5}[/]", end="")  #imprimo la nueva matriz porque si se imprime elemento va a tener almacenado la anterior matriz
        # uso el ^5 ya que permite dar 5 espacios mas ^ para centrarlo ya que con el :5 queda muy feo
        else:
            print(f"{elemento:^5}", end="")  
    print()