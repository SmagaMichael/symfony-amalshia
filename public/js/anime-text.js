$( ".button-avatar" ).click(function() {
// $( ".button-avatar" ).click(function() {
    $(".talk-bubble").removeAttr('hidden');
    "use strict";
    $(document).ready(function() {
      animate_text();
    });
    // -------------------
    function animate_text() 
    {
      let delay = 50,
          delay_start = 0,
          contents,
          letters;
    
      $(".animate-text").each(function(index, obj) {
        contents = $(obj).text().trim();
        $(obj).html(''); // on vide le contenu
        letters = contents.split("");
        $(letters).each(function(index_1, letter) {
          setTimeout(function() {
            // ---------
            // effet machine à écrire simple
            $(obj).html( $(obj).html() + letter ); // on ajoute chaque lettre l une après l autre
            // ---------
            // ---------
          }, delay_start + delay * index_1);
        });
        // le suivant démarre à la fin du précédent
        delay_start += delay * letters.length;
      });
    }

  });