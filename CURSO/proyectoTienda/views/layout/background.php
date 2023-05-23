<div id="back">
    <video autoplay muted loop >
        <source src="<?= baseURL ?>assets/vid/background.mp4" type="video/mp4" />
    </video>
    <script>
        (function () {
            var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
            if (1280 > w)
                document.querySelector("video source").setAttribute('src', '<?= baseURL ?>assets/vid/background-mobile.mp4');
            else 
                document.querySelector("video source").setAttribute('src', '<?= baseURL ?>assets/vid/background.mp4');
        })();</script>
</div>