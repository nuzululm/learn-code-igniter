/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : db_webtest

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 14/10/2022 08:54:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_barang
-- ----------------------------
DROP TABLE IF EXISTS `m_barang`;
CREATE TABLE `m_barang`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah_stok` int(5) NULL DEFAULT 0,
  `harga_jual` double NULL DEFAULT NULL,
  `satuan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'PCS',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_barang
-- ----------------------------
INSERT INTO `m_barang` VALUES (1, 'ITEM-001', 'TV LED SHARP 40\" ', 30, 2550000, 'PCS');
INSERT INTO `m_barang` VALUES (2, 'ITEM-002', 'MAGIC COM PHILIPS STAINLESS', 40, 525000, 'PCS');
INSERT INTO `m_barang` VALUES (3, 'ITEM-003', 'MAGIC COM YONG MA', 25, 450000, 'PCS');
INSERT INTO `m_barang` VALUES (4, 'ITEM-004', 'TV LED POLYTRON 32\"', 35, 1630000, 'PCS');
INSERT INTO `m_barang` VALUES (5, 'ITEM-005', 'SETRIKA MASPION', 20, 150000, 'PCS');
INSERT INTO `m_barang` VALUES (6, 'ITEM-006', 'SETRIKA TURBO', 20, 125000, 'PCS');
INSERT INTO `m_barang` VALUES (7, 'ITEM-007', 'BLENDER MASPION', 30, 250000, 'PCS');
INSERT INTO `m_barang` VALUES (8, 'ITEM-008', 'MESIN CUCI SAMSUNG', 10, 1410000, 'PCS');
INSERT INTO `m_barang` VALUES (9, 'ITEM-009', 'KIPAS ANGIN COSMOS', 20, 175000, 'PCS');
INSERT INTO `m_barang` VALUES (10, 'ITEM-010', 'KIPAS ANGIN MASPION', 20, 225000, 'PCS');
INSERT INTO `m_barang` VALUES (11, 'ITEM-011', 'TERMOS ELEPHANT 2 L', 15, 200000, 'PCS');
INSERT INTO `m_barang` VALUES (12, 'ITEM-012', 'STB TANAKA', 20, 215000, 'PCS');

-- ----------------------------
-- Table structure for m_customer
-- ----------------------------
DROP TABLE IF EXISTS `m_customer`;
CREATE TABLE `m_customer`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kota` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pos` int(5) NULL DEFAULT NULL,
  `telp1` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telp2` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_customer
-- ----------------------------
INSERT INTO `m_customer` VALUES (1, 'C-001', 'AGRI MAKMUR CV', 'JL. PROF. DR. MOESTOPO NO. 99', 'SURABAYA', 60286, '0310254154', '0310254153');
INSERT INTO `m_customer` VALUES (2, 'C-002', 'INDAH JAYA SENTOSA CV', 'PULO WONOKROMO', 'SURABAYA', 60241, '0857844466610', '0857844466612');
INSERT INTO `m_customer` VALUES (3, 'C-003', 'MUHAIMIN IQBAL', 'JL. KYAI MOJO 25, KRIAN', 'SIDOARJO', 61262, '0857844400010', '0857844400011');
INSERT INTO `m_customer` VALUES (4, 'C-004', 'ARIF SUGIARTO', 'JL. SUPRATMAN, WONOAYU', 'SIDOARJO', 61261, '085600012312', '085600012313');
INSERT INTO `m_customer` VALUES (5, 'C-005', 'ILHAM MAULANA', 'JL. A. YANI 98', 'SURABAYA', 60235, '08911561255', '085600012314');
INSERT INTO `m_customer` VALUES (6, 'C-006', 'KHOIRUL ANWAR', 'JL. SUDIRMAN 44', 'SURABAYA', 60271, '0310254199', '085600012399');

-- ----------------------------
-- Table structure for m_gudang
-- ----------------------------
DROP TABLE IF EXISTS `m_gudang`;
CREATE TABLE `m_gudang`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_gudang
-- ----------------------------
INSERT INTO `m_gudang` VALUES (1, 'GD-A', 'Gudang A');
INSERT INTO `m_gudang` VALUES (2, 'GD-B', 'Gudang B');
INSERT INTO `m_gudang` VALUES (3, 'GD-C', 'Gudang C');
INSERT INTO `m_gudang` VALUES (4, 'GD-D', 'Gudang D');

-- ----------------------------
-- Table structure for sales_order
-- ----------------------------
DROP TABLE IF EXISTS `sales_order`;
CREATE TABLE `sales_order`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tgl_dokumen` date NULL DEFAULT NULL,
  `gudang_kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_nama` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `customer_kota` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_pos` int(5) NULL DEFAULT NULL,
  `customer_telp1` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_telp2` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total_quantity` int(11) NULL DEFAULT NULL,
  `total_penjualan` double NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sales_order_line
-- ----------------------------
DROP TABLE IF EXISTS `sales_order_line`;
CREATE TABLE `sales_order_line`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) NULL DEFAULT NULL,
  `barang_kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `satuan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_satuan` double NULL DEFAULT NULL,
  `diskon` int(11) NULL DEFAULT NULL,
  `sub_total` double NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
