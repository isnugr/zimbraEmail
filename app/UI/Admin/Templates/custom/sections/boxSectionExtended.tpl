<div class="lu-widget" id="{$rawObject->getId()}">
    {if ($rawObject->getRawTitle() || $rawObject->getTitle()) && $rawObject->isViewHeader()}
        <div class="lu-widget__header">
            <div class="lu-widget__top lu-top">
                <div class="lu-top__title">
                    {if $rawObject->getIcon()}<i class="{$rawObject->getIcon()}"></i>{/if}
                    {if $rawObject->isRawTitle()}{$rawObject->getRawTitle()}{elseif $rawObject->getTitle()}{$MGLANG->T($rawObject->getTitle())}{/if}
                </div>

                <div class="lu-top__toolbar" style="padding-top:15px;">
                    {if $rawObject->getTooltip()}{$rawObject->getTooltip()->getHtml()}{/if}
                </div>
            </div>
        </div>
    {/if}
    <div class="lu-widget__body">
        <div class="lu-widget__content">
            {if $rawObject->getElementById('sectionDescription')}
                {$rawObject->insertElementById('sectionDescription')}
            {/if}
            <div class="lu-row">
                {if $rawObject->getFields()}
                    <div class="lu-col-md-6 lu-p-r-4x">
                        {foreach from=$rawObject->getFields() item=field }
                            {$field->getHtml()}
                        {/foreach}
                    </div>
                {/if}
                {if $rawObject->getSections()}
                    {foreach from=$rawObject->getSections() item=section }
                        {$section->getHtml()}
                    {/foreach}
                {/if}
            </div>
        </div>
    </div>
</div>