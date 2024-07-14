<?php

namespace PixxelTheme\includes;


if (!defined('ABSPATH')) {
    exit;
}

class Assign
{
    function __construct()
    {
    }

    public  function addToFooter()
    {
    }

    public  function addToHeader()
    {
        echo "<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KW8BL43');</script>
<!-- End Google Tag Manager -->
        ";

        echo '
        <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]function(){(c[a].q=c[a].q[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "lvu6wv5lz6");
</script>';
    }

    public  function addToBody()
    {
        echo '<!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KW8BL43"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->';
    }
}
