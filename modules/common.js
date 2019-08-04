$(function () {
    window.mediaLoader = {};
    window.mediaLoader.groups = {};

    //Define functions
    function findValueByPrefix(object, prefix) {
        var result = [];
        for (var property in object) {
            if (object.hasOwnProperty(property) && property.toString().startsWith(prefix)) {
                result.push(object[property]);
            }
        }
        return result;
    }

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

    function LoadImage() {
        var el = $(this).parent();
        var image = el.attr("image");
        var unloadtext = el.attr("unloadtext");
        el.html("<span class='MediaUnloadText'>" + unloadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a><br>" + image);
        var child = el.children()[0];
        child.onclick = UnloadImage;
    }
    function UnloadImage() {
        var el = $(this).parent();
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
        el.children().click(LoadImage)
    }

    function LoadAudio() {
        var el = $(this).parent();
        var volume = el.attr("volume");
        var loop = el.attr("loop");
        var auto = el.attr("autoplay");
        var src = el.attr("src");
        var unloadtext = el.attr("unloadtext");
        if (loop != undefined) {
            loop = "loop";
        } else {
            loop = "";
        }
        if (auto != undefined) {
            auto = "autoplay";
        } else {
            auto = "";
        }
        el.html("<span class='MediaUnloadText'>" + unloadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a><br><audio src='" + src + "' " + loop + " " + auto + " controls></audio>");
        var child = el.children()[0];
        child.onclick = UnloadAudio;
        el.children()[3].volume = volume;
    }
    function UnloadAudio() {
        var el = $(this).parent();
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
        el.children().click(LoadAudio)
    }

    function LoadVideo() {
        var el = $(this).parent();
        var volume = el.attr("volume");
        var loop = el.attr("loop");
        var auto = el.attr("autoplay");
        var src = el.attr("src");
        var width = el.attr("width");
        var height = el.attr("height");
        var unloadtext = el.attr("unloadtext");
        if (loop != undefined) {
            loop = "loop";
        } else {
            loop = "";
        }
        if (auto != undefined) {
            auto = "autoplay";
        } else {
            auto = "";
        }
        if (width != undefined) {
            width = "width='" + width + "'"
        } else {
            width = "";
        }
        if (height != undefined) {
            height = "height='" + height + "'"
        } else {
            height = "";
        }
        el.html("<span class='MediaUnloadText'>" + unloadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a><br><video src='" + src + "' " + loop + " " + auto + " controls " + width + " " + height + "></video>");
        var child = el.children()[0];
        child.onclick = UnloadVideo;
        el.children()[3].volume = volume;
    }
    function UnloadVideo() {
        var el = $(this).parent();
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
        el.children().click(LoadVideo)
    }

    function ManualLoadImage(el) {
        var image = el.attr("image");
        var unloadtext = el.attr("unloadtext");
        el.html("<span class='MediaUnloadText'>" + unloadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a><br>" + image);
        var child = el.children()[0];
        child.onclick = UnloadImage;
    }
    function ManualUnloadImage(el) {
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
        el.children().click(LoadImage)
    }

    function ManualLoadAudio(el) {
        var volume = el.attr("volume");
        var loop = el.attr("loop");
        var auto = el.attr("autoplay");
        var src = el.attr("src");
        var unloadtext = el.attr("unloadtext");
        if (loop != undefined) {
            loop = "loop";
        } else {
            loop = "";
        }
        /*if (auto != undefined) {
            auto = "autoplay";
        } else {*/
            auto = "";
        //}
        el.html("<span class='MediaUnloadText'>" + unloadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a><br><audio src='" + src + "' " + loop + " " + auto + " controls></audio>");
        var child = el.children()[0];
        child.onclick = UnloadAudio;
        el.children()[3].volume = volume;
    }
    function ManualUnloadAudio(el) {
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
        el.children().click(LoadAudio)
    }

    function ManualLoadVideo(el) {
        var volume = el.attr("volume");
        var loop = el.attr("loop");
        var auto = el.attr("autoplay");
        var src = el.attr("src");
        var width = el.attr("width");
        var height = el.attr("height");
        var unloadtext = el.attr("unloadtext");
        if (loop != undefined) {
            loop = "loop";
        } else {
            loop = "";
        }
        /*if (auto != undefined) {
            auto = "autoplay";
        } else {*/
            auto = "";
        //}
        if (width != undefined) {
            width = "width='" + width + "'"
        } else {
            width = "";
        }
        if (height != undefined) {
            height = "height='" + height + "'"
        } else {
            height = "";
        }
        el.html("<span class='MediaUnloadText'>" + unloadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a><br><video src='" + src + "' " + loop + " " + auto + " controls " + width + " " + height + "></video>");
        var child = el.children()[0];
        child.onclick = UnloadVideo;
        el.children()[3].volume = volume;
    }
    function ManualUnloadVideo(el) {
        var loadtext = el.attr("loadtext");
        el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
        el.children().click(LoadVideo)
    }

    function LoadAll() {
        var el = $(this);
        var filter = [].concat.apply([], findValueByPrefix(window.mediaLoader.groups, el.attr("group")));
        for(var el in filter){
            var e = filter[el];
            var ele = $('.MediaLoaderID'+e);
            var type = ele.attr("type");
            if(type == "audio"){
                ManualLoadAudio(ele);
            }
            else if(type == "image"){
                ManualLoadImage(ele);
            }
            else if(type == "video"){
                ManualLoadVideo(ele);
            }
        }
    }

    function UnloadAll() {
        var el = $(this);
        var filter = [].concat.apply([], findValueByPrefix(window.mediaLoader.groups, el.attr("group")));
        for(var el in filter){
            var e = filter[el];
            var ele = $('.MediaLoaderID'+e);
            var type = ele.attr("type");
            if(type == "audio"){
                ManualUnloadAudio(ele);
            }
            else if(type == "image"){
                ManualUnloadImage(ele);
            }
            else if(type == "video"){
                ManualUnloadVideo(ele);
            }
        }
    }

    function ToPrepareLoad() {
        var el = $(this);
        var loadtext = el.attr("loadtext");
        var type = el.attr("type");
        var group = el.attr("group");
        var mediaid = el.attr("mediaid")
        if (type == "image") {
            el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
            el.children()[0].onclick = LoadImage
        }
        else if (type == "audio") {
            el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
            el.children()[0].onclick = LoadAudio
        }
        else if (type == "video") {
            el.html("<span class='MediaLoadText'>" + loadtext + "</span> <a class='MediaLoadLink' href='"+el.attr("file")+"'>🔗</a>");
            el.children()[0].onclick = LoadVideo
        }
        if(window.mediaLoader.groups[group] == null){
            window.mediaLoader.groups[group] = [];
        }
        window.mediaLoader.groups[group].push(mediaid);
        el.removeClass("MediaLoad");
        el.parent().removeClass("MediaLoad");
    }
    $(".MediaLoad.MediaLoaderInner").each(ToPrepareLoad)

    function ToPrepareGroup() {
        var el = $(this);
        var loadtext = el.attr("loadtext");
        var unloadtext = el.attr("unloadtext");
        var group = el.attr("group");
        el.html("<span group='" + group + "' class='MediaLoadAllText'>" + loadtext + "</span><br><span group='" + group + "' class='MediaUnloadAllText'>" + unloadtext + "</span>");
        el.children()[0].onclick = LoadAll;
        el.children()[2].onclick = UnloadAll;
        el.removeClass("MediaLoaderGroupSet");
        el.parent().removeClass("MediaLoaderGroupSet");
    }
    $(".MediaLoaderGroupSet.MediaLoaderInner").each(ToPrepareGroup)
})