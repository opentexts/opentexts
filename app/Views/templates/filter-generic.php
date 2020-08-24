<?php
use Solarium\Component\Result\Facet\FacetResultInterface;
include_once("filter-script.php");
function render_facetset(string $key, ?string $currentValue, string $defaultValue, string $multiValue, FacetResultInterface $facet)
{
    $facetarray = $facet->getValues();
    $values = explode("|", urldecode($currentValue));
    ?>
    <div tabindex="0" class="outline-none cursor-pointer py-2 mr-6">
        <div class="flex items-center">
            <span class="text-gray-700 focus:text-blue-700"><?= $currentValue == "" ? $defaultValue : (count($values) > 1 ? $multiValue : $currentValue); ?></span>
            <span class="text-gray-600 pl-1 icon-sm"><?php echo file_get_contents('svg/chevron-down.svg'); ?></span>
        </div>
        <input type="hidden" name="<?=$key?>" value="<?= $currentValue ?>"/>
    
    <div class="rounded-md absolute filter-dropdown overflow-y-auto bg-gray-100 shadow-lg -ml-6">
        <ul class="list-group list-group-flush py-3 pr-3">
        <?php

            if($currentValue != null)
            {
                ?>
                <li>
                    <a class="flex items-center p-1 text-gray-700 border-2 border-transparent hover:text-blue-700 focus:text-blue-700 focus:border-blue-500 no-underline" onclick="this.closest('form').<?= $key ?>.value =''; this.closest('form').submit()">
                        <span class="block w-5"></span>
                        <?= $defaultValue ?>
                    </a>
                </li>
                <?php
            }
            else
            {
                ?>
                <li>
                    <a class="flex items-center p-1 text-blue-800 font-semibold border-2 border-transparent hover:text-blue-700 focus:text-blue-700 focus:border-blue-500 no-underline" onclick="this.closest('form').<?= $key ?>.value =''; this.closest('form').submit()">
                        <span class="block text-gray-600 w-5 icon-sm"><?php echo file_get_contents('svg/check.svg'); ?></span>
                        <?= $defaultValue ?>
                    </a>
                </li>
            <?php
            }
            foreach ($facetarray as $value => $count) {
                if ($count > 0) {
                    if(in_array($value, $values))
                    {
                    ?>
                        <li>
                            <a class="flex items-center p-1 text-blue-800 font-semibold border-2 border-transparent hover:text-blue-700 focus:text-blue-700 focus:border-blue-500 no-underline" onclick="removeValue(this.closest('form').<?=$key?>, '<?= esc($value) ?>');">
                                <span class="block text-gray-600 w-5 icon-sm"><?php echo file_get_contents('svg/check.svg'); ?></span>
                                <?= $value ?>
                                <span class="text-gray-600 font-normal pl-1">(<?= number_format($count); ?>)</span>
                            </a>
                        </li>
                    <?php
                    }
                    else
                    {
                        ?>
                        <li>
                            <a class="flex p-1 text-gray-700 border-2 border-transparent hover:text-blue-700 focus:text-blue-700 focus:border-blue-500 no-underline" onclick="addValue(this.closest('form').<?=$key?>, '<?= esc($value) ?>');">
                                <span class="block w-5"></span>
                                <?= $value ?>
                                <span class="text-gray-600 pl-1">(<?= number_format($count); ?>)</span>
                            </a>
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
