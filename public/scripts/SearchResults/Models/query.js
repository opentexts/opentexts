/**
 * @typedef Query
 * @type Class
 * @property {string} q
 * @property {string} language
 * @property {string} organisation
 * @property {number} start
 */
const filters = ["language", "organisation"];
export default class Query {
    constructor(rawQuery){
        Object.assign(this, rawQuery);
        for(let i = 0; i < filters.length; i++)
        {
            this[filters[i]] = this[filters[i]] || "";
        }
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