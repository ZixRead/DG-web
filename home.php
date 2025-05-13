<?php 
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
	header('Location: login');
}
require_once(__DIR__ . '/include/Core.php'); 
require_once(__DIR__ . '/include/Config.php');
require_once(__DIR__ . '/include/PDOQuery.php');

if($_GET['lang']){
	$_SESSION['lang'] = $_GET['lang'];
	header('Location:'.$_SERVER['PHP_SELF']);
	exit();
}

switch($_SESSION['lang']){
	case "th":
		require('lang/th.php');
	break;
	case "en":
		require('lang/en.php');
	break;
	default:
		require('lang/th.php');
	}
$websites = Query('SELECT * FROM settings');
$website = $websites->fetch();
?>
<!DOCTYPE html>
<html><head>
<?php echo MinifyTemplate(__DIR__ . '/template/header.php'); ?>
<style>
	/* ปรับแต่งการ์ด */
	.card {
		border-radius: 10px;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		background-color: #fff;
		overflow: hidden;
		transition: transform 0.3s ease, box-shadow 0.3s ease;
	}

	.card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
	}

	/* ปรับแต่งรูปภาพ */
	.symbol-label img {
		border-radius: 50%;
		border: 2px solid #ddd;
	}

	/* ปรับแต่งป้าย */
	.badge {
		font-size: 0.9rem;
		padding: 0.5rem 1rem;
		border-radius: 20px;
	}

	/* เพิ่ม Animation */
	@keyframes fadeIn {
		from {
			opacity: 0;
			transform: translateY(20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	.card {
		animation: fadeIn 0.5s ease-in-out;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
</head>
<body>


	<main class="page projects-page">
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php MinifyTemplate(__DIR__ . '/template/navbar.php'); ?>
					<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
						<div id="kt_toolbar_container" class="container-xxl py-5">
							<div class="row gy-0 gx-10">
								<div class="col-xl-12">
									<div class="card card-xl-stretch bg-body border-0 mb-5 mb-xl-0">
										<div class="card-body d-flex flex-column flex-lg-row flex-stack p-lg-15">
											<div class="d-flex flex-column justify-content-center align-items-center align-items-lg-start me-10 text-center text-lg-start">
												<h3 class="fs-2hx line-height-lg mb-5">
													<span class="fw-bolder">ยินดีต้อนรับ</span>
													<br />
													<span class="fw-bold"><?php echo $_SESSION['username']; ?></span>
													
												</h3>
												<div class="fs-4 text-muted mb-7"><?php echo $website['description']; ?></div>
												<a href='shop' class="btn btn-success fw-bold px-6 py-3">เลือกซื้อสินค้าเลย</a>
											</div>
											<img src="assets/media/illustrations/sketchy-1/BDG.png" alt="" class="mw-200px mw-lg-350px mt-lg-n10" />
										</div>
									</div>
								</div>
							</div>							
						</div>
					</div>

					
					<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
					
						<div class="content flex-row-fluid" id="kt_content">
							<div class="row gy-0 gx-10">
							
								
								
								<!-- filepath: c:\xampp\htdocs\home.php -->
								<div class="col-xl-8">
									<div class="card mb-10">
										<div class="card-header align-items-center border-0 mt-4">
											<h3 class="card-title align-items-start flex-column">
												<span class="fw-bolder mb-2 text-dark">สินค้าแนะนำ</span>
												<span class="text-muted fw-bold fs-7">(สุ่มจากร้านค้า)</span>
											</h3>
										</div>
										<div class="card-body">
											<div class="row">
												<?php
												// ดึงสินค้าสุ่ม 9 รายการจากฐานข้อมูล
												$randomProducts = Query('SELECT * FROM products ORDER BY RAND() LIMIT 9');
												foreach ($randomProducts as $product) {
													$product_id = $product['id'];
													$product_name = $product['name'];
													$product_img = $product['image'];
													$product_price = $product['price'];
								
													echo <<<EOD
													<div class="col-md-4 mb-4">
														<div class="card border-0 shadow-sm">
															<img src="$product_img" alt="$product_name" class="card-img-top" style="height: 150px; object-fit: cover;">
															<div class="card-body text-center">
																<h5 class="card-title">$product_name</h5>
																<p class="text-muted">฿$product_price</p>
																<a href="shop" class="btn btn-sm btn-primary">ดูเพิ่มเติม</a>
															</div>
														</div>
													</div>
													EOD;
												}
												?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-xl-4">
									<!-- ข่าวสารล่าสุด -->
									<div class="card">
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">ข่าวสารล่าสุด</span>
											</h3>
										</div>
										<div class="card-body">
											<?php
											// ตัวอย่างข่าวสารเกี่ยวกับสงกรานต์
											$news = [
												[
													'title' => 'กิจกรรมสงกรานต์สุดพิเศษ!',
													'summary' => 'ร่วมสนุกกับกิจกรรมสงกรานต์ออนไลน์ พร้อมรับของรางวัลสุดพิเศษ!',
													'image' => 'https://www.exta.co.th/wp-content/uploads/2023/05/Songkran-eXta-Shopping_1024x537.jpg',
													'link' => 'news/songkran-event'
												],
												[
													'title' => 'โปรโมชั่นสงกรานต์ ลดสูงสุด 50%',
													'summary' => 'ช้อปสินค้าราคาพิเศษต้อนรับสงกรานต์ ลดสูงสุดถึง 50%!',
													'image' => 'https://yulgang.playpark.com/th-th/wp-content/uploads/2025/04/yg-Apr68-Songkran-Event-Ban.jpg',
													'link' => 'news/songkran-sale'
												],
												[
													'title' => 'เคล็ดลับการเล่นน้ำสงกรานต์ให้ปลอดภัย',
													'summary' => 'แนะนำวิธีการเล่นน้ำสงกรานต์อย่างปลอดภัยและสนุกสนาน!',
													'image' => 'https://www.mustplay.in.th/static/thumb/2020/3/15/attach-1586953323703.jpg',
													'link' => 'news/songkran-tips'
												]
											];

											foreach ($news as $item) {
												echo "<div class='mb-3 d-flex'>";
												echo "<img src='{$item['image']}' alt='{$item['title']}' style='width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border-radius: 5px;'>";
												echo "<div>";
												echo "<h5 class='fw-bold'>{$item['title']}</h5>";
												echo "<p class='text-muted'>{$item['summary']}</p>";
												echo "<a href='{$item['link']}' class='text-primary'>อ่านเพิ่มเติม</a>";
												echo "</div>";
												echo "</div>";
											}
											?>
										</div>
									</div>

									<!-- กิจกรรมที่กำลังจะมาถึง -->
									<div class="card mt-5">
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">กิจกรรมที่กำลังจะมาถึง</span>
											</h3>
										</div>
										<div class="card-body">
											<div id="calendar"></div>
										</div>
									</div>

									<!-- การเติมเงินล่าสุด -->
									<div class="card mt-5">
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">การเติมเงินล่าสุด</span>
											</h3>
										</div>
										<?php
										$tops = Query('SELECT * FROM log_topup where status = "success" ORDER BY id DESC LIMIT 5');
										?>
										<div class="card-body pt-5">
											<?php foreach($tops as $data) { ?>
												<div class="d-flex align-items-sm-center mb-7">
													<div class="symbol symbol-50px me-5">
														<span class="symbol-label">
															<img src="https://minotar.net/helm/<?php echo $data['username']; ?>" class="h-50 align-self-center" alt="" />
														</span>
													</div>
													<div class="d-flex align-items-center flex-row-fluid flex-wrap">
														<div class="flex-grow-1 me-2">
															<a class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?php echo $data['username']; ?></a>
															<span class="text-muted fw-bold d-block fs-7"><?php echo $data['transaction']; ?></span>
														</div>
														<span class="badge badge-light fw-bolder my-2">+<?php echo $data['point']; ?> เครดิต</span>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>

									<!-- Discord Community -->
									<div class="card mt-5">
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">Discord Community</span>
											</h3>
										</div>
										<div class="card-body">
											<!-- Discord Widget -->
											<iframe src="https://discord.com/widget?id=1357561016401133821&theme=dark" width="100%" height="300" allowtransparency="true" frameborder="0"></iframe>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</main>
<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>
<div id="modalContainer"></div>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                { title: 'กิจกรรม A', start: '2025-04-15' },
                { title: 'กิจกรรม B', start: '2025-04-20' }
            ]
        });
        calendar.render();
    });
</script>
</body>
</html>