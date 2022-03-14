<div class="lu-form-group">
    <label class="lu-form-label">
        {if $rawObject->isRawTitle()}{$rawObject->getRawTitle()}{elseif $rawObject->getTitle()}{$MGLANG->T($rawObject->getTitle())}{/if}

        {if $rawObject->isRawDescription()}
            <i data-title="{$rawObject->getRawDescription()}" data-toggle="lu-tooltip" class="lu-i-c-2x lu-zmdi lu-zmdi-help-outline lu-form-tooltip-helper"></i>
        {elseif $rawObject->getDescription()}
            <i data-title="{$MGLANG->T($rawObject->getDescription())}" data-toggle="lu-tooltip" class="lu-i-c-2x lu-zmdi lu-zmdi-help-outline lu-form-tooltip-helper"></i>
        {/if}
    </label>
    <input class="lu-form-control" type="{$rawObject->getFieldType()}" placeholder="{$rawObject->getPlaceholder()}" name="{$rawObject->getName()}"
           value="{$rawObject->getValue()}" {if $rawObject->isDisabled()}disabled="disabled"{/if}
    {foreach $htmlAttributes as $aValue} {$aValue@key}="{$aValue}" {/foreach}>
    <div class="lu-form-feedback lu-form-feedback--icon" hidden="hidden">
    </div>
</div>