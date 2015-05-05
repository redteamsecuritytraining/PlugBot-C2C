// Initialize jQuery Visualise
$(function(){
	$('#stats').visualize({type: 'bar', height: '275px', width: '600px'});
});

// Sidebar Toggle
var fluid = {
Toggle : function(){
	var default_hide = {"grid": true };
	$.each(
		["pagesnav", "commentsnav", "userssnav", "imagesnav"],
		function() {
			var el = $("#" + (this == 'accordon' ? 'accordion-block' : this) );
			if (default_hide[this]) {
				el.hide();
				$("[id='toggle-"+this+"']").addClass("hidden")
			}
			$("[id='toggle-"+this+"']")
			.bind("click", function(e) {
				if ($(this).hasClass('hidden')){
					$(this).removeClass('hidden').addClass('visible');
					el.slideDown();
				} else {
					$(this).removeClass('visible').addClass('hidden');
					el.slideUp();
				}
				e.preventDefault();
			});
		}
	);
}
}
jQuery(function ($) {
	if($("[id^='toggle']").length){fluid.Toggle();}
});

// Notification Animations
$(function () { 
$('.notification').hide().append('<span class="close" title="Dismiss"></span>').fadeIn('slow');
$('.notification .close').hover(
function() { $(this).addClass('hover'); },
function() { $(this).removeClass('hover'); }
);
$('.notification .close').click(function() {
$(this).parent().fadeOut('slow', function() { $(this).remove(); });
}); 

});



// jQuery UI - Live Search
$(function() {
		var availableTags = ["dashboard", "pages", "manage pages", "edit pages", "delete pages", "users", "manage users", "edit users", "delete users", "settings", "system settings", "server settings", "documentation", "help", "community forums", "contact"];
		$("#livesearch").autocomplete({
			source: availableTags
		});
	});



// jQuery UI - Dialog Box
	$(function() {
		$('#dialog').dialog({
			autoOpen: false,
			modal: true,
			width: 500
		})
		$('#opener').click(function() {
			$('#dialog').dialog('open');
			return false;
		});

	});


function confirmDelLogs() {
    var answer = confirm("Are you sure you want to erase all logs?")

    if (answer){
//            alert("Logs deleted")
            window.location = 'delLogs';
    }
}

function confirmDelJob(id, botkey, base_url) {
    var answer = confirm("Are you sure you want to delete this job?")

    if (answer){
//            alert("Job deleted")
            window.location = base_url+'delJob/'+id;
    }
}


function confirmDelApp(id, botkey) {
    var answer = confirm("Are you sure you want to delete this app?")

    if (answer){
//            alert("App deleted")
            window.location = 'delApp/'+id;
    }
}




$().ready(function() {

    $('#job_botkey').bind("change", function(){
        id = $(this).attr('value');
        corresponder = $('#job_app_random'); // next select menu
        $(corresponder).html('<option>Loading...</option>');

         $.ajax({
            type: "POST",
             url: "ajaxgetapp/"+id,
            data: ''+id,
            success: function(response){
            $(corresponder).html('').append(response);
            }
         });

    });

});


$().ready(function() {

    $('#job_app_random').bind("change", function(){
        id = $(this).attr('value');
        corresponder = $('input#textbox'); // next select menu

         $.ajax({
            type: "POST",
             url: "ajaxgetcmd/"+id,
            data: ''+id,
            success: function(response){
            $("input#job_command").val(response);

            }
         });

    });

});





$().ready(function() {

    $('#job_app_random').bind("change", function(){
        id = $(this).attr('value');
        corresponder = $('#job_output'); // next select menu
        $(corresponder).html('<option>Loading...</option>');

         $.ajax({
            type: "POST",
             url: "ajaxgetinteractive/"+id,
            data: ''+id,
            success: function(response){
            $(corresponder).html('').append(response);
            }

         });

    });

});



// Tool tips

$(function(){
    $(".app_tips").tipTip({defaultPosition:"right", maxWidth: "100"});
});





