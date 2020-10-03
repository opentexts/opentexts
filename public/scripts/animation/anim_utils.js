/**
 * Performs a linear interpolation operation
 * @param {Number} a
 * @param {Number} b
 * @param {Number} t
 * @returns {Number}
 */
export function lerp(a, b, t) {
    return a + (b - a) * t;
}

/**
 * Clamps n within the range 0..1
 * @param {Number} n
 * @returns {Number}
 */
export function clamp01(n) {
    return Math.max(Math.min(n, 1), 0)
}

/**
 * Lerps all values between two points arrays and returns the resulting points array
 * @param {Number[][]} pointsA
 * @param {Number[][]} pointsB
 * @param {Number} t
 * @returns {Number[][]}
 */
export function lerpPoints(pointsA, pointsB, t) {
    var points = [];
    for (var i = 0; i < pointsA.length; i++) {
        points.push([
            lerp(pointsA[i][0], pointsB[i][0], t),
            lerp(pointsA[i][1], pointsB[i][1], t)
        ])
    }
    return points
}

/**
 * Renders points from a point array to match the OpenTexts logo style
 * @param {Number[][]} points
 * @param {Number} t
 * @param {CanvasRenderingContext2D} ctx
 */
export function renderPoints(points, t, ctx) {

    ctx.lineWidth = 1.5
    ctx.beginPath();
    ctx.strokeStyle = `rgb(${lerp(75, 205, t)}, ${lerp(0, 205, t)}, ${lerp(171, 255, t)})`
    ctx.moveTo(...points[0]);
    for (var i = 1; i < points.length - 1; i++) {
        ctx.lineTo(...points[i]);
    }
    ctx.stroke();

    ctx.beginPath();
    ctx.strokeStyle = `rgba(171, 0, 134, ${lerp(1, 0.75, t)})`
    ctx.moveTo(...points[1]);
    for (var i = 3; i < points.length - 1; i += 2) {
        ctx.lineTo(...points[i]);
    }
    ctx.stroke();

    ctx.beginPath();
    ctx.strokeStyle = `rgba(0, 128, 171, ${lerp(1, 0.75, t)})`
    ctx.moveTo(...points[0]);
    for (var i = 2; i < points.length - 1; i += 2) {
        ctx.lineTo(...points[i]);
    }
    ctx.stroke();

    ctx.fillStyle = "#FFF"
    for (var i = 0; i < points.length; i++) {
        ctx.beginPath();
        //ctx.fillText(i, points[i][0], points[i][1], 50)
        ctx.ellipse(...points[i], 2.64, 2.64, 0, 0, 2 * Math.PI);
        ctx.fill();
    }

}