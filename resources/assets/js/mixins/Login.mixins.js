

export default {
		methods:
		{
			  openLoginModal:function()
			  {
			    $('.modal').modal('hide');
	            $('#loginModal').modal('show');
	          },
	          openSignUpModal:function()
	          {
			    $('.modal').modal('hide');
	            $('#SignUpModal').modal()
	          },
	           closeAllPopups:function()
			  {
			    $('.modal').modal('hide');
	            // $('#loginModal').modal('hide');
	          },
	        
		}
}