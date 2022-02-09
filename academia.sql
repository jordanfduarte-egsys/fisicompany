/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : academia

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2015-12-15 21:09:19
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `banner`
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id_banner` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `ordem` int(3) NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES ('6', 'Capa', '#', '0d7fa4c58806fe5699c99fe1dbe245ec.jpg', '1', '1');
INSERT INTO `banner` VALUES ('7', 'Capa2', '@', '8e6e93470627a8bc5042f92a805fc425.jpg', '1', '2');

-- ----------------------------
-- Table structure for `caixa`
-- ----------------------------
DROP TABLE IF EXISTS `caixa`;
CREATE TABLE `caixa` (
  `id_caixa` int(11) NOT NULL AUTO_INCREMENT,
  `vlr_pago` decimal(9,2) NOT NULL,
  `dt_pagamento` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `des_pagamento` text,
  PRIMARY KEY (`id_caixa`),
  KEY `caixa_id_usuario` (`id_usuario`),
  CONSTRAINT `caixa_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of caixa
-- ----------------------------

-- ----------------------------
-- Table structure for `categoria`
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES ('1', 'Peito');
INSERT INTO `categoria` VALUES ('2', 'Perna');
INSERT INTO `categoria` VALUES ('3', 'Costa');
INSERT INTO `categoria` VALUES ('4', 'Biceps');
INSERT INTO `categoria` VALUES ('5', 'Triceps');
INSERT INTO `categoria` VALUES ('6', 'Antebraço');
INSERT INTO `categoria` VALUES ('7', 'Panturrilha');
INSERT INTO `categoria` VALUES ('8', 'Ombro');
INSERT INTO `categoria` VALUES ('9', 'Abdomen');
INSERT INTO `categoria` VALUES ('10', 'Cintura');

-- ----------------------------
-- Table structure for `dia`
-- ----------------------------
DROP TABLE IF EXISTS `dia`;
CREATE TABLE `dia` (
  `id_dia` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dia
-- ----------------------------
INSERT INTO `dia` VALUES ('1', 'Segunda-feira');
INSERT INTO `dia` VALUES ('2', 'Terça-feira');
INSERT INTO `dia` VALUES ('3', 'Quarta-feira');
INSERT INTO `dia` VALUES ('4', 'Quinta-feira');
INSERT INTO `dia` VALUES ('5', 'Sexta-feira');
INSERT INTO `dia` VALUES ('6', 'Sabado');
INSERT INTO `dia` VALUES ('7', 'Domingo');

-- ----------------------------
-- Table structure for `equipamento`
-- ----------------------------
DROP TABLE IF EXISTS `equipamento`;
CREATE TABLE `equipamento` (
  `id_equipamento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `data_inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  `marca` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_equipamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipamento
-- ----------------------------

-- ----------------------------
-- Table structure for `estrutura`
-- ----------------------------
DROP TABLE IF EXISTS `estrutura`;
CREATE TABLE `estrutura` (
  `id_estrutura` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `ordem` int(3) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_estrutura`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of estrutura
-- ----------------------------
INSERT INTO `estrutura` VALUES ('1', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', 'a947d9cd616ef230f2789916d4ad2c16.jpg', '2', '1');
INSERT INTO `estrutura` VALUES ('2', 'Novos Exercícios', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>', 'd465b2b4bdf518f635cc2d185a920c4b.jpg', '1', '1');
INSERT INTO `estrutura` VALUES ('3', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', 'ee3967f83712b09b148a7f8d43808bc5.jpg', '3', '1');
INSERT INTO `estrutura` VALUES ('4', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', 'fce879a8b9b443db74242b9f1dc2d170.jpg', '4', '1');
INSERT INTO `estrutura` VALUES ('5', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1e4e57d386d6d5a8f541021a1cc6ad54.jpg', '5', '1');

-- ----------------------------
-- Table structure for `exercicio`
-- ----------------------------
DROP TABLE IF EXISTS `exercicio`;
CREATE TABLE `exercicio` (
  `id_exercicio` int(10) NOT NULL AUTO_INCREMENT,
  `id_exercico_sistema` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `descricao` text,
  `id_categoria` int(10) NOT NULL,
  PRIMARY KEY (`id_exercicio`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of exercicio
-- ----------------------------
INSERT INTO `exercicio` VALUES ('1', '0', 'Abdominal Infra', 'e8521cd9de9a9aaac7704f19742afd5d.jpg', '<p>Exerc&iacute;cio para o abdomen.</p>', '9');
INSERT INTO `exercicio` VALUES ('2', '0', 'Adbominal Supra', '196ffc152b9afa879b7622fd7b953737.jpg', '<p>Exerc&iacute;cio para o abdomen.</p>', '9');
INSERT INTO `exercicio` VALUES ('3', '0', 'Bike', '', '<p>dssfds</p>', '1');
INSERT INTO `exercicio` VALUES ('4', '0', 'Com Inversão', '', '', '9');
INSERT INTO `exercicio` VALUES ('5', '0', 'Rosca Inversa', '', '', '4');
INSERT INTO `exercicio` VALUES ('6', '0', 'Rosca Concentrada', '', '', '4');
INSERT INTO `exercicio` VALUES ('7', '0', 'Rosca Martelo', '', '', '4');
INSERT INTO `exercicio` VALUES ('8', '0', 'Rosca Direta', '', '', '4');
INSERT INTO `exercicio` VALUES ('9', '0', 'Rosca Alternada', '', '', '4');
INSERT INTO `exercicio` VALUES ('10', '0', 'Remada Unilateral', '', '', '3');
INSERT INTO `exercicio` VALUES ('11', '0', 'Puxada na Frente com Triângulo e Polia Alta', '', '', '3');
INSERT INTO `exercicio` VALUES ('12', '0', 'Puxada na Frente com Polia Alta', '', '', '3');
INSERT INTO `exercicio` VALUES ('13', '0', 'Puxada Alta com Braços Estendidos', '', '', '3');
INSERT INTO `exercicio` VALUES ('14', '0', 'Crucifixo (ou Fly)', '', '', '1');
INSERT INTO `exercicio` VALUES ('15', '0', 'Crossover', '', '', '1');
INSERT INTO `exercicio` VALUES ('16', '0', 'Supino Inclinado', '', '', '1');
INSERT INTO `exercicio` VALUES ('17', '0', 'Supino Reto', '', '', '1');
INSERT INTO `exercicio` VALUES ('18', '0', 'Glúteos Quatro Apoios e Perna Estendida', '', '', '2');
INSERT INTO `exercicio` VALUES ('19', '0', 'Abdução de Quadril', '', '', '2');
INSERT INTO `exercicio` VALUES ('20', '0', 'Mesa Flexora', '', '', '2');
INSERT INTO `exercicio` VALUES ('21', '0', 'Cadeira Extensora', '', '', '2');
INSERT INTO `exercicio` VALUES ('22', '0', 'Gêmeos Sentado', '', '', '2');
INSERT INTO `exercicio` VALUES ('23', '0', 'Leg Press Inclinado', '', '', '2');
INSERT INTO `exercicio` VALUES ('24', '0', 'Francês', '', '', '5');
INSERT INTO `exercicio` VALUES ('25', '0', 'Kick Back', '', '', '5');
INSERT INTO `exercicio` VALUES ('26', '0', 'Corda', '', '', '5');
INSERT INTO `exercicio` VALUES ('27', '0', 'Pulley', '', '', '5');
INSERT INTO `exercicio` VALUES ('28', '0', 'Remada Alta', '', '', '8');
INSERT INTO `exercicio` VALUES ('29', '0', 'Desenvolvimento com Halteres', '', '', '8');
INSERT INTO `exercicio` VALUES ('30', '0', 'Elevação Frontal', '', '', '8');
INSERT INTO `exercicio` VALUES ('31', '0', 'Elevação Lateral', '', '', '8');
INSERT INTO `exercicio` VALUES ('32', '0', 'Elevação lateral', '', '', '10');
INSERT INTO `exercicio` VALUES ('33', '0', 'Abdominal lateral', '', '', '10');
INSERT INTO `exercicio` VALUES ('34', '0', 'Abdominal conjunto', '', '', '10');
INSERT INTO `exercicio` VALUES ('35', '0', 'Rosca Martelo', '', '', '6');
INSERT INTO `exercicio` VALUES ('36', '0', 'Rosca Pulso', '', '', '6');
INSERT INTO `exercicio` VALUES ('37', '0', 'Straps', '', '', '6');
INSERT INTO `exercicio` VALUES ('38', '0', 'ELEVAÇÕES DE GÉMEOS', '', '', '7');
INSERT INTO `exercicio` VALUES ('39', '0', 'PANTURRILHAS SENTADO', '', '', '7');
INSERT INTO `exercicio` VALUES ('40', '0', 'No supino', 'ce964e9abe0668f9ce951c792ca4ddaf.jpg', '', '7');
INSERT INTO `exercicio` VALUES ('41', '10', ' 1 Perde a barrifa', null, 'NN', '0');

-- ----------------------------
-- Table structure for `galeria`
-- ----------------------------
DROP TABLE IF EXISTS `galeria`;
CREATE TABLE `galeria` (
  `id_galeria` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `imagem_principal` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id_galeria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of galeria
-- ----------------------------
INSERT INTO `galeria` VALUES ('1', 'Gallery1', '9548dc44e92a652b9ac7370ca64f6925.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');
INSERT INTO `galeria` VALUES ('2', 'Gallery2', '2494e0c3456bd82ac168bbfc6ff09742.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');
INSERT INTO `galeria` VALUES ('3', 'Galeery3', 'acf14c16de82f6fc52f5fd6491b5bd9a.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');
INSERT INTO `galeria` VALUES ('4', 'Gallery4', '98a192ac21cf778405d960d4502e0ede.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p><span style=\"font-size: 11px;\">&nbsp;</span></p>', '1');
INSERT INTO `galeria` VALUES ('5', 'Gallery5', '18fa9d9fd3b6d658a2266468cbc7ffb3.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');
INSERT INTO `galeria` VALUES ('6', 'Gallery6', '3e55d0e4da511d01bec6ba2df49399ea.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');
INSERT INTO `galeria` VALUES ('7', 'Gallery6', '85aaa37788f9a458be3b0d7c08ac0f4e.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');
INSERT INTO `galeria` VALUES ('8', 'Gallery10', 'e1594dc330aab2b19379c3c0635eace4.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');
INSERT INTO `galeria` VALUES ('9', 'Gallery11', '3a2fa00026850862c34cd788729611f7.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');
INSERT INTO `galeria` VALUES ('10', 'Gallery12', 'dfeadb7cfa6f16ca71c748128d797eba.jpg', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '1');

-- ----------------------------
-- Table structure for `galeria_imagem`
-- ----------------------------
DROP TABLE IF EXISTS `galeria_imagem`;
CREATE TABLE `galeria_imagem` (
  `id_galeria_imagem` int(10) NOT NULL AUTO_INCREMENT,
  `id_galeria` int(10) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id_galeria_imagem`),
  KEY `galeria_imagem_id_galeria` (`id_galeria`),
  CONSTRAINT `galeria_imagem_id_galeria` FOREIGN KEY (`id_galeria`) REFERENCES `galeria` (`id_galeria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of galeria_imagem
-- ----------------------------
INSERT INTO `galeria_imagem` VALUES ('15', '2', '2494e0c3456bd82ac168bbfc6ff09742.jpg');
INSERT INTO `galeria_imagem` VALUES ('16', '3', 'acf14c16de82f6fc52f5fd6491b5bd9a.jpg');
INSERT INTO `galeria_imagem` VALUES ('17', '4', '98a192ac21cf778405d960d4502e0ede.jpg');
INSERT INTO `galeria_imagem` VALUES ('18', '5', '18fa9d9fd3b6d658a2266468cbc7ffb3.jpg');
INSERT INTO `galeria_imagem` VALUES ('19', '6', '3e55d0e4da511d01bec6ba2df49399ea.jpg');
INSERT INTO `galeria_imagem` VALUES ('20', '7', '85aaa37788f9a458be3b0d7c08ac0f4e.jpg');
INSERT INTO `galeria_imagem` VALUES ('21', '1', '9548dc44e92a652b9ac7370ca64f6925.jpg');
INSERT INTO `galeria_imagem` VALUES ('22', '1', '6db50927cc62355f4be603581fb7df29.jpg');
INSERT INTO `galeria_imagem` VALUES ('23', '8', 'e1594dc330aab2b19379c3c0635eace4.jpg');
INSERT INTO `galeria_imagem` VALUES ('24', '9', '3a2fa00026850862c34cd788729611f7.jpg');
INSERT INTO `galeria_imagem` VALUES ('25', '10', 'dfeadb7cfa6f16ca71c748128d797eba.jpg');

-- ----------------------------
-- Table structure for `medida`
-- ----------------------------
DROP TABLE IF EXISTS `medida`;
CREATE TABLE `medida` (
  `id_medida` int(10) NOT NULL AUTO_INCREMENT,
  `id_medida_sistema` int(10) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `braco` decimal(10,2) NOT NULL,
  `antebraco` decimal(10,2) NOT NULL,
  `peitoral` decimal(10,2) NOT NULL,
  `cintura` decimal(10,2) NOT NULL,
  `abdomen` decimal(10,2) NOT NULL,
  `quadril` decimal(10,2) NOT NULL,
  `coxa` decimal(10,2) NOT NULL,
  `pantorrilha` decimal(10,2) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `altura` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_medida`),
  KEY `medida_ibfk_1` (`id_usuario`),
  CONSTRAINT `medida_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of medida
-- ----------------------------

-- ----------------------------
-- Table structure for `modalidade`
-- ----------------------------
DROP TABLE IF EXISTS `modalidade`;
CREATE TABLE `modalidade` (
  `id_modalidade` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `ordem` int(10) NOT NULL,
  PRIMARY KEY (`id_modalidade`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modalidade
-- ----------------------------
INSERT INTO `modalidade` VALUES ('2', 'Jump', '<p>Para emagrecer e ficar em forma, muitas mulheres apostam em dietas e exerc&iacute;cios para poderem manter a forma. Conhe&ccedil;a agora o m&eacute;todo de Aulas de Jump para emagrecer, com dicas exclusivas para voc&ecirc; que quer perder peso mais f&aacute;cil e r&aacute;pido.exclusivas para voc&ecirc; que quer perder peso mais f&aacute;cil e r&aacute;pido.</p>', '2317e7023e02c65f8ae134b8347b935c.jpg', '3');
INSERT INTO `modalidade` VALUES ('3', 'Step', '<p>&Eacute; impressionante o que podemos fazer com um simples aparelho de step ou mesmo com um degrau (que pode servir de step simples). Ent&atilde;o, basta 1 step, 1 par de t&ecirc;nis, e um notebook ou tablet conectado no v&iacute;deo acima. S&atilde;o exatamente 50 minutos de v&iacute;deo de&nbsp;gin&aacute;stica para fazer em casa.</p>', '3de8c2bc74b5d4cfbc97aced9da29d78.jpg', '2');
INSERT INTO `modalidade` VALUES ('4', 'Musculação', '<p>orem ipsum dolor sit amet, consectetur adipisicing quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.exclusivas para voc&ecirc; que quer perder peso mais f&aacute;cil e r&aacute;pidoexclusivas para voc&ecirc; que quer perder peso mais f&aacute;cil e r&aacute;pidoexclusivas para voc&ecirc; que quer perder peso mais f&aacute;cil e r&aacute;pido</p>', 'c408c2a2ead0fd08fc3520b5eb2d5aef.jpg', '4');
INSERT INTO `modalidade` VALUES ('6', 'Avaliação Física', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>', '9bd1e6b9b8e781c6531f04fc6aca2bb9.jpg', '1');

-- ----------------------------
-- Table structure for `noticia`
-- ----------------------------
DROP TABLE IF EXISTS `noticia`;
CREATE TABLE `noticia` (
  `id_noticia` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `resumo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `data` date NOT NULL,
  `contador` int(10) NOT NULL,
  `imagem_principal` varchar(255) DEFAULT NULL,
  `urlrewrite` varchar(255) NOT NULL,
  `m2ys` varchar(255) NOT NULL,
  PRIMARY KEY (`id_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of noticia
-- ----------------------------
INSERT INTO `noticia` VALUES ('4', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-04-27', '33', '9eb2338576eee7093708f0d40bc9a74e.jpg', 'mussum-ipsum-cacilds-vidis-litro-abertis-consetis-adipiscings-elitis-4', '');
INSERT INTO `noticia` VALUES ('5', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-04-27', '0', 'b7dea13075bbee52ac438c8e0e201023.jpg', 'mussum-ipsum-cacilds-vidis-litro-abertis-consetis-adipiscings-elitis5', '');
INSERT INTO `noticia` VALUES ('6', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-04-27', '1', 'd0e778d0e5a42ccdc5e54e1c8e9d5b0b.jpg', 'mussum-ipsum-cacilds-vidis-litro-abertis-consetis-adipiscings-elitis6', '');
INSERT INTO `noticia` VALUES ('7', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-04-27', '33', '6cbea0cf01470c9f412e73222394ebe4.jpg', 'mussum-ipsum-cacilds-vidis-litro-abertis-consetis-adipiscings-elitis-7', 'http://m2y.me/hZUt');
INSERT INTO `noticia` VALUES ('8', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-04-27', '3', '12cc42b67251b84572d99917d91a16cf.jpg', 'mussum-ipsum-cacilds-vidis-litro-abertis-consetis-adipiscings-elitis-8', '');
INSERT INTO `noticia` VALUES ('9', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-04-27', '24', 'f9d013d69e19eb0564feba9e31025e0d.jpg', 'mussum-ipsum-cacilds-vidis-litro-abertis-consetis-adipiscings-elitis-9', '');
INSERT INTO `noticia` VALUES ('10', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. ', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. ', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-05-27', '0', '08092160b131acd130099cc018c1be39.jpg', 'mussum-ipsum-cacilds-vidis-litro-abertis-consetis-adipiscings-elitis-10', '');
INSERT INTO `noticia` VALUES ('11', 'kdoskodkos', 'kkdoskodksoko', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-05-02', '4', '1c7e64a4d69f42b38f60f254676aa3fb.jpg', 'kdoskodkos11', 'http://m2y.me/10a');
INSERT INTO `noticia` VALUES ('12', 'sfdfdfd', 'fdedfd', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-05-02', '1', 'b35c0350c1ca2028d5af36852844f29c.jpg', 'sfdfdfd9', '');
INSERT INTO `noticia` VALUES ('13', 'dsds', 'dsdsds', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-05-02', '3', '37978de6717fc28b1c7d601ecd0e5063.jpg', 'dsds10', '');
INSERT INTO `noticia` VALUES ('14', 'dsdsdsds', 'sdsdsdsdss', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-05-02', '2', '3918190671e847a9289766e5a058934f.jpg', 'dsdsdsds11', '');
INSERT INTO `noticia` VALUES ('15', 'dsdsdsdsdsds', 'dsdsdsdsds', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>\r\n<p>&nbsp;</p>', '2014-05-02', '1', 'd409c29c0d16734166de36557a2b76bf.jpg', 'dsdsdsdsdsds12', '');
INSERT INTO `noticia` VALUES ('16', 'fdfdfd', 'sdfsfd', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>', '2014-05-02', '0', 'ef276f5cae58dd4f7c0111c3329e3ee8.jpg', 'fdfdfd13', '');
INSERT INTO `noticia` VALUES ('17', 'dsds', 'dsdsds', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>', '2014-05-02', '0', '8c558a07e9f0baa186719f84e6dd307f.jpg', 'dsds14', '');
INSERT INTO `noticia` VALUES ('18', 'dsd', 'dsds', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>', '2014-05-02', '0', '376beacda3a09e595a654285aba16afc.jpg', 'dsd15', '');
INSERT INTO `noticia` VALUES ('19', 'dsds', 'dsds', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>', '2014-05-02', '2', '1fbc1ba80ce6a0bea82130db45efabd2.jpg', 'dsds16', '');
INSERT INTO `noticia` VALUES ('20', 'dsds', 'dsds', '<p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra l&aacute; , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. M&eacute; faiz elementum girarzis, nisi eros vermeio, in elementis m&eacute; pra quem &eacute; amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>', '2014-05-02', '11', '0751f2955db4097fb51ca7bffba64db7.jpg', 'dsds17', '');

-- ----------------------------
-- Table structure for `noticia_imagem`
-- ----------------------------
DROP TABLE IF EXISTS `noticia_imagem`;
CREATE TABLE `noticia_imagem` (
  `id_noticia_imagem` int(10) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(10) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id_noticia_imagem`),
  KEY `noticia_imagem_id_noticia` (`id_noticia`),
  CONSTRAINT `noticia_imagem_id_noticia` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id_noticia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of noticia_imagem
-- ----------------------------
INSERT INTO `noticia_imagem` VALUES ('53', '5', 'b7dea13075bbee52ac438c8e0e201023.jpg');
INSERT INTO `noticia_imagem` VALUES ('54', '6', 'd0e778d0e5a42ccdc5e54e1c8e9d5b0b.jpg');
INSERT INTO `noticia_imagem` VALUES ('58', '10', '08092160b131acd130099cc018c1be39.jpg');
INSERT INTO `noticia_imagem` VALUES ('61', '4', '9a36f2a4361168be213a7b9d4506167f.jpg');
INSERT INTO `noticia_imagem` VALUES ('62', '4', '9eb2338576eee7093708f0d40bc9a74e.jpg');
INSERT INTO `noticia_imagem` VALUES ('63', '8', 'd9aeef1d1103b832534c135dd53b023d.jpg');
INSERT INTO `noticia_imagem` VALUES ('64', '8', '12cc42b67251b84572d99917d91a16cf.jpg');
INSERT INTO `noticia_imagem` VALUES ('65', '9', 'f0ea912856cca56776a24529765deda8.jpg');
INSERT INTO `noticia_imagem` VALUES ('66', '9', 'f9d013d69e19eb0564feba9e31025e0d.jpg');
INSERT INTO `noticia_imagem` VALUES ('68', '12', 'b35c0350c1ca2028d5af36852844f29c.jpg');
INSERT INTO `noticia_imagem` VALUES ('69', '13', '37978de6717fc28b1c7d601ecd0e5063.jpg');
INSERT INTO `noticia_imagem` VALUES ('70', '14', '3918190671e847a9289766e5a058934f.jpg');
INSERT INTO `noticia_imagem` VALUES ('71', '15', 'd409c29c0d16734166de36557a2b76bf.jpg');
INSERT INTO `noticia_imagem` VALUES ('72', '16', 'ef276f5cae58dd4f7c0111c3329e3ee8.jpg');
INSERT INTO `noticia_imagem` VALUES ('73', '17', '8c558a07e9f0baa186719f84e6dd307f.jpg');
INSERT INTO `noticia_imagem` VALUES ('74', '18', '376beacda3a09e595a654285aba16afc.jpg');
INSERT INTO `noticia_imagem` VALUES ('75', '19', '1fbc1ba80ce6a0bea82130db45efabd2.jpg');
INSERT INTO `noticia_imagem` VALUES ('76', '20', '0751f2955db4097fb51ca7bffba64db7.jpg');
INSERT INTO `noticia_imagem` VALUES ('80', '7', '6cbea0cf01470c9f412e73222394ebe4.jpg');
INSERT INTO `noticia_imagem` VALUES ('81', '11', '1c7e64a4d69f42b38f60f254676aa3fb.jpg');

-- ----------------------------
-- Table structure for `permissao`
-- ----------------------------
DROP TABLE IF EXISTS `permissao`;
CREATE TABLE `permissao` (
  `id_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id_permissao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permissao
-- ----------------------------

-- ----------------------------
-- Table structure for `permissao_modulo`
-- ----------------------------
DROP TABLE IF EXISTS `permissao_modulo`;
CREATE TABLE `permissao_modulo` (
  `id_permissao_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_permissao` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id_permissao_modulo`),
  KEY `permissao_id_permissao` (`id_permissao`),
  CONSTRAINT `permissao_id_permissao` FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id_permissao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permissao_modulo
-- ----------------------------

-- ----------------------------
-- Table structure for `plano`
-- ----------------------------
DROP TABLE IF EXISTS `plano`;
CREATE TABLE `plano` (
  `id_plano` int(11) NOT NULL AUTO_INCREMENT,
  `desc_plano` varchar(255) DEFAULT NULL,
  `qtd_dias` int(11) DEFAULT NULL,
  `valor` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`id_plano`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of plano
-- ----------------------------

-- ----------------------------
-- Table structure for `sobre`
-- ----------------------------
DROP TABLE IF EXISTS `sobre`;
CREATE TABLE `sobre` (
  `id_sobre` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_sobre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sobre
-- ----------------------------
INSERT INTO `sobre` VALUES ('1', 'Sobre1', 'b6489f63c367215c09e2ff373a82d4bb.jpg', '1');
INSERT INTO `sobre` VALUES ('2', 'Capa2', 'afe98a8463743a5bb35fa3d0db3d225a.jpg', '1');
INSERT INTO `sobre` VALUES ('3', 'Teste', '6edca5b71dabd2fe059a9269119fd101.jpg', '1');

-- ----------------------------
-- Table structure for `treino`
-- ----------------------------
DROP TABLE IF EXISTS `treino`;
CREATE TABLE `treino` (
  `id_treino` int(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `series_mascara` varchar(255) NOT NULL,
  PRIMARY KEY (`id_treino`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of treino
-- ----------------------------
INSERT INTO `treino` VALUES ('1', '7', '1', '3x10');
INSERT INTO `treino` VALUES ('2', '7', '2', '3x10');
INSERT INTO `treino` VALUES ('3', '7', '3', '3x10');
INSERT INTO `treino` VALUES ('4', '7', '4', '3x10');
INSERT INTO `treino` VALUES ('5', '7', '5', '3x10');
INSERT INTO `treino` VALUES ('6', '7', '6', '3x10');
INSERT INTO `treino` VALUES ('7', '7', '7', '3x10');
INSERT INTO `treino` VALUES ('8', '7', '8', '3x12');
INSERT INTO `treino` VALUES ('9', '7', '9', '3x12');
INSERT INTO `treino` VALUES ('10', '7', '10', '3x12');
INSERT INTO `treino` VALUES ('11', '7', '4', '3x12');
INSERT INTO `treino` VALUES ('12', '7', '5', '3x12');
INSERT INTO `treino` VALUES ('13', '7', '6', '3x12');
INSERT INTO `treino` VALUES ('14', '7', '7', '3x12');
INSERT INTO `treino` VALUES ('15', '7', '8', '3x12');
INSERT INTO `treino` VALUES ('16', '7', '9', '3x12');
INSERT INTO `treino` VALUES ('17', '7', '10', '3x12');
INSERT INTO `treino` VALUES ('18', '7', '4', '3x12');
INSERT INTO `treino` VALUES ('19', '7', '5', '3x12');
INSERT INTO `treino` VALUES ('20', '7', '6', '3x12');
INSERT INTO `treino` VALUES ('21', '7', '7', '3x12');

-- ----------------------------
-- Table structure for `treino_cliente`
-- ----------------------------
DROP TABLE IF EXISTS `treino_cliente`;
CREATE TABLE `treino_cliente` (
  `id_treino_cliente` int(15) NOT NULL AUTO_INCREMENT,
  `id_treino_sistema` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_treino_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='treino_cliente';

-- ----------------------------
-- Records of treino_cliente
-- ----------------------------

-- ----------------------------
-- Table structure for `treino_dia`
-- ----------------------------
DROP TABLE IF EXISTS `treino_dia`;
CREATE TABLE `treino_dia` (
  `id_treino_dia` int(11) NOT NULL AUTO_INCREMENT,
  `id_treino` int(11) NOT NULL,
  `id_dia` int(11) NOT NULL,
  PRIMARY KEY (`id_treino_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of treino_dia
-- ----------------------------
INSERT INTO `treino_dia` VALUES ('1', '1', '1');
INSERT INTO `treino_dia` VALUES ('2', '2', '1');
INSERT INTO `treino_dia` VALUES ('3', '3', '1');
INSERT INTO `treino_dia` VALUES ('4', '4', '1');
INSERT INTO `treino_dia` VALUES ('5', '5', '1');
INSERT INTO `treino_dia` VALUES ('6', '6', '1');
INSERT INTO `treino_dia` VALUES ('7', '7', '3');
INSERT INTO `treino_dia` VALUES ('8', '1', '3');
INSERT INTO `treino_dia` VALUES ('9', '2', '3');
INSERT INTO `treino_dia` VALUES ('10', '3', '3');
INSERT INTO `treino_dia` VALUES ('11', '4', '3');
INSERT INTO `treino_dia` VALUES ('12', '5', '3');
INSERT INTO `treino_dia` VALUES ('13', '6', '3');
INSERT INTO `treino_dia` VALUES ('14', '7', '1');
INSERT INTO `treino_dia` VALUES ('15', '8', '2');
INSERT INTO `treino_dia` VALUES ('16', '9', '2');
INSERT INTO `treino_dia` VALUES ('17', '10', '2');
INSERT INTO `treino_dia` VALUES ('18', '11', '2');
INSERT INTO `treino_dia` VALUES ('19', '12', '2');
INSERT INTO `treino_dia` VALUES ('20', '13', '2');
INSERT INTO `treino_dia` VALUES ('21', '14', '2');
INSERT INTO `treino_dia` VALUES ('22', '8', '4');
INSERT INTO `treino_dia` VALUES ('23', '9', '4');
INSERT INTO `treino_dia` VALUES ('24', '10', '4');
INSERT INTO `treino_dia` VALUES ('25', '11', '4');
INSERT INTO `treino_dia` VALUES ('26', '12', '4');
INSERT INTO `treino_dia` VALUES ('27', '13', '4');
INSERT INTO `treino_dia` VALUES ('28', '14', '4');

-- ----------------------------
-- Table structure for `treino_exercicios`
-- ----------------------------
DROP TABLE IF EXISTS `treino_exercicios`;
CREATE TABLE `treino_exercicios` (
  `id_treino_exercicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_treino` int(11) NOT NULL,
  `id_exercicio` int(11) NOT NULL,
  PRIMARY KEY (`id_treino_exercicio`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of treino_exercicios
-- ----------------------------
INSERT INTO `treino_exercicios` VALUES ('1', '1', '3');
INSERT INTO `treino_exercicios` VALUES ('2', '1', '14');
INSERT INTO `treino_exercicios` VALUES ('3', '2', '19');
INSERT INTO `treino_exercicios` VALUES ('4', '2', '21');
INSERT INTO `treino_exercicios` VALUES ('5', '3', '11');
INSERT INTO `treino_exercicios` VALUES ('6', '3', '13');
INSERT INTO `treino_exercicios` VALUES ('7', '4', '7');
INSERT INTO `treino_exercicios` VALUES ('8', '4', '8');
INSERT INTO `treino_exercicios` VALUES ('9', '5', '25');
INSERT INTO `treino_exercicios` VALUES ('10', '5', '27');
INSERT INTO `treino_exercicios` VALUES ('11', '7', '38');
INSERT INTO `treino_exercicios` VALUES ('12', '7', '40');

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_sistema` int(11) DEFAULT NULL,
  `id_permissao` int(10) DEFAULT NULL,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `sobre_nome` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `acesso_cliente` int(5) DEFAULT NULL,
  `id_treino` int(11) DEFAULT NULL,
  `id_plano` int(11) NOT NULL,
  `dt_vencimento` date DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuario_id_treino` (`id_treino`),
  KEY `usuario_id_plano` (`id_plano`),
  KEY `usuario_id_permissao` (`id_permissao`),
  CONSTRAINT `usuario_id_permissao` FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id_permissao`),
  CONSTRAINT `usuario_id_plano` FOREIGN KEY (`id_plano`) REFERENCES `plano` (`id_plano`),
  CONSTRAINT `usuario_id_treino` FOREIGN KEY (`id_treino`) REFERENCES `treino_cliente` (`id_treino_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuario
-- ----------------------------
