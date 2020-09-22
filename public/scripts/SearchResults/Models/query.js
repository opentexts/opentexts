/**
 * A list of currently supported filters in queries.
 * @type {string[]}
 */
const filters = ["language", "organisation"];
/**
 * @typedef Query
 * @type Class
 * @property {string} q
 * @property {string} language
 * @property {string} organisation
 * @property {number} start
 */
export default class Query {
    constructor(rawQuery){

        Object.assign(this, rawQuery);
        for(let i = 0; i < filters.length; i++)
        {
            if(!Array.isArray(this[filters[i]])) {
            var filterText = this[filters[i]] || "";
            if(filterText === "")
            {
                this[filters[i]] = [];
                continue;
            }

            this[filters[i]] = filterText.split("|");
            }
        }
    }

    /**
     * Creates a clone of this query
     * @returns {Query}
     */
    clone() {
        return new Query(this);
    }

    /**
     * Queries the specified filter for whether the provided value is currently included in the set.
     * @param {string} filter - The name of the filter to be queried, should be a value in {@link filter}.
     * @param {string} value - The value to be searched for in the filter
     * @returns {boolean} - True if the value currently exists in the filter set.
     * @throws Will throw if filter is not referenced in {@link filters}
     */
    filterContainsValue(filter, value) {
        if(!filters.includes(filter)) {
            throw `Attempted to query value of non-existent filter: ${filter}.`
        }
        return this[filter].includes(value);
    }

    /**
     * Adds the provided value to the specified filter
     * @param {string} filter - The name of the filter to update, should be a value in {@link filters}.
     * @param {string} value - The value to be added to the filter.
     * @throws Will throw if filter is not referenced in {@link filters}
     */
    addToFilter(filter, value) {
        if(!filters.includes(filter)) {
            throw `Attempted to add to non-existent filter: ${filter}.`
        }

        this[filter].push(value);
    }

    /**
     * Removes the provided value from the specified filter
     * @param {string} filter - The name of the filter to update, should be a value in {@link filters}.
     * @param {string} value - The value to be added to the filter.
     * @throws Will throw if filter is not referenced in {@link filters}
     */
    removeFromFilter(filter, value) {
        if(!filters.includes(filter)) {
            throw `Attempted to remove from non-existent filter: ${filter}.`
        }

        for(let i = this[filter].length-1; i >= 0; i--)
        {
            if(this[filter][i] === value) {
                this[filter].splice(i,1);
            }
        }
    }

    /**
     * Resets the specified filter to an empty set, which will return all values.
     * @param {string} filter - The name of the filter to update, should be a value in {@link filters}.
     * @throws Will throw if filter is not referenced in {@link filters}
     */
    resetFilter(filter) {
        if(!filters.includes(filter)) {
            throw `Attempted to reset non-existent filter: ${filter}.`
        }
        this[filter] = [];
    }

    /**
     * Creates a Url representing this query which will load a human visible page
     * @returns {string}
     */
    buildDirectUrl() {
        return `/search?${this._getQueryString()}`;
    }

    /**
     * Creates a Url representing this query which will load the export CSV version
     * @returns {string}
     */
    buildExportUrl() {
        return `/search/export?${this._getQueryString()}`;
    }

    /**
     * Creates a Url representing this query which will load a JSON response
     * @returns {string}
     */
    buildDataUrl() {
        return `/search/data?${this._getQueryString()}`;
    }

    /**
     * Returns a query string suitable for using in request to the server
     * @returns {string}
     * @private
     */
    _getQueryString() {
        const keys = Object.keys(this);
        const params = [];
        // Omit empty values for a cleaner URL for sharing purposes
        keys.forEach(k => {
            if(!this[k]) return;
            if(Array.isArray(this[k])) {
                if(this[k].length === 0) return;
                params.push(`${k}=${encodeURIComponent(this[k].join('|'))}`)
            } else {
                params.push(`${k}=${encodeURIComponent(this[k])}`)
            }
        })
        return params.join('&')
    }
}