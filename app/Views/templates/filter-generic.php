<?php
use Solarium\Component\Result\Facet\FacetResultInterface;
include_once("filter-script.php");
function render_facetset(string $label, string $key, ?string $currentValue, string $defaultValue, FacetResultInterface $facet)
{
    $facetarray = $facet->getValues();
    $values = explode("|", urldecode($currentValue));
    ?>
    <div tabindex="0" class="outline-none cursor-pointer p-y-2 mr-4">
        <div class="flex items-center">
            <span class="text-gray-700"><?= $currentValue != null ? join(", ", $values) : $label; ?></span>
            <span class="text-gray-600 pl-1 icon-sm"><?php echo file_get_contents('svg/chevron-down.svg'); ?></span>
        </div>
        <input type="hidden" name="<?=$key?>" value="<?= $currentValue ?>"/>
    
    <div class="rounded-md absolute filter-dropdown overflow-y-auto bg-gray-100 shadow-lg">
        <ul class="list-group list-group-flush p-3">
        <?php

            if($currentValue != null)
            {
                ?>
                <li class="p-1 text-gray-700" onclick="this.closest('form').<?= $key ?>.value =''; this.closest('form').submit()">
                    <?= $defaultValue ?>
                </li>
                <?php
            }
            foreach ($facetarray as $value => $count) {
                if ($count > 0) {
                    if(in_array($value, $values))
                    {
                    ?>
                        <li class="list-group-item text-blue-800 p-1 font-semibold flex items-center" onclick="removeValue(this.closest('form').<?=$key?>, '<?= esc($value) ?>');">
                            <?= $value ?>
                            <span class="text-gray-600 font-normal pl-1">(<?= number_format($count); ?>)</span>
                            <span class="text-gray-600 w-5 ml-auto icon-sm"><?php echo file_get_contents('svg/check.svg'); ?></span>
                        </li>
                    <?php
                    }
                    else
                    {
                        ?>
                        <li class="list-group-item p-1 text-gray-700" onclick="addValue(this.closest('form').<?=$key?>, '<?= esc($value) ?>');">
                            <?= $value ?>
                            <span class="text-gray-600 pl-1">(<?= number_format($count); ?>)</span>
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
