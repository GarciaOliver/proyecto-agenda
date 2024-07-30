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
   OBSERVACIONTECNICO	TEXT,
   OBSERVACIONSOPORTE   TEXT                           NOT NULL,
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
-- Insertar cliente

DELIMITER //
CREATE PROCEDURE sp_insertarCliente(
   IN c_CEDULA VARCHAR(10),
   IN c_NOMBRE VARCHAR(50),
   IN c_NROTELEFONO VARCHAR(10),
   IN c_CORREO VARCHAR(100),
   IN c_CONTRASENIA VARCHAR(150)
)
BEGIN
      -- Insertar cliente
      INSERT INTO CLIENTE (CEDULA, NOMBRE, NROTELEFONO, CONTRASENIA, CORREO, ESTADO)
      VALUES (c_CEDULA, c_NOMBRE, c_NROTELEFONO, c_CONTRASENIA, c_CORREO, 1);
END //
DELIMITER ;
-- -----------------------------------------------------------------------------------------------------------------
-- Mostrar todos los clientes

DELIMITER //
CREATE PROCEDURE sp_mostrarClientes()
BEGIN
      -- Mostrar todos los clientes
      SELECT * FROM cliente;
END //
DELIMITER ;
-- -------------------------------------------------------------------------------------------------------------------
-- Insertar soporte o tecnico

DELIMITER //
CREATE PROCEDURE sp_insertarTrabajador(
    IN p_cedula VARCHAR(10),
    IN p_nombre VARCHAR(100),
    IN p_nroTelefono VARCHAR(10),
    IN p_contrasenia VARCHAR(150),
    IN p_estado TINYINT(1),
    IN p_lugar VARCHAR(50),
    IN p_ocupacion TINYINT(1)
)
BEGIN
	IF p_ocupacion = 1 THEN
		-- Insertar un soporte
		INSERT INTO SOPORTE (CEDULA, NOMBRE, NROTELEFONO, CONTRASENIA, ESTADO, LUGAR, ACTIVADO)
		VALUES (p_cedula, p_nombre, p_nroTelefono, p_contrasenia, p_estado, p_lugar, 1);
    
	ELSE
		-- Insertar un tecnico
		INSERT INTO TECNICO (CEDULA, NOMBRE, NROTELEFONO, CONTRASENIA, ESTADO, LUGAR, ACTIVADO)
		VALUES (p_cedula, p_nombre, p_nroTelefono, p_contrasenia, p_estado, p_lugar, 1);
	END IF;

    
END//
DELIMITER ;
-- ---------------------------------------------------------------------------------------------------------------
-- Función Insertar servicio
DELIMITER //

CREATE FUNCTION fn_insertarServicio(
   p_idcliente VARCHAR(10),
   p_ciudad VARCHAR(50),
   p_calleprincipal VARCHAR(50),
   p_callesecundaria VARCHAR(50),
   p_referencia TEXT,
   p_tiposervicio VARCHAR(25)
) RETURNS BOOLEAN
    DETERMINISTIC
    MODIFIES SQL DATA
BEGIN
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
       RETURN FALSE;
   END;

   INSERT INTO SERVICIO (IDCLIENTE, CIUDAD, CALLEPRINCIPAL, CALLESECUNDARIA, REFERENCIA, TIPOSERVICIO, ESTADO)
   VALUES (p_idcliente, p_ciudad, p_calleprincipal, p_callesecundaria, p_referencia, p_tiposervicio, 'ACTIVO');

   RETURN TRUE;
END //

DELIMITER ;

-- ------------------------------------------------------------------------------------------------------------------
-- Función insertar solicitud
DELIMITER //

CREATE FUNCTION fn_insertarSolicitud(
   p_idservicio INT,
   p_tipodano VARCHAR(50),
   p_horarioatencion VARCHAR(50),
   p_estado SMALLINT,
   p_detalle TEXT
) RETURNS BOOLEAN
    DETERMINISTIC
    MODIFIES SQL DATA
BEGIN
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
       RETURN FALSE;
   END;

   INSERT INTO SOLICITUD (IDSERVICIO, IDSOPORTE, TIPODANO, HORARIOATENCION, FECHAEMISION, ESTADO, DETALLE)
   VALUES (p_idservicio, null, p_tipodano, p_horarioatencion, CURDATE(), p_estado, p_detalle);

   RETURN TRUE;
END//

DELIMITER ;

-- -------------------------------------------------------------------------------------------------------------------
-- Función crear 
DELIMITER //

CREATE FUNCTION fn_insertarOrden(
   p_idsolicitud INT,
   p_idtecnico VARCHAR(10),
   p_relevancia VARCHAR(50),
   p_fechaelaboracion DATE,
   p_observacionsoporte TEXT
) RETURNS BOOLEAN
    DETERMINISTIC
    MODIFIES SQL DATA
BEGIN
   DECLARE EXIT HANDLER FOR SQLEXCEPTION
   BEGIN
       RETURN FALSE;
   END;

   INSERT INTO ORDEN (IDSOLICITUD, IDTECNICO, RELEVANCIA, FECHAEMISION, FECHAELABORACION, ESTADO, OBSERVACIONSOPORTE)
   VALUES (p_idsolicitud, p_idtecnico, p_relevancia, CURDATE(), p_fechaelaboracion, 'ESPERA', p_observacionsoporte);

   RETURN TRUE;
END//

DELIMITER ;


-- -------------------------------------------------------------------------------------------------------------------
/*
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

CREATE PROCEDURE sp_mostrarServiciosPersona(
   IN p_idpersona VARCHAR(10)
)
BEGIN
   SELECT *
   FROM SERVICIOS
   WHERE IDPERSONA = p_idpersona;
END //

DELIMITER ;

*/
-- ------------------------------------------------------------------------------------------------------------------