import mysql.connector

conexion = mysql.connector.connect(
    host="localhost",  
    user="root",    
    password="",
    database="red"
)
cursor = conexion.cursor(dictionary=True)

def crear_usuario(nombre, apellido, email, contrasena, rol="cliente"):
    sql = "INSERT INTO USUARIO (nombre, apellido, email, contrasena, rol) VALUES (%s, %s, %s, SHA2(%s,256), %s)"
    cursor.execute(sql, (nombre, apellido, email, contrasena, rol))
    conexion.commit()
    print("Usuario creado")

def leer_usuarios():
    cursor.execute("SELECT usuario_id, nombre, apellido, email, rol FROM USUARIO")
    for fila in cursor.fetchall():
        print(fila)

def actualizar_usuario(uid, nombre=None, rol=None):
    if nombre:
        cursor.execute("UPDATE USUARIO SET nombre=%s WHERE usuario_id=%s", (nombre, uid))
    if rol:
        cursor.execute("UPDATE USUARIO SET rol=%s WHERE usuario_id=%s", (rol, uid))
    conexion.commit()
    print("Usuario actualizado")

def eliminar_usuario(uid):
    cursor.execute("DELETE FROM USUARIO WHERE usuario_id=%s", (uid,))
    conexion.commit()
    print("Usuario eliminado")


def crear_producto(nombre, precio, categoria, tipo, descripcion):
    sql = "INSERT INTO PRODUCTO (nombre, precio_base, categoria, tipo, descripcion) VALUES (%s,%s,%s,%s,%s)"
    cursor.execute(sql, (nombre, precio, categoria, tipo, descripcion))
    conexion.commit()
    print("Producto creado")

def leer_productos():
    cursor.execute("SELECT producto_id, nombre, precio_base FROM PRODUCTO")
    for fila in cursor.fetchall():
        print(fila)

def crear_inventario(producto_id, talla, color, stock):
    sql = "INSERT INTO INVENTARIO (producto_id, talla, color, stock) VALUES (%s,%s,%s,%s)"
    cursor.execute(sql, (producto_id, talla, color, stock))
    conexion.commit()
    print("Inventario agregado")

def leer_inventario():
    cursor.execute("SELECT inventario_id, producto_id, talla, color, stock FROM INVENTARIO")
    for fila in cursor.fetchall():
        print(fila)

def menu():
    while True:
        print("\n--- MENÚ CRUD MYSQL ---")
        print("1. Crear usuario")
        print("2. Ver usuarios")
        print("3. Crear producto")
        print("4. Ver productos")
        print("5. Crear inventario")
        print("6. Ver inventario")
        print("0. Salir")

        op = input("Elige una opción: ")

        if op == "1":
            nombre = input("Nombre: ")
            apellido = input("Apellido: ")
            email = input("Email: ")
            contrasena = input("Contraseña: ")
            rol = input("Rol (cliente/diseñador/admin/revisor): ")
            crear_usuario(nombre, apellido, email, contrasena, rol)

        elif op == "2":
            leer_usuarios()

        elif op == "3":
            nombre = input("Nombre producto: ")
            precio = float(input("Precio base: "))
            categoria = input("Categoría: ")
            tipo = input("Tipo (camiseta, hoodie, taza...): ")
            descripcion = input("Descripción: ")
            crear_producto(nombre, precio, categoria, tipo, descripcion)

        elif op == "4":
            leer_productos()

        elif op == "5":
            producto_id = int(input("ID producto: "))
            talla = input("Talla (S,M,L,N/A): ")
            color = input("Color: ")
            stock = int(input("Stock: "))
            crear_inventario(producto_id, talla, color, stock)

        elif op == "6":
            leer_inventario()

        elif op == "0":
            break

        else:
            print(" Opción inválida")

menu()

cursor.close()
conexion.close()
