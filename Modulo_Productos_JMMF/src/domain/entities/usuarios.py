from abc import ABC, abstractmethod
from typing import List, Optional
from datetime import datetime
from enum import Enum


class EstadoUsuario(Enum):
    """Enumeración de estados de usuario"""
    ACTIVO = "Activo"
    INACTIVO = "Inactivo"
    BLOQUEADO = "Bloqueado"


class Usuario(ABC):
    """
    Clase abstracta Usuario - PADRE (HERENCIA)
    Demuestra ABSTRACCIÓN y base para POLIMORFISMO
    """
    
    def __init__(self, id: int, usuario: str, correo: str, contrasena: str):
        # ENCAPSULAMIENTO: Atributos privados con _
        self._id = id
        self._usuario = usuario
        self._correo = correo
        self._contrasena = self._hashear_contrasena(contrasena)
        self._estado = EstadoUsuario.ACTIVO
        self._fecha_registro = datetime.now()
        self._email_verificado = False
        self._intentos_fallidos = 0
    
    # GETTERS (Properties) - Encapsulamiento
    @property
    def id(self) -> int:
        return self._id
    
    @property
    def usuario(self) -> str:
        return self._usuario
    
    @property
    def correo(self) -> str:
        return self._correo
    
    @property
    def estado(self) -> EstadoUsuario:
        return self._estado
    
    # Métodos públicos comunes
    def autenticar(self, correo: str, password: str) -> bool:
        """Autenticar usuario"""
        if self._correo == correo and self._validar_contrasena(password):
            self._intentos_fallidos = 0
            return True
        self._intentos_fallidos += 1
        if self._intentos_fallidos >= 3:
            self.bloquear()
        return False
    
    def cambiar_contrasena(self, antigua: str, nueva: str) -> bool:
        """Cambiar contraseña del usuario"""
        if self._validar_contrasena(antigua):
            self._contrasena = self._hashear_contrasena(nueva)
            return True
        return False
    
    def bloquear(self) -> None:
        """Bloquear usuario"""
        self._estado = EstadoUsuario.BLOQUEADO
    
    def desbloquear(self) -> None:
        """Desbloquear usuario"""
        self._estado = EstadoUsuario.ACTIVO
        self._intentos_fallidos = 0
    
    # Métodos protegidos (para subclases)
    def _validar_contrasena(self, password: str) -> bool:
        """Validar contraseña (protegido)"""
        return self._contrasena == self._hashear_contrasena(password)
    
    def _hashear_contrasena(self, password: str) -> str:
        """Hashear contraseña - simulado"""
        return f"hash_{password}"
    
    # MÉTODOS ABSTRACTOS - POLIMORFISMO
    @abstractmethod
    def obtener_permisos(self) -> List[str]:
        """Obtener permisos del usuario - Implementación en subclases"""
        pass
    
    @abstractmethod
    def mostrar_dashboard(self) -> str:
        """Mostrar dashboard según tipo de usuario"""
        pass


class Administrador(Usuario):
    """
    HERENCIA: Administrador hereda de Usuario
    POLIMORFISMO: Implementa obtener_permisos() diferente
    """
    
    def __init__(self, id: int, usuario: str, correo: str, contrasena: str):
        super().__init__(id, usuario, correo, contrasena)
        self._nivel_acceso = 10
    
    def obtener_permisos(self) -> List[str]:
        """POLIMORFISMO: Permisos específicos de Admin"""
        return [
            'crear_producto',
            'editar_producto',
            'eliminar_producto',
            'aprobar_producto',
            'gestionar_usuarios',
            'ver_reportes',
            'configurar_sistema'
        ]
    
    def mostrar_dashboard(self) -> str:
        """POLIMORFISMO: Dashboard de administrador"""
        return f"Dashboard Administrador - Nivel {self._nivel_acceso}"
    
    def aprobar_producto(self, producto) -> None:
        """Método exclusivo de Administrador"""
        producto._aprobado = True
        producto._usuario_aprobador_id = self._id


class Revisor(Usuario):
    """HERENCIA: Revisor hereda de Usuario"""
    
    def __init__(self, id: int, usuario: str, correo: str, contrasena: str, especialidad: str = "General"):
        super().__init__(id, usuario, correo, contrasena)
        self._especialidad = especialidad
        self._disenos_revisados = 0
    
    def obtener_permisos(self) -> List[str]:
        """POLIMORFISMO: Permisos de revisor"""
        return [
            'ver_disenos_pendientes',
            'aprobar_diseno',
            'rechazar_diseno',
            'ver_productos'
        ]
    
    def mostrar_dashboard(self) -> str:
        """POLIMORFISMO: Dashboard de revisor"""
        return f"Dashboard Revisor - {self._especialidad} ({self._disenos_revisados} revisados)"


class Cliente(Usuario):
    """HERENCIA: Cliente hereda de Usuario"""
    
    def __init__(self, id: int, usuario: str, correo: str, contrasena: str):
        super().__init__(id, usuario, correo, contrasena)
        self._puntos_acumulados = 0
        self._historial_compras = []
    
    def obtener_permisos(self) -> List[str]:
        """POLIMORFISMO: Permisos de cliente"""
        return [
            'ver_catalogo',
            'comprar',
            'agregar_al_carrito',
            'calificar_producto',
            'ver_historial_compras'
        ]
    
    def mostrar_dashboard(self) -> str:
        """POLIMORFISMO: Dashboard de cliente"""
        return f"Dashboard Cliente - {self._puntos_acumulados} puntos"
    
    def agregar_puntos(self, puntos: int) -> None:
        """Método exclusivo de Cliente"""
        self._puntos_acumulados += puntos