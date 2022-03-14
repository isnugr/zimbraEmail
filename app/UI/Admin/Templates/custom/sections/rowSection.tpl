<div class='lu-row'>
    {foreach from=$rawObject->getSections() item=section }
        {$section->getHtml()}
    {/foreach}
    {foreach from=$rawObject->getFields() item=field }
        {$field->getHtml()}
    {/foreach}
</div>