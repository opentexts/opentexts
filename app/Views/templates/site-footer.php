        <footer role="contentinfo" class="mx-auto max-w-3xl grid md:grid-cols-3 gap-x-24 gap-y-12 justify-center items-center p-6 md:p-12 text-white">
            <?php
                $uri = current_url(true);
                $current_path = "/" . $uri->getSegment(1);

                if($current_path !== "/"):
            ?>
                <section class="md:col-span-2">
                    <a href="/" class="rounded-sm p-2 flex mb-4">
                        <img src="/images/logo.svg" class="w-12 sm:w-16 -ml-2 sm:-mr-1" alt="" />                    
                        <img src="/images/open-texts.svg" class="w-full max-w-sm" alt="Open Texts" />
                    </a>

                    <p class="text-xl">OpenTexts.world searches millions of digitised texts from libraries around the world. Currently in beta.</p>
                    <a href="https://twitter.com/opentexts/" class="text-blue-100 hover:text-white flex items-center no-underline max-w-xs social">
                        <span class="p-2 rounded-full bg-blue-600 mr-2 icon">
                            <?php echo file_get_contents('svg/twitter.svg'); ?>
                        </span>
                        <span class="opacity-75">Twitter</span>
                    </a>
                </section>

                <section>
                    <ul class="navigation-footer text-lg opacity-75">
                        <?php 
                            $current_path = getCurrentPage();
                            renderNavLink("/", "Home", $current_path);
                            renderNavLink("/about", "About", $current_path);
                            renderNavLink("/contribute", "Contribute", $current_path);
                            renderNavLink("/help", "Help", $current_path);
                        ?>
                    </ul>
                </section>
                <?php endif; ?>
            
            <section class="md:col-span-3 opacity-75 text-xs text-center">
                &copy; <?php echo date('Y'); ?> OpenTexts.world.
                &middot; 
                <a href="/accessibility" class="text-blue-100 hover:text-blue-400">Accessibility</a>
                &middot;
                <a href="/privacy" class="text-blue-100 hover:text-blue-400">Privacy</a>
        </footer>

        <script type="text/javascript">
            window.doorbellOptions = {
                "id": "11688",
                "appKey": "h4ZLt1kpIj6ch9JeeV48pgpl653MdPYKmpnOEZqDxqM3sZ6vgTuDmJAufJY8R8uG"
            };
            (function(w, d, t) {
                var hasLoaded = false;
                function l() { if (hasLoaded) { return; } hasLoaded = true; window.doorbellOptions.windowLoaded = true; var g = d.createElement(t);g.id = 'doorbellScript';g.type = 'text/javascript';g.async = true;g.src = 'https://embed.doorbell.io/button/'+window.doorbellOptions['id']+'?t='+(new Date().getTime());(d.getElementsByTagName('head')[0]||d.getElementsByTagName('body')[0]).appendChild(g); }
                if (w.attachEvent) { w.attachEvent('onload', l); } else if (w.addEventListener) { w.addEventListener('load', l, false); } else { l(); }
                if (d.readyState == 'complete') { l(); }
            }(window, document, 'script'));
        </script>
        
        <script src="/scripts/focus-visible.min.js"></script>
    </body>
</html>
