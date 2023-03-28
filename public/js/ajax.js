$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<div class="text-center mt-5"><div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div></div>',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
})


// Ajax

function like(myForm, liked) {
$(document).on('submit', myForm, function (event) { 
event.preventDefault();
var id = $(this).data('id');
var route = $(this).attr('action');
$.ajax({
    url         :       route,
    type        :       "POST",
    data        :       {"_token": $('#csrf-token')[0].content, "liked": liked},
    }).done(function (data) {
        $('#l-' + id).html(data.html);
    });
});
}

like('.like', true);
like('.dislike', false);



$(document).on('submit', '.follow', function (event) { 
event.preventDefault();
var el = this;
var style = $(this).children('button').hasClass('style') ? 'style' : '';
var userid = $(this).children('.not-userid').val();
var route = $(this).attr('action');
var msg = $(el).children().text().trim();
var modals = [];

$.ajax({
url         :       route,
type        :       "POST",
data        :       {"_token": $('#csrf-token')[0].content, "styleClass" : style, "user_id": userid},
success     :       function(data) {
                        $(el).html(data.html);
                        modals.push({position: 'bottom-end',icon: 'success',html: `<span>${msg === 'Follow' ? 'You Started Following ' : 'You Unfollowed ' }<strong>${data.username}</strong></span>`,showConfirmButton: false,timerProgressBar:true,toast:true,timer: 2500});
                        swal.queue(modals);
                    }
});
});

$(document).on('submit', '.delete-tweet', function (event) { 
event.preventDefault();
var el = this;
var route = $(this).attr('action');

Swal.fire({
    title: 'Are you sure You Want To Delete Your Tweet?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Delete'
    
}).then((result) => {
    if (result.isConfirmed) {
        Swal.fire({
            icon: 'success',
            title: 'Deleted!',
            text: 'Your Tweet has been deleted.',
            showConfirmButton: false,
            timer: 1500
        });
        $.ajax({
        url         :       route,
        type        :       "DELETE",
        data        :       {"_token": $('#csrf-token')[0].content},
        success     :       function(data) {        
                                $(el).closest('.media').fadeOut(1000, function () {
                                    $(this).remove();
                                });
                            }
        });
    }
})
});


$(document).on('submit', '.publish', function (event) { 
event.preventDefault();
var route = $(this).attr('action');
$.ajax({
url         :       route,
type        :       "POST",
data        :       $(this).serializeArray(),
success     :       function (data) {
                        $('.b-error').html('').parent().animate({height: 190},400);
                        $('.timeline').fadeOut(100, function () {
                            $(this).html(data.html).fadeIn();
                        });
                        $('.publish textarea').val('');
                        $('.publish .count').text('255');
                    },
error:              function (xhr) {
                        $('.b-error').parent().animate({height: 250},400);
                        $('.b-error').html('').fadeOut(100, function () {
                            $(this).fadeIn(400, function () {
                                $.each(xhr.responseJSON.errors, function(key,value) {
                                    $('.b-error').append('<div>'+value+'</div');
                                }); 
                            });
                        });
                    },
});
});