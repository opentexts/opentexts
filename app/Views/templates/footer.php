<!-- FOOTER -->
<footer>
    <div class="environment">
        <p>Enabling easy discovery of digitised texts: one, two, or thousands!</p>
    </div>

    <div class="copyrights">
        <p>&copy;<?= date('Y') ?> OpenTexts.World contributors</p>
    </div>
</footer>

<!-- SCRIPTS -->
<script>
	function toggleMenu() {
		var menuItems = document.getElementsByClassName('menu-item');
		for (var i = 0; i < menuItems.length; i++) {
			var menuItem = menuItems[i];
			menuItem.classList.toggle("hidden");
		}
	}
</script>

<!-- -->

</body>
</html>