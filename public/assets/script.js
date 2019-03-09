jQuery("document").ready(function() {
    function renderLoginType()
    {
            if(jQuery("#select-login-type").val() == "admin")
                jQuery("#password-group").show();
            else
                jQuery("#password-group").hide();
    }

    function renderDetailType()
    {
        if(jQuery("#select-entry-type").val() == "text")
        {
                jQuery("#detailstype-text").show();
                jQuery("#detailstype-image").hide();
        }        
        else
        {
            jQuery("#detailstype-text").hide();
            jQuery("#detailstype-image").show();
        }
    }

    renderLoginType();
    renderDetailType();

    jQuery("#select-login-type").change(function(){
        renderLoginType();    
    });

    jQuery("#select-entry-type").change(function(){
        renderDetailType();    
    });

    setTimeout(function() {
        jQuery("div.alert").hide();
    }, 5000);


});
