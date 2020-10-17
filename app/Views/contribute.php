<main role="main" class="container main-container">
    <article class="mx-auto max-w-xl">
    <h1>Contribute data</h1>
    <p class="intro">
        If you would like to contribute data to be included in OpenTexts.World, please email 
        <a href="mailto:stuart.lewis@nls.uk?&cc=gill.hamilton@nls.uk">stuart.lewis@nls.uk and gill.hamilton@nls.uk</a>
        for details.
    </p>
	
    <h2>Formats accepted</h2>
    <p>
        We can work with <a href="https://www.loc.gov/marc/bibliographic/" title="MARC21 at Library of Congress, USA">MARC21</a>, 
        <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/" title="DC terms">Dublin Core</a> or 
        <a href="https://en.wikipedia.org/wiki/Comma-separated_values" title="comma-separated value at Wikipedia">CSV</a> (comma-separated) files in the format below. We have also been able to harvest data via <a href="https://www.openarchives.org/pmh/">OAI-PMH</a> and
        <a href="https://iiif.io/">IIIF discovery</a>, or via custom existing data feeds and APIs.
    </p>

    <p>
        If your data is in another format, please <a href="mailto:stuart.lewis@nls.uk?&cc=gill.hamilton@nls.uk">contact us</a> 
        as we may be able to process and integrate it. We love a challenge!
    </p>
    
    <h2>Comma-separated format</h2>
    <p>
        If you are submitting <a href="https://en.wikipedia.org/wiki/Comma-separated_values">comma separated</a> 
        data please follow the format below. Contact us if you want to include other data/fields that are not 
        represented in the format - we'll try and adapt our tools to accommodate your data.

    <p>
        Repeatable fields must be separated with a '|' pipe.
    </p>
    
    <table class="my-6 w-full md:my-12 md:table-auto md:w-auto md:-mx-24 md:max-w-screen lg:-mx-40 lg:max-w-screen-lg border">
        <thead>
            <tr>
                <th scope="col" class="contribute-table__header">Heading</th>
                <th scope="col" class="contribute-table__header">Content</th>
                <th scope="col" class="contribute-table__header">Requirement</th>
                <th scope="col" class="contribute-table__header">Repeatable</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="contribute-table__cell">organisation</td>
                <td class="contribute-table__cell">Unique name of provider</td>
                <td class="contribute-table__cell">Mandatory</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1" ></td>
                <td colspan="3">
                    So we know which organisation contributed the metadata and content. This info will be displayed in a facet and in the full record display. E.g.: <em>Wellcome Library</em>, <em>National Library of Scotland</em>, <em>HathiTrust</em>.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">idLocal</td>
                <td class="contribute-table__cell">Local identifier</td>
                <td class="contribute-table__cell">Mandatory</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    ID from the local system - so each library can look up their 
                    local system if there's a query. 
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">title</td>
                <td class="contribute-table__cell">Title of the work</td>
                <td class="contribute-table__cell">Mandatory</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    For example <a href="https://www.loc.gov/marc/bibliographic/concise/bd245.html">MARC 245 $a $b</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/title">DC terms:title</a>.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">urlMain</td>
                <td class="contribute-table__cell">URL to access the item</td>
                <td class="contribute-table__cell">Mandatory</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    The URL that is most appropriate for a user to follow to get direct/immediate access to the
                    content. May be in <a href="https://www.loc.gov/marc/bibliographic/concise/bd856.html">MARC 856</a> or 
                    <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/identifier">DC terms:identifier</a>. This will likely be a 'landing page' containing metadata about the item and the item itself.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">year</td>
                <td class="contribute-table__cell">Year of publication</td>
                <td class="contribute-table__cell">Desirable</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    This needs to be numeric and four digits in length as it is used to feed the year filter.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">date</td>
                <td class="contribute-table__cell">Date of publication</td>
                <td class="contribute-table__cell">Desirable</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    Ideally numeric but can be any value. <a href="https://www.loc.gov/marc/bibliographic/concise/bd008a.html">MARC 008 position 7-10</a> rather than 
                    MARC 260 $c - e.g. preferred to 1884 vs ca.1884). May be in <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/date">DC terms:date</a>.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">publisher</td>
                <td class="contribute-table__cell">Publisher</td>
                <td class="contribute-table__cell">Desirable</td>
                <td class="contribute-table__cell">Repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    May be in <a href="https://www.loc.gov/marc/bibliographic/concise/bd260.html">MARC 260 $b</a>, <a href="https://www.loc.gov/marc/bibliographic/bd264.html">MARC 264 $a</a>, or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/publisher">DC terms:publisher</a>.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">creator</td>
                <td class="contribute-table__cell">Creator</td>
                <td class="contribute-table__cell">Desirable</td>
                <td class="contribute-table__cell">Repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    Author, editor, creator, organisation - any named person or organisation involved in the creation of the work. May be in MARC <a href="https://www.loc.gov/marc/bibliographic/bd1xx.html">1xx</a>, <a href="https://www.loc.gov/marc/bibliographic/bd70x75x.html">7xx</a> and <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/creator">DC terms:creator</a>, <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/contributor">DC terms:contributor</a>.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">topic</td>
                <td class="contribute-table__cell">Subject or topic</td>
                <td class="contribute-table__cell">Desirable</td>
                <td class="contribute-table__cell">Repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    May be in <a href="https://www.loc.gov/marc/bibliographic/bd6xx.html">MARC 6xx</a>, and <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/subject">DC terms:subject</a>.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">description</td>
                <td class="contribute-table__cell">Description</td>
                <td class="contribute-table__cell">Desirable</td>
                <td class="contribute-table__cell">Repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    Description about the content. May be in <a href="https://www.loc.gov/marc/bibliographic/bd5xx.html">MARC 5xx</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/description">DC terms:description</a>.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">urlPDF</td>
                <td class="contribute-table__cell">URL of a PDF</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr>
                <td class="contribute-table__cell">urlIIIF</td>
                <td class="contribute-table__cell">URL to a IIIF manifest</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr>
                <td class="contribute-table__cell">urlPlainText</td>
                <td class="contribute-table__cell">URL to a plain text file</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Not repeatable</td>
                </tr>
            <tr>
                <td class="contribute-table__cell">urlALTOXML</td>
                <td class="contribute-table__cell">URL to an <a href="https://en.wikipedia.org/wiki/ALTO_(XML)">ALTO XML</a> file</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr>
                <td class="contribute-table__cell">urlOther</td>
                <td class="contribute-table__cell">Other URL(s)</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    If there are other URLs for the content that may be useful - perhaps 
                    Google Books URL, or link to the catalogue record of the original.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">placeOfPublication</td>
                <td class="contribute-table__cell">Place of publication</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                May be in <a href="https://www.loc.gov/marc/bibliographic/concise/bd260.html">MARC 260 $a</a> or <a href="https://www.loc.gov/marc/bibliographic/bd264.html">MARC 264 $a</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/coverage">DC terms:coverage</a>.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">licence</td>
                <td class="contribute-table__cell">Licence of the material</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    May be in <a href="https://www.loc.gov/marc/bibliographic/concise/bd540.html">MARC 540</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/rights">DC terms:rights</a>. 
                    For example CC-BY.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">idOther</td>
                <td class="contribute-table__cell">Other IDs</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    Other local or external identifiers such as DOIs.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">catLink</td>
                <td class="contribute-table__cell">Direct record link</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    A link to the item in your catalogue or discovery system.
                </td>
            </tr>
            <tr>
                <td class="contribute-table__cell">language</td>
                <td class="contribute-table__cell">Item language</td>
                <td class="contribute-table__cell">Optional</td>
                <td class="contribute-table__cell">Not repeatable</td>
            </tr>
            <tr class="contribute-table__notes">
                <td colspan="1"></td>
                <td colspan="3">
                    May be in MARC 008 position 35-37 and/or  MARC 041.<a href="https://www.loc.gov/marc/languages/">[code list]</a> or 
                    <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/language">DC terms:language</a>.
                    Additional default values of 'Not specified' and 'Undetermined'.
                </td>
            </tr>
        </tbody>
    </table>

    </article>
</main>
