import SearchResult from '../Models/search-result.js';
export default class ResultViewController {
    /**
     * @param {Node} template - A template to be inflated.
     * @param {SearchResult} record - The record to be loaded into the template.
     * @param {number} index - The record to be loaded into the template.
     */
    static InflateTemplate(template, record, index) {
        const inflatedRecord = template.cloneNode(true);
        const titleNode = inflatedRecord.firstElementChild;
        if(record.urlMain)
        {
            const link = titleNode.firstElementChild;
            link.href = record.urlMain;
            addOutboundLinkHandler(index, link)
            this.SetInnerHTML(link, record.title);
            if(record.score) {
                link.nextElementSibling.innerText = `[${record.score}]`;
            }
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

        const libraryDetails = publisherDetails.nextElementSibling;
        this.SetInnerHTML(libraryDetails, record.organisation);

        let dlIcon = libraryDetails.nextElementSibling.querySelector("a");
        const urls = [record.urlPDF, record.urlIIIF, record.urlPlainText, record.urlALTOXML];
        let anyUrls = false;
        for(let i = 0; i < urls.length; i++){
            if(urls[i]) {
                anyUrls = true;
                break;
            }
        }
        if(!anyUrls && record.urlOther && record.urlOther.length > 0) {
            anyUrls = true;
        }

        if(!anyUrls){
            const iconStrip = dlIcon.parentNode;
            iconStrip.parentNode.removeChild(iconStrip);
            return inflatedRecord;
        }
        for(let i = 0; i < urls.length; i++) {
            if (urls[i]) {
                dlIcon.href = urls[i];
                addOutboundLinkHandler(index, dlIcon)
                dlIcon.addEventListener('click', handleOutboundLink.bind(null, index))
                dlIcon = dlIcon.nextElementSibling;
            } else {
                const icon = dlIcon
                dlIcon = dlIcon.nextElementSibling;
                icon.parentElement.removeChild(icon);
            }
        }
        if(record.urlOther && record.urlOther.length > 0){
            for(let i = 0; i < record.urlOther.length; i++){

                if(i === 0) {
                    dlIcon.href = record.urlOther[i]
                    addOutboundLinkHandler(index, dlIcon)
                } else {
                    const icon = dlIcon.cloneNode(true);
                    dlIcon.parentElement.appendChild(icon);
                    icon.href = record.urlOther[i]
                    addOutboundLinkHandler(index, icon)
                }
            }
        } else {
            dlIcon.parentElement.removeChild(dlIcon);
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
