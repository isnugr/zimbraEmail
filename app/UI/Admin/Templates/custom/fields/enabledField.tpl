<span class="lu-label lu-label--{$rawObject->getType()} lu-label--status">
    {if $rawObject->isRawTitle()}{$rawObject->getRawTitle()}{elseif $rawObject->getTitle()}{$MGLANG->T($rawObject->getTitle())}{/if}
</span>