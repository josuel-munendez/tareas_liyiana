matrizA = [
    [6,1],
    [8,-2]     
           ]
matrizB = [
    [7,-2],
    [-1,4]     
           ]

matrizC = []
for f in range(2):
    fila = []
    for c in range(2):
        suma = matrizA[f][c] + matrizB[f][c]
        fila.append(suma)
    matrizC.append(fila)
    
for f in matrizC:
   print(f)
    
