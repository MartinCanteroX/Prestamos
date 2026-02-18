create table Parametros(
    ParametroID int AUTO_INCREMENT PRIMARY KEY,
    Nombre varchar(250) not null,
    Valor varchar(250) not null,
    Tipo varchar(2) not null default 'C'
);
