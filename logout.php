<?php
session_start();
session_destroy();
?>
<html>
<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap');
        * {
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body>
    <script>
        Swal.fire({
            title: '👋 ออกจากระบบสำเร็จ!',
            text: 'หวังว่าจะได้พบคุณอีกครั้งในเร็ว ๆ นี้ 😊',
            icon: 'success',
            confirmButtonText: 'ตกลง',
            timer: 2000,
            timerProgressBar: true
        }).then(() => {
            window.location.href = 'login';
        });
    </script>
</body>
</html>