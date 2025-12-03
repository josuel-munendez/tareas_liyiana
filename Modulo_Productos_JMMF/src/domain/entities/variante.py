class Variante:
    """
    Entidad Variante - Representa una combinación de talla y color
    Relación de COMPOSICIÓN con Producto (no existe sin Producto)
    """
    
    def __init__(self, id: int, producto_id: int, talla: str, 
                 color_hex: str, color_nombre: str, stock: int,
                 precio_variante: Decimal = None):
        # Atributos privados
        self._id = id
        self._producto_id = producto_id
        self._talla = talla
        self._color_hex = color_hex
        self._color_nombre = color_nombre
        self._stock = stock
        self._precio_variante = precio_variante
        self._fecha_creacion = datetime.now()
        
        # Validar
        self._validar()
    
    def _validar(self):
        """Validaciones de negocio para variantes"""
        # Validar formato HEX (RN-015)
        if not self._color_hex.startswith('#') or len(self._color_hex) != 7:
            raise ValueError("Color debe estar en formato HEX (#RRGGBB)")
        
        # Validar stock >= 0
        if self._stock < 0:
            raise ValueError("El stock no puede ser negativo")
        
        # Validar precio variante si existe
        if self._precio_variante is not None and self._precio_variante <= 0:
            raise ValueError("El precio de variante debe ser mayor a 0")
    
    @property
    def id(self) -> int:
        return self._id
    
    @property
    def talla(self) -> str:
        return self._talla
    
    @property
    def color_hex(self) -> str:
        return self._color_hex
    
    @property
    def color_nombre(self) -> str:
        return self._color_nombre
    
    @property
    def stock(self) -> int:
        return self._stock
    
    def precio_final(self, precio_base_producto: Decimal) -> Decimal:
        """
        Retorna el precio final de la variante
        Si tiene precio_variante usa ese, sino usa el precio_base
        """
        return self._precio_variante if self._precio_variante else precio_base_producto
    
    def actualizar_stock(self, cantidad: int) -> None:
        """Actualiza el stock de la variante (RF-023)"""
        nuevo_stock = self._stock + cantidad
        if nuevo_stock < 0:
            raise ValueError("El stock no puede ser negativo")
        self._stock = nuevo_stock
    
    def reducir_stock(self, cantidad: int) -> None:
        """Reduce el stock (usado al hacer una venta)"""
        if cantidad > self._stock:
            raise ValueError("Stock insuficiente")
        self._stock -= cantidad
    
    def validar_disponibilidad(self, cantidad_solicitada: int) -> bool:
        """Verifica si hay stock suficiente"""
        return self._stock >= cantidad_solicitada
    
    def obtener_info(self) -> dict:
        return {
            'id': self._id,
            'talla': self._talla,
            'color_hex': self._color_hex,
            'color_nombre': self._color_nombre,
            'stock': self._stock,
            'precio_variante': float(self._precio_variante) if self._precio_variante else None
        }
    
    def __str__(self) -> str:
        return f"Variante(talla={self._talla}, color={self._color_nombre}, stock={self._stock})"
