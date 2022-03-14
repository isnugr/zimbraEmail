{if $rawObject->getFeatures()}
    <div class="lu-h4 lu-m-b-3x lu-m-t-3x">{$MGLANG->absoluteT('addonCA','homePage','manageHeader')}</div>
    <div class="lu-tiles lu-row row--eq-height">
        {foreach from=$rawObject->getFeatures() key=setting item=controller}
            <div class="lu-col-sm-20p">
                <a class="lu-tile lu-tile--btn" href="{$controller->getUrl()}" {if $controller->isTargetBlank()} target="_blank" {/if}>
                    <div class="lu-i-c-6x">
                        <img src="{$controller->getIcon()}" alt="">
                    </div>
                    <div class="lu-tile__title">{$MGLANG->absoluteT('addonCA' , 'homeIcons' ,$controller->getTitle())}</div>
                </a>
            </div>
        {/foreach}
    </div>
{/if}
