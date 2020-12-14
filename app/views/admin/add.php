<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header"><?=$title?></div>
        <div class="card-body">
			<form action="/admin/add" method="POST" id="form-add">
				<div class = "row">
					<div class = "col-sm-3">
						<label for="login">Login:</label>
					</div>
					<div class = "col-sm-9">
						<input name="login" type="text">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="pwd">password:</label>
					</div>
					<div class = "col-sm-9">
						<input name="pwd" type="text">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="name">Name:</label>
					</div>
					<div class = "col-sm-9">
						<input name="name" type="text">
					</div>
				</div>	
				<div class = "row">
					<div class = "col-sm-3">
						<label for="second_name">Second name:</label>
					</div>
					<div class = "col-sm-9">
						<input name="second_name" type="text">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="date_of_birth">Date of birth:</label>
					</div>
					<div class = "col-sm-9">
						<input name="date_of_birth" type="date">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="is_admin">Is admin:</label>
					</div>
					<div class = "col-sm-9">
						<input name="is_admin" type="checkbox">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="is_admin">Gender:</label>
					</div>
					<div class = "col-sm-9">
						<select name="gender" id="gender">
							<option value="male" >Male</option>
							<option value="female" >Female</option>
						</select><br>

					</div>
				</div>
				<input type="submit" value="Add user" class="btn btn-primary">
			</form>
        </div>
        <div class = "error-block" class = "row">
			<div class = "col-sm-12">
				<p class="error-text"></p>
			</div>
		</div>
    </div>
</div>