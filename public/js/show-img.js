// On va corriger l'affichage du label pour l'upload des images
$('[type="file"]').on('change', function () {
   
    // On va afficher un aperçu de l'image avant l'upload
    let reader = new FileReader();
    // On doit écouter un événement pour faire quelque chose avec cette image
    reader.addEventListener('load', function (file) {
        console.log(file);

        // Cleaner les anciennes images
        $('.img-fluid').remove();
        // Je réupère l'image au format base64
        let base64 = file.target.result;
        // Je crée une balise img en JS
        let img = $('<img class="img-fluid mt-5" width="250" />');
        // Je mets le base64 dans le src de l'img
        img.attr('src', base64);
        // Afficher l'image dans la div .custom-file
        $('.div-img-change').prepend(img);
    });

    // Le JS va charger l'image en mémoire
    reader.readAsDataURL(this.files[0]);
}); // Fin du on('change')

