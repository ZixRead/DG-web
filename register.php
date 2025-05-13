<?php 
error_reporting(0);
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
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
?>
<!DOCTYPE html>
<html><head>
<?php echo MinifyTemplate(__DIR__ . '/template/header.php'); ?>
</head>
<?php echo MinifyTemplate(__DIR__ . 'template/navbar.php'); ?>
<body id="kt_body" class="bg-body">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<a href="" class="mb-12">
						<img alt="Logo" src="https://media.discordapp.net/attachments/1357561017088872582/1359778885805277346/DG96x96.png?ex=67f8b845&is=67f766c5&hm=03330aac5ab194a9b754096e541a40da981d76ee53b3557fe62828c88b5e9688&=&format=webp&quality=lossless" class="h-50px" />
					</a>
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<form class="form w-100" method="post" action="">
							<div class="text-center mb-10">
								<h1 class="text-dark mb-3">สร้างบัญชี</h1>
								<div class="text-gray-400 fw-bold fs-4">หากมีบัญชีอยู่แล้ว
								<a href="login" class="link-primary fw-bolder">เข้าสู่ระบบ</a></div>
							</div>
							<?php
if (isset($_POST['btn-register'])) {
    if (!empty(rtrim($_POST['username'])) && !empty(rtrim($_POST['password'])) && !empty(rtrim($_POST['password_confirm'])) && !empty(rtrim($_POST['email']))) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $pwcn = $_POST['password_confirm'];
        $email = $_POST['email'];

        if (!empty($_SESSION['username'])) {
            echo "
            <script>
                Swal.fire(
                  '🚫 คุณเข้าสู่ระบบอยู่แล้ว!',
                  'กรุณาออกจากระบบก่อนทำการสมัครใหม่',
                  'warning'
                )
            </script>
            ";
        }

        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $user)) {
            echo "
            <script>
                Swal.fire(
                  '❌ ชื่อผู้ใช้ไม่ถูกต้อง!',
                  'ชื่อผู้ใช้ต้องประกอบด้วยตัวอักษร a-z, A-Z, 0-9, _ หรือ - เท่านั้น',
                  'error'
                )
            </script>
            ";
        } else {
            $q = Query('SELECT username FROM clients WHERE username = :user', array(':user' => $user));
            if ($q->rowCount() > 0) {
                echo "
                <script>
                    Swal.fire(
                      '⚠️ ชื่อผู้ใช้นี้มีอยู่แล้ว!',
                      'กรุณาเลือกชื่อผู้ใช้อื่น',
                      'warning'
                    )
                </script>
                ";
            } else {
                if ($pass === $pwcn) {
                    $hash = password_hash($pass, PASSWORD_DEFAULT);
                    $q = Query('INSERT INTO clients (username, password, email, ip) VALUES (:user, :pass, :email, :ip)', array(':user' => $user, ':pass' => $hash, ':email' => $email, ':ip' => $_SERVER['REMOTE_ADDR']));
                    if ($q) {
                        echo "
                        <script>
                        Swal.fire({
                          title: '🎉 สมัครสมาชิกสำเร็จ!',
                          text: 'ระบบกำลังพาคุณไปยังหน้าล็อกอิน',
                          icon: 'success',
                          timer: 2000,
                          timerProgressBar: true
                        }).then(() => {
                            window.location.href = 'login';
                        });
                        </script>
                        ";
                    } else {
                        echo "
                        <script>
                            Swal.fire(
                              '❌ เกิดข้อผิดพลาด!',
                              'ไม่สามารถสมัครสมาชิกได้ กรุณาลองใหม่อีกครั้ง',
                              'error'
                            )
                        </script>
                        ";
                    }
                } else {
                    echo "
                    <script>
                        Swal.fire(
                          '⚠️ รหัสผ่านไม่ตรงกัน!',
                          'กรุณากรอกรหัสผ่านให้ตรงกัน',
                          'warning'
                        )
                    </script>
                    ";
                }
            }
        }
    } else {
        echo "
        <script>
            Swal.fire(
              '⚠️ ข้อมูลไม่ครบถ้วน!',
              'กรุณากรอกข้อมูลให้ครบทุกช่อง',
              'warning'
            )
        </script>
        ";
    }
}
?>
							<div class="fv-row mb-5">
								<label class="form-label fs-6 fw-bolder text-dark">อีเมล</label>
								<input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
							</div>
							<div class="fv-row mb-5">
								<label class="form-label fs-6 fw-bolder text-dark">ชื่อผู้ใช้</label>
								<input class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" />
							</div>
							<div class="fv-row mb-5">
								<div class="d-flex flex-stack mb-2">
									<label class="form-label fw-bolder text-dark fs-6 mb-0">รหัสผ่าน</label>
								</div>
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
							</div>
							<div class="fv-row mb-10">
								<div class="d-flex flex-stack mb-2">
									<label class="form-label fw-bolder text-dark fs-6 mb-0">รหัสผ่านอีกครั้ง</label>
								</div>
								<input class="form-control form-control-lg form-control-solid" type="password" name="password_confirm" autocomplete="off" />
							</div>
							<div class="text-center">
								<div class="form-group" data-bs-hover-animate="pulse">
								<button type="submit" name="btn-register" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">สร้างบัญชี</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php echo MinifyTemplate(__DIR__ . '/template/footer.php'); ?>
</body>
</html>