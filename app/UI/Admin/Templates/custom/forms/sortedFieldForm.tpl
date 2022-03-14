{**
* @author Tomasz Bielecki <tomasz.bi@modulesgarden.com>
*}

{if $rawObject->haveInternalAlertMessage()}
    <div class="lu-alert {if $rawObject->getInternalAlertSize() !== ''}lu-alert--{$rawObject->getInternalAlertSize()}{/if} lu-alert--{$rawObject->getInternalAlertMessageType()} lu-alert--faded modal-alert-top">
        <div class="lu-alert__body">
            {if $rawObject->isInternalAlertMessageRaw()|unescape:'html'}{$rawObject->getInternalAlertMessage()}{else}{$MGLANG->T($rawObject->getInternalAlertMessage())|unescape:'html'}{/if}
        </div>
    </div>
{/if}
{if $rawObject->getConfirmMessage()}
    {if $rawObject->isTranslateConfirmMessage()}
        {$MGLANG->T($rawObject->getConfirmMessage())|unescape:'html'}
    {else}
        {$rawObject->getConfirmMessage()|unescape:'html'}
    {/if}
{/if}

<form id="{$rawObject->getId()}" namespace="{$namespace}" index="{$rawObject->getIndex()}"
      mgformtype="{$rawObject->getFormType()}"
{foreach $htmlAttributes as $aValue} {$aValue@key}="{$aValue}" {/foreach}>
{if $rawObject->getClasses()}
<div class="{$rawObject->getClasses()}">
    {/if}
    {foreach from=$rawObject->getSortedFields() item=field }
        {$field->getHtml()}
    {/foreach}
    {if $rawObject->getClasses()}
</div>
{/if}
</form>