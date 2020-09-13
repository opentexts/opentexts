<main role="main" class="container main-container">
    <article class="mx-auto max-w-xl">
    <h1>Become a data contributor</h1>
    <p class="intro">
        If you would like to contribute data to be included in OpenTexts.World, please email 
        <a href="mailto:stuart.lewis@nls.uk; gill.hamilton@nls.uk">stuart.lewis@nls.uk and gill.hamilton@nls.uk</a>
        for details.
    </p>
	
    <h2>Formats accepted</h2>
    <p>
        We can work with <a href="https://www.loc.gov/marc/bibliographic/" title="MARC21 at Library of Congress, USA">MARC21</a>, 
        <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/" title="DC terms">Dublin Core</a> or 
        <a href="https://en.wikipedia.org/wiki/Comma-separated_values" title="comma-separated value at Wikipedia">CSV</a> (comma-separated) files in the format below.
        We have also been able to harvest data via <a href="https://www.openarchives.org/pmh/">OAI-PMH</a> and
        <a href="https://iiif.io/">IIIF discovery</a>, or via custom existing data feeds and APIs.
    </p>

    <p>
        If your data is in another format, please <a href="mailto:stuart.lewis@nls.uk; gill.hamilton@nls.uk">contact us</a> 
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
    
    <table class="my-12 md:-mx-40 md:max-w-screen-lg lg:-mx-64 lg:max-w-screen-2xl">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Column</th>
                <th scope="col">Heading</th>
                <th scope="col">Content</th>
                <th scope="col">Requirement</th>
                <th scope="col">Repeatable</th>
                <th scope="col">Notes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>organisation</td>
                <td>Unique name of provider</td>
                <td>MANDATORY</td>
                <td>No</td>
                <td>
                    So we know which organisation contributed the metadata and content - 
                    this info will be displayed in a facet and in the full record display. E.g.:<br />
                    <br />
                    Wellcome Library<br />
                    National Library of Scotland<br />
                    HathiTrust
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>idLocal</td>
                <td>Local identifier</td>
                <td>MANDATORY</td>
                <td>No</td>
                <td>
                    ID from the local system - so each library can look up their 
                    local system if there's a query 
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>title</td>
                <td>Title of the work</td>
                <td>MANDATORY</td>
                <td>No</td>
                <td>
                    For example <a href="https://www.loc.gov/marc/bibliographic/concise/bd245.html">MARC 245 $a $b</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/title">DC terms:title</a>
                </td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>urlMain</td>
                <td>URL to access the item</td>
                <td>MANDATORY</td>
                <td>No</td>
                <td>
                    The URL that is most appropriate for a user to follow to get direct/immediate access to the
                    content. May be in <a href="https://www.loc.gov/marc/bibliographic/concise/bd856.html">MARC 856</a> or 
                    <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/identifier">DC terms:identifier</a>. This will likely be a 'landing page' containing metadata about the item and the item itself.
                </td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>year</td>
                <td>Year of publication</td>
                <td>DESIRABLE</td>
                <td>No</td>
                <td>
                    This needs to be numeric and four digits in length as it is used to feed the year filter.
                </td>
            </tr>
            <tr>
                <th scope="row">6</th>
                <td>date</td>
                <td>Date of publication</td>
                <td>DESIRABLE</td>
                <td>No</td>
                <td>
                    Ideally numeric but can be any value, <a href="https://www.loc.gov/marc/bibliographic/concise/bd008a.html">MARC 008 position 7-10</a> rather than 
                    MARC 260 $c - e.g. preferred to 1884 vs ca.1884). May be in <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/date">DC terms:date</a>
                </td>
            </tr>
            <tr>
                <th scope="row">7</th>
                <td>publisher</td>
                <td>Publisher</td>
                <td>DESIRABLE</td>
                <td>Yes</td>
                <td>
                    May be in <a href="https://www.loc.gov/marc/bibliographic/concise/bd260.html">MARC 260 $b</a> or <a href="https://www.loc.gov/marc/bibliographic/bd264.html">MARC 264 $a</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/publisher">DC terms:publisher</a>
                </td>
            </tr>
            <tr>
                <th scope="row">8</th>
                <td>creator</td>
                <td>Creator</td>
                <td>DESIRABLE</td>
                <td>Yes</td>
                <td>
                    Author, editor, creator, organisation - any named person/organisation involved in the creation of the work. May be in MARC <a href="https://www.loc.gov/marc/bibliographic/bd1xx.html">1xx</a>, <a href="https://www.loc.gov/marc/bibliographic/bd70x75x.html">7xx</a> and <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/creator">DC terms:creator</a>, <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/contributor">DC terms:contributor</a>
                </td>
            </tr>
            <tr>
                <th scope="row">9</th>
                <td>topic</td>
                <td>Subject or topic</td>
                <td>DESIRABLE</td>
                <td>Yes</td>
                <td>May be in <a href="https://www.loc.gov/marc/bibliographic/bd6xx.html">MARC 6xx</a>, and <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/subject">DC terms:subject</a>
                </td>
            </tr>
            <tr>
                <th scope="row">10</th>
                <td>description</td>
                <td>Description</td>
                <td>DESIRABLE</td>
                <td>Yes</td>
                <td>
                    Description about the content. May be in <a href="https://www.loc.gov/marc/bibliographic/bd5xx.html">MARC 5xx</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/description">DC terms:description</a>
                </td>
            </tr>
            <tr>
                <th scope="row">11</th>
                <td>urlPDF</td>
                <td>URL of a PDF</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>
                    If there is a PDF version of the item
                </td>
            </tr>
            <tr>
                <th scope="row">12</th>
                <td>urlIIIF</td>
                <td>URL to a IIIF manifest</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>URL to a IIIF manifest</td>
            </tr>
            <tr>
                <th scope="row">13</th>
                <td>urlPlainText</td>
                <td>URL to a plain text file</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>URL to a plain text file</td>
            </tr>
            <tr>
                <th scope="row">14</th>
                <td>urlALTOXML</td>
                <td>URL to an ALTO XML file</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>URL to an <a href="https://en.wikipedia.org/wiki/ALTO_(XML)">ALTO XML</a> file</td>
            </tr>
            <tr>
                <th scope="row">15</th>
                <td>urlOther</td>
                <td>URL of other useful version(s)</td>
                <td>OPTIONAL</td>
                <td>Yes</td>
                <td>
                    If there are other URLs for the content that may be useful - perhaps 
                    Google Books URL, or link to the catalogue record of the original
                </td>
            </tr>
            <tr>
                <th scope="row">16</th>
                <td>placeOfPublication</td>
                <td>Place of publication</td>
                <td>OPTIONAL</td>
                <td>Yes</td>
                <td>May be in <a href="https://www.loc.gov/marc/bibliographic/concise/bd260.html">MARC 260 $a</a> or <a href="https://www.loc.gov/marc/bibliographic/bd264.html">MARC 264 $a</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/coverage">DC terms:coverage</a></td>
            </tr>
            <tr>
                <th scope="row">17</th>
                <td>licence</td>
                <td>Licence of the material</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>
                    May be in <a href="https://www.loc.gov/marc/bibliographic/concise/bd540.html">MARC 540</a> or <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/rights">DC terms:rights</a><br/>
                    <br/>
                    For example CC-BY
                </td>
            </tr>
            <tr>
                <th scope="row">18</th>
                <td>idOther</td>
                <td>Other local or external ids</td>
                <td>OPTIONAL</td>
                <td>Yes</td>
                <td>Other identifiers such as DOIs</td>
            </tr>
            <tr>
                <th scope="row">19</th>
                <td>catLink</td>
                <td>A link directly to the item's catalogue record</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>A link to the item in your catalogue or discovery system</td>
            </tr>
            <tr>
                <th scope="row">20</th>
                <td>language</td>
                <td>language of the resource</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>
                    May be in MARC 008 position 35-37 and/or  MARC 041.<a href="https://www.loc.gov/marc/languages/">[code list]</a> or 
                    <a href="https://www.dublincore.org/specifications/dublin-core/dcmi-terms/#http://purl.org/dc/terms/language">DC terms:language</a>.
                    Additional default values of 'Not specified' and 'Undetermined'
                </td>
            </tr>
        </tbody>
    </table>

    </article>
</main>
