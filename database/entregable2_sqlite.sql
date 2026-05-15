PRAGMA foreign_keys = OFF;

-- categories
CREATE TABLE IF NOT EXISTS "categories" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "name" varchar NOT NULL,
  "created_at" datetime,
  "updated_at" datetime
);

INSERT INTO "categories" VALUES(1,'Cabello','2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "categories" VALUES(2,'Rostro','2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "categories" VALUES(3,'Cuerpo','2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "categories" VALUES(4,'Uñas','2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "categories" VALUES(5,'Cejas y pestañas','2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "categories" VALUES(6,'Maquillaje','2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "categories" VALUES(7,'Fragancias','2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "categories" VALUES(8,'Accesorios','2026-03-24 13:50:19','2026-03-24 13:50:19');

-- users
CREATE TABLE IF NOT EXISTS "users" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "name" varchar NOT NULL,
  "email" varchar NOT NULL UNIQUE,
  "email_verified_at" datetime,
  "password" varchar NOT NULL,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  "address" varchar NOT NULL DEFAULT '',
  "phoneNumber" varchar NOT NULL DEFAULT '',
  "role" varchar NOT NULL DEFAULT 'client'
);

INSERT INTO "users" VALUES(1,'Admin VeneKa','admin@veneka.com','2026-03-24 13:50:18','$2y$12$X3uaVB2sRGIzUmSgxMPTG.kxi28OAwC5oo4DNJKr/vQFZWw2kt0ti','WSoOc19D2q','2026-03-24 13:50:19','2026-03-24 13:50:19','Calle 1 # 2-3, Bogota','3001234567','admin');
INSERT INTO "users" VALUES(2,'Maria Lopez','maria@veneka.com','2026-03-24 13:50:19','$2y$12$X3uaVB2sRGIzUmSgxMPTG.kxi28OAwC5oo4DNJKr/vQFZWw2kt0ti','zKxRhj9JSl','2026-03-24 13:50:19','2026-03-24 13:50:19','Carrera 5 # 10-20, Medellin','3109876543','client');
INSERT INTO "users" VALUES(3,'Laura Martinez','laura@veneka.com','2026-03-24 13:50:19','$2y$12$X3uaVB2sRGIzUmSgxMPTG.kxi28OAwC5oo4DNJKr/vQFZWw2kt0ti','RUFbxCKZMX','2026-03-24 13:50:19','2026-03-24 13:50:19','Calle 80 # 45-12, Cali','3205551234','client');

-- products
CREATE TABLE IF NOT EXISTS "products" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "name" varchar NOT NULL,
  "image" varchar NOT NULL,
  "description" text NOT NULL,
  "available" integer NOT NULL DEFAULT 1,
  "price" integer NOT NULL,
  "brand" varchar,
  "keyword" text NOT NULL,
  "type" varchar NOT NULL DEFAULT 'article',
  "category_id" integer,
  "created_at" datetime,
  "updated_at" datetime
);

INSERT INTO "products" VALUES(1,'Champu Hidratante Argan','https://storage.googleapis.com/veneka-beauty-images/products/champu_hidratante_argan.jpg','Champu con aceite de argan para cabello seco y danado.',1,35000,'VeneKa Beauty','["Cabello","belleza","cuidado"]','article',1,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(2,'Mascarilla Nutritiva Keratina','https://storage.googleapis.com/veneka-beauty-images/products/mascarilla_nutritiva_keratina.jpg','Tratamiento profundo con keratina para cabello liso y brillante.',1,48000,'VeneKa Beauty','["Cabello","belleza","cuidado"]','article',1,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(3,'Tinte Castano Oscuro N°3','https://storage.googleapis.com/veneka-beauty-images/products/tinte_castano_oscuro.jpg','Tinte permanente con cobertura total de canas.',1,25000,'VeneKa Beauty','["Cabello","belleza","cuidado"]','article',1,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(4,'Alisado Brasileño','https://storage.googleapis.com/veneka-beauty-images/products/alisado_brasileno.jpg','Servicio de alisado progresivo con keratina brasileña.',1,180000,'VeneKa Beauty','["Cabello","belleza","cuidado"]','service',1,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(5,'Serum Reparador Puntas','https://storage.googleapis.com/veneka-beauty-images/products/serum_reparador_puntas.jpg','Serum sin enjuague para reparar puntas abiertas.',1,29000,'VeneKa Beauty','["Cabello","belleza","cuidado"]','article',1,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(6,'Crema Hidratante SPF 50','https://storage.googleapis.com/veneka-beauty-images/products/crema_hidratante_spf50.jpg','Crema facial con proteccion solar para uso diario.',1,55000,'VeneKa Beauty','["Rostro","belleza","cuidado"]','article',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(7,'Serum Vitamina C','https://storage.googleapis.com/veneka-beauty-images/products/serum_vitamina_c.jpg','Serum iluminador con vitamina C para piel opaca.',1,72000,'VeneKa Beauty','["Rostro","belleza","cuidado"]','article',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(8,'Limpieza Facial Profunda','https://storage.googleapis.com/veneka-beauty-images/products/limpieza_facial_profunda.jpg','Servicio de limpieza facial con vapor y extraccion.',1,90000,'VeneKa Beauty','["Rostro","belleza","cuidado"]','service',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(9,'Exfoliante Facial Papaya','https://storage.googleapis.com/veneka-beauty-images/products/exfoliante_facial_papaya.jpg','Exfoliante suave con enzimas de papaya para piel luminosa.',1,38000,'VeneKa Beauty','["Rostro","belleza","cuidado"]','article',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(10,'Contorno de Ojos Retinol','https://storage.googleapis.com/veneka-beauty-images/products/contorno_ojos_retinol.jpg','Crema contorno de ojos con retinol para reducir ojeras.',1,65000,'VeneKa Beauty','["Rostro","belleza","cuidado"]','article',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(11,'Crema Corporal Manteca Karite','https://storage.googleapis.com/veneka-beauty-images/products/crema_corporal_karite.jpg','Hidratante corporal con manteca de karite para piel seca.',1,42000,'VeneKa Beauty','["Cuerpo","belleza","cuidado"]','article',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(12,'Exfoliante Corporal Cafe','https://storage.googleapis.com/veneka-beauty-images/products/exfoliante_corporal_cafe.jpg','Exfoliante natural con cafe y aceite de coco.',1,35000,'VeneKa Beauty','["Cuerpo","belleza","cuidado"]','article',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(13,'Masaje Relajante','https://storage.googleapis.com/veneka-beauty-images/products/masaje_relajante.jpg','Servicio de masaje corporal con aceites esenciales.',1,120000,'VeneKa Beauty','["Cuerpo","belleza","cuidado"]','service',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(14,'Aceite Corporal Rosa Mosqueta','https://storage.googleapis.com/veneka-beauty-images/products/aceite_corporal_rosa_mosqueta.jpg','Aceite seco de rosa mosqueta para piel radiante.',1,58000,'VeneKa Beauty','["Cuerpo","belleza","cuidado"]','article',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(15,'Locion Reafirmante Colageno','https://storage.googleapis.com/veneka-beauty-images/products/locion_reafirmante_colageno.jpg','Locion corporal reafirmante con colageno y elastina.',1,48000,'VeneKa Beauty','["Cuerpo","belleza","cuidado"]','article',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(16,'Esmalte Gel Rojo Pasion','https://storage.googleapis.com/veneka-beauty-images/products/esmalte_gel_rojo_pasion.jpg','Esmalte semipermanente de larga duracion color rojo.',1,18000,'VeneKa Beauty','["Unas","belleza","cuidado"]','article',4,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(17,'Kit Lima y Pulidora','https://storage.googleapis.com/veneka-beauty-images/products/kit_lima_pulidora.jpg','Set de limas profesionales para manicura en casa.',1,22000,'VeneKa Beauty','["Unas","belleza","cuidado"]','article',4,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(18,'Manicura Spa','https://storage.googleapis.com/veneka-beauty-images/products/manicura_spa.jpg','Servicio completo de manicura con exfoliacion e hidratacion.',1,55000,'VeneKa Beauty','["Unas","belleza","cuidado"]','service',4,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(19,'Pedicura Completa','https://storage.googleapis.com/veneka-beauty-images/products/pedicura_completa.jpg','Servicio de pedicura con esmaltado y masaje de pies.',1,65000,'VeneKa Beauty','["Unas","belleza","cuidado"]','service',4,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(20,'Aceite Cuticulas Lavanda','https://storage.googleapis.com/veneka-beauty-images/products/aceite_cuticulas_lavanda.jpg','Aceite nutritivo para cuticulas con aroma a lavanda.',1,15000,'VeneKa Beauty','["Unas","belleza","cuidado"]','article',4,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(21,'Tinte Cejas Marron','https://storage.googleapis.com/veneka-beauty-images/products/tinte_cejas_marron.jpg','Tinte semipermanente para cejas color marron natural.',1,12000,'VeneKa Beauty','["Cejas y pestanas","belleza","cuidado"]','article',5,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(22,'Lifting Pestanas','https://storage.googleapis.com/veneka-beauty-images/products/lifting_pestanas.jpg','Servicio de lifting y tinte de pestanas.',1,80000,'VeneKa Beauty','["Cejas y pestanas","belleza","cuidado"]','service',5,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(23,'Depilacion Cejas Hilo','https://storage.googleapis.com/veneka-beauty-images/products/depilacion_cejas_hilo.jpg','Servicio de depilacion de cejas con hilo.',1,25000,'VeneKa Beauty','["Cejas y pestanas","belleza","cuidado"]','service',5,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(24,'Serum Crecimiento Pestanas','https://storage.googleapis.com/veneka-beauty-images/products/serum_crecimiento_pestanas.jpg','Serum para estimular el crecimiento y densidad de pestanas.',1,85000,'VeneKa Beauty','["Cejas y pestanas","belleza","cuidado"]','article',5,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(25,'Kit Modelado Cejas','https://storage.googleapis.com/veneka-beauty-images/products/kit_modelado_cejas.jpg','Kit completo para modelar y definir cejas en casa.',1,32000,'VeneKa Beauty','["Cejas y pestanas","belleza","cuidado"]','article',5,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(26,'Base Fluida Cobertura Total','https://storage.googleapis.com/veneka-beauty-images/products/base_fluida_cobertura_total.jpg','Base de maquillaje de larga duracion con cobertura total.',1,68000,'VeneKa Beauty','["Maquillaje","belleza","cuidado"]','article',6,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(27,'Paleta Sombras Nude','https://storage.googleapis.com/veneka-beauty-images/products/paleta_sombras_nude.jpg','Paleta de 12 sombras en tonos nude y tierra.',1,75000,'VeneKa Beauty','["Maquillaje","belleza","cuidado"]','article',6,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(28,'Maquillaje Profesional Evento','https://storage.googleapis.com/veneka-beauty-images/products/maquillaje_profesional_evento.jpg','Servicio de maquillaje profesional para eventos especiales.',1,150000,'VeneKa Beauty','["Maquillaje","belleza","cuidado"]','service',6,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(29,'Labial Mate Terciopelo','https://storage.googleapis.com/veneka-beauty-images/products/labial_mate_terciopelo.jpg','Labial liquido de larga duracion acabado mate.',1,28000,'VeneKa Beauty','["Maquillaje","belleza","cuidado"]','article',6,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(30,'Corrector Iluminador','https://storage.googleapis.com/veneka-beauty-images/products/corrector_iluminador.jpg','Corrector de ojeras con efecto iluminador natural.',1,42000,'VeneKa Beauty','["Maquillaje","belleza","cuidado"]','article',6,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(31,'Perfume Rosa & Jazmin 50ml','https://storage.googleapis.com/veneka-beauty-images/products/perfume_rosa_jazmin_50ml.jpg','Eau de parfum floral con notas de rosa y jazmin.',1,95000,'VeneKa Beauty','["Fragancias","belleza","cuidado"]','article',7,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(32,'Colonia Fresca Citrus 100ml','https://storage.googleapis.com/veneka-beauty-images/products/colonia_fresca_citrus_100ml.jpg','Colonia unisex con notas citricas y frescas.',1,65000,'VeneKa Beauty','["Fragancias","belleza","cuidado"]','article',7,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(33,'Body Splash Coco & Vainilla','https://storage.googleapis.com/veneka-beauty-images/products/body_splash_coco_vainilla.jpg','Splash corporal dulce con notas de coco y vainilla.',1,32000,'VeneKa Beauty','["Fragancias","belleza","cuidado"]','article',7,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(34,'Perfume Oud Noir 30ml','https://storage.googleapis.com/veneka-beauty-images/products/perfume_oud_noir_30ml.jpg','Eau de parfum oriental intenso con notas de oud.',1,120000,'VeneKa Beauty','["Fragancias","belleza","cuidado"]','article',7,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(35,'Set Fragancias Miniatura','https://storage.googleapis.com/veneka-beauty-images/products/set_fragancias_miniatura.jpg','Set de 5 miniaturas de los perfumes mas vendidos.',1,85000,'VeneKa Beauty','["Fragancias","belleza","cuidado"]','article',7,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(36,'Set Brochas Maquillaje x12','https://storage.googleapis.com/veneka-beauty-images/products/set_brochas_maquillaje_x12.jpg','Set profesional de 12 brochas para maquillaje completo.',1,88000,'VeneKa Beauty','["Accesorios","belleza","cuidado"]','article',8,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(37,'Rizador Automatico Ceramico','https://storage.googleapis.com/veneka-beauty-images/products/rizador_automatico_ceramico.jpg','Rizador automatico con placa ceramica para todo tipo de cabello.',1,195000,'VeneKa Beauty','["Accesorios","belleza","cuidado"]','article',8,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(38,'Plancha Cabello Titanio','https://storage.googleapis.com/veneka-beauty-images/products/plancha_cabello_titanio.jpg','Plancha profesional con placas de titanio y control de temperatura.',1,220000,'VeneKa Beauty','["Accesorios","belleza","cuidado"]','article',8,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(39,'Kit Cuidado Facial Hombre','https://storage.googleapis.com/veneka-beauty-images/products/kit_cuidado_facial_hombre.jpg','Kit completo de limpieza e hidratacion facial para hombres.',1,75000,'VeneKa Beauty','["Accesorios","belleza","cuidado"]','article',8,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "products" VALUES(40,'Neceser Organizador Maquillaje','https://storage.googleapis.com/veneka-beauty-images/products/neceser_organizador_maquillaje.jpg','Neceser transparente con compartimentos para organizar maquillaje.',1,45000,'VeneKa Beauty','["Accesorios","belleza","cuidado"]','article',8,'2026-03-24 13:50:19','2026-03-24 13:50:19');

-- orders
CREATE TABLE IF NOT EXISTS "orders" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "total" decimal NOT NULL,
  "paid" integer NOT NULL DEFAULT 0,
  "shipped" integer NOT NULL DEFAULT 0,
  "method_of_payment" varchar NOT NULL DEFAULT 'cash',
  "user_id" integer,
  "created_at" datetime,
  "updated_at" datetime
);

INSERT INTO "orders" VALUES(1,740000.00,0,1,'cash',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(2,850000.00,1,0,'bank',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(3,270000.00,1,0,'cash',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(4,778000.00,0,1,'cash',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(5,1028000.00,0,1,'bank',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(6,1247000.00,1,1,'card',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(7,168000.00,0,1,'bank',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(8,95000.00,1,1,'card',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(9,1560000.00,1,1,'card',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(10,775000.00,1,1,'cash',2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(11,1074000.00,1,1,'card',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(12,308000.00,0,1,'bank',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(13,1058000.00,0,1,'card',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(14,480000.00,0,0,'cash',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(15,347000.00,1,0,'bank',3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "orders" VALUES(16,905000.00,1,0,'cash',3,'2026-03-24 13:50:19','2026-03-24 13:50:20');
INSERT INTO "orders" VALUES(17,845000.00,0,1,'bank',3,'2026-03-24 13:50:19','2026-03-24 13:50:20');
INSERT INTO "orders" VALUES(18,236000.00,1,0,'card',3,'2026-03-24 13:50:19','2026-03-24 13:50:20');
INSERT INTO "orders" VALUES(19,355000.00,1,0,'card',3,'2026-03-24 13:50:19','2026-03-24 13:50:20');
INSERT INTO "orders" VALUES(20,192000.00,0,0,'cash',3,'2026-03-24 13:50:19','2026-03-24 13:50:20');

-- items
CREATE TABLE IF NOT EXISTS "items" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "quantity" integer NOT NULL,
  "price" integer NOT NULL,
  "order_id" integer,
  "product_id" integer,
  "created_at" datetime,
  "updated_at" datetime
);

INSERT INTO "items" VALUES(1,3,55000,1,6,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(2,1,95000,1,31,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(3,4,120000,1,34,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(4,3,35000,2,12,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(5,1,85000,2,35,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(6,3,220000,2,38,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(7,2,48000,3,2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(8,3,28000,3,29,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(9,2,45000,3,40,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(10,2,35000,4,12,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(11,4,18000,4,16,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(12,4,55000,4,18,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(13,2,32000,4,25,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(14,4,88000,4,36,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(15,3,35000,5,1,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(16,1,68000,5,26,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(17,4,195000,5,37,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(18,1,75000,5,39,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(19,3,120000,6,13,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(20,1,85000,6,24,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(21,4,68000,6,26,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(22,2,220000,6,38,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(23,2,45000,6,40,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(24,4,42000,7,30,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(25,1,95000,8,31,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(26,3,180000,9,4,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(27,4,90000,9,8,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(28,3,55000,9,18,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(29,4,75000,9,27,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(30,3,65000,9,32,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(31,4,48000,10,2,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(32,4,90000,10,8,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(33,3,35000,10,12,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(34,3,18000,10,16,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(35,2,32000,10,25,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(36,3,55000,11,6,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(37,3,68000,11,26,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(38,4,75000,11,27,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(39,3,120000,11,34,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(40,1,45000,11,40,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(41,1,180000,12,4,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(42,2,55000,12,6,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(43,1,18000,12,16,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(44,2,35000,13,1,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(45,1,42000,13,11,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(46,3,22000,13,17,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(47,4,220000,13,38,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(48,4,120000,14,13,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(49,3,25000,15,3,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(50,4,29000,15,5,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(51,2,22000,15,17,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(52,4,28000,15,29,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(53,3,35000,16,1,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(54,2,90000,16,8,'2026-03-24 13:50:19','2026-03-24 13:50:19');
INSERT INTO "items" VALUES(55,2,28000,16,29,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(56,2,42000,16,30,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(57,4,120000,16,34,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(58,1,55000,17,6,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(59,2,150000,17,28,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(60,2,95000,17,31,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(61,4,75000,17,39,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(62,4,25000,18,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(63,1,48000,18,15,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(64,4,22000,18,17,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(65,4,35000,19,12,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(66,3,55000,19,18,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(67,2,25000,19,23,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "items" VALUES(68,4,48000,20,15,'2026-03-24 13:50:20','2026-03-24 13:50:20');

-- reviews
CREATE TABLE IF NOT EXISTS "reviews" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "score" integer NOT NULL,
  "comment" text NOT NULL,
  "product_id" integer,
  "user_id" integer NOT NULL,
  "created_at" datetime,
  "updated_at" datetime
);

INSERT INTO "reviews" VALUES(1,4,'Excelente producto, lo recomiendo totalmente.',1,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(2,1,'Buen producto pero el envio tardo un poco.',2,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(3,2,'Relacion calidad-precio muy buena.',5,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(4,2,'No me convencio del todo, esperaba mas.',7,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(5,1,'El resultado supero mis expectativas.',9,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(6,3,'Relacion calidad-precio muy buena.',20,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(7,3,'Buen producto pero el envio tardo un poco.',25,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(8,3,'Relacion calidad-precio muy buena.',26,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(9,2,'Relacion calidad-precio muy buena.',27,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(10,1,'Relacion calidad-precio muy buena.',29,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(11,1,'Buen producto pero el envio tardo un poco.',32,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(12,1,'Increible resultado desde la primera aplicacion.',33,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(13,1,'Increible resultado desde la primera aplicacion.',34,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(14,1,'El resultado supero mis expectativas.',37,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(15,5,'El resultado supero mis expectativas.',38,2,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(16,1,'Increible resultado desde la primera aplicacion.',2,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(17,1,'Muy buena calidad, quede satisfecha.',5,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(18,5,'Funciona muy bien para mi tipo de piel.',7,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(19,2,'Buen producto pero el envio tardo un poco.',8,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(20,5,'No me convencio del todo, esperaba mas.',9,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(21,4,'No me convencio del todo, esperaba mas.',11,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(22,2,'No me convencio del todo, esperaba mas.',12,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(23,4,'Lo uso diariamente y mi piel ha mejorado mucho.',14,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(24,5,'Buen producto pero el envio tardo un poco.',15,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(25,5,'Buen producto pero el envio tardo un poco.',23,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(26,5,'No me convencio del todo, esperaba mas.',26,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(27,5,'Excelente producto, lo recomiendo totalmente.',30,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(28,1,'Increible resultado desde la primera aplicacion.',35,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(29,5,'Relacion calidad-precio muy buena.',36,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');
INSERT INTO "reviews" VALUES(30,4,'Increible resultado desde la primera aplicacion.',37,3,'2026-03-24 13:50:20','2026-03-24 13:50:20');

-- beauty_conversations
CREATE TABLE IF NOT EXISTS "beauty_conversations" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "user_id" integer,
  "last_message_at" datetime,
  "created_at" datetime,
  "updated_at" datetime
);

-- beauty_messages
CREATE TABLE IF NOT EXISTS "beauty_messages" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "beauty_conversation_id" integer NOT NULL,
  "role" varchar NOT NULL DEFAULT 'user',
  "content" text NOT NULL,
  "products" text,
  "meta" text,
  "created_at" datetime,
  "updated_at" datetime
);

-- migrations table
CREATE TABLE IF NOT EXISTS "migrations" (
  "id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  "migration" varchar NOT NULL,
  "batch" integer NOT NULL
);

PRAGMA foreign_keys = ON;