import Query from './Models/query.js'
import SearchResult from './Models/search-result.js'
import ResultViewController from "./result-view-controller.js";
import Event from './Util/event.js';

/**
 * @typedef ResultsController
 * @type Class
 * @property {Node} _template
 * @property {Node} _container
 * @property {SearchResult[]} _results
 * @property {Number} _start
 * @property {Number} _count
 * @property {Number} _total
 * @property {Query} _query
 * @property {Event} onResultsRequested - Is invoked whenever new results are requested, useful for updating buttons etc
 * @property {Event} onResultsAdded - Is invoked whenever new results are added, useful for updating counts etc
 */
export default class ResultsController {
    /**
     * @param {HTMLTemplateElement} template - The template for an individual result
     */
    constructor(template) {
        this._template = template.content.firstElementChild.cloneNode(true);
        this._container = template.parentNode;
        this._count = 0;
        this.onResultsRequested = new Event();
        this.onResultsAdded = new Event();

        const payload = JSON.parse(template.getAttribute("data-payload"));
        this._query = new Query(payload.query);
        const results = payload.results.map(o => new SearchResult(o));
        this._total = payload.total;
        this._processResults(results);
    }

    /**
     * Retrieves and renders additional results
     */
    fetchMoreResults() {
        const query = new Query(this._query);
        query.start += this._count;
        this.onResultsRequested.invoke();
        fetch(query.buildDataUrl() )
            .then(r => r.json())
            .then(json => {
                return json.map(o => new SearchResult(o));
            })
            .then(res => {
                this._processResults(res);
            })
    }

    /**
     * Return the index of the first result
     * @returns {number}
     */
    getStart() {
        return this._query.start;
    }

    /**
     * Returns the current total number of results
     * @returns {number}
     */
    getCount() {
        return this._count;
    }

    /**
     * Returns the overall total number of results
     * @returns {number}
     */
    getTotal() {
        return this._total;
    }

    _processResults(results) {
        const that = this;
        results.forEach(function(result){
            const record = ResultViewController.InflateTemplate(that._template, result)
            that._container.appendChild(record);
            that._count++;
        })
        this.onResultsAdded.invoke();
    }
}