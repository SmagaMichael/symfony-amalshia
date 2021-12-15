$('#text-avatar-modal').on('hidden.bs.modal', function () {
  clearInterval(AjoutDeLettre())
});

$(".button-avatar").click(function () {
  $(".talk-bubble").removeAttr('hidden');
  $(document).ready(function () {
    animate_text();
  });
});


function animate_text() {

  var text = document.getElementById('animate-text');
  var splitText = text.innerText.split('');

  text.innerHTML = '';
  i = 0
  setInterval(function () {
    AjoutDeLettre()
  }
    , 50)

  function AjoutDeLettre() {
    if (i < splitText.length) {
      text.innerHTML += splitText[i];
      i++;
    }

  }
}

