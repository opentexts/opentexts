<?php
use Solarium\Component\Result\Facet\FacetResultInterface;
const ACTIVE_FILTER_CLASSES = 'text-blue-800 font-semibold';
const INACTIVE_FILTER_CLASSES = 'text-gray-700';
function render_facetset(string $key, ?string $currentValue, string $pluralNoun, FacetResultInterface $facet)
{
    $facetarray = $facet->getValues();
    $values = explode("|", urldecode($currentValue));
    $defaultActive = $currentValue == null;
    $defaultValue = "All " . $pluralNoun;
    $multiValue = "Multiple " . $pluralNoun;
    ?>
    <div data-key="<?= esc($key) ?>" data-plural="<?= esc($pluralNoun) ?>"  tabindex="0" class="outline-none cursor-pointer py-2 mr-6 filter">
        <div class="flex items-center">
            <span class="text-gray-700 focus:text-blue-700"><?= $currentValue == "" ? $defaultValue : (count($values) > 1 ? $multiValue : $currentValue); ?></span>
            <span class="text-gray-600 pl-1 icon-sm"><?php echo file_get_contents('svg/chevron-down.svg'); ?></span>
        </div>

    <div class="rounded-md absolute filter-dropdown overflow-y-auto bg-gray-100 shadow-lg -ml-6">
        <ul class="list-group list-group-flush py-3 pr-3">
            <li tabindex="0">
                <a class="flex items-center p-1 border-2 border-transparent hover:text-blue-700 focus:text-blue-700 focus:border-blue-500 no-underline <?= $defaultActive != null ? ACTIVE_FILTER_CLASSES : INACTIVE_FILTER_CLASSES ?>">
                    <span class="block text-gray-600 w-5 icon-sm <?= $defaultActive ? "" : "invisible" ?>"><?php echo file_get_contents('svg/check.svg'); ?></span>
                    <span><?= $defaultValue ?></span>
                </a>
            </li>
            <?php
            foreach ($facetarray as $value => $count) {
                if ($count > 0) {
                    $active = in_array($value, $values);
                    ?>
                        <li tabindex="0">
                            <a class="flex items-center p-1 border-2 border-transparent hover:text-blue-700 focus:text-blue-700 focus:border-blue-500 no-underline <?= $active ? ACTIVE_FILTER_CLASSES : INACTIVE_FILTER_CLASSES ?>">
                                <span class="block text-gray-600 w-5 icon-sm <?= $active ? "" : "invisible" ?>"><?php echo file_get_contents('svg/check.svg'); ?></span>
                                <span><?= $value ?></span>
                                <span class="text-gray-600 font-normal pl-1">(<?= number_format($count); ?>)</span>
                            </a>
                        </li>
                    <?php
                }
            }

        ?>
        </ul>
    </div>
    </div>
    <?php
}
