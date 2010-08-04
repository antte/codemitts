$(document).ready(function(){
	if($("#loginForm").length) {

		$("#loginForm p").remove();
		$("#loginForm").css({marginTop: "-18px"});
		
		var loginForm = $("#loginForm form:first-child");
		var formAction = "login";
		
		var radioStyle = "width: 20px; height: 20px; float: left;";
		var labelStyle = "width: 200px; float: left; clear: right;";
		
		$('<form id="actionSelection"></form>').insertBefore("#loginForm form:first-child > :first-child")
		.append('<input style="'+radioStyle+'" type="radio" name="action" value="login" id="login" checked="checked" />')
		.append('<label style="'+labelStyle+'" for="login">Log in</label>')
		.append('<input style="'+radioStyle+'" type="radio" name="action" value="register" id="register" />')
		.append('<label style="'+labelStyle+' margin-bottom: 10px;'+'" for="register">Register</label>')
		//.append('<input style="'+radioStyle+'" type="radio" name="action" value="forgot" id="forgot" />')
		//.append('<label style="'+labelStyle+'" for="forgot">Forgot password?</label>')
		;
		
		$(loginForm).children('.input.password').children('label[for="UserPassword"]').clone().html('Retype Password').attr('for', 'UserRepassword').attr('disabled', 'disabled').css({marginTop: "10px"}).appendTo('.input.password').hide();
		$(loginForm).children('.input.password').children('input[id="UserPassword"]').clone().attr('id', 'UserRepassword').attr('name', 'data[User][repassword]').attr('disabled', 'disabled').appendTo('.input.password').hide();
		
		$("#actionSelection input").click(function() {
			
			var action = $(this).attr("value");
			formAction = $(this).attr("value");
			
			if(action == "login") {
				$("#usernameAvailability").remove();
			}
			
			if(action == "register") {
				
				changeFormAction('register');
				
				$(loginForm).children('.submit').children('input').attr('value', 'Register now!');
				
				$('label[for="UserRepassword"]').removeAttr('disabled').show();
				$('#UserRepassword').removeAttr('disabled').show();
				
				$('#UserLoginForm input#UserUsername').focus();
				
			} else if (action == "login") {
				
				changeFormAction('login');
				
				$(loginForm).children('.submit').children('input').attr('value', 'Login');
				
				$('label[for="UserRepassword"]').attr('disabled', 'disabled').hide();
				$('#UserRepassword').attr('disabled', 'disabled').hide();		
				
				$('#UserLoginForm input#UserUsername').focus();
				
			}
			
		});
		
		function changeFormAction(action) {
			
			var currentFormAction = $(loginForm).attr('action');
			
			var urlFragments = currentFormAction.split("/");
			
			urlFragments[urlFragments.length-1] = action;
			
			$(loginForm).attr('action', urlFragments.join("/"));
		}
		
		/* Username availability check */
		
		$("input#UserUsername").keyup(function() {
			if(formAction == "register") {
				checkAvailability($(this));
			}
		});	
		
		function checkAvailability(input) {
			
			var username = $(input).val();
			
			var url = window.location.href;
			
			var urlFragments = url.split("/");
			
			urlFragments[urlFragments.length-2] = 'users';
			urlFragments[urlFragments.length-1] = 'checkAvailability';
			urlFragments[urlFragments.length] = username;
			
			url = urlFragments.join('/');
			
			$.ajax({
				type: "GET",
				url: url,
				success: function(result) {
					if (result[0] == "1") {
						usernameAvailable(input, true);
					} else if (result[0] == "0") {
						usernameAvailable(input, false);
					}
				}
			});
		}
		
		function usernameAvailable(input, bool) {
			
			var availabilityBox = "#usernameAvailability";
			
			if(!($(availabilityBox).length)) {
				$('<p id="usernameAvailability" class="message notice"></p>').appendTo($(input).parent());
			}
			
			if(bool) {
				$(availabilityBox).removeClass('error');
				$(availabilityBox).addClass('notice');
				$(availabilityBox).text("Username available");
			} else {
				$(availabilityBox).removeClass('notice');
				$(availabilityBox).addClass('error');
				$(availabilityBox).text("Username not available");
			}
			
		}
		
	}
});