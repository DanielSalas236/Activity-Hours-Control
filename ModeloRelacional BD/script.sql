DROP TABLE actividad CASCADE CONSTRAINTS;

DROP TABLE control CASCADE CONSTRAINTS;

DROP TABLE facultad CASCADE CONSTRAINTS;

DROP TABLE institucion CASCADE CONSTRAINTS;

DROP TABLE programa CASCADE CONSTRAINTS;

DROP TABLE tipousuario CASCADE CONSTRAINTS;

DROP TABLE usuario CASCADE CONSTRAINTS;

DROP TABLE usuario_actividad CASCADE CONSTRAINTS;

CREATE TABLE actividad (
    idactividad            VARCHAR2(4) NOT NULL,
    descripcionactividad   VARCHAR2(20) NOT NULL
);

ALTER TABLE actividad ADD CONSTRAINT actividad_pk PRIMARY KEY ( idactividad );

CREATE TABLE control (
    idusuario      VARCHAR2(25) NOT NULL,
    codactividad   VARCHAR2(4) NOT NULL,
    consecutivo    NUMBER(5) NOT NULL,
    fecha          DATE NOT NULL,
    horas           number(2) NOT NULL,
    idusuario2     VARCHAR2(10) NOT NULL
);

ALTER TABLE control
    ADD CONSTRAINT control_pk PRIMARY KEY ( consecutivo,
                                            idusuario,
                                            codactividad );

CREATE TABLE facultad (
    idfacultad                  VARCHAR2(4) NOT NULL,
    nombrefac                   VARCHAR2(25) NOT NULL,
    institucion_idinstitucion   VARCHAR2(10) NOT NULL
);

ALTER TABLE facultad ADD CONSTRAINT facultad_pk PRIMARY KEY ( idfacultad );

CREATE TABLE institucion (
    idinstitucion   VARCHAR2(10) NOT NULL,
    nit             VARCHAR2(10) NOT NULL,
    nombreinst      VARCHAR2(20) NOT NULL,
    direccion       VARCHAR2(20) NOT NULL,
    telefono        VARCHAR2(10) NOT NULL,
    correo          VARCHAR2(20) NOT NULL
);

ALTER TABLE institucion ADD CONSTRAINT institucion_pk PRIMARY KEY ( idinstitucion );

CREATE TABLE programa (
    idprograma            VARCHAR2(4) NOT NULL,
    nombrepro             VARCHAR2(20) NOT NULL,
    facultad_idfacultad   VARCHAR2(4) NOT NULL
);

ALTER TABLE programa ADD CONSTRAINT programa_pk PRIMARY KEY ( idprograma );

CREATE TABLE tipousuario (
    idtipo       VARCHAR2(10) NOT NULL,
    descricion   VARCHAR2(20) NOT NULL
);

ALTER TABLE tipousuario ADD CONSTRAINT tipousuario_pk PRIMARY KEY ( idtipo );

CREATE TABLE usuario (
    idusuario             VARCHAR2(10) NOT NULL,
    tipodocumento         VARCHAR2(35) NOT NULL,
    apellidos             VARCHAR2(20) NOT NULL,
    nombres               VARCHAR2(20) NOT NULL,
    fechanacimiento       DATE NOT NULL,
    sexo                  CHAR(1) NOT NULL,
    email                 VARCHAR2(30) NOT NULL,
    direccion             VARCHAR2(30) NOT NULL,
    telefono              VARCHAR2(10) NOT NULL,
    clave                 VARCHAR2(5) NOT NULL,
    tipousuario_idtipo    VARCHAR2(10) NOT NULL,
    programa_idprograma   VARCHAR2(4) NOT NULL
);

ALTER TABLE usuario ADD CONSTRAINT usuario_pk PRIMARY KEY ( idusuario );

CREATE TABLE usuario_actividad (
    codactividad        VARCHAR2(4) NOT NULL,
    usuario_idusuario   VARCHAR2(10) NOT NULL,
    descripcion         VARCHAR2(20) NOT NULL
);

ALTER TABLE usuario_actividad ADD CONSTRAINT usuario_actividad_pk PRIMARY KEY ( usuario_idusuario,
                                                                                codactividad );

ALTER TABLE control
    ADD CONSTRAINT control_usuario_actividad_fk FOREIGN KEY ( idusuario2,
                                                              codactividad )
        REFERENCES usuario_actividad ( usuario_idusuario,
                                       codactividad );

ALTER TABLE control
    ADD CONSTRAINT control_usuario_fk FOREIGN KEY ( idusuario )
        REFERENCES usuario ( idusuario );

ALTER TABLE facultad
    ADD CONSTRAINT facultad_institucion_fk FOREIGN KEY ( institucion_idinstitucion )
        REFERENCES institucion ( idinstitucion );

ALTER TABLE programa
    ADD CONSTRAINT programa_facultad_fk FOREIGN KEY ( facultad_idfacultad )
        REFERENCES facultad ( idfacultad );

ALTER TABLE usuario_actividad
    ADD CONSTRAINT usuario_actividad_actividad_fk FOREIGN KEY ( codactividad )
        REFERENCES actividad ( idactividad );

ALTER TABLE usuario_actividad
    ADD CONSTRAINT usuario_actividad_usuario_fk FOREIGN KEY ( usuario_idusuario )
        REFERENCES usuario ( idusuario );

ALTER TABLE usuario
    ADD CONSTRAINT usuario_programa_fk FOREIGN KEY ( programa_idprograma )
        REFERENCES programa ( idprograma );

ALTER TABLE usuario
    ADD CONSTRAINT usuario_tipousuario_fk FOREIGN KEY ( tipousuario_idtipo )
        REFERENCES tipousuario ( idtipo );
        
 INSERT INTO INSTITUCION VALUES('UNIAJC','11001','UNIAJC','Avenida 1 #1','4145785','uniajc@uniajc.com');


INSERT INTO ACTIVIDAD VALUES('01','Guitarra');
INSERT INTO ACTIVIDAD VALUES('02','Fútbol');
INSERT INTO ACTIVIDAD VALUES('03','Baile');
INSERT INTO ACTIVIDAD VALUES('04','Ping Pong');
INSERT INTO ACTIVIDAD VALUES('05','Canto');


INSERT INTO FACULTAD VALUES('I01','INGENIERIA','UNIAJC');
INSERT INTO FACULTAD VALUES('T01','CIENCIAS SOCIALES','UNIAJC');



INSERT INTO PROGRAMA VALUES('I1','Ing. Sistemas','I01');
INSERT INTO PROGRAMA VALUES('I2','Ing. Industrial','I01');
INSERT INTO PROGRAMA VALUES('T1','Trabajo Social','T01');


INSERT INTO TIPOUSUARIO VALUES('A1','ADMIN');
INSERT INTO TIPOUSUARIO VALUES('E1','ESTUDIANTE');



INSERT INTO USUARIO VALUES('001','CC','SALAS DIAZ','CARLOS DANIEL',to_date('23-1-1982','dd-mm-yyyy'),'M','daniel@hotmail.com','Avenida 1 #23','3235291391','AB001','E1','I1');
INSERT INTO USUARIO VALUES('002','CC','RODRIGUEZ PACHECO','JONATHAN ARLEY',to_date('23-1-1982','dd-mm-yyyy'),'F','jonathan@gmail.com','Avenida 4 #12','3148463321','AB002','E1','I1');
INSERT INTO USUARIO VALUES('003','TI','PIES DE PLATA','MANOLITO',to_date('23-1-1982','dd-mm-yyyy'),'M','manolito@outlook.com','Avenida 47 #45','3142589633','AB003','E1','I2');
INSERT INTO USUARIO VALUES('004','CC','SMITH','WILL',to_date('23-1-1982','dd-mm-yyyy'),'M','willsmith@hotmail.com','Avenida 23 #22','3235214569','AB004','A1','T1');

INSERT INTO USUARIO_ACTIVIDAD VALUES('01','004','Descripcion1');
INSERT INTO USUARIO_ACTIVIDAD VALUES('02','004','Descripcion2');
INSERT INTO USUARIO_ACTIVIDAD VALUES('03','004','Descripcion3');


INSERT INTO CONTROL VALUES('001','01',0,to_date('23-1-1982','dd-mm-yyyy'),1,'004');
INSERT INTO CONTROL VALUES('002','02',0,to_date('23-1-1982','dd-mm-yyyy'),3,'004');
INSERT INTO CONTROL VALUES('003','03',0,to_date('23-1-1982','dd-mm-yyyy'),2,'004');       