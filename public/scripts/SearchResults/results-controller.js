import Query from './Models/query.js'
import SearchResult from './Models/search-result.js'
import ResultViewController from "./ViewControllers/result-view-controller.js";
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
 * @property {Object} _filterCounts
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
        // Update history with a query object so we can process back requests to the initial page.
        if(!history.state) {
            history.replaceState(this._query, '', null);
        }
        const results = payload.results.map(o => new SearchResult(o));
        this._total = payload.total;
        this._filterCounts = payload.filters;
        this._processResults(results);
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


    /**
     * Retrieves and renders additional results
     */
    fetchMoreResults() {
        const query = this._query.clone();
        query.start += this._count;
        this.onResultsRequested.invoke();
        fetch(query.buildDataUrl() )
            .then(r => r.json())
            .then(res => {
                this._total = res.total;
                this._filterCounts = res.filters;
                this._processResults(res.results.map(o => new SearchResult(o)));
            })
    }

    /**
     * @returns {Query} A clone of the current query, useful for modifying to replace the existing query.
     */
    getQuery() {
        return this._query.clone();
    }

    /**
     * Uses Object.assign to amend the existing query and refreshes results.
     * @param {Query} newQuery - An object representing the new state of the query object
     */
    updateQuery(newQuery) {
        Object.assign(this._query, newQuery);
        this._reloadResults();
    }


    /**
     * Replaces the existing query in it's entirety and refreshes results.
     * @param {Query} newQuery - An object representing the new state of the query object
     * @param {boolean} updateHistory - Whether the History API should be pushed with this query
     */
    replaceQuery(newQuery, updateHistory = true) {
        this._query = newQuery;
        this._reloadResults(updateHistory);
    }

    /**
     * Returns the total records matching each filter value for the given filter.
     * @param {string} filter
     * @returns {Object} A map of filter values to number of results.
     */
    getFilterCounts(filter) {
        return this._filterCounts[filter];
    }

    /**
     * Reload first page data and replace all existing content.
     * @param {boolean} updateHistory - Whether the History API should be pushed with this query
     * @private
     */
    _reloadResults(updateHistory= true) {
        const searchUrl = this._query.buildDirectUrl();
        if(updateHistory) {
            history.pushState(this._query, "", searchUrl)
        }
        // Empty container of all children
        while(this._container.firstChild)
        {
            this._container.removeChild(this._container.firstChild);
        }
        this._count = 0;
        this.fetchMoreResults();
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