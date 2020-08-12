<?php
use Solarium\Component\Result\Facet\FacetResultInterface;
function render_facetset(string $label, string $key, ?string $currentValue,  FacetResultInterface $facet)
{
    $facetarray = $facet->getValues();
    ?>
    <div tabindex="0" class="card-header bg-info inline-block outline-none" style="color: #333;">
        <?= $label; ?>
        <input type="hidden" name="<?=$key?>" value="<?= $currentValue ?>"/>
    <div class="rounded-md absolute filter-dropdown overflow-y-auto" style="background-color: #DDD;">
        <ul class="list-group list-group-flush ">
        <?php
            foreach ($facetarray as $value => $count) {
                if ($count > 0) {
                    if($value == $currentValue)
                    {
                    ?>
                        <li class="list-group-item" onclick="this.closest('form').<?=$key?>.value ='<?= esc($value) ?>'; this.closest('form').submit()">
                            <?= $value ?>
                            <span class="badge badge-pill badge-primary" style="float: right"><?= number_format($count); ?></span>
                        </li>
                    <?php
                    }
                    else
                    {
                        ?>
                        <li class="list-group-item selected" onclick="this.closest('form').<?=$key?>.value ='<?= esc($value) ?>'; this.closest('form').submit()">
                            <?= $value ?>
                            <span class="badge badge-pill badge-primary" style="float: right"><?= number_format($count); ?></span>
                        </li>
                        <?php
                    }
                }
            }

            if($currentValue != null)
            {
                ?>
                <li>
                    <span class="badge badge-pill badge-danger" onclick="this.closest('form').<?=$key?>.value =''; this.closest('form').submit()">Remove</span>
                </li>
                <?php
            }
        ?>
        </ul>
    </div>
    </div>
    <?php
}