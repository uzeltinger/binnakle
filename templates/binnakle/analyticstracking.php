<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-85996032-1', 'auto');
    ga('send', 'pageview');

    // FORM TRACK 

 var buttons = document.querySelectorAll('[name*="contacto_enviado"]');
  
  for (var i = 0; i < buttons.length; i++) {
    var button = buttons[i];
  
    button.addEventListener('click', function(){
     ga('send', 'event', 'formulario', 'formulario_enviado',);
    });
  }
</script>
<script>
    (function(w,d,t,u,n,a,m){w['MauticTrackingObject']=n;
        w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),
        m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://marketing.binnakle.es/mtc.js','mt');
    mt('send', 'pageview');
</script>
