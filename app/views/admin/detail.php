<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header"><?echo $user['login'];?></div>
        <div class="card-body">
			<form action="/admin/edit/<?=$user['id']?>" method="POST" id="form-edit">
				<div class = "row">
					<div class = "col-sm-3">
						<label for="login">login:</label>
					</div>
					<div class = "col-sm-9">
						<input name="login" type="text" value="<?echo $user['login'];?>">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="name">name:</label>
					</div>
					<div class = "col-sm-9">
						<input name="name" type="text" value="<?echo $user['name'];?>">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="pwd"> password:</label>
					</div>
					<div class = "col-sm-9">
						<input name="pwd" type="text" value="<?echo $user['pwd'];?>">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="second_name">second name:</label>
					</div>
					<div class = "col-sm-9">
						<input name="second_name" type="text" value="<?echo $user['second_name'];?>">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="gender">gender:</label>
					</div>
					<div class = "col-sm-9">
						<input name="gender" type="text" value="<?echo $user['gender'];?>">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-3">
						<label for="date_of_birth">date of birth:</label>
					</div>
					<div class = "col-sm-9">
						<input name="date_of_birth" type="date" value="<?echo $user['date_of_birth'];?>">
					</div>
				</div>
				<div class = "row">
					<div class = "col-sm-4">
						<input type="submit" value="Confirm changes" class="btn btn-primary">
					</div>
					<div class = "col-sm-4">
						<a href="/admin/list" class="btn btn-primary">Home</a > 
					</div>
				</div>
				
					
				<div class = "error-block" class = "row">
					<div class = "col-sm-12">
						<p class="error-text">123</p>
					</div>
				</div>
			</form>
        </div>
        
    </div>
</div>
