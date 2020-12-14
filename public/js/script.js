$(document).ready(function() {
	$('form').submit(function(event) {
		var json;
		var form = this;	
		//Block for reporting errors
		var errorBlock = $('.error-block');
		var errorText = $('.error-text');

		var url = $(this).attr('action');
		event.preventDefault();

		$.ajax({	
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				try{
					json = jQuery.parseJSON(result)
					
					//This case happens frequently on the logout method
					if (json.url) {
						window.location.href = json.url;
					} 
					//And this one for the render new list after deleting or sorting info
					if (json.ar){
						let i = 0;
						for (f of $('form.user-form')){

							if(i >= json.ar.length){
								f.remove();
							}

							f.action = f.action.replace(/(\d+)/, json.ar[i].id)
							f.elements.login.value = json.ar[i].login;
							f.elements.name.value = json.ar[i].name;
							f.elements.second_name.value = json.ar[i].second_name;
							f.elements.gender.value = json.ar[i].gender;
							f.elements.date_of_birth.value = json.ar[i].date_of_birth;
							
							$('a.more-button')[i].href = $('a.more-button')[i].href.replace(/(\d+)/, json.ar[i].id)

							i++;
						}
						$('.pagination').html(json.pag);					
					}

					if (json.status == 404){

						errorBlock.css("opacity", "1");
						errorText.text(json.message);
					}

					if (json.status == 200){
						setTimeout (zeroOpacity, 5000, errorBlock);
					}
				} catch {
					console.log(result);
				}
			}		
		});
	});	
});

function zeroOpacity(el){
	el.css("opacity", "0");
}