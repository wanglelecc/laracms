-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.18-log - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 com_leleserver_laracms 的数据库结构
DROP DATABASE IF EXISTS `com_leleserver_laracms`;
CREATE DATABASE IF NOT EXISTS `com_leleserver_laracms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `com_leleserver_laracms`;

-- 导出  表 com_leleserver_laracms.lara_articles 结构
DROP TABLE IF EXISTS `lara_articles`;
CREATE TABLE IF NOT EXISTS `lara_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'objectId',
  `alias` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '别名',
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题',
  `subtitle` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '副标题',
  `keywords` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关键字',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文章描述',
  `author` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文章作者',
  `source` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文章来源',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `thumb` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面',
  `is_link` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'isLink',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Link',
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '文章状态',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '浏览数',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '权重',
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '模板',
  `css` text COLLATE utf8mb4_unicode_ci COMMENT 'style',
  `js` text COLLATE utf8mb4_unicode_ci COMMENT 'javascript',
  `top` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '置顶',
  `created_op` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  `updated_op` int(11) NOT NULL DEFAULT '0' COMMENT '更新人',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `object_id_unique` (`object_id`),
  KEY `order_index` (`order`),
  KEY `views_index` (`views`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_articles 的数据：~13 rows (大约)
DELETE FROM `lara_articles`;
/*!40000 ALTER TABLE `lara_articles` DISABLE KEYS */;
INSERT INTO `lara_articles` (`id`, `object_id`, `alias`, `title`, `subtitle`, `keywords`, `description`, `author`, `source`, `content`, `thumb`, `is_link`, `link`, `type`, `status`, `views`, `order`, `weight`, `template`, `css`, `js`, `top`, `created_op`, `updated_op`, `created_at`, `updated_at`) VALUES
	(1, '1593889566486881', NULL, '享受购置税减半的B级车推荐', NULL, NULL, '前不久，一则重磅新闻引爆国内汽车市场，那就是国务院总理李克强9月29日主持召开国务院常务会议中决定，从2015年10月1日到2016年12月31日，对购买1.6升及以下排量乘用车实施减半征收车辆购置税的优惠政策。这便意味...', '稀饭不加糖', NULL, '<p><span style="color:rgb(85,85,85);font-size:15px;">前不久，一则重磅新闻引爆国内汽车市场，那就是国务院总理李克强9月29日主持召开国务院常务会议中决定，从2015年10月1日到2016年12月31日，对购买1.6升及以下排量乘用车实施减半征收车辆购置税的优惠政策。这便意味着市场上那些符合这一标准的车型，在消费者交全款买车前，就已经有了几千元甚至上万元的优惠！应该说此项举措对于目前比较消沉的车市以及不少持币观望合适买车的消费者来说，能起不少推动和促进的效果。</span></p>\r\n\r\n<p><span style="color:rgb(85,85,85);font-size:15px;">但在不少消费者心中，总是认为符合这一标准的车型基本都集中在了紧凑级以及微型车，对于那些想买级别再高车型的朋友来说有点不沾边。其实有这种想法的朋友大可不必担心，因为在目前的市场上，配有小排量涡轮增压发动机的B级车有很多，完全满足市场的要求。今天，我们特意选出了4款在这个级别比较有特点的车型，希望能对您有些帮助。</span></p>', NULL, '0', NULL, 'article', 1, 0, 9999, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:33:17', '2018-03-04 14:58:24'),
	(2, '1593889630591207', NULL, '荷兰人测试无人驾驶大巴笑哭了 车只跑了200米', NULL, NULL, '2月1日消息，上个星期，6 名居住在瓦格宁根的荷兰人，度过难忘的旅程。——他们坐上了全荷兰首次公开驾驶的无人驾驶汽车，尽管车速只有 8 km/h 的速度，行驶了 200 米的距离。  这个无人驾驶汽车由 The WePod 公司制造...', '稀饭不加糖', NULL, '<p>2月1日消息，上个星期，6 名居住在瓦格宁根的荷兰人，度过难忘的旅程。——他们坐上了全荷兰首次公开驾驶的无人驾驶汽车，尽管车速只有 8 km/h 的速度，行驶了 200 米的距离。</p>\r\n\r\n<p>这个无人驾驶汽车由 The WePod 公司制造，它的最高行驶速度当然不止 8km/h，不过为了公开测试的安全性，所以特意降低了行驶的速度。要知道，除了车上的 6 个人，路边还有很多好奇宝宝观摩。</p>', NULL, '0', NULL, 'article', 1, 1, 999, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:33:56', '2018-03-04 14:58:24'),
	(3, '1593889676648976', NULL, '任天堂或重返VR市场：一别已过二十一年', NULL, NULL, '2月3日消息，据外媒报道称，最近日本任天堂社长君岛达己日前在盈余电话会议上也将虚拟现实称作是“有趣的技术”。这一表述和之前苹果公司库克的表述极其类似。据报道，以游戏机和马里奥知名的任天堂表示他们正在探索虚...', '稀饭不加糖', NULL, '<p><span style="font-size:15px;">2月3日消息，据外媒报道称，最近日本任天堂社长君岛达己日前在盈余电话会议上也将</span><a href="http://www.kejixun.com/special/xunixianshi/">虚拟现实</a><span style="font-size:15px;">称作是“有趣的技术”。这一表述和之前苹果公司库克的表述极其类似。据报道，以</span><a href="http://www.kejixun.com/game/">游戏</a><span style="font-size:15px;">机和马里奥知名的任天堂表示他们正在</span><a href="http://tansuo.kejixun.com/">探索</a><span style="font-size:15px;">虚拟现实技术，但目前还没有发布任何产品的具体计划。</span></p>\r\n\r\n<p>实际上，任天堂早在1995年就率先推出了市面上最早的虚拟现实设备之一Virtual Boy，但由于高售价、黑白屏幕和易引发头晕恶心等问题，这款设备最终惨遭失败。当然，如今的虚拟现实已经成为业界新宠，也吸引到各大巨头涉足其中，为消费者越来越频繁地带来自己的虚拟现实设备。</p>', NULL, '0', NULL, 'article', 1, 2, 8, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:34:42', '2018-03-04 14:57:05'),
	(4, '1593889730658221', NULL, '阿里巴巴投资VR创业公司Magic Leap', NULL, NULL, '增强现实(AR)正在成为下一个热门的投资领域。就在昨日，增强现实(AR)创业公司Magic Leap今日宣布，在新一轮融资中获得7.935亿美元的投资，本轮融资由阿里巴巴领投。  其他新投资者还包括华纳兄弟、富达管理研究公司...', '稀饭不加糖', NULL, '<p><span style="font-size:15px;">增强现实(AR)正在成为下一个热门的投资领域。就在昨日，增强现实(AR)创业公司Magic Leap今日宣布，在新一轮融资中获得7.935亿美元的投资，本轮融资由</span><a href="http://www.kejixun.com/special/Alibaba/">阿里巴巴</a><span style="font-size:15px;">领投。</span></p>\r\n\r\n<p>其他新投资者还包括华纳兄弟、富达管理研究公司、摩根大通和摩根士丹利投资管理公司。此外，当前股东谷歌和高通风投(Qualcomm Ventures)也参与了本轮融资。</p>\r\n\r\n<p>高盛日前发布的一份报告显示，过去两年中<a href="http://www.kejixun.com/special/xunixianshi/">VR</a>/AR领域共进行225笔风险投资，投资额达35亿美元。与90年代的失败相比，当前的VR热有什么不同?答案在于技术。</p>', NULL, '0', NULL, 'article', 1, 1, 88, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:35:20', '2018-03-04 14:57:05'),
	(5, '1593889782101318', NULL, '全能跨界SUV推荐 个性与实用也能兼得', NULL, NULL, '凤凰汽车·多车导购 当今是个看脸的时代，什么东西要是和颜值好粘上边的话，那就等于成功了一半，这个观点在汽车界也特别实用。现在有不少的消费者在买车前都有一个苦恼，就是恨不得我买的这辆车既可以满足我对外形的...', '稀饭不加糖', NULL, '<p>凤凰汽车·多车导购 当今是个看脸的时代，什么东西要是和颜值好粘上边的话，那就等于<a href="http://data.auto.ifeng.com/price/p-30040-1-1.html">成功</a>了一半，这个观点在汽车界也特别实用。现在有不少的消费者在买车前都有一个苦恼，就是恨不得我买的这辆车既可以满足我对外形的要求，还要得够用，同样在功能上也得丰富，应该说是相当的纠结。这时您不妨看看在市面上的这些跨界SUV车型，这些车型在功能上自然不必多说，特别在样子上，应该说都能满足“外貌协会成员们”的喜爱，今天我们选出了四款在售的跨界SVU车型，希望能对您有所帮助！</p>\r\n\r\n<p>国产奔驰GLA</p>\r\n\r\n<p>售价：26.98-39.8万元</p>\r\n\r\n<p>在国产奔驰<a href="http://car.auto.ifeng.com/series/10508/">GLA级</a>上市之前，国内豪华紧凑SUV市场一直被华晨<a href="http://car.auto.ifeng.com/series/9607/">宝马X1</a>以及<a href="http://car.auto.ifeng.com/brand/10060/">一汽</a><a href="http://car.auto.ifeng.com/series/9839/">奥迪Q3</a>所占据，可以说除了这两款车，消费者基本没得可选。很多消费者一直在盼望着这个级别奔驰的车型能够上市。在今年的4月，国产GLA级正式上市，其不到27万元的价格让它成为了奔驰车最便宜的SUV车型。</p>\r\n\r\n<p>国产车型的样子与进口车型基本保持一致，这点非常值得称赞。相比同级别的X1和Q3，GLA级显然要更精致、更好看，对于不少外貌协会的朋友来说，十分符合他们的心意。车身尺寸方面，它的车身高度不占任何优势，而离地间隙却是最高的。</p>', NULL, '0', NULL, 'article', 1, 0, 888, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:36:15', '2018-03-04 14:58:24'),
	(6, '1593889837701212', NULL, '非日系合资轿车推荐 均为细分市场标杆', NULL, NULL, '凤凰汽车·多车导购 很多国内消费者在选购车辆时都比较倾向于合资车型，原因大多是感觉合资车型在质量、工艺等方面更为可靠。而这其中，以经济实用见长的日系车型在近年来表现强势，销量表现也是节节高升。但不可否认...', '稀饭不加糖', NULL, '<p><span style="font-size:16px;">凤凰汽车·多车导购 很多国内消费者在选购车辆时都比较倾向于合资车型，原因大多是感觉合资车型在质量、工艺等方面更为可靠。而这其中，以经济实用见长的日系车型在近年来表现强势，销量表现也是节节高升。但不可否认，历史遗留问题还是限制了很大一部分消费者购买日系车型。今天的文章，我们就为大家在轿车类别各细分市场精选了4款标杆级车型，如果您在近期有购车计划，那么希望今天的文章能够对您有所帮助。</span></p>\r\n\r\n<p><span style="font-size:16px;">级别：小型车</span></p>\r\n\r\n<p><span style="font-size:16px;">推荐车型：雪佛兰赛欧</span></p>\r\n\r\n<p><span style="font-size:16px;">官方指导价：5.99-7.99</span></p>\r\n\r\n<p><span style="font-size:16px;">新赛欧采用新一代雪佛兰设计语言，新车配备了雪佛兰全球最新家族式双格栅，进气口边缘的角度与老款赛欧的盾牌型进气口比较相似。尾部方面，新赛欧在尾灯造型与保险杠处均经过了全新设计，蝶形双尾灯以及层次丰富的尾部设计，使得整车看上去更为动感。</span></p>', NULL, '0', NULL, 'article', 1, 0, 888, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:36:58', '2018-03-04 14:58:24'),
	(7, '1593889884583943', NULL, '汽车圈的技术宅又发大招了', NULL, NULL, '2015年度Honda中国媒体大会在深圳召开，这次媒体大会上本田技研介绍了即将在中国市场投放的两项新技术和新技术的搭载计划，并公布了部分未来车型的发表计划，一向被人称为汽车圈里“技术宅”的本田技研，这次给中国市...', '稀饭不加糖', NULL, '<p><span style="color:rgb(85,85,85);font-size:16px;">2015年度Honda中国媒体大会在深圳召开，这次媒体大会上本田技研介绍了即将在中国市场投放的两项新技术和新技术的搭载计划，并公布了部分未来车型的发表计划，一向被人称为汽车圈里“技术宅”的本田技研，这次给中国市场带来了什么新鲜玩意儿呢？</span></p>\r\n\r\n<p><span style="color:rgb(85,85,85);font-size:16px;">安全驾驶辅助系统Honda SENSING（安全超感）</span></p>\r\n\r\n<p><span style="color:rgb(85,85,85);font-size:16px;">Honda SENSING（安全超感）系统是在以往车辆主/被动安全经验的基础上，面向未来自动驾驶需求开发的全方位安全驾驶辅助系统。</span></p>', NULL, '0', NULL, 'article', 1, 0, 88, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:37:32', '2018-03-04 14:58:24'),
	(8, '1593889903760156', NULL, '中型SUV安全性能大比拼', NULL, NULL, '凤凰汽车•多车导购 对于中型SUV而言，除了大多数消费者都会关心的乘坐舒适性以及储物空间大小，在安全性方面我们也同样不能忽视。我们通过《购车消费评价》的实测数据为大家带来各个级别车型在某一方面的横向对比，...', '稀饭不加糖', NULL, '<p>凤凰汽车•多车导购 对于中型SUV而言，除了大多数消费者都会关心的乘坐舒适性以及储物空间大小，在安全性方面我们也同样不能忽视。<br />我们通过《购车消费评价》的实测数据为大家带来各个级别车型在某一方面的横向对比，不吹不黑，完全用事实说话，来为大家的选车提供最准确的参考。</p>\r\n\r\n<p>本期我们锁定的对比对象是中型SUV，由于一款车的安全性会涉及到十分多的方面，因此我们仅通过车辆在100公里每小时的紧急制动表现、主被动安全性配置来了解一款车辆在这两方的安全性，来为大家选车提供一些参考。</p>', NULL, '0', NULL, 'article', 1, 1, 888, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:38:04', '2018-03-04 15:20:35'),
	(9, '1593889942778211', NULL, '大型招聘会现场', NULL, NULL, '增强现实(AR)正在成为下一个热门的投资领域。就在昨日，增强现实(AR)创业公司Magic Leap今日宣布，在新一轮融资中获得7.935亿美元的投资，本轮融资由阿里巴巴领投。  其他新投资者还包括华纳兄弟、富达管理研究公司...', '稀饭不加糖', NULL, '<p><span style="font-size:15px;">增强现实(AR)正在成为下一个热门的投资领域。就在昨日，增强现实(AR)创业公司Magic Leap今日宣布，在新一轮融资中获得7.935亿美元的投资，本轮融资由</span><a href="http://www.kejixun.com/special/Alibaba/">阿里巴巴</a><span style="font-size:15px;">领投。</span></p>\r\n\r\n<p>其他新投资者还包括华纳兄弟、富达管理研究公司、摩根大通和摩根士丹利投资管理公司。此外，当前股东谷歌和高通风投(Qualcomm Ventures)也参与了本轮融资。</p>\r\n\r\n<p>高盛日前发布的一份报告显示，过去两年中<a href="http://www.kejixun.com/special/xunixianshi/">VR</a>/AR领域共进行225笔风险投资，投资额达35亿美元。与90年代的失败相比，当前的VR热有什么不同?答案在于技术。</p>', NULL, '0', NULL, 'article', 1, 0, 888, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:38:38', '2018-03-04 14:58:24'),
	(10, '1593890202413795', NULL, '快快加入我们', NULL, NULL, '增强现实(AR)正在成为下一个热门的投资领域。就在昨日，增强现实(AR)创业公司Magic Leap今日宣布，在新一轮融资中获得7 935亿美元的投资，本轮融资由阿里巴巴领投。', '稀饭不加糖', NULL, '<p><span style="color:rgb(51,51,51);font-size:14px;">增强现实(AR)正在成为下一个热门的投资领域。就在昨日，增强现实(AR)创业公司Magic Leap今日宣布，在新一轮融资中获得7 935亿美元的投资，本轮融资由阿里巴巴领投。</span><br /></p>', NULL, '0', NULL, 'article', 1, 0, 88, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:42:51', '2018-03-04 14:58:24'),
	(11, '1593890267967061', NULL, '招产品经理一位', NULL, NULL, '岗位职责：  完成需求分析，并完成产品策划.原型设计负责跟踪管理完成产品的界面.功能.流程设计监控产品运行效果，收集用户反馈，分析用户行为统计数据，挖掘并发现用户需求，并根对产品进行持续改进制定明确的产品...', '稀饭不加糖', NULL, '<h4>岗位职责：</h4>\r\n\r\n<ol><li>完成需求分析，并完成产品策划.原型设计</li><li>负责跟踪管理完成产品的界面.功能.流程设计</li><li>监控产品运行效果，收集用户反馈，分析用户行为统计数据，挖掘并发现用户需求，并根对产品进行持续改进</li><li>制定明确的产品功能规划，以及产品项目计划，为开发团队提供明确的产品资料文档</li><li>负责用户研究，把握用户需求和行为特点，实现用户需求</li><li>提升整体产品用户满意度</li><li>对线上产品持续进行数据分析与挖掘，根据数据提出产品改进和新产品的具体思路</li></ol>\r\n\r\n<h4>岗位要求：</h4>\r\n\r\n<ol><li><p>3年以上互联网产品工作经验，有平台类产品设计工作经验者优先</p></li><li><p>表达能力强，能够与开发和设计同事进行良好的沟通</p></li><li><p>了解互联网产品整体实现过程，包括从需求分析到产品发布</p></li><li><p>良好的逻辑思维能力，分析问题、解决问题的能力和执行力</p></li><li><p>充满责任心、服务和敬业精神</p></li></ol>', NULL, '0', NULL, 'article', 1, 0, 88, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:43:37', '2018-03-04 14:58:24'),
	(12, '1593890292139934', NULL, '招聘结算主管', NULL, NULL, '岗位职责：  确保公司业务收付款资金安全，高效根据公司业务方向,规划结算部门架构及确认各岗位职责及KPI结算部管理制度，结算工作流程的策划建立跨部分沟通，处理系统新需求和资金结算中的问题出具成本收入分析报表...', '稀饭不加糖', NULL, '<h4>岗位职责：</h4>\r\n\r\n<ol><li>确保公司业务收付款资金安全，高效</li><li>根据公司业务方向,规划结算部门架构及确认各岗位职责及KPI</li><li>结算部管理制度，结算工作流程的策划建立</li><li>跨部分沟通，处理系统新需求和资金结算中的问题</li><li>出具成本收入分析报表</li></ol>\r\n\r\n<h4>岗位要求：</h4>\r\n\r\n<ol><li><p>3年以上互联网金融或第三方支付公司结算管理工作者优先</p></li><li><p>熟悉清结算各项实务的操作流程，熟悉国家结算法规政策，并能实际操作运用</p></li><li><p>有较强的亲和力和表达能力良好的沟通组织协调能力.优秀的解决复杂问题的能力</p></li><li><p>能在一定的压力下开展工作，并能够快速持续的学习</p></li></ol>', NULL, '0', NULL, 'article', 1, 1, 888, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 12:44:13', '2018-03-04 15:20:45'),
	(13, '1593908565063148', NULL, '联系我们', NULL, NULL, NULL, '稀饭不加糖', NULL, '<p><img src="http://qd0046.theme.chanzhi.org/data/source/default/default/addicon.png" alt="addicon.png" /></p>\r\n\r\n<h4>公司地址</h4>\r\n\r\n<p>中国 青岛 开发区 武夷山路888号</p>\r\n\r\n<p><img src="http://qd0046.theme.chanzhi.org/data/source/default/default/phone.png" alt="phone.png" /></p>\r\n\r\n<h4>联系电话</h4>\r\n\r\n<p>400-8888-6666</p>\r\n\r\n<p><img src="http://qd0046.theme.chanzhi.org/data/source/default/default/name.png" alt="name.png" /></p>\r\n\r\n<h4>人才招聘</h4>\r\n\r\n<p>HR@163.com</p>\r\n\r\n<p><img src="http://qd0046.theme.chanzhi.org/data/source/default/default/email.png" alt="email.png" /></p>\r\n\r\n<h4>业务合作</h4>\r\n\r\n<p>yewu@163.com</p>\r\n\r\n<p><img src="http://qd0046.theme.chanzhi.org/data/source/default/default/media.png" alt="media.png" /></p>\r\n\r\n<h4>媒体合作</h4>\r\n\r\n<p>meiti@163.com</p>', NULL, '0', NULL, 'page', 1, 3, 999, 0, NULL, NULL, NULL, '0', 1, 1, '2018-03-03 17:34:21', '2018-03-04 15:21:38');
/*!40000 ALTER TABLE `lara_articles` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_article_category 结构
DROP TABLE IF EXISTS `lara_article_category`;
CREATE TABLE IF NOT EXISTS `lara_article_category` (
  `article_id` int(10) unsigned NOT NULL COMMENT '文章ID',
  `category_id` int(10) unsigned NOT NULL COMMENT '分类ID',
  UNIQUE KEY `article_id_and_category_id_unique` (`article_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_article_category 的数据：~15 rows (大约)
DELETE FROM `lara_article_category`;
/*!40000 ALTER TABLE `lara_article_category` DISABLE KEYS */;
INSERT INTO `lara_article_category` (`article_id`, `category_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 2),
	(5, 3),
	(6, 2),
	(7, 2),
	(7, 3),
	(8, 2),
	(8, 3),
	(9, 4),
	(10, 4),
	(11, 4),
	(12, 4);
/*!40000 ALTER TABLE `lara_article_category` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_blocks 结构
DROP TABLE IF EXISTS `lara_blocks`;
CREATE TABLE IF NOT EXISTS `lara_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'objectId',
  `group` int(11) NOT NULL DEFAULT '0' COMMENT '分组',
  `type` enum('latestArticle','hotArticle','latestProduct','hotProduct','slide','articleTree','productTree','blogTree','pageList','contact','about','links','header','followUs','html','htmlcode','phpcode') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default' COMMENT '模板',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
  `more_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '更多链接名称',
  `more_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '更多链接',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `created_op` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  `updated_op` int(11) NOT NULL DEFAULT '0' COMMENT '更新人',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `object_id_unique` (`object_id`),
  KEY `type_index` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_blocks 的数据：~0 rows (大约)
DELETE FROM `lara_blocks`;
/*!40000 ALTER TABLE `lara_blocks` DISABLE KEYS */;
INSERT INTO `lara_blocks` (`id`, `object_id`, `group`, `type`, `template`, `title`, `icon`, `more_title`, `more_link`, `content`, `created_op`, `updated_op`, `created_at`, `updated_at`) VALUES
	(1, '1593921820130870', 0, 'slide', 'default', '首页幻灯', NULL, NULL, NULL, '{"mark":"1"}', 1, 1, '2018-03-03 21:05:02', '2018-03-03 21:05:02'),
	(2, '1593926806514812', 0, 'hotArticle', 'default', '企业新闻', NULL, '更多', 'http://laracms.leleserver.cc/article/list_2_1.html', '{"category_id":"1","display":"4"}', 1, 1, '2018-03-03 22:24:17', '2018-03-03 22:24:17'),
	(3, '1593929822441295', 0, 'hotArticle', 'default', '成功案例', NULL, '更多', 'http://laracms.leleserver.cc/article/list_3_2.html', '{"category_id":"2","display":"4"}', 1, 1, '2018-03-03 23:12:13', '2018-03-03 23:12:13'),
	(4, '1593930272075407', 0, 'hotArticle', 'default', '本周热议', NULL, NULL, NULL, '{"category_id":"3","display":"10"}', 1, 1, '2018-03-03 23:19:22', '2018-03-03 23:19:22');
/*!40000 ALTER TABLE `lara_blocks` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_categorys 结构
DROP TABLE IF EXISTS `lara_categorys`;
CREATE TABLE IF NOT EXISTS `lara_categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `keywords` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关键字',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '描述',
  `parent` int(11) NOT NULL COMMENT '父id',
  `order` int(11) NOT NULL COMMENT '排序',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路径',
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接',
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '模板',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_index` (`type`),
  KEY `parent_index` (`parent`),
  KEY `path_index` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_categorys 的数据：~4 rows (大约)
DELETE FROM `lara_categorys`;
/*!40000 ALTER TABLE `lara_categorys` DISABLE KEYS */;
INSERT INTO `lara_categorys` (`id`, `name`, `keywords`, `description`, `parent`, `order`, `path`, `type`, `link`, `template`, `created_at`, `updated_at`) VALUES
	(1, '企业新闻', NULL, NULL, 0, 888, '0', 'article', NULL, NULL, '2018-03-03 12:28:59', '2018-03-04 15:16:43'),
	(2, '成功案例', NULL, NULL, 0, 777, '0', 'article', NULL, NULL, '2018-03-03 12:29:19', '2018-03-04 15:16:43'),
	(3, '产品活动', NULL, NULL, 0, 666, '0', 'article', NULL, NULL, '2018-03-03 12:29:45', '2018-03-04 15:16:43'),
	(4, '人才招聘', NULL, NULL, 0, 555, '0', 'article', NULL, NULL, '2018-03-03 12:30:06', '2018-03-04 15:16:43');
/*!40000 ALTER TABLE `lara_categorys` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_failed_jobs 结构
DROP TABLE IF EXISTS `lara_failed_jobs`;
CREATE TABLE IF NOT EXISTS `lara_failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_failed_jobs 的数据：~0 rows (大约)
DELETE FROM `lara_failed_jobs`;
/*!40000 ALTER TABLE `lara_failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `lara_failed_jobs` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_files 结构
DROP TABLE IF EXISTS `lara_files`;
CREATE TABLE IF NOT EXISTS `lara_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('image','voice','video','annex','file') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件类型',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件路径',
  `mime_type` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件mimeType',
  `md5` char(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Md5',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件标题',
  `folder` char(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件对象类型',
  `object_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件对象ID',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `width` smallint(6) NOT NULL DEFAULT '0' COMMENT '宽度',
  `height` smallint(6) NOT NULL DEFAULT '0' COMMENT '高度',
  `downloads` mediumint(9) NOT NULL DEFAULT '0' COMMENT '下载次数',
  `public` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '是否公开',
  `editor` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '富编辑器图片',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '附件状态',
  `created_op` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `md5_type_folder_unique` (`md5`,`type`,`folder`),
  KEY `type_index` (`type`),
  KEY `folder_index` (`folder`),
  KEY `object_id_index` (`object_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_files 的数据：~0 rows (大约)
DELETE FROM `lara_files`;
/*!40000 ALTER TABLE `lara_files` DISABLE KEYS */;
INSERT INTO `lara_files` (`id`, `type`, `path`, `mime_type`, `md5`, `title`, `folder`, `object_id`, `size`, `width`, `height`, `downloads`, `public`, `editor`, `status`, `created_op`, `created_at`, `updated_at`) VALUES
	(1, 'image', 'images/slide/201803/03/538aFhREvHFKgq5AkWRSvNyFzT3FzgvVemW6yXkD.jpeg', 'image/jpeg', '9d9ce9a512a9555f386e0a0f40a30fa0', '222.jpg', 'slide', '0', 116659, 1000, 332, 0, '1', '0', '0', 1, '2018-03-03 21:58:26', '2018-03-03 21:58:26'),
	(2, 'image', 'images/slide/201803/03/jKwPxbEU4lo5ZySz887QOSZCzu4P3OKPNM9TZ4X2.jpeg', 'image/jpeg', 'cb3519d3b1b16415ac167e3b3df6426c', '333.jpg', 'slide', '0', 105233, 1000, 332, 0, '1', '0', '0', 1, '2018-03-03 22:00:47', '2018-03-03 22:00:47'),
	(3, 'image', 'images/slide/201803/03/GrEN5y7OH8Ps1FM3lDzGFMe2P1aP5pMgPRnd62aT.jpeg', 'image/jpeg', 'b843de23efe8a64b6c6a643174632413', '555.jpg', 'slide', '0', 94325, 1000, 332, 0, '1', '0', '0', 1, '2018-03-03 22:01:22', '2018-03-03 22:01:22'),
	(4, 'image', 'images/slide/201803/03/yq9VLRIKJty8orH8Vq7CO8D5WhRZx1h6OJqVDyPb.jpeg', 'image/jpeg', 'a7016cb9c662784e86428bd1ebc79172', '444.jpg', 'slide', '0', 81432, 1000, 332, 0, '1', '0', '0', 1, '2018-03-03 22:02:31', '2018-03-03 22:02:31'),
	(5, 'image', 'images/avatar/201803/04/9CT3XvX0Jcv8QEEzPCzgg8k0NXJVwrMsaKKf1iN9.jpeg', 'image/jpeg', '21463f816eb9b8595bfec72d720b6823', 'QQ图片20180106112335.jpg', 'avatar', '1', 14353, 300, 300, 0, '1', '0', '0', 1, '2018-03-04 15:30:39', '2018-03-04 15:30:39');
/*!40000 ALTER TABLE `lara_files` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_forms 结构
DROP TABLE IF EXISTS `lara_forms`;
CREATE TABLE IF NOT EXISTS `lara_forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'objectId',
  `form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '所属表单',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'IP',
  `data` json NOT NULL COMMENT '数据',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_index` (`form`),
  KEY `object_id_index` (`object_id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_forms 的数据：~0 rows (大约)
DELETE FROM `lara_forms`;
/*!40000 ALTER TABLE `lara_forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `lara_forms` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_links 结构
DROP TABLE IF EXISTS `lara_links`;
CREATE TABLE IF NOT EXISTS `lara_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接名称',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '友情链接描述',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接地址',
  `rating` int(11) NOT NULL DEFAULT '0' COMMENT '友情链接评级',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '友情链接图标',
  `target` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接打开方式',
  `rel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接与网站的关系',
  `order` int(11) NOT NULL DEFAULT '999' COMMENT '排序',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '状态:1显示;0不显示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_links 的数据：~0 rows (大约)
DELETE FROM `lara_links`;
/*!40000 ALTER TABLE `lara_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `lara_links` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_migrations 结构
DROP TABLE IF EXISTS `lara_migrations`;
CREATE TABLE IF NOT EXISTS `lara_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_migrations 的数据：~20 rows (大约)
DELETE FROM `lara_migrations`;
/*!40000 ALTER TABLE `lara_migrations` DISABLE KEYS */;
INSERT INTO `lara_migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_03_16_195041_create_articles_table', 1),
	(4, '2017_03_16_195113_create_categorys_table', 1),
	(5, '2017_03_16_195459_create_forms_table', 1),
	(6, '2017_03_16_195722_create_settings_table', 1),
	(7, '2017_03_17_202713_create_files_table', 1),
	(8, '2017_03_17_203024_create_navigations_table', 1),
	(9, '2017_04_22_193637_create_slides_table', 1),
	(10, '2017_05_10_083723_create_blocks_table', 1),
	(11, '2018_01_31_221753_add_avatar_and_introduction_to_users_table', 1),
	(12, '2018_02_01_003843_create_projects_table', 1),
	(13, '2018_02_01_163230_create_failed_jobs_table', 1),
	(14, '2018_02_01_170327_create_permission_tables', 1),
	(15, '2018_02_06_223204_add_remarks_to_roles_and_permissions_table', 1),
	(16, '2018_02_07_142436_create_links_table', 1),
	(17, '2018_02_18_055948_create_articles_categorys', 1),
	(18, '2018_02_18_065948_create_model_has_category', 1),
	(19, '2018_02_25_170926_seed_roles_and_permissions_data', 1),
	(20, '2018_02_28_090351_seed_settings_data', 1);
/*!40000 ALTER TABLE `lara_migrations` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_model_has_category 结构
DROP TABLE IF EXISTS `lara_model_has_category`;
CREATE TABLE IF NOT EXISTS `lara_model_has_category` (
  `category_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`,`model_id`,`model_type`),
  KEY `model_has_category_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `lara_categorys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_model_has_category 的数据：~0 rows (大约)
DELETE FROM `lara_model_has_category`;
/*!40000 ALTER TABLE `lara_model_has_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `lara_model_has_category` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_model_has_permissions 结构
DROP TABLE IF EXISTS `lara_model_has_permissions`;
CREATE TABLE IF NOT EXISTS `lara_model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `lara_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_model_has_permissions 的数据：~0 rows (大约)
DELETE FROM `lara_model_has_permissions`;
/*!40000 ALTER TABLE `lara_model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `lara_model_has_permissions` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_model_has_roles 结构
DROP TABLE IF EXISTS `lara_model_has_roles`;
CREATE TABLE IF NOT EXISTS `lara_model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `lara_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_model_has_roles 的数据：~2 rows (大约)
DELETE FROM `lara_model_has_roles`;
/*!40000 ALTER TABLE `lara_model_has_roles` DISABLE KEYS */;
INSERT INTO `lara_model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
	(1, 1, 'App\\Models\\User'),
	(2, 2, 'App\\Models\\User');
/*!40000 ALTER TABLE `lara_model_has_roles` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_navigations 结构
DROP TABLE IF EXISTS `lara_navigations`;
CREATE TABLE IF NOT EXISTS `lara_navigations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` enum('desktop','footer','mobile') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '导航分类',
  `type` enum('action','link','article','page','category') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '描述',
  `target` enum('_self','_blank') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self' COMMENT '是否新建标签',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
  `parent` int(11) NOT NULL COMMENT '父id',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路径',
  `params` json NOT NULL COMMENT '参数',
  `is_show` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '是否显示',
  `order` int(11) NOT NULL COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_navigations 的数据：~6 rows (大约)
DELETE FROM `lara_navigations`;
/*!40000 ALTER TABLE `lara_navigations` DISABLE KEYS */;
INSERT INTO `lara_navigations` (`id`, `category`, `type`, `title`, `description`, `target`, `link`, `image`, `icon`, `parent`, `path`, `params`, `is_show`, `order`, `created_at`, `updated_at`) VALUES
	(1, 'desktop', 'action', '关于我们', NULL, '_self', 'http://laracms.leleserver.cc/company/index_1.html', NULL, NULL, 0, '0', '{"route": "company.index", "params": "{}"}', '1', 999, '2018-03-03 17:31:52', '2018-03-04 15:18:45'),
	(2, 'desktop', 'article', '企业新闻', NULL, '_self', 'http://laracms.leleserver.cc/article/list_2_1.html', NULL, NULL, 0, '0', '{"category_id": "1"}', '1', 999, '2018-03-03 17:32:39', '2018-03-04 15:18:45'),
	(3, 'desktop', 'article', '成功案例', NULL, '_self', 'http://laracms.leleserver.cc/article/list_3_2.html', NULL, NULL, 0, '0', '{"category_id": "2"}', '1', 999, '2018-03-03 17:32:56', '2018-03-04 15:18:45'),
	(4, 'desktop', 'article', '产品活动', NULL, '_self', 'http://laracms.leleserver.cc/article/list_4_3.html', NULL, NULL, 0, '0', '{"category_id": "3"}', '1', 999, '2018-03-03 17:33:16', '2018-03-04 15:18:45'),
	(5, 'desktop', 'article', '人才招聘', NULL, '_self', 'http://laracms.leleserver.cc/article/list_5_4.html', NULL, NULL, 0, '0', '{"category_id": "4"}', '1', 999, '2018-03-03 17:33:29', '2018-03-04 15:18:45'),
	(6, 'desktop', 'page', '联系我们', NULL, '_self', 'http://laracms.leleserver.cc/page/show_6_13.html', NULL, NULL, 0, '0', '{"page_id": "13"}', '1', 999, '2018-03-03 17:34:40', '2018-03-04 15:18:45');
/*!40000 ALTER TABLE `lara_navigations` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_password_resets 结构
DROP TABLE IF EXISTS `lara_password_resets`;
CREATE TABLE IF NOT EXISTS `lara_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_password_resets 的数据：~0 rows (大约)
DELETE FROM `lara_password_resets`;
/*!40000 ALTER TABLE `lara_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `lara_password_resets` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_permissions 结构
DROP TABLE IF EXISTS `lara_permissions`;
CREATE TABLE IF NOT EXISTS `lara_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_permissions 的数据：~13 rows (大约)
DELETE FROM `lara_permissions`;
/*!40000 ALTER TABLE `lara_permissions` DISABLE KEYS */;
INSERT INTO `lara_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `remarks`) VALUES
	(1, 'manage_develop', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '系统开发'),
	(2, 'manage_log', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '操作日志'),
	(3, 'manage_system', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '系统管理'),
	(4, 'manage_users', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '用户管理'),
	(5, 'manage_permissions', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '权限管理'),
	(6, 'manage_setting', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '系统设置'),
	(7, 'manage_article', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '文章管理'),
	(8, 'manage_page', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '页面管理'),
	(9, 'manage_slide', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '幻灯管理'),
	(10, 'manage_block', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '区块管理'),
	(11, 'manage_annex', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '附件管理'),
	(12, 'manage_watch', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '公众号管理'),
	(13, 'manage_xcx', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '小程序管理');
/*!40000 ALTER TABLE `lara_permissions` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_projects 结构
DROP TABLE IF EXISTS `lara_projects`;
CREATE TABLE IF NOT EXISTS `lara_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `subscriber_count` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_projects 的数据：~0 rows (大约)
DELETE FROM `lara_projects`;
/*!40000 ALTER TABLE `lara_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `lara_projects` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_roles 结构
DROP TABLE IF EXISTS `lara_roles`;
CREATE TABLE IF NOT EXISTS `lara_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_roles 的数据：~3 rows (大约)
DELETE FROM `lara_roles`;
/*!40000 ALTER TABLE `lara_roles` DISABLE KEYS */;
INSERT INTO `lara_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `remarks`) VALUES
	(1, 'Administrator', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '超级管理员'),
	(2, 'Founder', 'web', '2018-03-03 10:43:14', '2018-03-03 10:43:14', '创始人'),
	(3, 'Maintainer', 'web', '2018-03-03 10:43:15', '2018-03-03 10:43:15', '站长');
/*!40000 ALTER TABLE `lara_roles` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_role_has_permissions 结构
DROP TABLE IF EXISTS `lara_role_has_permissions`;
CREATE TABLE IF NOT EXISTS `lara_role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `lara_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `lara_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_role_has_permissions 的数据：~33 rows (大约)
DELETE FROM `lara_role_has_permissions`;
/*!40000 ALTER TABLE `lara_role_has_permissions` DISABLE KEYS */;
INSERT INTO `lara_role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(2, 2),
	(3, 2),
	(4, 2),
	(5, 2),
	(6, 2),
	(7, 2),
	(8, 2),
	(9, 2),
	(10, 2),
	(11, 2),
	(12, 2),
	(13, 2),
	(3, 3),
	(4, 3),
	(6, 3),
	(7, 3),
	(8, 3),
	(9, 3),
	(10, 3),
	(11, 3);
/*!40000 ALTER TABLE `lara_role_has_permissions` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_settings 结构
DROP TABLE IF EXISTS `lara_settings`;
CREATE TABLE IF NOT EXISTS `lara_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '所属',
  `module` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模块',
  `section` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '部分',
  `key` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '键',
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `owner_and_module_and_section_unique` (`owner`,`module`,`section`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_settings 的数据：~24 rows (大约)
DELETE FROM `lara_settings`;
/*!40000 ALTER TABLE `lara_settings` DISABLE KEYS */;
INSERT INTO `lara_settings` (`id`, `owner`, `module`, `section`, `key`, `value`) VALUES
	(1, 'system', 'common', 'basic', 'name', 'LaraCMS'),
	(2, 'system', 'common', 'basic', 'copyright', 'LaraCMS'),
	(3, 'system', 'common', 'basic', 'create_year', '2018'),
	(4, 'system', 'common', 'basic', 'keywords', 'LaraCMS'),
	(5, 'system', 'common', 'basic', 'index_keywords', ''),
	(6, 'system', 'common', 'basic', 'slogan', ''),
	(7, 'system', 'common', 'basic', 'icp', ''),
	(8, 'system', 'common', 'basic', 'icp_link', ''),
	(9, 'system', 'common', 'basic', 'meta', ''),
	(10, 'system', 'common', 'basic', 'description', ''),
	(11, 'system', 'common', 'basic', 'statistics', ''),
	(12, 'system', 'common', 'company', 'name', ''),
	(13, 'system', 'common', 'company', 'description', ''),
	(14, 'system', 'common', 'company', 'content', '<h4>关于青岛易软天创网络科技有限公司</h4><p>青岛易软天创网络科技有限公司位于美丽的青岛开发区，团队成员拥有丰富的网站设计、系统研发、服务器维护和SEO经验。我们正在打造一款开源免费的企业门户系统，以帮助企业建立品牌网站，进行宣传推广、市场营销、产品销售和客户跟踪。<span style="color: rgb(229, 51, 51);">为天下企业提供专业的营销工具！</span></p><h4>关于蝉知企业门户系统(chanzhiEPS)</h4><p>蝉知门户系统（changezhiEPS）是一款开源免费的企业门户系统，专为企业营销设计！</p><h4>为什么来做蝉知？</h4><p>禅道团队开发的禅道项目管理软件主要是解决企业内部研发的问题。在我们和客户接触的时候，发现企业现在对外营销的问题解决得非常不好。现在的企业网站大都是使用cms系统修改而来，各地大大小小的建站公司做的网站，实在不敢恭维。很多号称开源的cms系统也都严格限制商用，所以我们就有了做一个开源的企业门户系统的想法，于是就有了息壤这个团队，有了蝉知这个产品。</p><h4>为什么叫做蝉知？<br></h4><p></p><p>蝉在中国传统文化中象征着闻达和财富，非常适合企业宣传营销的特点，所以我们为这套系统起名为蝉知，我们希望通过这款开源免费的系统可以帮助众多的中小企业快速方便的建立自己的企业网站，进行宣传营销。更重要的是蝉知是开放的，企业做大之后，可以在蝉知基础上继续扩展开发，不会成为您的瓶颈！</p>'),
	(15, 'system', 'common', 'contact', 'contacts', '望乐乐'),
	(16, 'system', 'common', 'contact', 'phone', '13366995858'),
	(17, 'system', 'common', 'contact', 'fax', ''),
	(18, 'system', 'common', 'contact', 'email', 'wanglelecc@gmail.com'),
	(19, 'system', 'common', 'contact', 'qq', '294990941'),
	(20, 'system', 'common', 'contact', 'weixin', ''),
	(21, 'system', 'common', 'contact', 'weibo', ''),
	(22, 'system', 'common', 'contact', 'wangwang', ''),
	(23, 'system', 'common', 'contact', 'site', 'https://www.wanglele.cc/'),
	(24, 'system', 'common', 'contact', 'address', 'Beijing');
/*!40000 ALTER TABLE `lara_settings` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_slides 结构
DROP TABLE IF EXISTS `lara_slides`;
CREATE TABLE IF NOT EXISTS `lara_slides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'objectId',
  `group` smallint(6) NOT NULL DEFAULT '0' COMMENT '分组',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '描述',
  `target` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self' COMMENT '是否新建标签',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'URL',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `order` int(11) NOT NULL COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_index` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_slides 的数据：~0 rows (大约)
DELETE FROM `lara_slides`;
/*!40000 ALTER TABLE `lara_slides` DISABLE KEYS */;
INSERT INTO `lara_slides` (`id`, `object_id`, `group`, `title`, `description`, `target`, `link`, `image`, `order`, `status`, `created_at`, `updated_at`) VALUES
	(1, '1593925271911899', 1, '1111', '', '_self', 'http://www.jd.com/', 'images/slide/201803/03/538aFhREvHFKgq5AkWRSvNyFzT3FzgvVemW6yXkD.jpeg', 9999, 1, '2018-03-03 21:59:54', '2018-03-03 21:59:54'),
	(2, '1593925329620945', 1, '222', '', '_self', 'http://222.com/', 'images/slide/201803/03/jKwPxbEU4lo5ZySz887QOSZCzu4P3OKPNM9TZ4X2.jpeg', 9999, 1, '2018-03-03 22:00:49', '2018-03-03 22:00:49'),
	(3, '1593925368321300', 1, '444', '', '_self', 'http://4444.com', 'images/slide/201803/03/GrEN5y7OH8Ps1FM3lDzGFMe2P1aP5pMgPRnd62aT.jpeg', 9999, 1, '2018-03-03 22:01:26', '2018-03-03 22:01:26'),
	(4, '1593925415909278', 1, '333', '', '_self', 'http://333.com/', 'images/slide/201803/03/yq9VLRIKJty8orH8Vq7CO8D5WhRZx1h6OJqVDyPb.jpeg', 9999, 1, '2018-03-03 22:02:11', '2018-03-03 22:07:00');
/*!40000 ALTER TABLE `lara_slides` ENABLE KEYS */;

-- 导出  表 com_leleserver_laracms.lara_users 结构
DROP TABLE IF EXISTS `lara_users`;
CREATE TABLE IF NOT EXISTS `lara_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在导出表  com_leleserver_laracms.lara_users 的数据：~2 rows (大约)
DELETE FROM `lara_users`;
/*!40000 ALTER TABLE `lara_users` DISABLE KEYS */;
INSERT INTO `lara_users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `introduction`, `status`) VALUES
	(1, 'admin', 'admin@56br.com', '$2y$10$V4tZ635kEm6RoSlmR/3ijehuMbn4ivUnj6WBUfd71qGflSwClxtia', 'gjW1TfcnmZ', '2018-03-03 10:43:22', '2018-03-04 15:30:41', 'images/avatar/201803/04/9CT3XvX0Jcv8QEEzPCzgg8k0NXJVwrMsaKKf1iN9.jpeg', 'Codiing 改变世界！', '1'),
	(2, 'wll', 'wll@56br.com', '$2y$10$bTjZKG800OdGXTLfaVz/JuhcdbCxufWkEtwqkSI8Hz/34Vb.2LeQK', '2izrHjMnej', '2018-03-03 10:43:22', '2018-03-03 10:43:22', NULL, 'Codiing 改变世界！', '1');
/*!40000 ALTER TABLE `lara_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
