jQuery(function(){
    'use strict';
    //hide palceholder on input foucs
    $('[placeholder]').focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });

    $('input').each(function(){
        if($(this).attr('required')){
            $(this).after('<span class="asterisk">*</span>');
        }
    });

    //confrim delete user
    $('.Confirm').click(function(){
        return confirm('Do you want Delete user');
    });
});