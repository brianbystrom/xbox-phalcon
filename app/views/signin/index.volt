{% extends "templates/base.volt" %}


{% block content %}
	<div class='signin-container'>
		<form class='form-signin' method='post' action='{{ url('signin/doSignin') }}'>
			<h2 class='form-signin-heading'>Please sign in</h2>
			<input type='text' name='email' class='form-control' placeholder='Email address'>
			<input type='password' name='password' class='form-control' placeholder='Password'>
			<input class='btn btn-lg btn-primary btn-block' type='submit' value='Sign in'>
		</form>
	</div>
{% endblock %}