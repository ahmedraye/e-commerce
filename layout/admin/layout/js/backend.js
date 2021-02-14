jQuery(function(){
    'use strict';
    // hide section in dashboard
    $('.toggle-inf').click(function(){
        $(this).toggleClass('select').parent().parent().next('.card-body').fadeToggle(100);
        if($(this).hasClass('select')){
            $(this).html('<i class="fa fa-minus fa-lg float-right"></i>');
        }else{
            $(this).html('<i class="fa fa-plus fa-lg float-right"></i>');
        }

    });
    //to valid input text
    $('.valid').blur(function(){
        if(!$(this).val()){
            $(this).addClass('is-invalid');
        }else{
            //console.log( $(this).val().length);
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });


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