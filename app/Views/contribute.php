<main role="main" class="container">
    <h1 class="mt-5">Contribute data</h1>
    <p class="lead">
        If you want to contribute data email 
        <a href="mailto:stuart.lewis@nls.uk; gill.hamilton@nls.uk">stuart.lewis@nls.uk and gill.hamilton@nls.uk</a>
        for details.
    </p>
    
    <p>
        The draft requirements for files is <a href="https://en.wikipedia.org/wiki/Comma-separated_values" target=_blank">CSV</a> with the following fields:
    </p>
    
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope=col">Column</th>
                <th scope=col">Heading</th>
                <th scope=col">Content</th>
                <th scope=col">Requirement</th>
                <th scope=col">Repeatable</th>
                <th scope=col">Notes</th>
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
                    So we know which organisation "owns" the metadata and content - 
                    this info might be displayed in a facet or in the full record display</br>
                    </br>
                    Wellcome Library</br>
                    University of Oxford</br>
                    University of Cambridge</br>
                    National Library of Wales</br>
                    National Library of Scotland</br>
                    Trinity College, Dublin</br>
                    The British Library</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>idLocal</td>
                <td>Local identifier</td>
                <td>MANDATORY</td>
                <td>No</td>
                <td>
                    ID from the local system - so each library can look up their 
                    local system if there’s a query 
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>title</td>
                <td>Title of the work</td>
                <td>MANDATORY</td>
                <td>No</td>
                <td>
                    For example MARC 245 $a $b or DC:TITLE
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
                    content. (Might be in MARC 856 or DC. This will likely be a ‘landing page’ containing metadata
                    and the item.
                </td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>year</td>
                <td>Year of publication</td>
                <td>DESIRABLE</td>
                <td>No</td>
                <td>
                    Ideally a numeric (like what we see in MARC 008 rather than 
                    MARC 260$c - e.g. preferred to 1884 vs ca.1884). May be in DC:DATE
                </td>
            </tr>
            <tr>
                <th scope="row">6</th>
                <td>publisher</td>
                <td>Publisher</td>
                <td>DESIRABLE</td>
                <td>Yes</td>
                <td>
                    Found in MARC 260$b or DC:PUBLISHER
                </td>
            </tr>
            <tr>
                <th scope="row">7</th>
                <td>creator</td>
                <td>Creator</td>
                <td>DESIRABLE</td>
                <td>Yes</td>
                <td>
                    Author, editor, creator, organisation - any named person/organisation 
                    involved in the creation of the work. May be in MARC 1xx, 7xx and 
                    DC:CREATOR, DC:CONTRIBUTOR
                </td>
            </tr>
            <tr>
                <th scope="row">8</th>
                <td>topic</td>
                <td>Subject or topic</td>
                <td>DESIRABLE</td>
                <td>Yes</td>
                <td>
                    Might be in MARC 6xx fields, and DC:SUBJECT
                </td>
            </tr>
            <tr>
                <th scope="row">9</th>
                <td>description</td>
                <td>Description</td>
                <td>DESIRABLE</td>
                <td>Yes</td>
                <td>
                    Description about the content. Might be in MARC 500?? Or DC:DESCRIPTION
                </td>
            </tr>
            <tr>
                <th scope="row">10</th>
                <td>urlPDF</td>
                <td>URL of a PDF</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>
                    If you've got a PDF version of the item
                </td>
            </tr>
            <tr>
                <th scope="row">11</th>
                <td>urlOther</td>
                <td>URL of other userful version(s)</td>
                <td>OPTIONAL</td>
                <td>Yes</td>
                <td>
                    If you’ve got other URLs of the content that may be useful - perhaps 
                    Google Books URL, or link to the catalogue record of the original
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
                <td>placeOfPublication</td>
                <td>Place of publication</td>
                <td>OPTIONAL</td>
                <td>Yes</td>
                <td>Found in 260$a in MARC</td>
            </tr>
            <tr>
                <th scope="row">14</th>
                <td>licence</td>
                <td>Licence of the material</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>
                    Might be in MARC 540 or DC:RIGHTS<br/>
                    <br/>
                    For example CC-BY
                </td>
            </tr>
            <tr>
                <th scope="row">15</th>
                <td>idOther</td>
                <td>Other local or external ids</td>
                <td>OPTIONAL</td>
                <td>Yes</td>
                <td>Other identifiers such as DOIs</td>
            </tr>
            <tr>
                <th scope="row">16</th>
                <td>catLink</td>
                <td>A link directly to the item's catalogue record</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>A link to the item in your catalogue or discovery system</td>
            </tr>
            <tr>
                <th scope="row">17</th>
                <td>language</td>
                <td>language of the resource</td>
                <td>OPTIONAL</td>
                <td>No</td>
                <td>Found in MARC 008 position 35-37 and 041. Codes list <a href="https://www.loc.gov/marc/languages/">here</a></td>
            </tr>
        </tbody>
    </table>
    
    <p>
        Repeatable fields are separated with a '|' pipe.
    </p>
</main>