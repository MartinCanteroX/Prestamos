-- Active: 1744924762273@@127.0.0.1@3306@prestamos
-- TODO Database Prestamos
-- *************************************
-- TODO Nueva base de datos
-- *************************************
create database Prestamos;
use prestamos;

-- *************************************
-- TODO Tabla Parametros
-- *************************************
create table Parametros(
    ParametroID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(250) not null,
    Valor varchar(250) not null,
    Tipo varchar(2) not null default 'C'
);

-- *************************************
-- TODO Tablas
-- *************************************
-- * Tablas bases
create table Clientes(
    ClienteID int AUTO_INCREMENT PRIMARY KEY,
    Numero int not null default 0,
    Nombre varchar(150) not null,
    UsuarioID int default 0
);

create table ConceptosPrestamos(
    ConceptoID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(50) not null,
    Tipo char(1) default 'P' ,   -- P por prestamo o C por cuota
    TipoMonto char(1) default 'P' ,  -- P por Porcentaje, I por Importe Fijo
    CuentaContable varchar(30) default ''
);

create table TiposMedios(
    TipoMedioID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(50) not null,
    CuentaID int default 0 not null
);

create table TiposPrestamos(
    TipoPrestamoID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(100) not null
);

    create table TiposPrestamosConceptos(
        TipoPrestamoConceptoID int AUTO_INCREMENT PRIMARY KEY,
        TipoPrestamoID int not null,
        ConceptoID int not null
        Constraint FK_TipoPrestamosConceptos_Conceptos FOREIGN KEY (ConceptoID) REFERENCES ConceptosPrestamos(ConceptoID)
    );
        
create table Entidades(
    EntidadID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(150) not null
);
    create table EntidadesTiposPrestamos(
        EntidadTipoPrestamoID int AUTO_INCREMENT PRIMARY KEY,
        EntidadID int not null,
        TipoPrestamoID int not null
        Constraint FK_EntidadesTiposPrestamos_Entidades FOREIGN KEY(EntidadID) REFERENCES Entidades(EntidadID)
    );   
-- drop table Comercializadores;
create table Comercializadores(
    ComercializadorID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(150) not null
);

-- * Prestamos
create table Prestamos(
    PrestamoID int AUTO_INCREMENT PRIMARY KEY,
    Numero int not null default 0,
    ClienteID int not null,
    TipoPrestamoID int not null default 0,
    EntidadID int not null,
    ComercializadorID int not null,
    FechaAlta datetime not null,
    Fecha date,
    FechaOtorgamiento date,
    Fecha1Vto date,
    FechaUltVto date,
    ImporteCapital decimal(15,2) default 0,
    ImporteNeto decimal(15,2) default 0,
    ImporteCuota decimal(15,2) default 0,
    UsuarioID int default 0,
    CONSTRAINT FK_Prestamos_Clientes FOREIGN KEY(ClienteID) REFERENCES Clientes(ClienteID),
    CONSTRAINT FK_Prestamos_TiposPrestamos FOREIGN KEY(TipoPrestamoID) REFERENCES TiposPrestamos(TipoPrestamoID),
    CONSTRAINT FK_Prestamos_Entidades FOREIGN KEY(EntidadID) REFERENCES Entidades(EntidadID),
    CONSTRAINT FK_Prestamos_Comercialzadores FOREIGN KEY(ComercializadorID) REFERENCES Comercializadores(ComercializadorID)
) ENGINE=InnoDB;

    create table PrestamosCuotas(
        PrestamoCuotaID int AUTO_INCREMENT PRIMARY KEY,
        PrestamoID int not null,
        Numero int not null,
        FechaVto date,
        Importe decimal(15,2) default 0 not null,
        CONSTRAINT PrestamosCuotas_Prestamos FOREIGN KEY(PrestamoID) REFERENCES Prestamos(PrestamoID)
    );
    
    create table PrestamosCuotasDet(
        PrestamoCuotaDetID int AUTO_INCREMENT PRIMARY KEY,
        PrestamoID int not null,
        PrestamoCuotaID int not null,
        ConceptoID int not null,
        Importe decimal(15,2) default 0 not null,
        CONSTRAINT PrestamosCuotasDet_Prestamos FOREIGN KEY(PrestamoID) REFERENCES Prestamos(PrestamoID),
        CONSTRAINT PrestamosCuotasDet_PrestamosCuotas FOREIGN KEY(PrestamoCuotaID) REFERENCES PrestamosCuotas(PrestamoCuotaID)
    )
    
    create table PrestamosConceptos(
        PrestamoConceptoID int AUTO_INCREMENT PRIMARY KEY,
        PrestamoID int not null,
        ConceptoID int not null,
        Valor decimal(15,2) default 0,
        Importe decimal(15,2) default 0,
        CONSTRAINT PrestamosConceptos_Prestamos FOREIGN KEY(PrestamoID) REFERENCES Prestamos(PrestamoID),
        CONSTRAINT PrestamosConceptos_Conceptos FOREIGN KEY(ConceptoID) REFERENCES ConceptosPrestamos(ConceptoID)
    );
    
-- * Otorgamientos de prestamos
create table PrestamosOtorgamientos(
    PrestamoOtorgamientoID int AUTO_INCREMENT PRIMARY KEY,
    FechaAlta datetime,
    Fecha date,
    PrestamoID int not null,
    ImporteNeto decimal(15,2) default 0,
    AsientoID int default 0,
    UsuarioID int default 0,
    CONSTRAINT PrestamosOtorgamientos_Prestamos FOREIGN KEY(PrestamoID) REFERENCES Prestamos(PrestamoID)
);

    create table PrestamosOtorgamientosMedios(
        PrestamoOtorgamientoMedioID int AUTO_INCREMENT PRIMARY KEY,
        PrestamoOtorgamientoID int,
        TipoMedioID int not null,
        CuentaID int not null,
        Importe decimal(15,2) default 0,
        CONSTRAINT PrestamosOtorgamientosMedios_PrestamosOtorgamientos FOREIGN KEY(PrestamoOtorgamientoID) REFERENCES PrestamosOtorgamientos(PrestamoOtorgamientoID),
        CONSTRAINT PrestamosOtorgamientosMedios_TiposMedios FOREIGN KEY(TipoMedioID) REFERENCES TiposMedios(TipoMedioID)
    );
    
-- * Cobros
create table PrestamosCobros(
    PrestamoCobroID int AUTO_INCREMENT PRIMARY KEY,
    FechaAlta datetime,
    Fecha date,
    Tipo char(1),   -- I por Individual, A por anticipado o L por lotes
    ImporteCobrado decimal(15,2) default 0,
    AsientoID int default 0,
    UsuarioID int default 0
);
    create table PrestamosCobrosPrestamos(
        PrestamoCobroPrestamoID int AUTO_INCREMENT PRIMARY KEY,
        PrestamoCobroID int not null,
        PrestamoID int not null,
        Importe decimal(15,2) default 0,
        CONSTRAINT FK_PrestamosCobrosPrestamos_PrestamosCobros FOREIGN KEY(PrestamoCobroID) REFERENCES PrestamosCobros(PrestamoCobroID),
        CONSTRAINT FK_PrestamosCobrosPrestamos_Prestamos FOREIGN KEY(PrestamoID) REFERENCES Prestamos(PrestamoID)
    );
    
    create table PrestamosCobrosCuotas(
        PrestamoCobroCuotaID int AUTO_INCREMENT PRIMARY KEY,
        PrestamoCobroID int not null,
        PrestamoID int not null,
        PrestamoCuotaID int not null,
        Importe decimal(15,2) default 0,
        CONSTRAINT FK_PrestamosCobrosCuotas_PrestamosCobros FOREIGN KEY(PrestamoCobroID) REFERENCES PrestamosCobros(PrestamoCobroID),
        CONSTRAINT FK_PrestamosCobrosCuotas_Prestamos FOREIGN KEY(PrestamoID) REFERENCES Prestamos(PrestamoID),
        CONSTRAINT FK_PrestamosCobrosCuotas_PrestamosCuotas FOREIGN KEY(PrestamoCuotaID) REFERENCES PrestamosCuotas(PrestamoCuotaID)
    );
    
    create table PrestamosCobrosCuotasDet(
        PrestamoCobroCuotaDetID int AUTO_INCREMENT PRIMARY KEY,
        PrestamoCobroID int not null,
        PrestamoCobroCuotaID int not null,
        ConceptoID int not null,
        Importe decimal(15,2) default 0,
        CONSTRAINT FK_PrestamosCobrosCuotasDet_PrestamosCobros FOREIGN KEY(PrestamoCobroID) REFERENCES PrestamosCobros(PrestamoCobroID),
        CONSTRAINT FK_PrestamosCobrosCuotasDet_PrestamosCobrosCuotas FOREIGN KEY(PrestamoCobroCuotaID) REFERENCES PrestamosCobrosCuotas(PrestamoCobroCuotaID),
        CONSTRAINT FK_PrestamosCobrosCuotasDet_Conceptos FOREIGN KEY(ConceptoID) REFERENCES ConceptosPrestamos(ConceptoID)
    );
    
-- * Devengamientos
create table Devengamientos
(
    DevengamientoID int AUTO_INCREMENT PRIMARY KEY,
    FechaAlta datetime,
    Anio int not null,
    Mes int not null,
    AsientoID int default 0,
    UsuarioID int default 0
);
    create table DevengamientosDet(
        DevengamientoDetID int AUTO_INCREMENT PRIMARY KEY,
        DevengamientoID int,
        PrestamoID int not null,
        PrestamoCuotaID int not null,
        CONSTRAINT FK_DevengamientosDet_Devengamientos FOREIGN KEY(DevengamientoID) REFERENCES Devengamientos(DevengamientoID),
        CONSTRAINT FK_DevengamientosDet_PrestamosCuotas FOREIGN KEY(PrestamoCuotaID) REFERENCES PrestamosCuotas(PrestamoCuotaID),
        CONSTRAINT FK_DevengamientosDet_Prestamos FOREIGN KEY(PrestamoID) REFERENCES Prestamos(PrestamoID)
    );
    go