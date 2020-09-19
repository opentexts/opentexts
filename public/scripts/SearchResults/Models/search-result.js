/**
 * @typedef SearchResult
 * @type {Class}
 * @property {string} title - The title of the record.
 * @property {?string[]} creators - The creators of the record.
 * @property {?string[]} publishers - The publishers of the record.
 * @property {?string[]} placesOfPublication - The place(s) where the record was published.
 * @property {?string} organisation - The library where this record is kept.
 * @property {?string} urlMain - The main URL to retrieve the record at.
 * @property {?string} urlPDF - The URL at which the record is kept in PDF format.
 * @property {?string} urlIIIF - The URL at which the record is kept in IIIF format.
 * @property {?string} urlPlainText - The URL at which the record is kept in plaintext format.
 * @property {?string} urlALTOXML - The URL at which the record is kept in ALTOXML format.
 * @property {?string[]} urlOther - Other relevant URLs for the record.
 * @property {Number} year - The year of publication
 */
export default class SearchResult {
    /**
     * @param {Object} rawRecord - The server returned object defining the result.
     * @constructor
     */
    constructor(rawRecord)
    {
        Object.assign(this, rawRecord);
    }
}