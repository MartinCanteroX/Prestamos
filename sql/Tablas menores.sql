-- TODO Tablas menores
/*
    Tipos de Iva
*/
create table tiposiva(
    TipoIvaID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(250) not null
);

/*
    Estados Civiles
*/
create table tiposestciviles(
    TipoEstCivilID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(100) not null
);

/*
    Tipos de Documentos
*/
create table tiposdocumentos (
    TipoDocumID int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(100) not null
);

/*
    Localidades
*/
create table tablalocalidades(
        LocalidadID int AUTO_INCREMENT PRIMARY KEY,
        Nombre varchar(250) not null,
        CodPostal varchar(20) not null
);

/*
    Provincias
*/
create table tablaprovincias(
    ProvinciaID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(30) not null
);

/*
    Sexo
*/
create table tiposexo(
    TipoSexoID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(30) not null
);

/*
    Ingresos Brutos
*/
create table tipoiibb(
    TipoIIBBID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(50) not null
);

/*
    Bancos
*/
create table tablabancos(
    BancoID int AUTO_INCREMENT PRIMARY KEY,
    Codigo int not null,
    Nombre varchar(250) not null
)

/*
    Campos dinamicos de clientes
*/
create table tablacampos(
    CampoID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(100) not null
)

/*
    Especies
*/
create table tablaespecies(
    EspecieID int AUTO_INCREMENT PRIMARY KEY,
    Codigo int not null,
    Nombre varchar(100) not null
);

/*
    Feriados
*/
create table tablaferiados(
        FeriadoID int AUTO_INCREMENT PRIMARY  KEY,
        Fecha date not null,
        Descripcion varchar(50) default ''
);

/*
    Tabla de Nombres de personas
*/
create table tablanombres(
    Nombre varchar(50) PRIMARY KEY, 
    TipoSexoID int not null
);

/*
    Tabla de Actividades de IIBB
*/
create table tipoiibbactividades(
    TipoIIBBActividadID int AUTO_INCREMENT PRIMARY  KEY,
    Nombre varchar(100) not null
);


