/**
 *
 *
 * Modal position fix.
 * add custom class if modal height is bigger than window.
 */
mgEventHandler.on('ModalLoaded', null,function(){

    $('.lu-modal__dialog').each(function(index){
        var self = $(this);
        var pixelDiff = $(window).height() - self.height();

        if(pixelDiff < 30)
        {
            self.addClass('lu-modal_fixed_position');
        }
    });
});