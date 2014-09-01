$(document).ready(function(){
	var username_box = $('.username').width();
	var panel_edit_profile = $('#column-info').height();
	$('.username>ul').css({'width': username_box});
	$('#column-images').css({'height': panel_edit_profile});
	$('#edit_profile_sidebar').css({'height': panel_edit_profile});

	$('.username').click(function(event){
		event.stopPropagation();
		$('.username>ul').slideToggle('fast');
	});

	$(".username>ul").on("click", function (event) {
        event.stopPropagation();
    });

   var croppic = new Croppic('front_cover', cropperOptions);
   var avatar_croppic = new Croppic('profile_avatar_big', cropperAvatar);
 });



$(document).on('click',function(){
	$('.username>ul').slideUp('fast');
});