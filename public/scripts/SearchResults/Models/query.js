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

        for(let i = filters[filter].length-1; i >= 0; i--)
        {
            if(filters[filter][i] === value) {
                filters[filter].removeAt(i);
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
        filters[filter] = [];
    }

    /**
     * Creates a Url representing this query which will load a human visible page
     * @returns {string}
     */
    buildDirectUrl() {
        return `/search?start=${this.start}&q=${this.q}&organisation=${this.organisation}&language=${this.language}`;
    }

    /**
     * Creates a Url representing this query which will load a JSON response
     * @returns {string}
     */
    buildDataUrl() {
        return `/search/data?start=${this.start}&q=${this.q}&organisation=${this.organisation}&language=${this.language}`;
    }
}