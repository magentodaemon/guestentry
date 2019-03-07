jQuery("document").ready(function() {
    
        renderLoginType();
        
        jQuery("#select-login-type").change(function(){
            renderLoginType();    
        });


    function renderLoginType()
    {
            if(jQuery("#select-login-type").val() == "admin")
                jQuery("#password-group").show();
            else
                jQuery("#password-group").hide();
    }
});
