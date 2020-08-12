<?php
use Solarium\Component\Result\Facet\FacetResultInterface;
function render_facetset(string $label, string $key, ?string $currentValue, string $defaultValue, FacetResultInterface $facet)
{
    $facetarray = $facet->getValues();
    ?>
    <div tabindex="0" class="card-header bg-info inline-block outline-none cursor-pointer p-y-2 mr-4" style="color: #333;">
        <?= $currentValue != null ? $currentValue : $label; ?>
        <input type="hidden" name="<?=$key?>" value="<?= $currentValue ?>"/>
    <div class="rounded-md absolute filter-dropdown overflow-y-auto" style="background-color: #DDD;">
        <ul class="list-group list-group-flush p-l-1 p-y-1">
        <?php

            if($currentValue != null)
            {
                ?>
                <li class="p-1" onclick="this.closest('form').<?= $key ?>.value =''; this.closest('form').submit()">
                    <span class="badge badge-pill badge-danger"><?= $defaultValue ?></span>
                </li>
                <?php
            }
            foreach ($facetarray as $value => $count) {
                if ($count > 0) {
                    if($value == $currentValue)
                    {
                    ?>
                        <li class="list-group-item bg-offWhite p-1" onclick="this.closest('form').<?=$key?>.value ='<?= esc($value) ?>'; this.closest('form').submit()">
                            <?= $value ?>
                            <!--span class="badge badge-pill badge-primary" style="float: right"><?= number_format($count); ?></span-->
                        </li>
                    <?php
                    }
                    else
                    {
                        ?>
                        <li class="list-group-item p-1" onclick="this.closest('form').<?=$key?>.value ='<?= esc($value) ?>'; this.closest('form').submit()">
                            <?= $value ?>
                            <!-- span class="badge badge-pill badge-primary" style="float: right"><?= number_format($count); ?></span -->
                        </li>
                        <?php
                    }
                }
            }

        ?>
        </ul>
    </div>
    </div>
    <?php
}