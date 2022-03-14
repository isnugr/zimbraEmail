{**********************************************************************
* ZimbraEmail product developed. (2017-08-24)
* *
*
*  CREATED BY MODULESGARDEN       ->       http://modulesgarden.com
*  CONTACT                        ->       contact@modulesgarden.com
*
*
* This software is furnished under a license and may be used and copied
* only  in  accordance  with  the  terms  of such  license and with the
* inclusion of the above copyright notice.  This software  or any other
* copies thereof may not be provided or otherwise made available to any
* other person.  No title to and  ownership of the  software is  hereby
* transferred.
*
*
**********************************************************************}

{**
* @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
*}

<div class="row-fluid">
    <div class="box light" id="{$elementId}">
        <div class="box-title tabbable-line" style="border-bottom: 1px solid #eee!important;">
{***CONTAINER*HEADER*TITLE***********************************************************}
            <div class="caption" style="display: inline-block!important; max-width: 30%;">
                <i class="fa fa-th font-red-thunderbird"></i>
                <span class="caption-subject bold font-red-thunderbird uppercase">
                    {$MGLANG->controlerContextT('title')}
                </span>
            </div>
        </div>
{***DATATABLES*BODY*****************************************************************}
        <div class="lu-row">
            {assign var="firstArrKey" value=$elements|array_keys}                
            {if $elements}
                <ul class="lu-nav nav-tabs" style="display: inline-block!important; max-width: 70%;">
                    {foreach from=$elements key=tplKey item=tplValue}     
                        <li {if $tplKey  === $firstArrKey[0]} class="active" {/if}><a  data-toggle="tab" href="#contTab{$tplValue->getId()}">{if $tplValue->getTitle()}{$tplValue->getTitle()}{else}{$tplValue->getRawTitle()}{/if}</a></li>
                    {/foreach}
                </ul>
            {/if}             
            <div class="lu-col-md-12">
                <div class="box-body">
                    <div class="lu-tab-content">
                        {foreach from=$elements key=tplKey item=tplValue}
                            <div id="contTab{$tplValue->getId()}" class="lu-tab-pane {if $tplKey === $firstArrKey[0]} active {/if}">
                                {$tplValue->getHtml()}
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

