$(function () {
    //Define functions
    window.MediaLoader = {};
    //To add ID handler
    var mediaID = 0;
    function ToSetID() {
        var el = $(this);
        el.addClass("MediaLoaderID" + mediaID)
        el.attr("mediaid", mediaID);
        mediaID++;
        el.removeClass("MediaLoaderID");
    }
    //Execute
    $(".MediaLoaderID").each(ToSetID)

    //To set handler
    function ToSet() {
        var el = $(this);
        if (el[0].tagName == "AUDIO" || el[0].tagName == "VIDEO") {
            var vol = el.attr("volume");
            if (vol != null) {
                el[0].volume = vol;
            }
            el.removeClass("MediaLoaderToSet");
        }
    }
    //Execute for performance reasons
    $(".MediaLoaderToSet").each(ToSet)

    function LoadImage(){
        var el = $(this).parent();
        var image = el.attr("image");
        var unloadtext = el.attr("unloadtext");
        el.html("<span class='MediaUnloadText'>"+unloadtext+"</span><br>"+image);
        var child = el.children();
        child.click(UnloadImage);
    }
    function UnloadImage(){
        var el = $(this).parent();
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>"+loadtext+"</span>");
        el.children(0).click(LoadImage)
    }

    function LoadAudio(){
        var el = $(this).parent();
        var volume = el.attr("volume");
        var loop = el.attr("loop");
        var src = el.attr("src");
        var unloadtext = el.attr("unloadtext");
        if(loop != undefined){
            loop = "loop";
        }else{
            loop = "";
        }
        el.html("<span class='MediaUnloadText'>"+unloadtext+"</span><br><audio src='"+src+"' "+loop+" controls></audio>");
        var child = el.children();
        child.click(UnloadAudio);
        el.children()[2].volume = volume;
    }
    function UnloadAudio(){
        var el = $(this).parent();
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>"+loadtext+"</span>");
        el.children(0).click(LoadAudio)
    }

    function LoadVideo(){
        var el = $(this).parent();
        var volume = el.attr("volume");
        var loop = el.attr("loop");
        var src = el.attr("src");
        var width = el.attr("width");
        var height = el.attr("height");
        var unloadtext = el.attr("unloadtext");
        if(loop != undefined){
            loop = "loop";
        }else{
            loop = "";
        }
        if(width != undefined){
            width = "width='"+width+"'"
        }else{
            width = "";
        }
        if(height != undefined){
            height = "height='"+height+"'"
        }else{
            height = "";
        }
        el.html("<span class='MediaUnloadText'>"+unloadtext+"</span><br><video src='"+src+"' "+loop+" controls "+width+" "+height+"></video>");
        var child = el.children();
        child.click(UnloadVideo);
        el.children()[2].volume = volume;
    }
    function UnloadVideo(){
        var el = $(this).parent();
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>"+loadtext+"</span>");
        el.children(0).click(LoadVideo)
    }

    function ToPrepareLoad() {
        var el = $(this);
        var loadtext = el.attr("loadtext");
        var type = el.attr("type");
        if(type == "image"){
            el.html("<span class='MediaLoadText'>"+loadtext+"</span>");
            el.children(0).click(LoadImage)
        }
        else if(type == "audio"){
            el.html("<span class='MediaLoadText'>"+loadtext+"</span>");
            el.children(0).click(LoadAudio)
        }
        else if(type == "video"){
            el.html("<span class='MediaLoadText'>"+loadtext+"</span>");
            el.children(0).click(LoadVideo)
        }
    }

    $(".MediaLoad").each(ToPrepareLoad)
})