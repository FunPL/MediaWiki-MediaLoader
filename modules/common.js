$(function(){
    //Define functions
    window.MediaLoader = {};
    //To add ID handler
    var mediaID = 0;
    function ToSetID(){
        var el = $(this);
        el.addClass("MediaLoaderID"+mediaID)
        el.attr("mediaid", mediaID);
        mediaID++;
        el.removeClass("MediaLoaderID");
    }
    //Execute
    $(".MediaLoaderID").each(ToSetID)

    //To set handler
    function ToSet(){
        var el = $(this);
        if(el[0].tagName == "AUDIO" || el[0].tagName == "VIDEO"){
            var vol = el.attr("volume");
            if(vol != null){
                el[0].volume = vol;
            }
            el.removeClass("MediaLoaderToSet");
        }
    }
    //Execute for performance reasons
    $(".MediaLoaderToSet").each(ToSet)

    function LoadImage(){
        
    }

    if($(".MediaLoad").length > 0){
        window.MediaLoader.LoadAudio
    }
})