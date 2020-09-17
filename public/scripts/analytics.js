let analyticsDebug = {}
const debug = true;

function pushAnalytics(dataObject) {
    if(debug) {
        Object.assign(analyticsDebug, dataObject);
        console.log(analyticsDebug)
    } else {
        dataLayer.push(dataObject);
    }
}

/**
 * Adds events to perform analytics tracking on a link
 * @param {number} index
 * @param {Element} element
 */
function addOutboundLinkHandler(index, element) {
    element.addEventListener('mouseup', ((index, evt) => {
        if(evt.button < 2) {
            handleOutboundLink(index, evt.target.getAttribute("href"))
        }
    }).bind(null, index))
    element.addEventListener('keydown', ((index, evt) => {
        if(evt.keyCode === 13) {
            handleOutboundLink(index, evt.target.getAttribute("href"))
        }
    }).bind(null, index))
}

/**
 * Performs analytics tracking on outbound links
 * @param {number} index
 * @param {string} href
 */
function handleOutboundLink(index, href) {
    const domain = href.replace('http://','').replace('https://','').split(/[/?#]/)[0];
    outboundInteraction(domain, index);
}

/**
 * Sets the `libraryFilter` value for analytics
 * @param {string} filterSet
 */
function setLibraryFilter(filterSet) {
    pushAnalytics({'libraryFilter': filterSet});

}
/**
 * Sets the `languageFilter` value for analytics
 * @param {string} filterSet
 */
function setLanguageFilter(filterSet) {
    pushAnalytics({'languageFilter': filterSet});
}
/**
 * Sets the `loadedTotal` value for analytics
 * @param {number} total
 */
function setLoadedTotal(total) {
    pushAnalytics({'loadedTotal': total});
}
/**
 * Sets the `total` value for analytics
 * @param {number} total
 */
function setTotal(total) {
    pushAnalytics({'total': total});
}


/**
 * Triggers the pageview analytics event
 * @param {string} url
 */
function sendPageview(url) {
    pushAnalytics({'event':'virtualPageView', 'pageUrl': url});
}

/**
 * Triggers the interaction -> outbound analytics event
 * @param {string} origin
 * @param {number} recordIndex
 */
function outboundInteraction(origin, recordIndex) {
    pushAnalytics({'event':'interaction_outbound', 'origin': origin, 'recordIndex': recordIndex});
}

/**
 * Triggers the interaction -> moreResults analytics event
 */
function moreResultsInteraction() {
    pushAnalytics({'event':'interaction_moreResults'});
}

/**
 * Triggers the interaction -> moreResults analytics event
 */
function allResultsLoadedInteraction() {
    pushAnalytics({'event':'interaction_allResultsLoaded'});
}

/**
 * Triggers the interaction -> moreResults analytics event
 */
function exportInteraction() {
    pushAnalytics({'event':'interaction_export'});
}

/**
 * Triggers the interaction -> libraryFilterAdded analytics event
 * @param {string} filterValue
 * @param {number} filteredTotal
 */
function libraryFilterAddedInteraction(filterValue, filteredTotal) {
    pushAnalytics({'event':'interaction_libraryFilterAdded', "eventLabel": filterValue, "eventValue": filteredTotal});
}

/**
 * Triggers the interaction -> libraryFilterRemoved analytics event
 * @param {string} filterValue
 */
function libraryFilterRemovedInteraction(filterValue) {
    pushAnalytics({'event':'interaction_libraryFilterAdded', "eventLabel": filterValue});
}

/**
 * Triggers the interaction -> languageFilterAdded analytics event
 * @param {string} filterValue
 * @param {number} filteredTotal
 */
function languageFilterAddedInteraction(filterValue, filteredTotal) {
    pushAnalytics({'event':'interaction_languageFilterAdded', "eventLabel": filterValue, "eventValue": filteredTotal});
}

/**
 * Triggers the interaction -> languageFilterRemoved analytics event
 * @param {string} filterValue
 */
function languageFilterRemovedInteraction(filterValue) {
    pushAnalytics({'event':'interaction_languageFilterAdded', "eventLabel": filterValue});
}