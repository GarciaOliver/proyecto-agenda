/*==============================================================*/
/* DBMS name:      Sybase SQL Anywhere 12                       */
/* Created on:     18/7/2024 16:41:55                           */
/*==============================================================*/

drop table if exists ORDEN;

drop table if exists SOPORTE;

drop table if exists TECNICO;

drop table if exists CLIENTE;

drop table if exists SOLICITUD;

drop table if exists SERVICIO;

/*==============================================================*/
/* Table: SERVICIO                                             */
/*==============================================================*/
CREATE TABLE SERVICIO 
(
   IDSERVICIO           INT                            NOT NULL AUTO_INCREMENT,
   IDCLIENTE            VARCHAR(10)                    NOT NULL,
   CIUDAD               VARCHAR(50)                    NOT NULL,
   CALLEPRINCIPAL       VARCHAR(50)                    NOT NULL,
   CALLESECUNDARIA      VARCHAR(50)                    NULL,
   REFERENCIA           TEXT                           NOT NULL,
   TIPOSERVICIO         VARCHAR(25)                    NOT NULL,
   ESTADO               VARCHAR(25)                    DEFAULT 'activo',
   CONSTRAINT PK_SERVICIO PRIMARY KEY (IDSERVICIO)
);

/*==============================================================*/
/* Table: CLIENTE                                              */
/*==============================================================*/
CREATE TABLE CLIENTE
(
   CEDULA               VARCHAR(10)                    NOT NULL,
   NOMBRE               VARCHAR(100)                    NOT NULL,
   NROTELEFONO          VARCHAR(10)                    NOT NULL,
   CONTRASENIA          VARCHAR(150)                   NOT NULL,
   CORREO               VARCHAR(100)                   NOT NULL,
   ESTADO               TINYINT(1)                    NOT NULL,
   hash_                VARCHAR(45)                    DEFAULT NULL,
   ACTIVADO             TINYINT(1)                     DEFAULT 0,
   CONSTRAINT PK_PERSONA PRIMARY KEY (CEDULA)
);

/*==============================================================*/
/* Table: SOPORTE                                              */
/*==============================================================*/
CREATE TABLE SOPORTE 
(
   CEDULA               VARCHAR(10)                    NOT NULL,
   NOMBRE               VARCHAR(100)                    NOT NULL,
   NROTELEFONO          VARCHAR(10)                    NOT NULL,
   CONTRASENIA          VARCHAR(150)                   NOT NULL,
   ESTADO               TINYINT(1)                    NOT NULL,
   LUGAR				VARCHAR(50)						NOT NULL,
   ACTIVADO             TINYINT(1)                     DEFAULT 0,
   CONSTRAINT PK_SOPORTE PRIMARY KEY (CEDULA)
);

/*==============================================================*/
/* Table: TECNICO                                         */
/*==============================================================*/
CREATE TABLE TECNICO 
(
   CEDULA               VARCHAR(10)                    NOT NULL,
   NOMBRE               VARCHAR(100)                    NOT NULL,
   NROTELEFONO          VARCHAR(10)                    NOT NULL,
   CONTRASENIA          VARCHAR(150)                   NOT NULL,
   ESTADO               TINYINT(1)                    NOT NULL,
   LUGAR				VARCHAR(50)						NOT NULL,
   ACTIVADO             TINYINT(1)                     DEFAULT 0,
   CONSTRAINT PK_TECNICO PRIMARY KEY (CEDULA)
);

/*==============================================================*/
/* Table: SOLICITUD                                           */
/*==============================================================*/
CREATE TABLE SOLICITUD 
(
   IDSOLICITUD          INT                            NOT NULL AUTO_INCREMENT,
   IDSERVICIO			INT								NOT NULL,
   IDSOPORTE			VARCHAR(10),
   TIPODANO             VARCHAR(50)                    NOT NULL,
   HORARIOATENCION      VARCHAR(50)                    NOT NULL,
   FECHAEMISION         DATE                           NOT NULL,
   ESTADO               SMALLINT                       NOT NULL,
   DETALLE				TEXT							NOT NULL,
   CONSTRAINT PK_SOLICITUD PRIMARY KEY (IDSOLICITUD)
);

/*==============================================================*/
/* Table: ORDEN                                          */
/*==============================================================*/
CREATE TABLE ORDEN 
(
   IDORDEN              INT                            NOT NULL AUTO_INCREMENT,
   IDSOLICITUD          INT                            NOT NULL,
   IDTECNICO       		VARCHAR(10)                    NOT NULL,
   RELEVANCIA           VARCHAR(50)                    NOT NULL,
   FECHAEMISION         DATE                           NOT NULL,
   FECHAFIN             DATE                       		NULL,
   FECHAELABORACION     DATE                           NOT NULL,
   ESTADO               VARCHAR(50)                    NOT NULL,
   OBSERVACION          TEXT                           NOT NULL,
   CONSTRAINT PK_ORDEN PRIMARY KEY (IDORDEN)
);

alter table ORDEN
   add constraint FK_ORDEN_REFERENCE_TECNICO foreign key (IDTECNICO)
      references TECNICO (CEDULA)
      on update restrict
      on delete restrict;

alter table ORDEN
   add constraint FK_ORDEN_REFERENCE_SOLICITUD foreign key (IDSOLICITUD)
      references SOLICITUD (IDSOLICITUD)
      on update restrict
      on delete restrict;

ALTER TABLE SERVICIO
   ADD CONSTRAINT FK_SERVICIO_REFERENCE_CLIENTE FOREIGN KEY (IDCLIENTE)
      REFERENCES CLIENTE (CEDULA)
      ON UPDATE RESTRICT
      ON DELETE RESTRICT;

ALTER TABLE SOLICITUD
   ADD CONSTRAINT FK_SOLICITU_REFERENCE_SERVICIO FOREIGN KEY (IDSERVICIO)
      REFERENCES SERVICIO (IDSERVICIO)
      ON UPDATE RESTRICT
      ON DELETE RESTRICT;

ALTER TABLE SOLICITUD
   ADD CONSTRAINT FK_SOLICITU_REFERENCE_SOPORTE FOREIGN KEY (IDSOPORTE)
      REFERENCES SOPORTE (CEDULA)
      ON UPDATE RESTRICT
      ON DELETE RESTRICT;

-- ------------------------------------------------------------------------------------------------------------------

/*DELIMITER //
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

-- ---------------------------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE sp_login(
   IN p_correo VARCHAR(100),
   IN p_contrasenia VARCHAR(150)
)
BEGIN
   -- Selecciona el rol, hash de la contraseña y el estado de activación
   SELECT *
   FROM PERSONAS
   WHERE CORREO = p_correo AND CONTRASENIA = p_contrasenia;
END //

DELIMITER ;


-- ---------------------------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE sp_insertarServicio(
   IN p_idpersona VARCHAR(10),
   IN p_ciudad VARCHAR(50),
   IN p_calleprincipal VARCHAR(50),
   IN p_callesecundaria VARCHAR(50),
   IN p_nrocasa VARCHAR(5),
   IN p_referencia TEXT,
   IN p_tiposervicio VARCHAR(25)
)
BEGIN
   INSERT INTO SERVICIOS (IDPERSONA, CIUDAD, CALLEPRINCIPAL, CALLESECUNDARIA, NROCASA, REFERENCIA, TIPOSERVICIO)
   VALUES (p_idpersona, p_ciudad, p_calleprincipal, p_callesecundaria, p_nrocasa, p_referencia, p_tiposervicio);
END //

DELIMITER ;

-- ------------------------------------------------------------------------------------------------------------------

DELIMITER //

CREATE PROCEDURE sp_mostrarServiciosPersona(
   IN p_idpersona VARCHAR(10)
)
BEGIN
   SELECT *
   FROM SERVICIOS
   WHERE IDPERSONA = p_idpersona;
END //

DELIMITER ;


-- ------------------------------------------------------------------------------------------------------------------