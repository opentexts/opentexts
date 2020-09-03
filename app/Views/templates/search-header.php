<header role="header" class="mx-auto max-w-3xl flex justify-center items-center py-6 space-x-6">

  <a href="/">
      <!--img class="w-16" src="/images/logo.svg" alt="Open Texts" /-->
      <canvas height="94" width="94" id="logo" style="height: 52px;" onmouseover="isMouseOver = true; homeConstellationAnim(-1);" onmouseleave="isMouseOver= false;homeConstellationReverseAnim(-1);"></canvas>
  </a>
    <script>
        var firstPoints = [
            [54.807731, 3.572109], // 0
            [78.193554, 14.205771], // 1
            [90.526338, 40.126809], // 2
            [87.101689, 64.501572], // 3
            [68.004968, 86.675298],  // 4
            [41.066672, 88.884830], // 5
            [15.771199, 79.335112], // 6
            [3.527717, 52.753105], // 7
            [6.955773, 28.378486], // 8
            [47.179674, 45.357034], // 9
        ]
        var secondPoints = [
            [90.55773, 88.884830], // 0
            [90.955773, 52.753105], // 1
            [53.955773, 34.205771], // 2
            [21.955773, 46.753105], // 3
            [21.955773, 52.753105],  // 4
            [21.955773, 24.205771], // 5
            [6.955773, 24.205771], // 6
            [6.955773, 52.753105], // 7
            [6.955773, 88.884830], // 8
            [53.955773, 75.357034], // 9
        ]

        function generateSecondPoints(radius, spacing, offset) {
            var points = []
            var baseAngle = (34.9);
            offset += 45;
            baseAngle *= spacing;
            for (var i = 0; i < 9; i++) {
                var angle = baseAngle * (i-4.5) + offset;
                angle *= Math.PI / 180
                var x = radius * Math.sin(angle) + firstPoints[9][0];
                var y = radius * Math.cos(angle) + firstPoints[9][1];
                points.push([x, y])
            }
            points.push(firstPoints[9])
            return points
        }

        function lerp(a,b,t){
            return a + (b-a) * t;
        }

        function clamp01(n) {
            return Math.max(Math.min(n,1),0)
        }
        function lerpPoints(pointsA, pointsB, t) {
            var points = [];
            for(var i = 0; i < pointsA.length; i++){
                points.push([
                    lerp(pointsA[i][0], pointsB[i][0], t),
                    lerp(pointsA[i][1], pointsB[i][1], t)
                ])
            }
            return points
        }
        var logo = document.querySelector("#logo");
        var logoCtx = logo.getContext("2d");
        var offset = 0;
        var updateTime = -1;
        var isMouseOver = false;
        var isLoading = false;
        function loadingSpinnerAnim(T) {
            if(T === -1) {
                updateTime = -1;
                offset = 0;
            }
            var dT = 0
            if(updateTime > 0) {
                dT = T - updateTime;
            }
            updateTime = T;
            offset = (offset + dT)%1500;
            var t = clamp01(offset/1500);

            var points = generateSecondPoints(43, 1-Math.sin(t*Math.PI), t * 360);
            logoCtx.clearRect(0,0,logo.width, logo.height)
            if(t <= 0.025 && !isLoading) {
                renderPoints(points, 0);
                updateTime = -1;
                offset = 0;
            } else {
                renderPoints(points, 0);
                window.requestAnimationFrame(loadingSpinnerAnim)
            }
        }
        function homeConstellationAnim(T) {
            if(isLoading) return;
            if(!isMouseOver)
                return;
            if(T === -1) {
                if(updateTime > 0) {
                    offset = 250 - offset;
                }
                window.requestAnimationFrame(homeConstellationAnim)
                return;
            }
            var dT = 0
            if(updateTime > 0) {
                dT = T - updateTime;
                console.log(dT)
            }
            updateTime = T;
            offset = (offset + dT);
            var t = offset/250.0;
            t = t > 1 ? 1 : t;
            logoCtx.clearRect(0,0,logo.width, logo.height)
            renderPoints(lerpPoints(firstPoints, secondPoints, t), t);
            if(t < 1) {
                window.requestAnimationFrame(homeConstellationAnim)
            } else {
                updateTime = -1;
                offset = 0
            }
        }
        function homeConstellationReverseAnim(T) {
            if(isLoading) return;
            if(isMouseOver)
                return;
            if(T === -1) {
                if(updateTime > 0) {
                    offset = 250 - offset;
                }
                window.requestAnimationFrame(homeConstellationReverseAnim)
                return;
            }
            var dT = 0
            if(updateTime > 0) {
                dT = T - updateTime;
            }
            updateTime = T;
            offset = (offset + dT);
            var t = 1-(offset/250.0);
            t = t > 1 ? 1 : t;
            logoCtx.clearRect(0,0,logo.width, logo.height)
            if(t > 0) {
                renderPoints(lerpPoints(firstPoints, secondPoints, t), t);
                window.requestAnimationFrame(homeConstellationReverseAnim)
            } else {
                renderPoints(firstPoints, 0);
                updateTime = -1;
                offset = 0
            }
        }
        renderPoints(firstPoints, 0);
        function renderPoints(points, t) {

            logoCtx.lineWidth = 1.5
            logoCtx.beginPath();
            logoCtx.strokeStyle = `rgb(${lerp(75, 205, t)}, ${lerp(0, 205, t)}, ${lerp(171, 255, t)})`
            logoCtx.moveTo(...points[0]);
            for (var i = 1; i < points.length - 1; i++) {
                logoCtx.lineTo(...points[i]);
            }
            logoCtx.stroke();

            logoCtx.beginPath();
            logoCtx.strokeStyle = `rgba(171, 0, 134, ${lerp(1, 0.75, t)})`
            logoCtx.moveTo(...points[1]);
            for (var i = 3; i < points.length - 1; i += 2) {
                logoCtx.lineTo(...points[i]);
            }
            logoCtx.stroke();

            logoCtx.beginPath();
            logoCtx.strokeStyle = `rgba(0, 128, 171, ${lerp(1, 0.75, t)})`
            logoCtx.moveTo(...points[0]);
            for (var i = 2; i < points.length - 1; i += 2) {
                logoCtx.lineTo(...points[i]);
            }
            logoCtx.stroke();

            logoCtx.fillStyle = "#FFF"
            for (var i = 0; i < points.length; i++) {
                logoCtx.beginPath();
                //logoCtx.fillText(i, points[i][0], points[i][1], 50)
                logoCtx.ellipse(...points[i], 2.64, 2.64, 0, 0, 2 * Math.PI);
                logoCtx.fill();
            }
            /*
            var bonusPoints = generateSecondPoints(43, Math.cos(Math.PI), 360);

            logoCtx.fillStyle = "#F00"
            for (var i = 0; i < bonusPoints.length; i++) {
                logoCtx.beginPath();
                //logoCtx.fillText(i, points[i][0], points[i][1], 50)
                logoCtx.ellipse(...bonusPoints[i], 2.64, 2.64, 0, 0, 2 * Math.PI);
                logoCtx.fill();
            }*/
        }
    </script>
  <?php include('search-form.php'); ?>
    
    <a class="flex flex-col justify-center items-center text-gray-100 no-underline">
        <span class="text-opacity-50"><?php echo file_get_contents('svg/menu.svg'); ?></span>
        <span class="text-sm">Menu</span>
    </a>


</header>
