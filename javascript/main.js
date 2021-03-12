$(document).ready(()=>{
  $('body').addClass('visible');
});
$('.filter-ico').click((el)=>{
  $(el.target).toggleClass('enabled');
})
$(".fav").click((el)=> {
  
    p = $(el.target);

    p.toggleClass('isfav nofav')

    if(p.hasClass('click'))
      {
        p.removeClass('click');
        setTimeout(()=>{p.addClass('click')},1);
      }
    else
      {
        p.addClass('click');
      }
  })
$('.filter-ico').click(()=>{
let filters = $('.filters_list');
filters.addClass('show');
$('body').addClass('overflow-hidden');
$('.close').click(()=>{
filters.removeClass('show');
$('body').removeClass('overflow-hidden');
})
});