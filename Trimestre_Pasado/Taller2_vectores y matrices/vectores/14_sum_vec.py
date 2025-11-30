# 14) Realizar un vector A y B, y sumarlos, es decir posición uno de a y b
# sumarse y llevarlo a un vector c.
# no usare numpy sino con un ciclo
vectorA = [2,4,5,6]
vectorB = [1,2,3,1]
vectorC = []
suma = 0

max_pos = max(len(vectorA), len(vectorB))

for i in range(max_pos): #traemos cada valor de los vectores y los sumanmos y los agregamos al vector C
    num1 = vectorA[i]
   
    num2 = vectorB[i]
    suma = num1 + num2
    vectorC.append(suma)

    
   
    
print("Vector A: ",vectorA)   
print("Vector B: ",vectorB) 
print(f"la suma de los dos vectores es, Vector C: {vectorC}")