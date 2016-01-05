function scrollToAnchor(aid){
    var aTag = $("section[name='"+ aid +"']");
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

