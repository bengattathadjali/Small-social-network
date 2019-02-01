function scroller(href){
  $('html,body').animate({ scrollTop: ($(href).offset().top)}, 700).promise().done(function(){
    console.log('yoann');
  });
}
$(function(){
})