import SearchResult from './Models/search-result.js';

export default class ResultViewController {
    /**
     * @param {Node} template - A template to be inflated.
     * @param {SearchResult} record - The record to be loaded into the template.
     */
    static InflateTemplate(template, record) {
        const inflatedRecord = template.cloneNode(true);
        const titleNode = inflatedRecord.firstElementChild;
        if(record.urlMain)
        {
            const link = titleNode.firstElementChild;
            link.href = record.urlMain;
            this.SetInnerHTML(link, record.title);
        }
        else
        {
            this.SetInnerHTML(titleNode, record.title);
        }

        const author = titleNode.nextElementSibling;
        this.SetInnerHTML(author, record.creators ? record.creators.join() : "")

        const publisherDetails = author.nextElementSibling;
        let publisherDetailsString = record.publishers ? record.publishers.join(" ") + " " : "";
        publisherDetailsString += record.placesOfPublication ? record.placesOfPublication.join(" ") + " " : "";
        publisherDetailsString += record.year || ""
        this.SetInnerHTML(publisherDetails, publisherDetailsString);


        let dlIcon = publisherDetails.nextElementSibling.firstElementChild;
        const urls = [record.urlPDF, record.urlIIIF, record.urlPlainText, record.urlALTOXML, record.urlOther];
        for(let i = 0; i < urls.length; i++) {
            if (urls[i]) {
                dlIcon.href = urls[i];
                dlIcon = dlIcon.nextElementSibling;
            } else {
                const icon = dlIcon
                dlIcon = dlIcon.nextElementSibling;
                icon.parentElement.removeChild(icon);
            }
        }
        return inflatedRecord;
    }

    /**
     * Attempts to sanitize value before setting HTML to avoid injection attacks.
     * @param {Element} element
     * @param {string} value
     * @constructor
     */
    static SetInnerHTML(element, value) {
        value.replace(/<em( class=[^>]+)?>/, "%%EM$1%%")
        value.replace("</em>", "%%/EM%%");
        value.replace("<", "&lt;");
        value.replace(">", "&gt;");
        value.replace(/%%EM( class=[^>]+)?%%/, "<em$1>")
        value.replace("%%/EM%%", "</em>");
        // noinspection InnerHTMLJS
        element.innerHTML = value;
    }
}
