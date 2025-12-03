from datetime import datetime
from typing import List, Optional
from decimal import Decimal

class Producto:
    """
    Entidad Producto - Representa un producto del catálogo
    Aplica: Encapsulamiento, Validaciones de Negocio
    """
    
    def __init__(self, id: int, nombre: str, descripcion: str, 
                 precio_base: Decimal, usuario_creador_id: int = None):
        # Atributos privados (encapsulamiento)
        self._id = id
        self._nombre = nombre
        self._descripcion = descripcion
        self._precio_base = precio_base
        self._activo = True
        self._aprobado = False
        self._fecha_creacion = datetime.now()
        self._usuario_creador_id = usuario_creador_id
        self._usuario_aprobador_id = None
        self._fecha_aprobacion = None
        
        # Listas de composición
        self._variantes: List['Variante'] = []
        self._imagenes: List['Imagen'] = []
        
        # Validar al crear
        self._validar()
    
    def _validar(self):
        """Método privado para validaciones de negocio"""
        if not self._nombre or len(self._nombre.strip()) == 0:
            raise ValueError("El nombre del producto no puede estar vacío")
        
        if len(self._nombre) > 100:
            raise ValueError("El nombre no puede exceder 100 caracteres")
        
        if len(self._descripcion) > 500:
            raise ValueError("La descripción no puede exceder 500 caracteres")
        
        if self._precio_base <= 0:
            raise ValueError("El precio base debe ser mayor a 0")
    
    # Properties (Getters) - Acceso controlado a atributos privados
    @property
    def id(self) -> int:
        return self._id
    
    @property
    def nombre(self) -> str:
        return self._nombre
    
    @property
    def descripcion(self) -> str:
        return self._descripcion
    
    @property
    def precio_base(self) -> Decimal:
        return self._precio_base
    
    @property
    def activo(self) -> bool:
        return self._activo
    
    @property
    def aprobado(self) -> bool:
        return self._aprobado
    
    @property
    def fecha_creacion(self) -> datetime:
        return self._fecha_creacion
    
    @property
    def variantes(self) -> List['Variante']:
        return self._variantes.copy()  # Retorna copia para proteger lista interna
    
    @property
    def imagenes(self) -> List['Imagen']:
        return self._imagenes.copy()
    
    # Métodos de negocio públicos
    def agregar_variante(self, talla: str, color_hex: str, color_nombre: str, 
                        stock: int, precio_variante: Decimal = None) -> 'Variante':
        """Agrega una variante al producto (Composición)"""
        # Validar límites de negocio (RN-015)
        if len(self._variantes) >= 40:  # 4 tallas x 10 colores
            raise ValueError("Se alcanzó el límite máximo de variantes")
        
        # Validar talla permitida
        tallas_validas = ['S', 'M', 'L', 'XL']
        if talla not in tallas_validas:
            raise ValueError(f"Talla inválida. Permitidas: {tallas_validas}")
        
        # Crear variante
        variante = Variante(
            id=len(self._variantes) + 1,
            producto_id=self._id,
            talla=talla,
            color_hex=color_hex,
            color_nombre=color_nombre,
            stock=stock,
            precio_variante=precio_variante
        )
        
        self._variantes.append(variante)
        return variante
    
    def agregar_imagen(self, ruta: str, alt_text: str, es_principal: bool = False) -> 'Imagen':
        """Agrega una imagen al producto (Composición)"""
        # Validar límite de imágenes (RN-014)
        if len(self._imagenes) >= 5:
            raise ValueError("Máximo 5 imágenes por producto")
        
        # Si es principal, desmarcar las demás
        if es_principal:
            for img in self._imagenes:
                img._principal = False
        
        imagen = Imagen(
            id=len(self._imagenes) + 1,
            producto_id=self._id,
            ruta_imagen=ruta,
            alt_text=alt_text,
            principal=es_principal,
            orden=len(self._imagenes) + 1
        )
        
        self._imagenes.append(imagen)
        return imagen
    
    def aprobar(self, usuario_aprobador_id: int) -> None:
        """Aprueba el producto para el catálogo público (RF-031)"""
        # Validar que cumpla requisitos mínimos
        if not self.tiene_configuracion_minima():
            raise ValueError("El producto no cumple con la configuración mínima requerida")
        
        self._aprobado = True
        self._usuario_aprobador_id = usuario_aprobador_id
        self._fecha_aprobacion = datetime.now()
    
    def desaprobar(self, motivo: str) -> None:
        """Desaprueba el producto (RF-032)"""
        if len(motivo) > 200:
            raise ValueError("El motivo no puede exceder 200 caracteres")
        
        self._aprobado = False
        self._fecha_aprobacion = None
    
    def activar(self) -> None:
        """Activa el producto"""
        self._activo = True
    
    def desactivar(self) -> None:
        """Desactiva el producto (Soft Delete - RF-029)"""
        self._activo = False
    
    def tiene_configuracion_minima(self) -> bool:
        """Verifica si el producto cumple con los requisitos mínimos (RN-017)"""
        tiene_nombre = len(self._nombre) > 0
        tiene_descripcion = len(self._descripcion) > 0
        tiene_imagen_principal = any(img.principal for img in self._imagenes)
        tiene_variante = len(self._variantes) > 0
        tiene_stock = any(v.stock > 0 for v in self._variantes)
        
        return all([tiene_nombre, tiene_descripcion, tiene_imagen_principal, 
                   tiene_variante, tiene_stock])
    
    def calcular_precio_minimo(self) -> Decimal:
        """Calcula el precio mínimo entre todas las variantes"""
        if not self._variantes:
            return self._precio_base
        
        precios = [v.precio_final(self._precio_base) for v in self._variantes]
        return min(precios)
    
    def stock_total(self) -> int:
        """Calcula el stock total de todas las variantes"""
        return sum(v.stock for v in self._variantes)
    
    def actualizar_info(self, nombre: str = None, descripcion: str = None, 
                       precio_base: Decimal = None) -> None:
        """Actualiza información básica del producto (RF-022)"""
        if nombre:
            if len(nombre) > 100:
                raise ValueError("El nombre no puede exceder 100 caracteres")
            self._nombre = nombre
        
        if descripcion:
            if len(descripcion) > 500:
                raise ValueError("La descripción no puede exceder 500 caracteres")
            self._descripcion = descripcion
        
        if precio_base:
            if precio_base <= 0:
                raise ValueError("El precio base debe ser mayor a 0")
            self._precio_base = precio_base
    
    def obtener_info(self) -> dict:
        """Retorna información completa del producto"""
        return {
            'id': self._id,
            'nombre': self._nombre,
            'descripcion': self._descripcion,
            'precio_base': float(self._precio_base),
            'precio_minimo': float(self.calcular_precio_minimo()),
            'activo': self._activo,
            'aprobado': self._aprobado,
            'fecha_creacion': self._fecha_creacion.isoformat(),
            'stock_total': self.stock_total(),
            'num_variantes': len(self._variantes),
            'num_imagenes': len(self._imagenes),
            'configuracion_completa': self.tiene_configuracion_minima()
        }
    
    def __str__(self) -> str:
        return f"Producto(id={self._id}, nombre='{self._nombre}', precio=${self._precio_base})"
    
    def __repr__(self) -> str:
        return self.__str__()
