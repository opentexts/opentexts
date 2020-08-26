/**
 * @typedef Event
 * @type Class
 * @property {Set<function>} _callbacks
 */
export default class Event {
    constructor() {
        this._callbacks = new Set();
    }

    /**
     * @param {function} callback - A function to be called when the event is triggered
     */
    addEventListener(callback) {
        this._callbacks.add(callback);
    }

    /**
     * @param {function} callback - The function to be removed
     */
    removeEventListener(callback) {
        this._callbacks.remove(callback);
    }

    /**
     * Triggers the event invoking all registered callbacks.
     */
    invoke() {
        const args = arguments;
        this._callbacks.forEach(cb => cb(...args));
    }
}