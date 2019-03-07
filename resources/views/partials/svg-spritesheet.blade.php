<?php
  $base = App\asset_path("svg-sprites/sprites.svg");
?>

<!--[if gte IE 9]><!-->
<script>
  // SVG spritesheet include
  (function(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if (xhr.readyState == 4 && xhr.status == 200){
        var div = document.createElement("div");
        div.style.display = "none";
        div.classList.add("SvgSprites");
        div.innerHTML = xhr.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
      } else if (xhr.readyState == 4) {
        console.log('Fetching spritesheet failed with status: ' + xhr.status)
      }
    }
    xhr.open("GET", "<?= $base; ?>", true);
    xhr.send();
  })()
</script>
<!--<![endif]-->