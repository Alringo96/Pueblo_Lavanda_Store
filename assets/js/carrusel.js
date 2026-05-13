$(document).ready(function(){
  const $carousel = $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: false, // Desactivamos los botones por defecto
    dots: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    center: true,
    responsive: {
      0: { items: 1 },
      600: { items: 1 },
      1000: { items: 3 }
    }
  });

  // Mover los dots dentro de nuestro contenedor personalizado
  $('.owl-dots-wrapper').append($('.owl-dots'));

  // Eventos para tus botones personalizados
  $('#custom-prev').click(function() {
    $carousel.trigger('prev.owl.carousel');
  });

  $('#custom-next').click(function() {
    $carousel.trigger('next.owl.carousel');
  });
});
