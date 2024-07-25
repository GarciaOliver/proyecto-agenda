/*==============================================================*/
/* DBMS name:      Sybase SQL Anywhere 12                       */
/* Created on:     18/7/2024 16:41:55                           */
/*==============================================================*/

drop table if exists ASIGNACIONES;

drop table if exists SERVICIOS;

drop table if exists SOLICITUDES;

drop table if exists SOPORTES;

drop table if exists TECNICOSCAMPO;

drop table if exists CLIENTES;

drop table if exists PERSONAS;

drop table if exists TIPODANOS;

/*==============================================================*/
/* Table: ASIGNACIONES                                          */
/*==============================================================*/
CREATE TABLE ASIGNACIONES 
(
   IDTAREA              INT                            NOT NULL AUTO_INCREMENT,
   IDSOLICITUD          INT                            NOT NULL,
   IDTECNICOCAMPO       INT                            NOT NULL,
   IDSOPORTE            INT                            NOT NULL,
   RELEVANCIA           VARCHAR(50)                    NOT NULL,
   FECHAEMISION         DATE                           NOT NULL,
   FECHAFIN             DATETIME                       NULL,
   FECHAELABORACION     DATE                           NOT NULL,
   ESTADO               INT                            NOT NULL,
   OBSERVACION          TEXT                           NOT NULL,
   CONSTRAINT PK_ASIGNACIONES PRIMARY KEY (IDTAREA)
);

/*==============================================================*/
/* Table: CLIENTES                                              */
/*==============================================================*/
CREATE TABLE CLIENTES 
(
   CEDULA               VARCHAR(10)                    NOT NULL,
   IDCLIENTE            INT                            NOT NULL AUTO_INCREMENT,
   CONSTRAINT PK_CLIENTES PRIMARY KEY (IDCLIENTE)
);

/*==============================================================*/
/* Table: PERSONAS                                              */
/*==============================================================*/
CREATE TABLE PERSONAS 
(
   CEDULA               VARCHAR(10)                    NOT NULL,
   NOMBRE               VARCHAR(50)                    NOT NULL,
   APELLIDO             VARCHAR(50)                    NOT NULL,
   NROTELEFONO          VARCHAR(10)                    NOT NULL,
   CONTRASENIA          VARCHAR(150)                   NOT NULL,
   OCUPACION            VARCHAR(50)                    NOT NULL,
   CORREO               VARCHAR(100)                   NOT NULL,
   ESTADO               VARCHAR(25)                    NOT NULL,
   hash_                VARCHAR(45)                    DEFAULT NULL,
   ACTIVADO             TINYINT(1)                     DEFAULT 0,
   CONSTRAINT CHK_OCUPACION CHECK (OCUPACION IN ('cliente','soporte','empleado')),
   CONSTRAINT PK_PERSONAS PRIMARY KEY (CEDULA)
);

/*==============================================================*/
/* Table: SERVICIOS                                             */
/*==============================================================*/
CREATE TABLE SERVICIOS 
(
   IDSERVICIO           INT                            NOT NULL AUTO_INCREMENT,
   IDCLIENTE            INT                            NOT NULL,
   CIUDAD               VARCHAR(50)                    NOT NULL,
   CALLEPRINCIPAL       VARCHAR(50)                    NOT NULL,
   CALLESECUNDARIA      VARCHAR(50)                    NULL,
   REFERENCIA           TEXT                           NOT NULL,
   TIPOSERVICIO         VARCHAR(25)                    NOT NULL,
   ESTADO               VARCHAR(25)                    NOT NULL,
   CONSTRAINT PK_SERVICIOS PRIMARY KEY (IDSERVICIO)
);

/*==============================================================*/
/* Table: SOLICITUDES                                           */
/*==============================================================*/
CREATE TABLE SOLICITUDES 
(
   IDSOLICITUD          INT                            NOT NULL AUTO_INCREMENT,
   IDDANO               INT                            NOT NULL,
   IDSERVICIO           INT                            NOT NULL,
   HORARIOATENCION      VARCHAR(50)                    NOT NULL,
   FECHAEMISION         DATE                           NOT NULL,
   ESTADO               SMALLINT                       NOT NULL,
   CONSTRAINT PK_SOLICITUDES PRIMARY KEY (IDSOLICITUD)
);

/*==============================================================*/
/* Table: SOPORTES                                              */
/*==============================================================*/
CREATE TABLE SOPORTES 
(
   IDSOPORTE            INT                            NOT NULL AUTO_INCREMENT,
   CEDULA               VARCHAR(10)                    NOT NULL,
   SECTORTRABAJO        VARCHAR(50)                    NOT NULL,
   CONSTRAINT PK_SOPORTES PRIMARY KEY (IDSOPORTE)
);

/*==============================================================*/
/* Table: TECNICOSCAMPO                                         */
/*==============================================================*/
CREATE TABLE TECNICOSCAMPO 
(
   IDTECNICOCAMPO       INT                            NOT NULL AUTO_INCREMENT,
   CEDULA               VARCHAR(10)                    NOT NULL,
   SECTORTRABAJO        VARCHAR(50)                    NOT NULL,
   CONSTRAINT PK_TECNICOSCAMPO PRIMARY KEY (IDTECNICOCAMPO)
);

/*==============================================================*/
/* Table: TIPODANOS                                             */
/*==============================================================*/
CREATE TABLE TIPODANOS 
(
   IDDANO               INT                            NOT NULL AUTO_INCREMENT,
   DETALLE              VARCHAR(255)                   NOT NULL,
   CONSTRAINT PK_TIPODANOS PRIMARY KEY (IDDANO)
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

ALTER TABLE SOLICITUDES
   ADD CONSTRAINT FK_SOLICITU_REFERENCE_TIPODANO FOREIGN KEY (IDDANO)
      REFERENCES TIPODANOS (IDDANO)
      ON UPDATE RESTRICT
      ON DELETE RESTRICT;

ALTER TABLE SOLICITUDES
   ADD CONSTRAINT FK_SOLICITU_REFERENCE_SERVICIOS FOREIGN KEY (IDSERVICIO)
      REFERENCES SERVICIOS (IDSERVICIO)
      ON UPDATE RESTRICT
      ON DELETE RESTRICT;

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

-- ------------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE sp_insertarCliente(
   IN p_CEDULA_PERSONA VARCHAR(10),
   IN p_NOMBRE VARCHAR(50),
   IN p_APELLIDO VARCHAR(50),
   IN p_NROTELEFONO VARCHAR(10),
   IN p_CONTRASENIA VARCHAR(150),
   IN p_CORREO VARCHAR(100),
   IN p_HASH VARCHAR(45)
)
BEGIN
      -- Insertar en la tabla PERSONAS con el rol 'cliente'
      INSERT INTO PERSONAS (CEDULA, NOMBRE, APELLIDO, NROTELEFONO, CONTRASENIA, OCUPACION, CORREO, ESTADO, hash_, activado)
      VALUES (p_CEDULA_PERSONA, p_NOMBRE, p_APELLIDO, p_NROTELEFONO, p_CONTRASENIA, 'cliente', p_CORREO, 'activo', p_HASH, 0);

      -- Insertar en la tabla CLIENTES
      INSERT INTO CLIENTES (CEDULA)
      VALUES (p_CEDULA_PERSONA);
END //
DELIMITER ;

-- ---------------------------------------------------------------------------------------------------------------

DELIMITER //
CREATE PROCEDURE sp_insertarTrabajador(
   IN p_CEDULA_PERSONA VARCHAR(10),
   IN p_NOMBRE VARCHAR(50),
   IN p_APELLIDO VARCHAR(50),
   IN p_NROTELEFONO VARCHAR(10),
   IN p_CONTRASENIA VARCHAR(150),
   IN p_OCUPACION INT,
   IN p_CORREO VARCHAR(100),
   IN p_HASH VARCHAR(45),
   IN p_SECTOR VARCHAR(50)
)
BEGIN
   IF p_OCUPACION = 1 THEN
      -- Insertar en la tabla PERSONAS con el rol 'soporte'
      INSERT INTO PERSONAS (CEDULA, NOMBRE, APELLIDO, NROTELEFONO, CONTRASENIA, OCUPACION, CORREO, ESTADO, hash_, activado)
      VALUES (p_CEDULA_PERSONA, p_NOMBRE, p_APELLIDO, p_NROTELEFONO, p_CONTRASENIA, 'soporte', p_CORREO, 'activo', p_HASH, 0);

      -- Insertar en la tabla SOPORTES
      INSERT INTO SOPORTES (CEDULA, SECTORTRABAJO)
      VALUES (p_CEDULA_PERSONA, p_SECTOR);

   ELSE
      -- Insertar en la tabla PERSONAS con el rol 'empleado'
      INSERT INTO PERSONAS (CEDULA, NOMBRE, APELLIDO, NROTELEFONO, CONTRASENIA, OCUPACION, CORREO, ESTADO, hash_, activado)
      VALUES (p_CEDULA_PERSONA, p_NOMBRE, p_APELLIDO, p_NROTELEFONO, p_CONTRASENIA, 'empleado', p_CORREO, 'activo', p_HASH, 0);

      -- Insertar en la tabla TECNICOSCAMPO
      INSERT INTO TECNICOSCAMPO (CEDULA, SECTORTRABAJO)
      VALUES (p_CEDULA_PERSONA, p_SECTOR);
      
END IF;

END //
DELIMITER ;