    <?php
        // Do we ened pagination?
        if ($resultcount > 10) {
            ?>
        
            <nav aria-label="Page navigation example">
                <ul class="pagination">
            
            <?php
            // Do we need to show first page jump link
            if ($start > 10) {
                ?><li class="page-item"><a class="page-link" href='<?= $url; ?>'>
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span></a>
                  </li><?php
            }

            // Do we need to show previous page link?
            if ($start >= 10) {
                ?><li class="page-item"><a class="page-link" href='<?= $url . '&start=' . ($start - 10); ?>'>&lt; Previous page</a></li><?php
            }

            // Do we need to show next page link?
            if ($resultcount > $start + 10) {
                ?><li class="page-item"><a class="page-link" href='<?= $url . '&start=' . ($start + 10); ?>'>Next page &gt;</a></li><?php
            }

            // Do we need to show a last page jump link
            if ($start < ($resultcount - 10)) {
                ?><li class="page-item"><a class="page-link" href='<?= $url . '&start=' . (floor($resultcount / 10) * 10); ?>'>
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Last</span></a>
                  </li><?php
            }
            ?>
                
                </ul>
            </nav>    
                
            <?php
        }
    ?>
