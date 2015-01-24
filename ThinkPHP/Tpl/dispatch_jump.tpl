<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <script src="/Public/sweetalert/lib/sweet-alert.min.js"></script> <link rel="stylesheet" type="text/css" href="/Public/sweetalert/lib/sweet-alert.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Jump Page</title>
    </head>
<body>

    <p class="jump" style="display: none">
        <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
    </p>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();


    <?php $wait = $waitSecond * 1000; ?>
    <?php if(isset($message)) {?>
    swal({
        title: "<?php echo $message; ?>",
        text: "I will close in <?php echo $waitSecond; ?> seconds.",
        type: 'success',
        timer: <?php echo $wait ?>
    });

    <?php }else{?>

    swal({
        title: "<?php echo $error; ?>",
        text: "I will close in <?php echo $waitSecond; ?> seconds.",
        type: 'error',
        timer: <?php echo $wait ?>
    });
    <?php }?>
</script>
</body>
</html>
