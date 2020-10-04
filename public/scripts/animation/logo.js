import {clamp01, lerpPoints, renderPoints} from "./anim_utils.js";
import {defaultLogo, houseLogo} from "./anim_data.js";

function generateRotationalPoints(radius, spacing, offset) {
    var points = []
    var baseAngle = (34.9);
    offset += 45;
    baseAngle *= spacing;
    for (var i = 8; i >= 0; i--) {
        var angle = baseAngle * (i-4.5) + offset;
        angle *= Math.PI / 180
        var x = radius * Math.sin(angle) + defaultLogo[9][0];
        var y = radius * Math.cos(angle) + defaultLogo[9][1];
        points.push([x, y])
    }
    points.push(defaultLogo[9])
    return points
}

var offset = 0;
var updateTime = -1;
var isMouseOver = false;
var isLoading = false;

export function setIsLoading(loading) {
    isLoading = loading;
}

export function loadingSpinnerAnim(ctx, T) {
    const duration = 1500;

    // First frame behaviour
    if(T === -1) {
        updateTime = -1;
        offset = 0;
    }

    // Calculate deltaTime
    let dT = 0
    if(updateTime > 0) {
        dT = T - updateTime;
    }
    updateTime = T;
    offset = (offset + dT)%duration;

    // Calculate t value
    const t = clamp01(offset/ duration);

    let points = generateRotationalPoints(43, 1-Math.sin(t*Math.PI), t * 360);
    ctx.clearRect(0,0, ctx.canvas.width, ctx.canvas.height)

    const finalBlendT = clamp01((t > 0.5 ? 1-t : t) / 0.1)
    if(finalBlendT < 1) {
        points = lerpPoints(defaultLogo, points, finalBlendT)
    }
    if(t <= 0.025 && !isLoading) {
        renderPoints(points, 0, ctx);
        updateTime = -1;
        offset = 0;
    } else {
        renderPoints(points, 0, ctx);
        window.requestAnimationFrame(loadingSpinnerAnim.bind(this, ctx))
    }
}

/**
 * Performs the animation from Home to Default
 * @param {CanvasRenderingContext2D} ctx
 * @param {boolean} reverse
 */
export function performHomeAnim(ctx, reverse) {
    if(reverse) {
        isMouseOver = false;
        homeConstellationReverseAnim(ctx);
    } else {
        isMouseOver = true;
        homeConstellationAnim(ctx);
    }
}

function homeConstellationAnim(ctx, T = -1) {
    if(isLoading) return;
    if(!isMouseOver)
        return;
    if(renderKeyframeLerp(ctx, defaultLogo, houseLogo, T, false))
    {
        window.requestAnimationFrame(homeConstellationAnim.bind(this, ctx))
    }
}

function homeConstellationReverseAnim(ctx, T = -1) {
    if(isLoading) return;
    if(isMouseOver)
        return;
    if(renderKeyframeLerp(ctx, defaultLogo, houseLogo, T, true))
    {
        window.requestAnimationFrame(homeConstellationReverseAnim.bind(this, ctx))
    }
}

/**
 * Lerps between two sets of keyframes and renders them
 * @param {CanvasRenderingContext2D} ctx
 * @param {Number[][]} framesA
 * @param {Number[][]} framesB
 * @param {Number} T
 * @param {boolean} reverse - whether to play the animation backwards
 * @returns {boolean} true if animation is ongoing - else false
 */
function renderKeyframeLerp(ctx, framesA, framesB, T, reverse) {
    const duration = 250.0;

    // First frame behaviour
    if(T === -1) {
        if(updateTime > 0) {
            offset = duration - offset;
        }
        updateTime = T;
        return true;
    }

    // Calculate deltaTime
    let dT = 0
    if(updateTime > 0) {
        dT = T - updateTime;
    }
    updateTime = T;
    offset = (offset + dT);

    // Calculate t value
    let t = clamp01((offset/ duration));
    const finished = t === 1;
    if(reverse) {
        t = 1 - t;
    }

    ctx.clearRect(0,0, ctx.canvas.width, ctx.canvas.height)

    renderPoints(lerpPoints(framesA, framesB, t), t, ctx);
    return !finished;
}

/**
 * Renders the default Opentexts logo to the provided 2d context
 * @param {CanvasRenderingContext2D} ctx
 */
export function renderOpentextsLogo(ctx) {
    renderPoints(defaultLogo, 0, ctx)
}