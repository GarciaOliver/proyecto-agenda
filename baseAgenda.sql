/*==============================================================*/
/* DBMS name:      Sybase SQL Anywhere 12                       */
/* Created on:     18/7/2024 16:41:55                           */
/*==============================================================*/

drop table if exists ASIGNACIONES;

drop table if exists CLIENTES;

drop table if exists PERSONAS;

drop table if exists SERVICIOS;

drop table if exists SOLICITUDES;

drop table if exists SOPORTES;

drop table if exists TECNICOSCAMPO;

drop table if exists TIPODANOS;

/*==============================================================*/
/* Table: ASIGNACIONES                                          */
/*==============================================================*/
create table ASIGNACIONES 
(
   IDTAREA              integer                        not null,
   IDSOLICITUD          int                            not null,
   IDTECNICOCAMPO       int                            not null,
   IDSOPORTE            int                            not null,
   RELEVANCIA           varchar(50)                    not null,
   FECHAEMISION         date                           not null,
   FECHAFIN             datetime                       null,
   FECHAELABORACION     date                           not null,
   ESTADO               int                            not null,
   OBSERVACION          text                           not null,
   constraint PK_ASIGNACIONES primary key clustered (IDTAREA)
);

/*==============================================================*/
/* Table: CLIENTES                                              */
/*==============================================================*/
create table CLIENTES 
(
   CEDULA               varchar(10)                    not null,
   IDCLIENTE            integer                        not null,
   constraint PK_CLIENTES primary key clustered (IDCLIENTE)
);

/*==============================================================*/
/* Table: PERSONAS                                              */
/*==============================================================*/
create table PERSONAS 
(
   CEDULA               varchar(10)                    not null,
   NOMBRE               varchar(50)                    not null,
   APELLIDO             varchar(50)                    not null,
   NROTELEFONO          varchar(10)                    not null,
   CONTRASENIA          varchar(150)                   not null,
   OCUPACION            varchar(50)                    not null,
   CORREO               varchar(100)                   not null,
   ESTADO				varchar(25)						not null,
   constraint PK_PERSONAS primary key clustered (CEDULA)
);

/*==============================================================*/
/* Table: SERVICIOS                                             */
/*==============================================================*/
create table SERVICIOS 
(
   IDSERVICIO           integer                        not null,
   IDCLIENTE            integer                        not null,
   CIUDAD               varchar(50)                    not null,
   CALLEPRINCIPAL       varchar(50)                    not null,
   CALLESECUNDARIA      varchar(50)                    null,
   REFERENCIA           text                           not null,
   TIPOSERVICIO         varchar(25)                    not null,
   ESTADO				varchar(25)						not null,
   constraint PK_SERVICIOS primary key clustered (IDSERVICIO)
);

/*==============================================================*/
/* Table: SOLICITUDES                                           */
/*==============================================================*/
create table SOLICITUDES 
(
   IDSOLICITUD          integer                        not null,
   IDDANO               int                            not null,
   IDCLIENTE            integer                        not null,
   HORARIOATENCION      varchar(50)                    not null,
   FECHAEMISION         date                           not null,
   ESTADO               smallint                       not null,
   constraint PK_SOLICITUDES primary key clustered (IDSOLICITUD)
);

/*==============================================================*/
/* Table: SOPORTES                                              */
/*==============================================================*/
create table SOPORTES 
(
   IDSOPORTE            integer                        not null,
   CEDULA               varchar(10)                    not null,
   constraint PK_SOPORTES primary key clustered (IDSOPORTE)
);

/*==============================================================*/
/* Table: TECNICOSCAMPO                                         */
/*==============================================================*/
create table TECNICOSCAMPO 
(
   IDTECNICOCAMPO       integer                        not null,
   CEDULA               varchar(10)                    not null,
   SECTORTRABAJO        varchar(50)                    not null,
   constraint PK_TECNICOSCAMPO primary key clustered (IDTECNICOCAMPO)
);

/*==============================================================*/
/* Table: TIPODANOS                                             */
/*==============================================================*/
create table TIPODANOS 
(
   IDDANO               integer                        not null,
   DETALLE              varchar(255)                   not null,
   constraint PK_TIPODANOS primary key clustered (IDDANO)
);

alter table ASIGNACIONES
   add constraint FK_ASIGNACI_REFERENCE_TECNICOS foreign key (IDTECNICOCAMPO)
      references TECNICOSCAMPO (IDTECNICOCAMPO)
      on update restrict
      on delete restrict;

alter table ASIGNACIONES
   add constraint FK_ASIGNACI_REFERENCE_SOPORTES foreign key (IDSOPORTE)
      references SOPORTES (IDSOPORTE)
      on update restrict
      on delete restrict;

alter table ASIGNACIONES
   add constraint FK_ASIGNACI_REFERENCE_SOLICITU foreign key (IDSOLICITUD)
      references SOLICITUDES (IDSOLICITUD)
      on update restrict
      on delete restrict;

alter table CLIENTES
   add constraint FK_CLIENTES_REFERENCE_PERSONAS foreign key (CEDULA)
      references PERSONAS (CEDULA)
      on update restrict
      on delete restrict;

alter table SERVICIOS
   add constraint FK_SERVICIO_REFERENCE_CLIENTES foreign key (IDCLIENTE)
      references CLIENTES (IDCLIENTE)
      on update restrict
      on delete restrict;

alter table SOLICITUDES
   add constraint FK_SOLICITU_REFERENCE_CLIENTES foreign key (IDCLIENTE)
      references CLIENTES (IDCLIENTE)
      on update restrict
      on delete restrict;

alter table SOLICITUDES
   add constraint FK_SOLICITU_REFERENCE_TIPODANO foreign key (IDDANO)
      references TIPODANOS (IDDANO)
      on update restrict
      on delete restrict;

alter table SOPORTES
   add constraint FK_SOPORTES_REFERENCE_PERSONAS foreign key (CEDULA)
      references PERSONAS (CEDULA)
      on update restrict
      on delete restrict;

alter table TECNICOSCAMPO
   add constraint FK_TECNICOS_REFERENCE_PERSONAS foreign key (CEDULA)
      references PERSONAS (CEDULA)
      on update restrict
      on delete restrict;


